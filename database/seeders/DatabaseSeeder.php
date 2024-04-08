<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            OfficeSeeder::class,
            PositionSeeder::class,
            MetaSeeder::class,
            UserSeeder::class,
            DocumentSeeder::class,
            StatusSeeder::class,
            AdminSeeder::class,
            HomepageSeeder::class,
            AnnouncementSeeder::class,
            PublicationSeeder::class,
        ]);
    }
}
