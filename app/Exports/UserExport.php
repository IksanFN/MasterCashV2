<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public $query;

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Status'
        ];
    }

    public function forSearch($query)
    {
        $this->query = $query;

        return $this;
    }

    public function query()
    {
        return User::query()->where('is_student', false)->where('is_active', true)
                            ->when($this->query, function($query) {
                                $query->where('name', 'like', '%'.$this->query.'%')
                                        ->where('email', 'like', '%'.$this->query.'%');
                            })
                            ->latest();
    }

    public function map($users): array
    {
        return [
            $users->name,
            $users->email,
            $users->phone,
            $users->is_active,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
