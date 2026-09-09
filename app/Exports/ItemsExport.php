<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Item::with('category')
            ->orderBy('name', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Category',
            'Quantity Left',
        ];
    }

    public function map($item): array
    {
        static $serial = 0;
        $serial++;
        return [
            $serial,
            $item->name,
            $item->category->name ?? 'N/A',
            $item->stocks_left ?? 0,
        ];
    }
}