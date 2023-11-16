<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public $query;
    public $classroom;

    public function headings(): array
    {
        return [
            'NISN',
            'Name',
            'Email',
            'Number Phone',
            'Gender',
            'Classroom',
            'Major'
        ];
    }

    public function forClassroom($classroom)
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function forSearch($query)
    {
        $this->query = $query;

        return $this;
    }

    public function query()
    {
        return  User::query()->where('is_student', true)
                            ->when($this->query, function($query) {
                                $query->where(function($query) {
                                    $query->where('nisn', 'like', '%'.$this->query.'%')
                                            ->orWhere('name', 'like', '%'.$this->query.'%');
                                });
                            })
                            ->when($this->classroom, function($classroom) {
                                $classroom->where(function($classroom) {
                                    $classroom->where('classroom_id', '=', $this->classroom);
                                });
                            })
                            ->latest();
    }

    public function map($students): array
    {
        return [
            $students->nisn,
            $students->name,
            $students->email,
            $students->phone,
            $students->gender,
            $students->classroom->title,
            $students->major->title
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
