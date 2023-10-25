<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $months = [
            ['title' => 'January'],
            ['title' => 'February'],
            ['title' => 'March'],
            ['title' => 'April'],
            ['title' => 'May'],
            ['title' => 'June'],
            ['title' => 'July'],
            ['title' => 'August'],
            ['title' => 'September'],
            ['title' => 'October'],
            ['title' => 'November'],
            ['title' => 'December'],
        ];

        foreach ($months as $month) {
            Month::create($month);
        }
    }
}
