<?php

namespace Database\Seeders;

use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numRecords = 15;  // Sesuaikan jumlah record yang diinginkan
        $startTime = Carbon::now()->subDay();

        \App\Models\Status::factory()->count($numRecords)->create()->each(function ($status, $index) use ($startTime) {
            $status->created_at = $startTime->copy()->addMinutes($index * 10);
            $status->updated_at = $status->created_at;
            $status->save();
        });
    }
}
