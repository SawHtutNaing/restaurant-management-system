<?php
namespace App\Exports;

use App\Models\Meal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MealsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Meal::with('category')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Category',
            'Price ($)',
            'Description',
            'Is Signature',
        ];
    }

    public function map($meal): array
    {
        return [
            $meal->name,
            $meal->category->name,
            number_format($meal->price, 2),
            $meal->description ?? 'No description',
            $meal->is_signature ? 'Yes' : 'No',
        ];
    }
}
