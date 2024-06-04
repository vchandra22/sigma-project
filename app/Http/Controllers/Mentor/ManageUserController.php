<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Office;
use App\Models\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ManageUserController extends Controller
{
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
        $admin = Auth::guard('admin')->user();
        $query = Document::with(['user', 'status.certificate.score', 'position'])
            ->where('office_id', $admin->office_id)
            ->whereHas('status', function ($q) {
                $q->where('status', '!=', 'menunggu');
            })
            ->orderByDesc('updated_at')
            ->whereHas('status.certificate')
            ->latest();

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
        ]);

        // Convert date formats
        $validatedData['u_tgl_mulai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_mulai'])->format('Y-m-d');
        $validatedData['u_tgl_selesai'] = Carbon::createFromFormat('d/m/Y', $validatedData['u_tgl_selesai'])->format('Y-m-d');

        // Update document
        $document->update($validatedData);

        // Update user
        $document->user->update($validatedData);

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
        //
    }

    public function downloadFile($documents)
    {
        $filePath = storage_path('app/private/documents/' . $documents);

        // Return the file as a download response
        return response()->download($filePath);
    }
}
