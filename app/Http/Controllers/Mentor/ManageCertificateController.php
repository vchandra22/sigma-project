<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Document;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ManageCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Penilaian';

        $admin = Auth::guard('admin')->user();
        $data['dataCertificate'] = Document::with('user', 'status', 'position')
            ->where('office_id', $admin->office_id)
            ->whereHas('status', function ($query) {
                $query->whereNot('status', 'menunggu');
            })
            ->latest()
            ->get();

        return view('mentor.penilaian.penilaian_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Buat Penilaian';
        $user = Auth::user();
        $data['userData'] = Document::with('user', 'status.certificate')
            ->where('office_id', $user->office_id)
            ->whereHas('status.certificate') // Ensure that the document has a related status with a certificate
            ->get();

        return view('mentor.penilaian.penilaian_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'certificate_id' => ['required'],
            'judul_kompetensi.*' => ['required'],
            'nilai_uji.*' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        // Retrieve the validated data from the request
        $certificateId = $request->certificate_id;
        $judul = $request->judul_kompetensi;
        $nilai = $request->nilai_uji;

        // Create an array to hold the new records
        $newScores = [];
        $now = now(); // Get the current time

        foreach ($judul as $key => $judul) {
            $uuid = Str::uuid();
            $newScores[] = [
                'uuid' => $uuid,
                'certificate_id' => $certificateId,
                'judul_kompetensi' => $judul,
                'nilai_uji' => $nilai[$key],
                'created_at' => $now, // Set created_at timestamp
                'updated_at' => $now, // Set created_at timestamp
            ];
        }

        // Insert the new records into the database
        DB::table('scores')->insert($newScores);

        return redirect(route('mentor.managePenilaian'))->with('success', 'Registrasi Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        //
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
}
