<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Office;
use App\Models\Position;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Manage User';

        return view('admin.manage_user.user_list', $data);
    }

    public function tableUser()
    {
        $query = Document::with(['user', 'office', 'position', 'status']);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('user.nama_lengkap', function ($data) {
                return $data->user->nama_lengkap;
            })
            ->addColumn('opsi', function ($data) {
                // Assuming you have a route named 'detail' to show details
                $detailRoute = route('admin.editUser', ['document' => $data->uuid]);

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
        $data['pageTitle'] = 'Edit Data User';
        $data['userData'] = Document::with(['user', 'office', 'position', 'status'])->where('documents.uuid', $uuid)->get();
        $data['officeList'] = Office::all();
        $data['positionList'] = Position::all();

        return view('admin.manage_user.user_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            // User data
            'nama_lengkap' => ['required', 'string', 'min:4', 'max:49'],
            'username' => ['required', 'unique:users,username,' . $document->user->id],
            'jenis_kelamin' => ['required'],
            'no_hp' => ['required', 'numeric', 'digits_between:11,14', 'unique:users,no_hp,' . $document->user->id],
            'email' => ['required', 'email', 'unique:users,email,' . $document->user->id],

            // Status data
            'status' => ['required', 'in:menunggu,diterima,ditolak,selesai'],
            'keterangan' => ['required'],
            'doc_balasan' => 'nullable|mimes:pdf|max:2048',

            // Document data
            'no_identitas' => ['required', 'numeric', 'digits_between:4,20', 'unique:documents,no_identitas,' . $document->id],
            'jurusan' => ['required'],
            'instansi_asal' => ['required'],
            'office_id' => ['required'],
            'position_id' => ['required'],
            'u_tgl_mulai' => ['required', 'date_format:d/m/Y'],
            'u_tgl_selesai' => ['required', 'date_format:d/m/Y'],
            'e_tgl_mulai' => ['required', 'date_format:d/m/Y'],
            'e_tgl_selesai' => ['required', 'date_format:d/m/Y'],
        ]);

        // Convert date formats
        $validatedData['u_tgl_mulai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_mulai'])->format('Y-m-d');
        $validatedData['u_tgl_selesai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_selesai'])->format('Y-m-d');
        $validatedData['e_tgl_mulai'] = Carbon::createFromFormat('d/m/Y', $validatedData['e_tgl_mulai'])->format('Y-m-d');
        $validatedData['e_tgl_selesai'] = Carbon::createFromFormat('d/m/Y', $validatedData['e_tgl_selesai'])->format('Y-m-d');

        // Update document
        $document->update($validatedData);

        // Update status
        $statusData = [
            'status' => $validatedData['status'],
            'keterangan' => $validatedData['keterangan'],
        ];
        $document->status->update($statusData);

        // Update user
        $document->user->update($validatedData);

        return redirect(route('admin.manageUser'))->with('success', 'Data berhasil diupdate!');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
