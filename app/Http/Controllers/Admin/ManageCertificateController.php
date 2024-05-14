<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Document;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class ManageCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Data Sertifikat Peserta';

        return view('admin.certificate.certificate_list', $data);
    }

    public function tableCertificate()
    {
        $query = Document::select('documents.*')
            ->with('user', 'status.certificate.score', 'position')
            ->whereHas('status', function ($queryS) {
                $queryS->whereNot('status', 'menunggu')
                ->whereHas('certificate.score');
            })
            ->orderByDesc('updated_at');

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('user.nama_lengkap', function ($data) {
                return $data->user->nama_lengkap;
            })
            ->editColumn('user.jenis_kelamin', function ($data) {
                return $data->user->jenis_kelamin;
            })
            ->editColumn('instansi_asal', function ($data) {
                return $data->instansi_asal;
            })
            ->editColumn('e_tgl_mulai', function ($data) {
                return $data->e_tgl_mulai;
            })
            ->editColumn('e_tgl_selesai', function ($data) {
                return $data->e_tgl_selesai;
            })

            ->addColumn('opsi', function ($data) {
                // Assuming you have a route named 'mentor.manageCertificate' to show certificate details
                $detailRoute = route('admin.detailCertificate', ['certificate' => Crypt::encryptString($data->status->certificate->id)]);

                return '<a href="' . $detailRoute . '" class="py-2 text-center text-md text-blue-500 cursor-pointer hover:underline">Detail</a>';
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
        $certificate = Certificate::find($certificate->id);

        if ($certificate->doc_sertifikat) {
            Storage::disk('local')->delete('private/certificates/' . $certificate->doc_sertifikat);
        }
        $certificate->delete();

        Status::where('id', $certificate->status_id)->update(['status' => 'ditolak']);

        return redirect(route('admin.manageCertificate'))->with('success', 'Data berhasil dihapus!');
    }

    public function generateCertificate($id)
    {
        $decryptId = Crypt::decryptString($id);
        $data['scoreData'] = Certificate::join('scores', 'certificates.id', 'scores.certificate_id')
            ->where('scores.certificate_id', $decryptId)
            ->get();

        $path_qrCode = Certificate::where('id', $decryptId)->first();

        $downloadLink = route('downloadFileCertificate', ['certificate' => $path_qrCode->uuid]);

        // Generate the QR code with the download link
        $qrCode = QrCode::format('png')->size(300)->generate($downloadLink);

        // Save the generated QR code to the storage directory
        $directory_qr = 'img/qr_code';

        // Create directory if not exists
        if (!Storage::disk('public')->exists($directory_qr)) {
            Storage::disk('public')->makeDirectory($directory_qr, 0775, true);
        }

        $filename_qr = 'qr_code_' . Str::random(20) . '.png';
        $filePath = $directory_qr . '/' . $filename_qr;

        Storage::disk('public')->put($filePath, $qrCode);
        // save qr_code
        Certificate::where('id', $decryptId)->update(['qr_code' => $filename_qr]);

        $now = Carbon::now();
        $id_certificate = str_pad($decryptId, 3, '0', STR_PAD_LEFT); // Add leading zeros if necessary
        $month = $now->format('n');
        $romanMonth = toRoman($month);
        $year = $now->format('Y');

        // Format the certificate number
        $certificateNumber = $id_certificate . '/SIGMA/' . $now->format('d') . '/' . $romanMonth . '/' . $year;
        // save certificate number
        Certificate::where('id', $decryptId)->update(['no_sertifikat' => $certificateNumber]);

        $data['userData'] = Document::with('user', 'office', 'position', 'status.certificate.score')
            ->whereHas('status.certificate.score', function ($query) use ($decryptId) {
                $query->where('certificate_id', $decryptId);
            })->get();

        // Load the certificate HTML view
        $certificateView = view('admin.certificate.template_certificate', $data)->render();

        // Setup Dompdf options
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->setChroot(app_path());

        $sslContextOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];
        $options->setHttpContext(
            stream_context_create($sslContextOptions)
        );

        // Create a new Dompdf instance
        $dompdf = new Dompdf($options);

        // Load the HTML content into Dompdf
        $dompdf->loadHtml($certificateView);

        // Set paper size and orientation
        $dompdf->setPaper('a4', 'landscape');


        // Render the PDF
        $dompdf->render();

        // Save the PDF file in the private/certificates directory
        $filename = 'certificate_' . Str::random(20) . '.pdf';
        $directoryPath = 'private/certificates';

        // Create directory if not exists
        if (!Storage::disk('local')->exists($directoryPath)) {
            Storage::disk('local')->makeDirectory($directoryPath, 0755, true);
        }

        $filePath = $directoryPath . '/' . $filename;
        Storage::disk('local')->put($filePath, $dompdf->output(['compress' => true]));

        // Update the Certificate model with the path to the saved PDF file
        $certificate = Certificate::where('id', $decryptId)->update(['doc_sertifikat' => $filename]);

        // Retrieve the certificate model
        $certificate = Certificate::find($decryptId);

        // Update the status to 'selesai'
        $status = $certificate->status;
        $status->update(['status' => 'selesai']);

        // Return the path to the saved PDF file
        return back()->with('success', 'Sukses Generate Sertifikat!');
    }

    public function downloadCertificate($certificate)
    {
        $certificate = Certificate::where('uuid', $certificate)->first();

        // Check if certificate exists
        if (!$certificate) {
            abort(404);
        }

        // Get the file path
        $filePath = storage_path('app/private/certificates/' . $certificate->doc_sertifikat);

        // Check if the file exists
        if (!file_exists($filePath)) {
            abort(404);
        }

        // Return the file as a download response
        return response()->download($filePath);
    }
}
