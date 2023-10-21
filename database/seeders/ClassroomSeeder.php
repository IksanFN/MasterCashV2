<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classrooms = [
            ['title' => 'X RPL 2'],
            ['title' => 'X RPL 1'],
            ['title' => 'X RPL 3'],
            ['title' => 'X AK 1'],
            ['title' => 'X AK 2'],
        ];

        foreach ($classrooms as $classroom) {
            \App\Models\Classroom::create($classroom);
        }
    }
}
