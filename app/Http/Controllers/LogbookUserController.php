<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Homepage;
use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LogbookUserController extends Controller
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
        $data['pageTitle'] = 'Logbook'; // Setel judul halaman menjadi 'Logbook'
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Mendapatkan data peserta
        $data['userDetail'] = Document::with('user', 'status')->where('documents.user_id', $user->id)->get();

        // Mendapatkan entri logbook peserta, diurutkan berdasarkan tanggal, dan paginasi (2 per halaman)
        $data['logbookUser'] = Logbook::with('status')->where('status_id', $user->id)->latest('logbooks.tgl_magang')->paginate(2);

        return view('user.logbook', $data); // Kembalikan view dengan data
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'status_id' => ['required'],
            'tgl_magang' => ['required', 'date_format:d/m/Y'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i'],
            'topik_diskusi' => ['required'],
            'arahan_pembimbing' => ['required'],
            'bukti' => ['required', 'url'],
        ]);

        // Ubah format tanggal magang menjadi format yang sesuai dengan database
        $validatedData['tgl_magang'] = Carbon::createFromFormat('d/m/Y', $validatedData['tgl_magang'])->format('Y-m-d');

        Logbook::create($validatedData); // Buat entri logbook baru dengan data yang divalidasi

        // Redirect ke halaman logbook dengan pesan sukses
        return redirect(route('user.logbook'))->with('success', 'Berhasil menambahkan logbook!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data['pageTitle'] = 'Logbook Magang';
        $data['aboutData'] = Homepage::firstOrFail();

        $status_id = Crypt::decrypt($id);
        $data['userData'] = User::join('documents', 'users.id', '=', 'documents.user_id')
            ->join('offices', 'documents.office_id', '=', 'offices.id')
            ->join('positions', 'documents.position_id', '=', 'positions.id')
            ->join('statuses', 'documents.id', '=', 'statuses.document_id')
            ->join('logbooks', 'statuses.id', '=', 'logbooks.status_id')
            ->where('logbooks.status_id', $status_id)
            ->first();

        $data['logbookData'] = User::join('documents', 'users.id', '=', 'documents.user_id')
            ->join('statuses', 'documents.id', '=', 'statuses.document_id')
            ->join('logbooks', 'statuses.id', '=', 'logbooks.status_id')
            ->where('logbooks.status_id', $status_id)
            ->oldest('logbooks.tgl_magang')
            ->get();

        return view('user.logbook_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logbook $logbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logbook $logbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari entri logbook berdasarkan id
        $logbook = Logbook::find($id);

        // Jika entri logbook tidak ditemukan, redirect dengan pesan error
        if (!$logbook) {
            return redirect(route('user.logbook'))->with('error', 'Data tidak ditemukan.');
        }

        $logbook->delete(); // Hapus entri logbook

        // Redirect ke halaman logbook dengan pesan sukses
        return redirect(route('user.logbook'))->with('success', 'Data berhasil dihapus!');
    }
}
