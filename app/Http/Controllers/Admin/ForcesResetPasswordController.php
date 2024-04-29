<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ForcesResetPasswordController extends Controller
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
    public function edit($uuid)
    {
        $data['pageTitle'] = 'Force Reset Password';
        $data['userData'] = Admin::where('uuid', $uuid)->first();

        return view('admin.manage_admin.update_password', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required_with:password', 'min:8', 'same:password'],
        ]);

        // Hash the new password
        $hashedPassword = Hash::make($validatedData['password']);

        $admin = Admin::where('id', $admin->id)->update(['password' => $hashedPassword]);

        $user = Auth::guard('admin')->user();

        activity()->causedBy($admin)->log($user->nama_lengkap . '(' . $user->nip . ')' . ' melakukan force reset password untuk admin');

        return redirect(route('admin.manageAdmin'))->with('success', 'Force reset password baru berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
