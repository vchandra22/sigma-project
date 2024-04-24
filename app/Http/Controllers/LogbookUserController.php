<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;

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
        $data['pageTitle'] = 'Logbook';
        $user = Auth::user(); //mengambil id user yang telah login

        $data['userDetail'] = Document::with('user', 'status')->where('documents.user_id', $user->id)->get();
        $data['logbookUser'] = Logbook::with('status')->where('status_id', $user->id)->latest('logbooks.tgl_magang')->paginate(2);

        return view('user.logbook', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'status_id' => ['required'],
            'tgl_magang' => ['required'],
            'jam_mulai' => ['required'],
            'jam_selesai' => ['required'],
            'topik_diskusi' => ['required'],
            'arahan_pembimbing' => ['required'],
            'bukti' => ['required', 'url'],
        ]);

        $tgl_magang = DateTime::createFromFormat('m/d/Y', $validatedData['tgl_magang']);
        $validatedData['tgl_magang'] = trim($tgl_magang->format('Y-m-d'));

        Logbook::create($validatedData);

        return redirect(route('user.logbook'))->with('success', 'Berhasil menambahkan logbook!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Logbook $logbook)
    {
        //
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
        $logbook = Logbook::find($id);
        $logbook->delete();

        return redirect(route('user.logbook'))->with('success', 'Data berhasil dihapus!');
    }
}
