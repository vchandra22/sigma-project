<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ManageCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Data Sertifikat Peserta';
        $data['dataCertificate'] = Document::with('user', 'status.certificate.score', 'position')
            ->whereHas('status', function ($query) {
                $query->whereNot('status', 'menunggu');
            })
            ->whereHas('status.certificate.score')
            ->latest()
            ->paginate(20);

        return view('admin.certificate.certificate_list', $data);
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
    public function show($id)
    {
        $decryptId =  Crypt::decryptString($id);
        $data['pageTitle'] = 'Detail Penilaian';
        $data['scoreDetail'] = Certificate::join('scores', 'certificates.id', 'scores.certificate_id')->where('scores.certificate_id', $decryptId)->get();
        $data['getCertificateId'] = Certificate::where('id', $decryptId)->first();
        $data['getUserData'] = Document::with('user', 'status')
        ->whereHas('status.certificate', function ($query) use ($decryptId) {
            $query->where('id', $decryptId);
        })
            ->first();

        return view('admin.certificate.certificate_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        //
    }

    public function template() {
        return view('admin.certificate.template_certificate');
    }
}
