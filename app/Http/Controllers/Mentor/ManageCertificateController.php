<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Document;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ManageCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Penilaian';

        return view('mentor.penilaian.penilaian_list', $data);
    }

    /**
     * Display a listing of the penilaian peserta data.
     */
    public function tablePenilaian()
    {
        $admin = Auth::guard('admin')->user();
        $query = Document::with(['user', 'status.certificate.score', 'position'])
            ->where('office_id', $admin->office_id)
            ->whereHas('status', function ($query) {
                $query->where('status', '!=', 'menunggu');
            })
            ->whereHas('status.certificate')
            ->orderByDesc('updated_at');

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('user.nama_lengkap', function ($data) {
                return $data->user->nama_lengkap;
            })
            ->editColumn('user.document.no_identitas', function ($data) {
                return $data->user->document->no_identitas;
            })
            ->editColumn('no_identitas', function ($data) {
                return $data->no_identitas;
            })
            ->editColumn('instansi_asal', function ($data) {
                return $data->instansi_asal;
            })
            ->editColumn('status.certificate.no_sertifikat', function ($data) {
                return $data->status->certificate->no_sertifikat;
            })
            ->editColumn('status.certificate.score', function ($data) {
                return $data->status->certificate->score;
            })
            ->addColumn('opsi', function ($data) {
                if ($data->status->certificate->score) {
                    $detailRoute = route('mentor.detailPenilaian', Crypt::encryptString($data->status->certificate->id));
                    return '<a href="' . $detailRoute . '" class="py-2 text-center text-md text-blue-500 cursor-pointer hover:underline">Detail</a>';
                } else {
                    $newPenilaianRoute = route('mentor.newPenilaian', $data->uuid);
                    return '<a href="' . $newPenilaianRoute . '" class="py-2 text-center text-md text-red-500 cursor-pointer hover:underline">Buat Penilaian</a>';
                }
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Buat Penilaian';
        $user = Auth::user();
        $data['userData'] = Document::with('user', 'status.certificate.score')
            ->where('office_id', $user->office_id)
            ->whereHas('status.certificate', function ($query) {
                $query->whereDoesntHave('score');
            })
            ->get();

        return view('mentor.penilaian.penilaian_create', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createOnUser($userId)
    {
        $data['pageTitle'] = 'Buat Penilaian';
        $admin = Auth::user();
        $user = Document::where('uuid', $userId)->first();
        $data['userData'] = Document::with('user', 'status.certificate.score')
            ->where('office_id', $admin->office_id)
            ->where('uuid', $user->uuid)
            ->whereHas('status.certificate', function ($query) {
                $query->whereDoesntHave('score');
            })
            ->get();

        // dd($data['userData']);

        return view('mentor.penilaian.penilaian_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'certificate_id' => ['required'],
            'judul_kompetensi.*' => ['required'],
            'nilai_uji.*' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        // Retrieve the validated data from the request
        $certificateId = $request->certificate_id;
        $judul = $request->judul_kompetensi;
        $nilai = $request->nilai_uji;

        // Create an array to hold the new records
        $newScores = [];
        $now = now(); // Get the current time

        foreach ($judul as $key => $judul) {
            // Ensure the array key exists in the other array
            if (isset($nilai[$key])) {
                $uuid = Str::uuid();
                $newScores[] = [
                    'uuid' => $uuid,
                    'certificate_id' => $certificateId,
                    'judul_kompetensi' => $judul, // Use the value from the $judul array
                    'nilai_uji' => $nilai[$key], // Use the value from the $nilai array
                    'created_at' => $now, // Set created_at timestamp
                    'updated_at' => $now, // Set updated_at timestamp
                ];
            }
        }

        // Insert the new records into the database
        DB::table('scores')->insert($newScores);

        return redirect(route('mentor.managePenilaian'))->with('success', 'Registrasi Berhasil!');
    }

    public function add(Request $request)
    {
        $certificateId = Crypt::decryptString($request->route('certificate'));
        $data['pageTitle'] = 'Tambah Penilaian';
        $user = Auth::user();
        $data['userData'] = Document::with('user', 'status.certificate.score')
            ->where('office_id', $user->office_id)
            ->whereHas('status.certificate', function ($query) use ($certificateId) {
                $query->where('id', $certificateId);
            })
            ->get();

        return view('mentor.penilaian.penilaian_add', $data);
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

        return view('mentor.penilaian.penilaian_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        // $decryptId =  Crypt::decryptString($id);
        $data['pageTitle'] = 'Update Nilai';
        $data['scoreDetail'] = Score::where('uuid', $uuid)->get();

        return view('mentor.penilaian.penilaian_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score)
    {
        $validatedData = $request->validate([
            'judul_kompetensi' => ['required'],
            'nilai_uji' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        $score->update($validatedData);

        $certificateId = $score->certificate_id;
        $encryptedCertificateId = Crypt::encryptString($certificateId);
        return redirect()->route('mentor.detailPenilaian', ['certificate' => $encryptedCertificateId])->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $score = Score::find($id);
        $score->delete();

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
