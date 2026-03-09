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

        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $judulPeriode = match ($filter) {
            'harian'  => 'Periode: ' . Carbon::parse($date)->locale('id')->translatedFormat('d F Y'),
            'bulanan' => 'Periode: ' . ($months[$month] ?? '') . ' ' . $year,
            'tahunan' => 'Periode: Tahun ' . $year,
        };

        if ($export === 'excel') {
            $excelTitle = 'Laporan Penjualan - ' . $judulPeriode;
            return Excel::download(
                new LaporanPenjualanExport($laporan, $totalPendapatan, $excelTitle),
                'laporan-penjualan.xlsx'
            );
        }

        if ($export === 'pdf') {
            $pdf = Pdf::loadView('laporan.PDF.penjualan_pdf', compact(
                'laporan',
                'totalPendapatan',
                'judulPeriode'
            ))->setPaper('a4', 'portrait');
            return $pdf->download('laporan-penjualan.pdf');
        }

        return view('laporan.penjualan', compact(
            'laporan',
            'totalPendapatan',
            'filter',
            'date',
            'month',
            'year'
        ));
    }

    public function produkTerlaris(Request $request)
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

        $transaksis = $query->with('detail.produk')->get();

        $produkTerlaris = [];
        foreach ($transaksis as $t) {
            foreach ($t->detail as $item) {
                if (!$item->produk) continue;

                $id = $item->produk_id;
                if (!isset($produkTerlaris[$id])) {
                    $produkTerlaris[$id] = [
                        'produk'  => $item->produk->nama_produk,
                        'terjual' => 0,
                    ];
                }
                $produkTerlaris[$id]['terjual'] += $item->jumlah;
            }
        }

        usort($produkTerlaris, fn($a, $b) => $b['terjual'] <=> $a['terjual']);

        $laporan = collect(array_values($produkTerlaris))->map(function ($item, $index) {
            return [
                'no'      => $index + 1,
                'produk'  => $item['produk'],
                'terjual' => $item['terjual'],
            ];
        });

        // ✅ Buat judulPeriode untuk PDF
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $judulPeriode = match ($filter) {
            'harian'  => 'Periode: ' . Carbon::parse($date)->locale('id')->translatedFormat('d F Y'),
            'bulanan' => 'Periode: ' . ($months[$month] ?? '') . ' ' . $year,
            'tahunan' => 'Periode: Tahun ' . $year,
        };

        if ($export === 'excel') {
            $filename = "Produk_Terlaris_" . date('Ymd_His') . ".xlsx";
            return Excel::download(
                new class($laporan) implements \Maatwebsite\Excel\Concerns\FromCollection {
                    protected $data;
                    public function __construct($data)
                    {
                        $this->data = $data;
                    }
                    public function collection()
                    {
                        return collect($this->data);
                    }
                },
                $filename
            );
        }

        // ✅ Fix: pakai view PDF baru + kirim $judulPeriode
        if ($export === 'pdf') {
            $pdf = Pdf::loadView('laporan.PDF.terlaris_pdf', compact(
                'laporan',
                'judulPeriode'
            ))->setPaper('a4', 'portrait');
            return $pdf->download('produk-terlaris.pdf');
        }

        return view('laporan.terlaris', compact('laporan', 'filter', 'date', 'month', 'year'));
    }

    public function metodePembayaran(Request $request)
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

        // Pisah berdasarkan metode pembayaran
        $cash = $transaksis->where('metode_pembayaran', 'cash');
        $qris = $transaksis->where('metode_pembayaran', 'qris');

        $laporan = $transaksis->map(function ($t, $index) {
            return [
                'no'      => $index + 1,
                'tanggal' => $t->created_at->locale('id')->translatedFormat('d F Y'),
                'metode'  => strtoupper($t->metode_pembayaran),
                'nominal' => $t->subtotal,
            ];
        });

        $totalCash = $cash->sum('subtotal');
        $totalQris = $qris->sum('subtotal');
        $totalKeseluruhan = $transaksis->sum('subtotal');
        $jumlahCash = $cash->count();
        $jumlahQris = $qris->count();

        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $judulPeriode = match ($filter) {
            'harian'  => 'Periode: ' . Carbon::parse($date)->locale('id')->translatedFormat('d F Y'),
            'bulanan' => 'Periode: ' . ($months[$month] ?? '') . ' ' . $year,
            'tahunan' => 'Periode: Tahun ' . $year,
        };

        if ($export === 'pdf') {
            $pdf = Pdf::loadView('laporan.PDF.metode_pdf', compact(
                'laporan',
                'judulPeriode',
                'totalCash',
                'totalQris',
                'totalKeseluruhan',
                'jumlahCash',
                'jumlahQris'
            ))->setPaper('a4', 'portrait');
            return $pdf->download('laporan-metode-pembayaran.pdf');
        }

        return view('laporan.metode', compact(
            'laporan',
            'filter',
            'date',
            'month',
            'year',
            'totalCash',
            'totalQris',
            'totalKeseluruhan',
            'jumlahCash',
            'jumlahQris'
        ));
    }
}
