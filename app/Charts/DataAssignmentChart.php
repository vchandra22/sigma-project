<?php

namespace App\Charts;

use App\Models\Assignment;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;

class DataAssignmentChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $auth = Auth::user();

        $statusCounts = Assignment::where('created_by', $auth->id)
            ->groupBy('status')
            ->selectRaw('status, count(*) as count')
            ->pluck('count', 'status')
            ->toArray();

        // Map status labels to display values
        $statusLabels = [
            'dikirim' => 'Belum Dikerjakan',
            'selesai' => 'Selesai',
            'terlambat' => 'Terlambat',
        ];

        // Replace status counts with zero counts for missing statuses
        $statusCounts = array_replace(array_fill_keys(array_keys($statusLabels), 0), $statusCounts);

        // Map status labels to their display values
        $statusLabels = array_map(function ($status) use ($statusLabels) {
            return $statusLabels[$status];
        }, array_keys($statusCounts));

        return $this->chart->barChart()
            ->setColors(['#243048', '#0F2885'])
            ->addData('Jumlah', array_values($statusCounts))
            ->setXAxis($statusLabels)
            ->setFontFamily('Hanuman');
    }
}
