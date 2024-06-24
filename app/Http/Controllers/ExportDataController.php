<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ExportDataController extends Controller
{
    public function exportUsersPDF($status = null)
    {
        $query = Document::with(['user', 'office', 'position', 'status'])
            ->where('office_id', auth()->user()->office_id)
            ->latest();

        if ($status && $status !== ' ') {
            $query->whereHas('status', function ($q) use ($status) {
                $q->where('status', $status);
            });
        }

        $documents = $query->get();

        $pdf = Pdf::loadView('exports.peserta', compact('documents'))
            ->setPaper('a4', 'landscape');

        $date = date('Ymd_His');
        $fileName = "data_peserta_{$date}.pdf";

        return $pdf->download($fileName);
    }

    public function exportUsersMentorPDF($status = null)
    {
        $query = Document::with(['user', 'office', 'position', 'status.certificate'])
            ->where('office_id', auth()->user()->office_id)
            ->whereHas('status', function ($q) {
                $q->where('status', '!=', 'menunggu');
            })
            ->whereHas('status.certificate')
            ->latest();

        if ($status && $status !== ' ') {
            $query->whereHas('status', function ($q) use ($status) {
                $q->where('status', $status);
            });
        }

        $documents = $query->get();

        $pdf = Pdf::loadView('exports.peserta', compact('documents'))
            ->setPaper('a4', 'landscape');

        $date = date('Ymd_His');
        $fileName = "data_peserta_{$date}.pdf";

        return $pdf->download($fileName);
    }

    public function exportCertificatePDF()
    {

        $documents = Document::select('documents.*')
            ->with('user', 'status.certificate.score', 'position')
            ->where('office_id', Auth::guard('admin')->user()->office_id)
            ->whereHas('status', function ($queryS) {
                $queryS->whereNot('status', 'menunggu')
                    ->whereHas('certificate.score');
            })
            ->latest()
            ->get();

        $pdf = Pdf::loadView('exports.certificate', compact('documents'))
            ->setPaper('a4', 'landscape');

        $date = date('Ymd_His');
        $fileName = "data_penerbitan_sertifikat{$date}.pdf";

        return $pdf->download($fileName);
    }
}
