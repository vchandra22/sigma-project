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
            FaqSeeder::class,
            JourneySeeder::class,
            BenefitSeeder::class,
            RequirementSeeder::class,
        ]);
    }
}
