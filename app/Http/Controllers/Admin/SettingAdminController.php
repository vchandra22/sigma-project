<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SettingAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Pengaturan';

        $admin = Auth::guard('admin')->user();
        $data['adminData'] = Admin::where('id', $admin->id)->get();
        $data['getOffice'] = Office::where('id', $admin->office_id)->get();

        return view('admin.settings', $data);
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
    public function edit($id)
    {
        $data['pageTitle'] = 'Update Profile';
        $decryptId = Crypt::decryptString($id);

        // Retrieve the admin details
        $data['adminDetail'] = Admin::findOrFail($decryptId);

        // Retrieve the associated office using the office_id
        $officeId = $data['adminDetail']->office_id;

        // Retrieve the list of offices
        $data['officeList'] = Office::where('id', $officeId)->get();

        return view('admin.update_profile', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $adminId = Auth::guard('admin')->user();
        $validatedData = $request->validate([
            'username' => ['required', 'min:4', 'max:49', 'regex:/^[^\s]+$/i', 'unique:admins,username,' . $adminId->id . ',id'],
            'nama_lengkap' => ['required', 'min:4', 'max:49'],
            'nip' => ['required', 'numeric', 'digits_between:4,20', 'unique:admins,nip,' . $adminId->id . ',id'],
            'jenis_kelamin' => ['required'],
            'office_id' => ['required'],
            'no_hp' => ['required', 'numeric', 'min_digits:11', 'max_digits:14', 'unique:admins,no_hp,' . $adminId->id . ',id'],
            'email' => ['required', 'email', 'unique:admins,email,' . $adminId->id . ',id'],
        ]);

        $admin = Admin::where('id', $admin->id)->update($validatedData);

        return redirect(route('admin.settings'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
