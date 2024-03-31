<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManagePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Manage Internship Roles';

        $data['positionData'] = Position::all();

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

        Position::create($validatedData);

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
    public function edit($slug)
    {
        $data['pageTitle'] = 'Edit Roles';

        $data['positionData'] = Position::where('slug', $slug)->get();

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

        $position = Position::where('id', $position->id)->update($validatedData);

        return redirect(route('admin.managePosition'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $position = Position::find($id);
        $position->delete();

        return redirect(route('admin.managePosition'))->with('success', 'Data berhasil dihapus!');
    }
}
