<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForceResetUserPasswordController extends Controller
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['pageTitle'] = 'Force Reset Password';
        $data['userData'] = User::where('uuid', $uuid)->first();

        return view('admin.manage_user.update_password', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required_with:password', 'min:8', 'same:password'],
        ]);

        // Hash the new password
        $hashedPassword = Hash::make($validatedData['password']);

        $user = User::where('id', $user->id)->update(['password' => $hashedPassword]);

        $admin = Auth::guard('admin')->user();

        activity()->causedBy($admin)->log($admin->nama_lengkap . '(' . $admin->nip . ')' . ' melakukan force reset password untuk peserta');

        return redirect(route('admin.manageUser'))->with('success', 'Force reset password baru berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
