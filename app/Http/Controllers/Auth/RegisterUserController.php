<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Homepage;
use App\Models\Office;
use App\Models\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Storage;

class RegisterUserController extends Controller
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
        $data['pageTitle'] = 'Register';
        $data['officeList'] = Office::all();
        $data['positionList'] = Position::all();
        $data['homeData'] = Homepage::latest()->firstOrFail();

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
            'username' => ['required', 'same:no_identitas', 'unique:users,username', 'regex:/^[a-zA-Z0-9_]+$/'],
            'jenis_kelamin' => ['required'],
            'no_hp' => ['required', 'numeric', 'digits_between:10,14', 'unique:users,no_hp'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
            'instansi_asal' => ['required'],
            'nama_pembimbing' => ['required'],
            'no_hp_pembimbing' => ['required', 'numeric', 'digits_between:10,14'],
            'jurusan' => ['required'],
            'office_id' => 'required',
            'position_id' => 'required',
            'u_tgl_mulai' => ['required', 'date_format:d/m/Y'],
            'u_tgl_selesai' => ['required', 'date_format:d/m/Y'],
            'doc_pengantar' => 'required|mimes:pdf|max:2048',
            'doc_kesbang' => 'nullable|mimes:pdf|max:2048',
            'doc_proposal' => 'nullable|mimes:pdf|max:2048',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $validatedData['u_tgl_mulai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_mulai'])->format('Y-m-d');
        $validatedData['u_tgl_selesai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_selesai'])->format('Y-m-d');

        if ($request->hasFile('doc_pengantar')) {
            $file = $request->file('doc_pengantar');
            $directoryPath = 'private/documents';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/documents/' . $filename, File::get($file));
            $validatedData['doc_pengantar'] = $filename;
        }

        if ($request->hasFile('doc_kesbang')) {
            $file = $request->file('doc_kesbang');
            $directoryPath = 'private/documents';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/documents/' . $filename, File::get($file));
            $validatedData['doc_kesbang'] = $filename;
        }

        if ($request->hasFile('doc_proposal')) {
            $file = $request->file('doc_proposal');
            $directoryPath = 'private/documents';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/documents/' . $filename, File::get($file));
            $validatedData['doc_proposal'] = $filename;
        }

        $user = User::create([
            'username' => $validatedData['username'],
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'email' => $validatedData['email'],
            'no_hp' => $validatedData['no_hp'],
            'password' => $validatedData['password']
        ]);

        $document = $user->document()->create($validatedData);
        $document->status()->create($validatedData);

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
