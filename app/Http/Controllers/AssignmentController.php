<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Str;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Tugas / Proyek'; // Setel judul halaman menjadi 'Assignment'
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Mengambil data assignment dimana status_id sesuai dengan id user yang sedang login,
        // urutkan berdasarkan yang terbaru, dan paginasi (10 per halaman)
        $data['assignmentData'] = Assignment::where('status_id', $user->id)->latest()->paginate(10);

        // Periksa apakah data assignment yang diambil kosong
        if ($data['assignmentData']->isEmpty()) {
            $data['mentorData'] = null; // Jika tidak ada assignment ditemukan, setel mentorData menjadi null
        } else {
            // Jika data assignment tidak kosong, cari data mentor berdasarkan id yang sama dengan created_by
            $mentor_ids = $data['assignmentData']->pluck('created_by')->unique();
            $data['mentorData'] = Admin::whereIn('id', $mentor_ids)->get();
        }

        return view('user.assignment_list', $data); // Kembalikan view daftar tugas dengan data
    }

    public function statusBelumDikerjakan()
    {
        $data['pageTitle'] = 'Tugas / Proyek'; // Setel judul halaman menjadi 'Assignment'
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Mengambil data assignment dimana status_id sesuai dengan id user yang sedang login dan status assignment dikirim,
        // urutkan berdasarkan yang terbaru, dan paginasi (10 per halaman)
        $data['assignmentData'] = Assignment::where('status_id', $user->id)->where('status', 'dikirim')->latest()->paginate(10);

        // Periksa apakah data assignment yang diambil kosong
        if ($data['assignmentData']->isEmpty()) {
            $data['mentorData'] = null; // Jika tidak ada assignment ditemukan, setel mentorData menjadi null
        } else {
            // Jika data assignment tidak kosong, cari data mentor berdasarkan id yang sama dengan created_by
            $mentor_ids = $data['assignmentData']->pluck('created_by')->unique();
            $data['mentorData'] = Admin::whereIn('id', $mentor_ids)->get();
        }

        return view('user.assignment_list', $data); // Kembalikan view dengan data
    }


    public function statusSelesai()
    {
        $data['pageTitle'] = 'Tugas / Proyek'; // Setel judul halaman menjadi 'Assignment'
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Mengambil data assignment dimana status_id sesuai dengan id user yang sedang login dan status assignment selesai,
        // urutkan berdasarkan yang terbaru, dan paginasi (10 per halaman)
        $data['assignmentData'] = Assignment::where('status_id', $user->id)->where('status', 'selesai')->latest()->paginate(10);

        // Periksa apakah data assignment yang diambil kosong
        if ($data['assignmentData']->isEmpty()) {
            $data['mentorData'] = null; // Jika tidak ada assignment ditemukan, setel mentorData menjadi null
        } else {
            // Jika data assignment tidak kosong, cari data mentor berdasarkan id yang sama dengan created_by
            $mentor_ids = $data['assignmentData']->pluck('created_by')->unique();
            $data['mentorData'] = Admin::whereIn('id', $mentor_ids)->get();
        }

        return view('user.assignment_list', $data); // Kembalikan view dengan data
    }

    public function statusTerlambat()
    {
        $data['pageTitle'] = 'Tugas / Proyek'; // Setel judul halaman menjadi 'Assignment'
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Mengambil data assignment dimana status_id sesuai dengan id user yang sedang login dan status assignment terlambat,
        // urutkan berdasarkan yang terbaru, dan paginasi (10 per halaman)
        $data['assignmentData'] = Assignment::where('status_id', $user->id)->where('status', 'terlambat')->latest()->paginate(10);

        // Periksa apakah data assignment yang diambil kosong
        if ($data['assignmentData']->isEmpty()) {
            $data['mentorData'] = null; // Jika tidak ada assignment ditemukan, setel mentorData menjadi null
        } else {
            // Jika data assignment tidak kosong, cari data mentor berdasarkan id yang sama dengan created_by
            $mentor_ids = $data['assignmentData']->pluck('created_by')->unique();
            $data['mentorData'] = Admin::whereIn('id', $mentor_ids)->get();
        }

        return view('user.assignment_list', $data); // Kembalikan view dengan data
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
    public function store(StoreAssignmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $data['pageTitle'] = 'Assignment Detail'; // Setel judul halaman menjadi 'Assignment Detail'

        // Mengambil data assignment berdasarkan slug
        $data['assignmentData'] = Assignment::where('slug', $slug)->firstOrFail();

        // Ekstrak id mentor dari field created_by pada assignment
        $mentor_id = $data['assignmentData']->pluck('created_by')->unique();

        // Ambil informasi mentor berdasarkan $mentor_id
        $data['mentorData'] = Admin::whereIn('id', $mentor_id)->firstOrFail();

        return view('user.assignment_detail', $data); // Kembalikan view detail assignment dengan data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'doc_jawaban' => 'nullable|mimes:pdf,zip,rar,docx,xlsx,xls,txt|max:10240', // Maksimum ukuran file 10MB
        ]);

        // Periksa apakah request berisi file 'doc_jawaban'
        if ($request->hasFile('doc_jawaban')) {
            $file = $request->file('doc_jawaban'); // Mendapatkan file
            $directoryPath = 'private/assignments'; // Menentukan path direktori untuk menyimpan file

            // Buat direktori jika belum ada
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension(); // Buat nama file acak dengan ekstensi asli file
            Storage::disk('local')->put('/private/assignments/' . $filename, File::get($file)); // Simpan file ke direktori yang ditentukan
            $validatedData['doc_jawaban'] = $filename; // Setel nama file ke dalam array data yang tervalidasi
        }

        // Periksa apakah assignment melebihi batas waktu (overdue)
        if ($assignment->updated_at > $assignment->due_date) {
            $validatedData['status'] = 'terlambat'; // Jika terlambat, setel status ke 'terlambat'
        } else {
            $validatedData['status'] = 'selesai'; // Jika tidak terlambat, setel status ke 'selesai'
        }

        Assignment::where('id', $assignment->id)->update($validatedData); // Perbarui data assignment di database berdasarkan id assignment

        // Redirect ke halaman assignment user dengan pesan sukses
        return redirect(route('user.assignment'))->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        //
    }

    /**
     * Mengunduh file jawaban untuk assignment yang ditentukan.
     */
    public function downloadJawaban($assignment)
    {
        // Cari assignment berdasarkan uuid yang diberikan
        $assignment = Assignment::where('uuid', $assignment)->first();

        // Tentukan path file yang akan diunduh
        $filePath = storage_path('app/private/assignments/' . $assignment->doc_jawaban);

        // Tetapkan nama file yang akan diunduh dengan judul assignment diikuti oleh tanggal saat ini
        $downloadFileName = 'Jawaban_' . $assignment->doc_jawaban . '_' . now()->format('Ymd') . '.' . pathinfo($assignment->doc_jawaban, PATHINFO_EXTENSION);

        // Kembalikan file sebagai respon unduhan
        return response()->download($filePath, $downloadFileName);
    }

    public function cancelJawaban(Assignment $assignment)
    {
        // Mendapatkan nama file dari assignment yang diberikan
        $filename = $assignment->doc_jawaban;

        // Jika file ada
        if ($filename) {
            // Hapus file dari direktori
            Storage::disk('local')->delete('private/assignments/' . $filename);
        }

        // Perbarui data assignment dengan mengatur 'doc_jawaban' menjadi null dan status menjadi 'dikirim' = 'belum dikerjakan'
        $assignment->update(['doc_jawaban' => null, 'status' => 'dikirim']);

        // Redirect ke halaman assignment user dengan pesan sukses
        return redirect(route('user.assignment'))->with('success', 'Sukses membatalkan jawaban!');
    }
}
