<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\Position;
use App\Models\User;
use Carbon\Carbon;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Register';
        $data['officeList'] = Office::all();
        $data['positionList'] = Position::all();

        return view('auth.sign-up', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => ['required', 'string', 'min:4', 'max:49'],
            'no_identitas' => ['required', 'numeric', 'digits_between:4,20', 'unique:documents,no_identitas'],
            'username' => ['required', 'same:no_identitas', 'unique:users,username'],
            'jenis_kelamin' => ['required'],
            'no_hp' => ['required', 'numeric', 'digits_between:11,14', 'unique:users,no_hp'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
            'instansi_asal' => ['required'],
            'jurusan' => ['required'],
            'office_id' => 'required',
            'position_id' => 'required',
            'u_tgl_mulai' => ['required', 'date'],
            'u_tgl_selesai' => ['required', 'date'],
            'doc_pengantar' => 'required|mimes:pdf|max:2048',
            'doc_kesbang' => 'nullable|mimes:pdf|max:2048',
            'doc_proposal' => 'nullable|mimes:pdf|max:2048',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $validatedData['u_tgl_mulai'] = Carbon::createFromFormat('m/d/Y', $validatedData['u_tgl_mulai'])->format('Y-m-d');
        $validatedData['u_tgl_selesai'] = Carbon::createFromFormat('m/d/Y', $validatedData['u_tgl_selesai'])->format('Y-m-d');

        $currentDate = now()->format('d-m-Y');

        $doc_pengantar = $request->file('doc_pengantar');
        $doc_kesbang = $request->file('doc_kesbang');
        $doc_proposal = $request->file('doc_proposal');

        $doc_pengantar_path = $doc_pengantar->storeAs('docs', 'pengantar_' . Str::random(8) . '_' . $currentDate . '.' . $doc_pengantar->getClientOriginalExtension());

        $doc_kesbang_path = NULL;
        if ($doc_kesbang) {
            $doc_kesbang_path = $doc_kesbang->storeAs('docs', 'kesbang_' . Str::random(8) . '_' . $currentDate . '.' . $doc_kesbang->getClientOriginalExtension());
        }

        $doc_proposal_path = NULL;
        if ($doc_proposal) {
            $doc_proposal_path = $doc_proposal->storeAs('docs', 'proposal_' . Str::random(8) . '_' . $currentDate . '.' . $doc_proposal->getClientOriginalExtension());
        }

        $values = [
            'no_identitas' => $validatedData['no_identitas'],
            'jurusan' => $validatedData['jurusan'],
            'instansi_asal' => $validatedData['instansi_asal'],
            'office_id' => $validatedData['office_id'],
            'position_id' => $validatedData['position_id'],
            'instansi_asal' => $validatedData['instansi_asal'],
            'u_tgl_mulai' => $validatedData['u_tgl_mulai'],
            'u_tgl_selesai' => $validatedData['u_tgl_selesai'],
            'doc_pengantar' => $doc_pengantar_path,
            'doc_kesbang' => $doc_kesbang_path,
            'doc_proposal' => $doc_proposal_path,
        ];

        $user = User::create([
            'username' => $validatedData['username'],
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'email' => $validatedData['email'],
            'no_hp' => $validatedData['no_hp'],
            'password' => $validatedData['password']
        ]);

        $document = $user->document()->create($values);
        $document->status()->create($values);

        return redirect(route('auth.login'))->with('success', 'Registrasi Berhasil, silakan login menggunakan nomor identitasmu');
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
