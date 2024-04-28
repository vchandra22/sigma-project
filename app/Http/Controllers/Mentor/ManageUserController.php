<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Office;
use App\Models\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\FileHandlerTrait;
use Illuminate\Contracts\Support\ValidatedData;

class ManageUserController extends Controller
{
    use FileHandlerTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Manage User';

        return view('mentor.manage_user.user_list', $data);
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
                $detailRoute = route('mentor.editUser', ['document' => $data->uuid]);

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
        $data['pageTitle'] = 'Tambah User';
        $data['officeList'] = Office::all();
        $data['positionList'] = Position::all();

        return view('mentor.manage_user.user_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => ['required', 'string', 'min:4', 'max:49'],
            'no_identitas' => ['required', 'numeric', 'digits_between:4,20', 'unique:documents,no_identitas'],
            'username' => ['required', 'same:no_identitas', 'unique:users,username'],
            'jenis_kelamin' => ['required'],
            'no_hp' => ['required', 'numeric', 'digits_between:11,14', 'unique:users,no_hp'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
            'instansi_asal' => ['required'],
            'jurusan' => ['required'],
            'office_id' => 'required',
            'position_id' => 'required',
            'u_tgl_mulai' => ['required', 'date_format:d/m/Y'],
            'u_tgl_selesai' => ['required', 'date_format:d/m/Y'],
            'e_tgl_mulai' => ['nullable', 'date_format:d/m/Y'],
            'e_tgl_selesai' => ['nullable', 'date_format:d/m/Y'],
            'doc_pengantar' => 'required|mimes:pdf|max:2048',
            'doc_kesbang' => 'nullable|mimes:pdf|max:2048',
            'doc_proposal' => 'nullable|mimes:pdf|max:2048',
            'status' => ['required', 'in:menunggu,diterima,ditolak,selesai'],
            'keterangan' => ['nullable'],
            'doc_balasan' => 'nullable|mimes:pdf|max:2048',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $validatedData['u_tgl_mulai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_mulai'])->format('Y-m-d');
        $validatedData['u_tgl_selesai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_selesai'])->format('Y-m-d');
        $validatedData['e_tgl_mulai'] = Carbon::createFromFormat('d/m/Y', $validatedData['e_tgl_mulai'])->format('Y-m-d');
        $validatedData['e_tgl_selesai'] = Carbon::createFromFormat('d/m/Y', $validatedData['e_tgl_selesai'])->format('Y-m-d');

        $currentDate = now()->format('d-m-Y');

        $doc_pengantar = $request->file('doc_pengantar');
        $doc_kesbang = $request->file('doc_kesbang');
        $doc_proposal = $request->file('doc_proposal');
        $doc_balasan = $request->file('doc_balasan');

        $doc_pengantar_path = $doc_pengantar->storeAs('docs', 'pengantar_' . Str::random(8) . '_' . $currentDate . '.' . $doc_pengantar->getClientOriginalExtension());

        $doc_kesbang_path = NULL;
        if ($doc_kesbang) {
            $doc_kesbang_path = $doc_kesbang->storeAs('docs', 'kesbang_' . Str::random(8) . '_' . $currentDate . '.' . $doc_kesbang->getClientOriginalExtension());
        }

        $doc_proposal_path = NULL;
        if ($doc_proposal) {
            $doc_proposal_path = $doc_proposal->storeAs('docs', 'proposal_' . Str::random(8) . '_' . $currentDate . '.' . $doc_proposal->getClientOriginalExtension());
        }

        $doc_balasan_path = NULL;
        if ($doc_balasan) {
            $doc_balasan_path = $doc_balasan->storeAs('docs', 'balasan_' . Str::random(8) . '_' . $currentDate . '.' . $doc_balasan->getClientOriginalExtension());
        }

        $valuesDoc = [
            'no_identitas' => $validatedData['no_identitas'],
            'jurusan' => $validatedData['jurusan'],
            'instansi_asal' => $validatedData['instansi_asal'],
            'office_id' => $validatedData['office_id'],
            'position_id' => $validatedData['position_id'],
            'u_tgl_mulai' => $validatedData['u_tgl_mulai'],
            'u_tgl_selesai' => $validatedData['u_tgl_selesai'],
            'e_tgl_mulai' => $validatedData['e_tgl_mulai'],
            'e_tgl_selesai' => $validatedData['e_tgl_selesai'],
            'doc_pengantar' => $doc_pengantar_path,
            'doc_kesbang' => $doc_kesbang_path,
            'doc_proposal' => $doc_proposal_path,
            'status' => $validatedData['status'],
            'keterangan' => $validatedData['keterangan'],
            'doc_balasan' => $doc_balasan_path,
        ];

        $user = User::create([
            'username' => $validatedData['username'],
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'email' => $validatedData['email'],
            'no_hp' => $validatedData['no_hp'],
            'password' => $validatedData['password']
        ]);

        $document = $user->document()->create($valuesDoc);
        $document->status()->create($valuesDoc);

        return redirect(route('mentor.manageUser'))->with('success', 'Registrasi Berhasil!');
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

        return view('mentor.manage_user.user_edit', $data);
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

            // Status data
            'status' => ['required', 'in:menunggu,diterima,ditolak,selesai'],
            'keterangan' => ['required'],
            'doc_balasan' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Convert date formats
        $validatedData['u_tgl_mulai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_mulai'])->format('Y-m-d');
        $validatedData['u_tgl_selesai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_selesai'])->format('Y-m-d');
        $validatedData['e_tgl_mulai'] = Carbon::createFromFormat('d/m/Y', $validatedData['e_tgl_mulai'])->format('Y-m-d');
        $validatedData['e_tgl_selesai'] = Carbon::createFromFormat('d/m/Y', $validatedData['e_tgl_selesai'])->format('Y-m-d');

        // Update document
        $document->update($validatedData);

        // Update user
        $document->user->update($validatedData);

        // Update status
        $statusData = [
            'status' => $validatedData['status'],
            'keterangan' => $validatedData['keterangan'],
        ];

        // if ($request->hasFile('doc_balasan')) {
        //     $statusData['doc_balasan'] = $this->uploadFile('doc_balasan', $validatedData['doc_balasan']);
        // }

        $document->status->update($statusData);

        return redirect(route('mentor.manageUser'))->with('success', 'Data berhasil diupdate!');
    }


    public function download($filename)
    {
        $filePath = 'docs/' . $filename;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }

        abort(404, 'File not found');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect(route('mentor.manageUser'))->with('success', 'Data berhasil dihapus!');
    }
}
