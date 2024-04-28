<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ManagePublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Publikasi';
        $data['publicationData'] = Publication::latest()->paginate(10);

        return view('admin.publication.publication_list', $data);
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
            'gambar' => ['image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
        ]);

        // Store the image
        if ($request->hasFile('gambar')) {
            // Get the uploaded file
            $gambar = $request->file('gambar');

            // Generate a unique filename
            $filename = time() . '_' . $gambar->getClientOriginalName();

            // Store the image in the storage directory
            $path = $gambar->storeAs('public/frontend/assets/img', $filename);

            // Update the 'gambar' field in the database with the image path
            $validatedData['gambar'] = $path;
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
        ]);

        // Store the image
        if ($request->hasFile('gambar')) {
            // Get the uploaded file
            $gambar = $request->file('gambar');

            // Generate a unique filename
            $filename = time() . '_' . $gambar->getClientOriginalName();

            // Store the image in the storage directory
            $path = $gambar->storeAs('public/frontend/assets/img', $filename);

            // Update the 'gambar' field in the database with the image path
            $validatedData['gambar'] = $path;
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
        $publication->delete();

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($publication)->log($getUser . ' melakukan delete data Publikasi');

        return redirect(route('admin.managePublication'))->with('success', 'Data berhasil dihapus!');
    }
}
