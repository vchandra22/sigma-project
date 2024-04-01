<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ManageAnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Update Pengumuman';

        $decryptId = Crypt::decryptString($id);
        $data['announcementData'] = Announcement::where('id', $decryptId)->get();

        return view('admin.announcement.announcement_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $validatedData = $request->validate([
            'pengumuman' => ['required'],
            'file' => ['mimes:pdf|max:2048']
        ]);

        // Store the image
        if ($request->hasFile('file')) {
            // Get the uploaded file
            $file = $request->file('file');

            // Generate a unique filename
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store the image in the storage directory
            $path = $file->storeAs('docs/announcement', $filename);

            // Update the 'file' field in the database with the image path
            $validatedData['file'] = $path;
        } 

        $announcement = Announcement::where('id', $announcement->id)->update($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($announcement)->log($getUser . ' melakukan update Pengumuman');

        return redirect(route('admin.dashboard'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
