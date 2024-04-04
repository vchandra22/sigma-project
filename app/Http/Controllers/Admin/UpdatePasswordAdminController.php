<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordAdminController extends Controller
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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $data['pageTitle'] = 'Ubah Password';

        return view('admin.update_password', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'old_password' => 'required',
            'password' => ['required_with:password_confirmation', 'min:8'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],
        ]);

        $currentPassword = Auth::guard('admin')->user()->password; //mendapatkan password dari user yang login
        $old_password = $validatedData['old_password']; //mengambil password lama dari validasi

        //Memeriksa apakah password lama yang dimasukkan sudah sesuai
        if (Hash::check($old_password, $currentPassword)) {

            $currentPassword = $validatedData['password']; //mendapatkan password baru dari form validasi

            $hashedPassword = Hash::make($currentPassword); //hash password baru sebelum disimpan ke database

            $user = Auth::guard('admin')->user(); //mendapatkan data user yang sedang login

            $admin = Admin::where('id', $user->id)->update(['password' => $hashedPassword]); //update password user dengan eloquent

            activity()->causedBy($admin)->log($user->nama_lengkap . '(' . $user->nip . ')' . ' melakukan update password');

            return redirect(route('admin.settings'))->with('success', 'Password baru berhasil diubah');
        } else {
            return back()->withErrors(['old_password' => 'Pastikan anda memasukkan password lama dengan benar']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
