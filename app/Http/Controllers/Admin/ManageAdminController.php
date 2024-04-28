<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;


class ManageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Manage Admin';

        return view('admin.manage_admin.admin_list', $data);
    }

    public function tableAdmin()
    {
        $query = Admin::with('roles')->leftJoin('offices', 'admins.office_id', '=', 'offices.id')->select('admins.*', 'offices.nama_kantor');

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('admin.nama_lengkap', function ($data) {
                return $data->nama_lengkap;
            })
            ->editColumn('roles.name', function ($data) {
                return $data->roles->pluck('name')->implode(', ');
            })
            ->editColumn('offices.nama_kantor', function ($data) {
                // Ambil data office berdasarkan office_id yang ada pada admin
                $office = Office::find($data->office_id);

                // Jika office ditemukan, kembalikan nama office, jika tidak kembalikan null
                return $office ? $office->nama_kantor : null;
            })
            ->addColumn('opsi', function ($data) {

                $detailRoute = route('admin.editAdmin', ['admin' => $data->uuid]);

                return '<a href="' . $detailRoute . '" class="py-2 text-md text-blue-500 cursor-pointer hover:underline">Detail</a>';
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Data Admin';
        $data['officeList'] = Office::all();
        $data['roleList'] = Role::all();

        return view('admin.manage_admin.admin_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(([
            'nama_lengkap' => ['required', 'string', 'min:4', 'max:49'],
            'username' => ['required', 'string', 'min:4', 'max:49', 'unique:admins,username,'],
            'jenis_kelamin' => ['required'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
            'nip' => ['required', 'unique:admins,nip,'],
            'email' => ['required', 'email', 'unique:admins,email,'],
            'no_hp' => ['required', 'unique:admins,no_hp,'],
            'office_id' => ['required'],
            'roles' => ['required'],
        ]));

        $validatedData['password'] = Hash::make($validatedData['password']);

        $admin = Admin::create($validatedData);
        $admin->assignRole($validatedData['roles']);

        return redirect(route('admin.manageAdmin'))->with('success', 'Data berhasil disimpan!');
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
        $data['pageTitle'] = 'Update Data Admin';
        $data['userData'] = Admin::with(['roles'])->where('admins.uuid', $uuid)->get();
        $data['officeList'] = Office::all();
        $data['roleList'] = Role::all();

        return view('admin.manage_admin.admin_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $validatedData = $request->validate(([
            'nama_lengkap' => ['required', 'string', 'min:4', 'max:49'],
            'username' => ['required', 'string', 'min:4', 'max:49', 'unique:admins,username,' . $admin->id],
            'nip' => ['required', 'unique:admins,nip,' . $admin->id],
            'email' => ['required', 'email', 'unique:admins,email,' . $admin->id],
            'no_hp' => ['required', 'unique:admins,no_hp,' . $admin->id],
            'office_id' => ['required'],
            'roles' => ['required'],
        ]));

        $admin = Admin::find($admin->id);
        $admin->update($validatedData);
        DB::table('model_has_roles')->where('model_id', $admin->id)->delete();

        $admin->assignRole($validatedData['roles']);

        return redirect(route('admin.manageAdmin'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $admin = Admin::where('uuid', $uuid)->first();
        $admin->delete();

        return redirect(route('admin.manageAdmin'))->with('success', 'Data berhasil dihapus!');
    }
}
