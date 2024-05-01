<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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

        return view('admin.announcement.announcement_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $validatedData = $request->validate([
            'pengumuman' => ['required'],
            'file' => ['mimes:pdf', 'max:2048']
        ]);

        // Check if there is an old file
        $oldFilePath = $announcement->file;

        // Store the new file
        if ($request->hasFile('file')) {
            // Get the uploaded file
            $file = $request->file('file');

            // Define the directory path
            $directoryPath = 'public/docs/announcement';

            // Check if the directory doesn't exist, then create it
            if (!Storage::exists($directoryPath)) {
                Storage::makeDirectory($directoryPath, 0777, true); // Recursive creation with permissions
            }

            // Generate a unique filename
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

            // Store the new file in the storage/app/public directory
            $newFilePath = $file->storeAs($directoryPath, $filename);

            // Update the 'file' field in the database with the new file path
            $validatedData['file'] = $newFilePath;

            // Delete the old file if it exists
            if ($oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }
        }

        // Update the announcement with the new data
        $announcement->update($validatedData);

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($announcement)->log($getUser . ' melakukan update Pengumuman');

        return redirect(route('admin.dashboard'))->with('success', 'Data berhasil diupdate!');
    }

    public function downloadFile($filename)
    {
        // Check if the file exists
        if (Storage::disk('public')->exists('docs/announcement/' . $filename)) {
            // Get the file path
            $filePath = storage_path('public/' . $filename);

            // Return the file as a download response
            return response()->download($filePath);
        } else {
            // If the file does not exist, return a 404 response
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
