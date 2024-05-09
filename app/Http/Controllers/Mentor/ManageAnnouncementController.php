<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

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
    public function edit($uuid)
    {
        $data['pageTitle'] = 'Update Pengumuman';

        $data['announcementData'] = Announcement::where('uuid', $uuid)->get();

        return view('mentor.announcement.announcement_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $validatedData = $request->validate([
            'pengumuman' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $directoryPath = 'private/announcement';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/announcement/' . $filename, File::get($file));
            $validatedData['file'] = $filename;
        } else {

            $oldFilePath = 'private/announcement/' . $announcement->file;
            if (Storage::disk('local')->exists($oldFilePath)) {
                Storage::disk('local')->delete($oldFilePath);
            }
            $validatedData['file'] = null;
        }

        $announcement->update($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($announcement)->log($getUser . ' melakukan update Pengumuman');

        return redirect(route('mentor.dashboard'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
