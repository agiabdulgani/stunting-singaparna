<?php
namespace App\Exports;

use App\Models\TargetData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TargetDataExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return TargetData::all();
    }

    public function headings(): array
    {
        return ["ID", "Nama Desa", "Populasi", "Keluarga", "Remaja Putri", "Anak", "Created At", "Updated At"];
    }
}