<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Support\Facades\Auth;
use File;

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
        $query = Document::select('documents.*')
            ->with(['user', 'office', 'position', 'status'])
            ->where('office_id', Auth::user()->office_id)->latest();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('user.nama_lengkap', function ($data) {
                return $data->user->nama_lengkap;
            })
            ->editColumn('user.no_hp', function ($data) {
                return $data->user->no_hp;
            })
            ->editColumn('user.jenis_kelamin', function ($data) {
                return $data->user->jenis_kelamin;
            })
            ->editColumn('office.nama_kantor', function ($data) {
                return $data->office->nama_kantor;
            })
            ->editColumn('position.role', function ($data) {
                return $data->position->role;
            })
            ->editColumn('status.status', function ($data) {
                return $data->status->status;
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
        $data['pageTitle'] = 'Tambah User';
        $data['officeList'] = Office::where('id', Auth::guard('admin')->user()->office_id)->get();
        $data['positionList'] = Position::all();

        return view('admin.manage_user.user_create', $data);
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
            'nama_pembimbing' => ['required'],
            'no_hp_pembimbing' => ['required', 'numeric', 'digits_between:10,14'],
            'jurusan' => ['required'],
            'office_id' => 'required',
            'position_id' => 'required',
            'u_tgl_mulai' => ['required', 'date_format:d/m/Y'],
            'u_tgl_selesai' => ['required', 'date_format:d/m/Y'],
            'e_tgl_mulai' => ['required', 'date_format:d/m/Y'],
            'e_tgl_selesai' => ['required', 'date_format:d/m/Y'],
            'doc_pengantar' => 'required|mimes:pdf|max:2048',
            'doc_kesbang' => 'nullable|mimes:pdf|max:2048',
            'doc_proposal' => 'nullable|mimes:pdf|max:2048',
            'status' => ['required', 'in:diterima'],
            'keterangan' => ['nullable'],
            'doc_balasan' => 'nullable|mimes:pdf|max:2048',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $validatedData['u_tgl_mulai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_mulai'])->format('Y-m-d');
        $validatedData['u_tgl_selesai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_selesai'])->format('Y-m-d');
        $validatedData['e_tgl_mulai'] = Carbon::createFromFormat('d/m/Y', $validatedData['e_tgl_mulai'])->format('Y-m-d');
        $validatedData['e_tgl_selesai'] = Carbon::createFromFormat('d/m/Y', $validatedData['e_tgl_selesai'])->format('Y-m-d');

        if ($request->hasFile('doc_pengantar')) {
            $file = $request->file('doc_pengantar');
            $directoryPath = 'private/documents';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/documents/' . $filename, File::get($file));
            $validatedData['doc_pengantar'] = $filename;
        }

        if ($request->hasFile('doc_kesbang')) {
            $file = $request->file('doc_kesbang');
            $directoryPath = 'private/documents';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/documents/' . $filename, File::get($file));
            $validatedData['doc_kesbang'] = $filename;
        }

        if ($request->hasFile('doc_proposal')) {
            $file = $request->file('doc_proposal');
            $directoryPath = 'private/documents';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/documents/' . $filename, File::get($file));
            $validatedData['doc_proposal'] = $filename;
        }

        if ($request->hasFile('doc_balasan')) {
            $file = $request->file('doc_balasan');
            $directoryPath = 'private/documents';

            // Create directory if not exists
            if (!file_exists($directoryPath)) {
                Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
            }

            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('/private/documents/' . $filename, File::get($file));
            $validatedData['doc_balasan'] = $filename;
        }

        $user = User::create([
            'username' => $validatedData['username'],
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'email' => $validatedData['email'],
            'no_hp' => $validatedData['no_hp'],
            'password' => $validatedData['password']
        ]);

        $document = $user->document()->create($validatedData);
        $document->status()->create($validatedData);

        if ($validatedData['status'] === 'diterima') {
            $status = $document->status;
            $status->certificate()->create($validatedData);
        }

        return redirect(route('admin.manageUser'))->with('success', 'Registrasi Berhasil!');
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
            'no_hp' => ['required', 'numeric', 'digits_between:10,14', 'unique:users,no_hp,' . $document->user->id],
            'email' => ['required', 'email', 'unique:users,email,' . $document->user->id],

            // Document data
            'no_identitas' => ['required', 'numeric', 'digits_between:4,20', 'unique:documents,no_identitas,' . $document->id],
            'jurusan' => ['required'],
            'instansi_asal' => ['required'],
            'office_id' => ['required'],
            'position_id' => ['required'],
            'nama_pembimbing' => ['required'],
            'no_hp_pembimbing' => ['required', 'numeric', 'digits_between:10,14'],
            'u_tgl_mulai' => ['required', 'date_format:d/m/Y'],
            'u_tgl_selesai' => ['required', 'date_format:d/m/Y'],
            'e_tgl_mulai' => ['required', 'date_format:d/m/Y'],
            'e_tgl_selesai' => ['required', 'date_format:d/m/Y'],

            // Status data
            'status' => ['required', 'in:menunggu,diterima,ditolak,selesai'],
            'keterangan' => ['nullable'],
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

        if (isset($validatedData['doc_balasan'])) {
            // Process 'doc_balasan' if it exists
            if ($request->hasFile('doc_balasan')) {
                // Handle file upload and storage
                $file = $request->file('doc_balasan');
                $directoryPath = 'private/documents';

                // Create directory if not exists
                if (!file_exists($directoryPath)) {
                    Storage::disk('local')->makeDirectory($directoryPath, 0775, true);
                }

                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                Storage::disk('local')->put('/private/documents/' . $filename, File::get($file));
                $statusData['doc_balasan'] = $filename;
            }
        }

        $document->status->update($statusData);

        if ($validatedData['status'] === 'diterima') {
            // Get the document's current status
            $status = $document->status;

            // Create a certificate if the status is changing to "diterima"
            $status->certificate()->create($validatedData);
        } elseif ($validatedData['status'] === 'ditolak') {
            $status = $document->status;
            $document->update([
                'e_tgl_mulai' => null,
                'e_tgl_selesai' => null
            ]);

            $status->certificate()->delete();
        }

        return redirect(route('admin.manageUser'))->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Document::with('user', 'status')
            ->whereHas('user', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->firstOrFail();

        if ($user->doc_pengantar) {
            Storage::disk('local')->delete('private/documents/' . $user->doc_pengantar);
        }
        if ($user->doc_kesbang) {
            Storage::disk('local')->delete('private/documents/' . $user->doc_kesbang);
        }
        if ($user->doc_proposal) {
            Storage::disk('local')->delete('private/documents/' . $user->doc_proposal);
        }
        if ($user->status->doc_balasan) {
            Storage::disk('local')->delete('private/documents/' . $user->status->doc_balasan);
        }
        $user->delete();

        $getUser = Auth::guard('admin')->user()->nama_lengkap;
        activity()->causedBy($user)->log($getUser . ' melakukan delete data User');

        return redirect(route('admin.manageUser'))->with('success', 'Data berhasil dihapus!');
    }

    public function downloadFile($documents)
    {

        $filePath = storage_path('app/private/documents/' . $documents);

        // Return the file as a download response
        return response()->download($filePath);
    }
}
