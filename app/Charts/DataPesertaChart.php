<?php

namespace App\Charts;

use App\Models\Document;
use App\Models\Status;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;

class DataPesertaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $auth = Auth::user();

        $statusCounts = Document::with('status')
        ->where('office_id', $auth->office_id)
            ->get()
            ->groupBy('status.status')
            ->map(function ($group) {
                return $group->count();
            })
            ->toArray();

        // Map status labels to display values
        $statusLabels = [
            'menunggu' => 'Pendaftar',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            'selesai' => 'Selesai'
        ];

        // Replace status counts with zero counts for missing statuses
        $statusCounts = array_replace(array_fill_keys(array_keys($statusLabels), 0), $statusCounts);

        // Map status labels to their display values
        $statusLabels = array_map(function ($status) use ($statusLabels) {
            return $statusLabels[$status];
        }, array_keys($statusCounts));

        return $this->chart->barChart()
            ->setColors(['#243048', '#0F2885'])
            ->addData('Jumlah Peserta', array_values($statusCounts))
            ->setXAxis($statusLabels)
            ->setFontFamily('Hanuman');
    }
}
