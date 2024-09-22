<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, WithHeadings, WithTitle, WithCustomStartCell, WithStyles
{
    protected $data;
    protected $headings;
    protected $title;
    protected $start_date;
    protected $end_date;

    public function __construct($data, $headings, $title, $start_date, $end_date)
    {
        $this->data = $data;
        $this->headings = $headings;
        $this->title = $title;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function startCell(): string
    {
        return 'A4';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:D1');
        $sheet->setCellValue('A1', $this->title);

        $sheet->mergeCells('A2:D2');
        $sheet->setCellValue('A2', "Periode: $this->start_date sampai $this->end_date");

        return [
            'A1' => ['font' => ['bold' => true, 'size' => 16]],
            'A2' => ['font' => ['italic' => true]],
            'A4:Z4' => ['font' => ['bold' => true]],
        ];
    }
}
