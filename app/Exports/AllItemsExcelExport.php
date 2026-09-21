<?php

namespace App\Exports;

use App\Models\StocksOut;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AllItemsExcelExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithEvents
{
    protected $from;
    protected $to;
    protected $itemId;

    protected $serial = 1;
    protected $total = 0;

    public function __construct($from, $to, $itemId)
    {
        $this->from = $from;
        $this->to = $to;
        $this->itemId = $itemId;
    }

    public function collection()
    {
        return StocksOut::where('item_id', $this->itemId)
            ->whereBetween('date', [$this->from, $this->to])
            ->with('member')
            ->orderBy('date', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Date',
            'Designation',
            'Comment',
            'Quantity',
        ];
    }

    public function map($data): array
    {
        $quantity = $data->quantity ?? 0;

        $this->total += $quantity;

        return [
            $this->serial++,
            $data->date,
            $data->member->name ?? 'N/A',
            $data->member->title ?? 'N/A',
            $data->comment ?? 'N/A',
            $quantity,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $lastRow = $event->sheet->getHighestRow();

                $totalRow = $lastRow + 1;

                $event->sheet->setCellValue(
                    'D' . $totalRow,
                    'Total Quantity'
                );

                $event->sheet->setCellValue(
                    'E' . $totalRow,
                    $this->total
                );

                // Header Bold
                $event->sheet
                    ->getStyle('A1:E1')
                    ->getFont()
                    ->setBold(true);

                // Total Bold
                $event->sheet
                    ->getStyle('D' . $totalRow . ':E' . $totalRow)
                    ->getFont()
                    ->setBold(true);

                // Column Width
                $event->sheet->getColumnDimension('A')->setWidth(8);
                $event->sheet->getColumnDimension('B')->setWidth(15);
                $event->sheet->getColumnDimension('C')->setWidth(25);
                $event->sheet->getColumnDimension('D')->setWidth(40);
                $event->sheet->getColumnDimension('E')->setWidth(15);
            },
        ];
    }
}