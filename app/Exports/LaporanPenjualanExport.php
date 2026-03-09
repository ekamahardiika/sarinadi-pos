<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaporanPenjualanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithEvents
{
    protected $data;
    protected $totalPendapatan;
    protected $title;

    public function __construct($data, $totalPendapatan, $title)
    {
        $this->data = $data;
        $this->totalPendapatan = $totalPendapatan;
        $this->title = $title;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return ['No', 'Tanggal / Hari / Bulan', 'Pendapatan'];
    }

    public function map($row): array
    {
        // Flexibel: gunakan label agar mendukung harian/bulanan/tahunan
        $label = $row['label'] ?? $row['kode_transaksi'] ?? $row['hari'] ?? $row['bulan'] ?? '';

        return [
            $row['no'],
            $label,
            $row['pendapatan'],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 25,
            'C' => 22,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // judul
            2 => ['font' => ['bold' => true]], // header tabel
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = count($this->data) + 2; // +2 karena baris 1: judul, baris 2: header

                // ===== JUDUL =====
                $sheet->mergeCells('A1:C1');
                $sheet->setCellValue('A1', $this->title);
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 13],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $sheet->getRowDimension(1)->setRowHeight(25);

                // ===== HEADER =====
                $sheet->getStyle('A2:C2')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFFFFF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // ===== BORDER SEMUA DATA =====
                $sheet->getStyle("A2:C{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // ===== FORMAT KOLOM PENDAPATAN =====
                $sheet->getStyle("C3:C{$lastRow}")->getNumberFormat()
                    ->setFormatCode('"Rp "#,##0');

                // ===== BARIS TOTAL =====
                $totalRow = $lastRow + 1;
                $sheet->mergeCells("A{$totalRow}:B{$totalRow}");
                $sheet->setCellValue("A{$totalRow}", 'Total Pendapatan');
                $sheet->setCellValue("C{$totalRow}", $this->totalPendapatan);
                $sheet->getStyle("A{$totalRow}:C{$totalRow}")->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF000000']],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);
                $sheet->getStyle("C{$totalRow}")->getNumberFormat()
                    ->setFormatCode('"Rp "#,##0');

                // ===== ALIGNMENT =====
                $sheet->getStyle("A3:A{$totalRow}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("A{$totalRow}:B{$totalRow}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}