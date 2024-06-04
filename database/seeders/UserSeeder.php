<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numRecords = 15;  // Sesuaikan jumlah record yang diinginkan
        $startTime = Carbon::now()->subDay();

        \App\Models\User::factory()->count($numRecords)->create()->each(function ($user, $index) use ($startTime) {
            $user->created_at = $startTime->copy()->addMinutes($index * 10);
            $user->updated_at = $user->created_at;
            $user->save();
        });
    }
}
