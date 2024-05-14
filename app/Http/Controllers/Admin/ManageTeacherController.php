<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ManageTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Kontak Dosen / Guru';

        return view('admin.teacher.teacher_list', $data);
    }

    public function tableTeacher()
    {
        $admin = Auth::guard('admin')->user();
        $query = Document::with('status', 'user')
            ->where('office_id', $admin->office_id)
            ->whereHas('status', function ($query) {
                $query->whereNot('status', 'menunggu');
            })
            ->latest()
            ->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('documents.nama_pembimbing', function ($data) {
                return $data->nama_pembimbing;
            })
            ->addColumn('opsi', function ($data) {
                // Construct WhatsApp chat link
                $phoneNumber = $data->no_hp_pembimbing;
                $internationalNumber = '62' . ltrim($phoneNumber, '0');
                $whatsappLink = 'https://wa.me/' . $internationalNumber;

                // Generate anchor tag with WhatsApp chat link
                return '<a href="' . $whatsappLink . '" target="_blank" class="text-secondary bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-100 font-medium rounded-sm text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 me-2 mb-2"><i class="fa-brands fa-whatsapp mr-2 fa-lg"></i>Coba Hubungi WA</a>';
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
