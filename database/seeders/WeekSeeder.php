<?php

namespace Database\Seeders;

use App\Models\Week;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weeks = [
            ['title' => 'First Week'],
            ['title' => 'Second Week'],
            ['title' => 'Third Week'],
            ['title' => 'Fourth Week'],
        ];

        foreach ($weeks as $week) {
            Week::create($week);
        }
    }
}
