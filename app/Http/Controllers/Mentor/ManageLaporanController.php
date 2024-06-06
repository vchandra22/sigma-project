<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ManageLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Laporan Magang';

        return view('mentor.laporan.laporan_list', $data);
    }

    /**
     * Display a listing of the laporan data    .
     */
    public function tableLaporan()
    {
        $user = Auth::user();
        $query = Document::select('documents.*')->with('user', 'status', 'position')
            ->where('office_id', $user->office_id)
            ->where(function ($query) {
                $query->whereHas('status', function ($query) {
                    $query->where('status', 'diterima');
                })->orWhereHas('status', function ($query) {
                    $query->where('status', 'selesai');
                });
            })
            ->orderByDesc('updated_at');

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('user.nama_lengkap', function ($data) {
                return $data->user->nama_lengkap;
            })
            ->editColumn('no_identitas', function ($data) {
                return $data->no_identitas;
            })
            ->editColumn('user.no_hp', function ($data) {
                return $data->user->no_hp;
            })
            ->editColumn('instansi_asal', function ($data) {
                return $data->instansi_asal;
            })
            ->editColumn('position.role', function ($data) {
                return $data->position->role;
            })
            ->editColumn('status.status', function ($data) {
                return $data->status->status;
            })
            ->addColumn('opsi', function ($data) {
                if ($data->doc_laporan) {
                    return '<a href="' . route('mentor.downloadLaporan', $data->uuid) . '">'
                        . '<div class="capitalize mx-auto text-start py-2 pointer-events-none text-blue-500 hover:underline hover:text-blue-800">'
                        . 'Unduh Laporan'
                        . '</div>'
                        . '</a>';
                } else {
                    return '<p class="capitalize mx-auto text-start py-2 pointer-events-none text-red-500">'
                        . 'Peserta belum mengunggah laporan'
                        . '</p>';
                }
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }

    public function downloadLaporan($laporan)
    {
        $laporan = Document::where('uuid', $laporan)->first();

        // Check if certificate exists
        if (!$laporan) {
            abort(404);
        }

        // Get the file path
        $filePath = storage_path('app/private/laporan/' . $laporan->doc_laporan);

        // Check if the file exists
        if (!file_exists($filePath)) {
            abort(404);
        }

        // Return the file as a download response
        return response()->download($filePath);
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
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
    }
}
