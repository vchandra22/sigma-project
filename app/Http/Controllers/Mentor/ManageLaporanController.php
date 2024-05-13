<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Laporan Magang';

        $user = Auth::user();
        $data['laporanData'] = Document::with('user', 'status', 'position')
            ->where('office_id', $user->office_id)
            ->where(function ($query) {
                $query->whereHas('status', function ($query) {
                    $query->where('status', 'diterima');
                })->orWhereHas('status', function ($query) {
                    $query->where('status', 'selesai');
                });
            })
            ->latest()
            ->paginate(20);

        return view('mentor.laporan.laporan_list', $data);
    }

    public function downloadLaporan($laporan)
    {
        $laporan = Document::where('uuid', $laporan)->first();

        // Check if certificate exists
        if (!$laporan) {
            abort(404);
        }

        // Get the file path
        $filePath = storage_path('app/private/laporan/' . $laporan->doc_laporan);

        // Check if the file exists
        if (!file_exists($filePath)) {
            abort(404);
        }

        // Return the file as a download response
        return response()->download($filePath);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
    }
}
