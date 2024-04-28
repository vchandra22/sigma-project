<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Homepage;
use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\User;
use DateTime;
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
        $logbook = Logbook::find($id);
        $logbook->delete();

        return redirect(route('user.logbook'))->with('success', 'Data berhasil dihapus!');
    }
}
