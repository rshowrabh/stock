<?php

namespace App\Exports;

use App\Models\StocksOut;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AdvanceExport implements WithMultipleSheets
{
    protected $from;
    protected $to;
    protected $itemId;

    public function __construct($from, $to, $itemId)
    {
        $this->from = $from;
        $this->to = $to;
        $this->itemId = $itemId;
    }

    public function sheets(): array
    {
        $sheets = [];

        $start = \Carbon\Carbon::parse($this->from)->startOfMonth();
        $end = \Carbon\Carbon::parse($this->to)->startOfMonth();

        while ($start <= $end) {

            $sheets[] = new AdvanceMonthSheet(
                $start->year,
                $start->month,
                $start->format('F Y'),
                $this->itemId
            );

            $start->addMonth();
        }

        return $sheets;
    }
}