<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use File;

class ManagePublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Publikasi';

        return view('admin.publication.publication_list', $data);
    }

    /**
     * Display a listing of the publikasi data.
     */
    public function tablePublication()
    {
        $query = Publication::latest();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('judul', function ($data) {
                return $data->judul;
            })
            ->editColumn('content', function ($data) {
                $excerpt = strip_tags($data->content);
                if (strlen($excerpt) > 500) {
                    $excerpt = mb_strimwidth($excerpt, 0, 500, "...");
                }
                return $excerpt;
            })
            ->addColumn('opsi', function ($data) {
                $editRoute = route('admin.editPublication', $data->uuid);
                $deleteRoute = route('admin.deletePublication', ['id' => $data->id]);

                return '
                <div class="flex items-center h-full gap-4">
                    <a href="' . $editRoute . '" class="py-2 text-center text-md text-blue-500 hover:underline">
                        Edit
                    </a>
                    <form id="delete-publication-' . $data->id . '" action="' . $deleteRoute . '" method="POST">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <div class="py-2 text-center text-md text-red-500 hover:underline">
                            <button class="delete-button" data-id="' . $data->id . '" type="submit" value="Delete">Hapus</button>
                        </div>
                    </form>
                </div>';
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Publikasi';

        return view('admin.publication.publication_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => ['required'],
            'content' => ['required'],
            'gambar' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
            // meta validation
            'meta_title' => ['nullable', 'max:255', 'min:10'],
            'meta_description' => ['nullable', 'max:255'],
            'meta_keywords' => ['nullable'],
            'og_image' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048', 'nullable'],
        ]);

        if (isset($validatedData['gambar'])) {
            // Process 'ttd_kepala' if it exists
            if ($request->hasFile('gambar')) {
                // Handle file upload and storage
                $file = $request->file('gambar');
                $directoryPath = 'img';

                // Create directory if not exists
                if (!file_exists($directoryPath)) {
                    Storage::disk('public')->makeDirectory($directoryPath, 0775, true);
                }

                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put('/img/' . $filename, File::get($file));
                $validatedData['gambar'] = $filename;
            }
        }

        if (isset($validatedData['og_image'])) {
            // Process 'ttd_kepala' if it exists
            if ($request->hasFile('og_image')) {
                // Handle file upload and storage
                $file = $request->file('og_image');
                $directoryPath = 'img';

                // Create directory if not exists
                if (!file_exists($directoryPath)) {
                    Storage::disk('public')->makeDirectory($directoryPath, 0775, true);
                }

                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put('/img/' . $filename, File::get($file));
                $validatedData['og_image'] = $filename;
            }
        }

        $publication = Publication::create($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($publication)->log($getUser . ' melakukan tambah data Publikasi baru');

        return redirect(route('admin.managePublication'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['pageTitle'] = 'Edit Publikasi';
        $data['publicationData'] = Publication::where('uuid', $uuid)->get();

        return view('admin.publication.publication_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        $validatedData = $request->validate([
            'judul' => ['required'],
            'content' => ['required'],
            'gambar' => ['image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
            // meta validation
            'meta_title' => ['nullable', 'max:255', 'min:10'],
            'meta_description' => ['nullable', 'max:255'],
            'meta_keywords' => ['nullable'],
            'og_image' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048', 'nullable'],
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $directoryPath = 'img';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('public')->makeDirectory($directoryPath, 0775, true);
            }

            // Delete old 'gambar' if it exists
            if ($publication->gambar) {
                Storage::disk('public')->delete('img/' . $publication->gambar);
            }

            // Handle file upload and storage
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('/img/' . $filename, File::get($file));
            $validatedData['gambar'] = $filename;
        }

        if ($request->hasFile('og_image')) {
            $file = $request->file('og_image');
            $directoryPath = 'img';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('public')->makeDirectory($directoryPath, 0775, true);
            }

            // Delete old 'gambar' if it exists
            if ($publication->gambar) {
                Storage::disk('public')->delete('img/' . $publication->og_image);
            }

            // Handle file upload and storage
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('/img/' . $filename, File::get($file));
            $validatedData['og_image'] = $filename;
        }

        $newSlug = Str::slug($request->input('judul'));

        if ($newSlug !== $publication->slug) {
            $count = 1;
            $slugExists = Publication::where('slug', $newSlug)->exists();
            while ($slugExists) {
                $newSlug = $newSlug . '-' . $count;
                $slugExists = Publication::where('slug', $newSlug)->exists();
                $count++;
            }
            $publication->slug = $newSlug;
        }

        $validatedData['slug'] = $newSlug;
        $publication = Publication::where('uuid', $publication->uuid)->update($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($publication)->log($getUser . ' melakukan update data Publikasi');

        return redirect(route('admin.managePublication'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $publication = Publication::find($id);
        if ($publication->gambar) {
            Storage::disk('public')->delete('/img/' . $publication->gambar);
        }

        if ($publication->og_image) {
            Storage::disk('public')->delete('/img/' . $publication->og_image);
        }

        $publication->delete();

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($publication)->log($getUser . ' melakukan delete data Publikasi');

        return redirect(route('admin.managePublication'))->with('success', 'Data berhasil dihapus!');
    }
}
