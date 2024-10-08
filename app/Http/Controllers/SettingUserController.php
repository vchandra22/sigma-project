<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Pengaturan'; // Setel judul halaman menjadi 'Pengaturan'

        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Mendapatkan data peserta berdasarkan uuid
        $data['userDetail'] = User::with('document')->where('uuid', $user->uuid)->get();

        return view('user.settings', $data); // Kembalikan view dengan data
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['pageTitle'] = 'Ubah Profil'; // Setel judul halaman menjadi 'Ubah Profil'

        // Mendapatkan data peserta berdasarkan uuid
        $data['userDetail'] = User::with('document')->where('uuid', $uuid)->get();

        return view('user.update_profile', $data); // Kembalikan view dengan data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $userId = Auth::user(); // Mendapatkan user yang sedang login
        $validatedUser = $request->validate([
            'nama_lengkap' => ['required', 'string', 'min:4', 'max:255'],
            'username' => ['required', 'same:no_identitas', 'unique:documents,no_identitas,' . $userId->id . ',user_id'],
            'jenis_kelamin' => ['required'],
            'no_hp' => ['required', 'numeric', 'digits_between:10,14', 'unique:users,no_hp,' . $userId->id . ',id'],
            'email' => ['required', 'email', 'unique:users,email,' . $userId->id . ',id'],
        ]);

        $validatedDocs = $request->validate([
            'instansi_asal' => ['required'],
            'jurusan' => ['required'],
            'nama_pembimbing' => ['required', 'string', 'min:4', 'max:255'],
            'no_hp_pembimbing' => ['required', 'numeric', 'digits_between:10,14'],
            'no_identitas' => ['required', 'numeric', 'digits_between:4,20', 'unique:documents,no_identitas,' . $userId->id . ',user_id'],
        ]);

        $user->update($validatedUser); // Perbarui data peserta

        $user->document()->update($validatedDocs); // Perbarui data dokumen peserta yang terkait

        // Redirect ke halaman pengaturan pengguna dengan pesan sukses
        return redirect(route('user.settings'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
