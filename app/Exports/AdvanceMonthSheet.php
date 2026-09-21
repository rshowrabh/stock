<?php

namespace App\Exports;

use App\Models\StocksOut;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class AdvanceMonthSheet implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithTitle
{
    protected $year;
    protected $month;
    protected $title;
    protected $itemId;
    protected $serial = 1;

    public function __construct($year, $month, $title, $itemId)
    {
        $this->year = $year;
        $this->month = $month;
        $this->title = $title;
        $this->itemId = $itemId;
    }

    public function collection()
    {
        return StocksOut::where('item_id', $this->itemId)
            ->whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->with('member')
            ->orderBy('date', 'asc')
            ->get();
    }

    public function title(): string
    {
        return $this->title;
    }

    public function headings(): array
    {
        return [
            '#',
            'Date',
            'Member',
            'Designation',
            'Comment',
            'Quantity',
        ];
    }

    public function map($data): array
    {
        return [
            $data->int_no,
            $data->date,
            $data->member->name ?? 'N/A',
            $data->member->title ?? 'N/A',
            $data->comment ?? 'N/A',
            $data->quantity ?? 0,
        ];
    }
}