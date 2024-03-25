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

        $data['pageTitle'] = 'Pengaturan';

        $user = Auth::user();
        $data['userDetail'] = User::with('document')->where('id', $user->id)->get();

        return view('user.settings', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Ubah Profil';

        $user = Auth::user();
        $data['userDetail'] = User::with('document')->where('id', $user->id)->get();

        return view('user.update_profile', $data);

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
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedUser = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:33'],
            'no_identitas' => ['required', 'numeric'],
            'username' => ['required', 'same:no_identitas'],
            'no_hp' => ['required', 'numeric', 'min_digits:11', 'max_digits:14'],
            'email' => ['required', 'email'],
        ]);

        $validatedDocs = $request->validate([
            'instansi_asal' => ['required'],
            'jurusan' => ['required'],
        ]);

        $user->update($validatedUser);

        $user->document()->update($validatedDocs);

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
