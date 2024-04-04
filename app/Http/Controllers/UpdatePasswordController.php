<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    public function edit() {
        $data['pageTitle'] = 'Ubah Password';

        return view('user.update_password', $data);
    }

    public function update(Request $request) {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'old_password' => 'required',
            'password' => ['required_with:password_confirmation', 'min:8'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],
        ]);

        $currentPassword = Auth::user()->password; //mendapatkan password dari user yang login
        $old_password = $validatedData['old_password']; //mengambil password lama dari validasi

        //Memeriksa apakah password lama yang dimasukkan sudah sesuai
        if(Hash::check($old_password, $currentPassword)) {

            $currentPassword = $validatedData['password']; //mendapatkan password baru dari form validasi

            $hashedPassword = Hash::make($currentPassword); //hash password baru sebelum disimpan ke database

            $user = Auth::user(); //mendapatkan data user yang sedang login

            User::where('id', $user->id)->update(['password' => $hashedPassword]); //update password user dengan eloquent

            return redirect (route('user.settings'))->with('success', 'Password baru berhasil diubah');
        } else {
            return back()->withErrors(['old_password' => 'Pastikan anda memasukkan password lama dengan benar']);
        }
    }
}
