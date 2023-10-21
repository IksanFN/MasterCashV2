<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = [
            ['title' => 'Rekayasa Perangkat Lunak', 'major_code' => 'RPL'],
            ['title' => 'Akutansi', 'major_code' => 'AK'],
        ];

        foreach ($majors as $major) {
            \App\Models\Major::create($major);
        }
    }
}
