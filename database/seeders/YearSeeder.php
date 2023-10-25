<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = [
            ['title' => '2023'],
            ['title' => '2022'],
            ['title' => '2021'],
            ['title' => '2020'],
        ];

        foreach ($years as $year) {
            Year::create($year);
        }
    }
}
