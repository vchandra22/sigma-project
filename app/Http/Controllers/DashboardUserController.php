<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Document;
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
        $data['pageTitle'] = 'Dashboard'; // Setel judul halaman menjadi 'Dashboard'
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Mengambil data dokumen yang terkait dengan pengguna, termasuk relasi pengguna, kantor, posisi, status dan sertifikat
        $data['userData'] = Document::with(['user', 'office', 'position', 'status.certificate'])->where('user_id', $user->id)->get();

        $data['announcementData'] = Announcement::latest()->get(); // Mengambil data pengumuman terbaru

        return view('user.dashboard', $data); // Kembalikan view dashboard dengan data
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
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'doc_laporan' => 'required|mimes:pdf|max:10240', // Maksimum ukuran file 10MB
        ]);

        // Periksa apakah ada file yang diunggah dalam request
        if ($request->hasFile('doc_laporan')) {
            $file = $request->file('doc_laporan'); // Mendapatkan file
            $directoryPath = 'private/laporan'; // Menentukan path direktori untuk menyimpan file

            // Buat direktori jika belum ada
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension(); // Buat nama file acak dengan ekstensi asli file
            Storage::disk('local')->put('/private/laporan/' . $filename, File::get($file)); // Simpan file ke direktori yang ditentukan
            $validatedData['doc_laporan'] = $filename; // Setel nama file ke dalam array data yang tervalidasi
        }

        // Perbarui data dokumen pengguna dengan file laporan yang baru
        Document::where('id', Auth::user()->id)->update(['doc_laporan' => $validatedData['doc_laporan']]);

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect(route('user.dashboard'))->with('success', 'Berhasil mengirim laporan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
    }
    /**
     * Mengunduh file surat balasan
     */
    public function downloadSuratBalasan($documents)
    {
        // Tentukan path file yang akan diunduh berdasarkan nama file surat balasan
        $filePath = storage_path('app/private/documents/' . $documents);

        // Kembalikan file sebagai respon unduhan dengan nama file yang ditentukan
        return response()->download($filePath);
    }
}
