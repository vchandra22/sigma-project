<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

class ManagePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Manage Internship Roles';

        $data['positionData'] = Position::latest()->get();

        return view('admin.position.position_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Posisi';

        return view('admin.position.position_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role' => ['required'],
            'deskripsi' => ['required'],
            'jobdesk' => ['required'],
            'requirement' => ['required'],
            'gambar' => ['image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $directoryPath = 'img';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('public')->makeDirectory($directoryPath, 0777, true, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('/img/' . $filename, File::get($file));
            $validatedData['gambar'] = $filename;
        } else {
            // Code block intentionally left empty
        }
        $position = Position::create($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($position)->log($getUser . ' melakukan tambah data Posisi Pekerjaan baru');

        return redirect(route('admin.managePosition'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['pageTitle'] = 'Edit Roles';

        $data['positionData'] = Position::where('uuid', $uuid)->get();
        $data['metaData'] = Meta::where('slug', "home")->get();

        return view('admin.position.position_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $validatedData = $request->validate([
            'role' => ['required'],
            'deskripsi' => ['required'],
            'jobdesk' => ['required'],
            'requirement' => ['required'],
            'gambar' => ['image', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $directoryPath = 'img';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('public')->makeDirectory($directoryPath, 0777, true, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('/img/' . $filename, File::get($file));
            $validatedData['gambar'] = $filename;
        } else {
            // Code block intentionally left empty
        }

        $newSlug = Str::slug($request->input('role'));

        if ($newSlug !== $position->slug) {
            $count = 1;
            $slugExists = Position::where('slug', $newSlug)->exists();
            while ($slugExists) {
                $newSlug = $newSlug . '-' . $count;
                $slugExists = Position::where('slug', $newSlug)->exists();
                $count++;
            }
            $position->slug = $newSlug;
        }

        $validatedData['slug'] = $newSlug;
        $position = Position::where('uuid', $position->uuid)->update($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($position)->log($getUser . ' melakukan update data Posisi Pekerjaan');


        return redirect(route('admin.managePosition'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $position = Position::find($id);
        $position->delete();

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($position)->log($getUser . ' melakukan delete data Posisi Pekerjaan');

        return redirect(route('admin.managePosition'))->with('success', 'Data berhasil dihapus!');
    }
}
