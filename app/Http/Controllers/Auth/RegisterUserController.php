<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterUserController extends Controller
{
    public $doc_pengantar;
    public $doc_kesbang;
    public $doc_proposal;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Register';

        return view('auth.sign-up', $data);
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
        $validatedData = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:33'],
            'no_identitas' => ['required', 'numeric', 'unique:documents,no_identitas'],
            'username' => ['required', 'same:no_identitas', 'unique:users,username'],
            'no_hp' => ['required', 'numeric', 'min_digits:11', 'max_digits:14', 'unique:users,no_hp'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required_with:password_confirmation', 'min:8'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],
            'instansi_asal' => ['required'],
            'jurusan' => ['required'],
            'instansi_tujuan' => ['required'],
            'u_tgl_mulai' => ['required'],
            'u_tgl_selesai' => ['required'],
            'doc_pengantar' => 'required|mimes:pdf|max:2048',
            'doc_kesbang' => 'mimes:pdf|max:2048',
            'doc_proposal' => 'mimes:pdf|max:2048',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);


        $date_start = DateTime::createFromFormat('m/d/Y', $validatedData['u_tgl_mulai']);
        $validatedData['u_tgl_mulai'] = trim($date_start->format('Y-m-d'));

        $date_end = DateTime::createFromFormat('m/d/Y', $validatedData['u_tgl_selesai']);
        $validatedData['u_tgl_selesai'] = trim($date_end->format('Y-m-d'));

        $currentDate = now()->format('d-m-Y');

        $doc_pengantar = $request->file('doc_pengantar');
        $doc_kesbang = $request->file('doc_kesbang');
        $doc_proposal = $request->file('doc_proposal');

        $doc_pengantar_path = $doc_pengantar->storeAs('docs', 'pengantar_' . Str::random(8) . '_' . $currentDate . '.' . $doc_pengantar->getClientOriginalExtension());
        $doc_kesbang_path = $doc_kesbang->storeAs('docs', 'kesbang_' . Str::random(8) . '_' . $currentDate . '.' . $doc_kesbang->getClientOriginalExtension());
        $doc_proposal_path = $doc_proposal->storeAs('docs', 'proposal_' . Str::random(8) . '_' . $currentDate . '.' . $doc_proposal->getClientOriginalExtension());

        if ($doc_pengantar_path && $doc_kesbang_path && $doc_proposal_path) {
            $values = array(
                'no_identitas' => $validatedData['no_identitas'],
                'jurusan' => $validatedData['jurusan'],
                'instansi_asal' => $validatedData['instansi_asal'],
                'u_tgl_mulai' => $validatedData['u_tgl_mulai'],
                'u_tgl_selesai' => $validatedData['u_tgl_selesai'],
                'doc_pengantar' => $doc_pengantar_path,
                'doc_kesbang' => $doc_kesbang_path,
                'doc_proposal' => $doc_proposal_path,
            );

            $user = User::create([
                'username' => $validatedData['username'],
                'nama_lengkap' => $validatedData['nama_lengkap'],
                'email' => $validatedData['email'],
                'no_hp' => $validatedData['no_hp'],
                'password' => $validatedData['password']
            ]);

            $document = $user->document()->create($values);
            $document->status()->create($values);
        }
        return redirect(route('auth.login'))->with('success', 'Registrasi Berhasil, silakan login menggunakan username dan password');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
