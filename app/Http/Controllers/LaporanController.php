<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Exports\LaporanPenjualanExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');

        $filter = $request->get('filter', 'harian');
        $date   = $request->get('date', Carbon::today()->toDateString());
        $month  = $request->get('month', Carbon::now()->month);
        $year   = $request->get('year', Carbon::now()->year);
        $export = $request->get('export');

        $query = Transaksi::query();
        if ($filter === 'harian') {
            $query->whereDate('created_at', $date);
        } elseif ($filter === 'bulanan') {
            $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
        } elseif ($filter === 'tahunan') {
            $query->whereYear('created_at', $year);
        }

        $transaksis = $query->orderBy('created_at', 'desc')->get();

        $laporan = $transaksis->map(function ($t, $index) {
            return [
                'no'         => $index + 1,
                'tanggal'    => $t->created_at->locale('id')->translatedFormat('d F Y'),
                'pendapatan' => $t->subtotal,
            ];
        });

        $totalPendapatan = $transaksis->sum('subtotal');

        // Buat judul periode untuk PDF & Excel
        $months = [
            1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
            5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
            9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
        ];
        $judulPeriode = match($filter) {
            'harian'  => 'Periode: ' . Carbon::parse($date)->locale('id')->translatedFormat('d F Y'),
            'bulanan' => 'Periode: ' . ($months[$month] ?? '') . ' ' . $year,
            'tahunan' => 'Periode: Tahun ' . $year,
        };

        // ===== Export Excel =====
        if ($export === 'excel') {
            $excelTitle = 'Laporan Penjualan - ' . $judulPeriode;
            return Excel::download(
                new LaporanPenjualanExport($laporan, $totalPendapatan, $excelTitle),
                'laporan-penjualan.xlsx'
            );
        }

        // ===== Export PDF =====
        if ($export === 'pdf') {
            $pdf = Pdf::loadView('laporan.PDF.penjualan_pdf', compact(
                'laporan', 'totalPendapatan', 'judulPeriode'
            ))->setPaper('a4', 'portrait');
            return $pdf->download('laporan-penjualan.pdf');
        }

        // ===== Normal view =====
        return view('laporan.penjualan', compact(
            'laporan', 'totalPendapatan', 'filter', 'date', 'month', 'year'
        ));
    }
}