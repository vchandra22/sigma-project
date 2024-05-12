<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Document;
use App\Models\Office;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Dashboard'; //memberikan nama pada halaman

        $user = Auth::user(); //mengambil id user yang telah login
        $data['userData'] = Document::with(['user', 'office', 'position', 'status'])->where('user_id', $user->id)->get();

        $data['announcementData'] = Announcement::latest()->get();

        return view('user.dashboard', $data);
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
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $validatedData = $request->validate([
            'doc_laporan' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('doc_laporan')) {
            $file = $request->file('doc_laporan');
            $directoryPath = 'private/laporan';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/laporan/' . $filename, File::get($file));
            $validatedData['doc_laporan'] = $filename;
        }

        Document::where('id', Auth::user()->id)->update(['doc_laporan' => $validatedData['doc_laporan']]);

        return redirect(route('user.dashboard'))->with('success', 'Berhasil mengirim laporan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
    }

    public function downloadFile($documents)
    {

        $filePath = storage_path('app/private/documents/' . $documents);

        // Return the file as a download response
        return response()->download($filePath);
    }
}
