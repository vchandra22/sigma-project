<?php

namespace Database\Seeders;

use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $numRecords = 15;  // Sesuaikan jumlah record yang diinginkan
        $startTime = Carbon::now()->subDay();

        \App\Models\Document::factory()->count($numRecords)->create()->each(function ($document, $index) use ($startTime) {
            $document->created_at = $startTime->copy()->addMinutes($index * 10);
            $document->updated_at = $document->created_at;
            $document->save();
        });
    }
}
