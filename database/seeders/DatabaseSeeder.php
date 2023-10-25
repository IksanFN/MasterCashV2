<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminUserSeeder::class,
            ClassroomSeeder::class,
            MajorSeeder::class,
            YearSeeder::class,
            MonthSeeder::class,
            WeekSeeder::class,
        ]);
    }
}
