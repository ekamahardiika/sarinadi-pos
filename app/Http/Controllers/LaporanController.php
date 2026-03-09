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

        $transaksis = $query->orderBy('created_at', 'asc')->get();

        $laporan = [];

        if ($filter === 'harian') {
            foreach ($transaksis as $index => $t) {
                $laporan[] = [
                    'no'             => $index + 1,
                    'kode_transaksi' => $t->kode_transaksi,
                    'pendapatan'     => $t->subtotal,
                ];
            }
        } elseif ($filter === 'bulanan') {
            $grouped = $transaksis->groupBy(fn($t) => $t->created_at->format('Y-m-d'));
            $no = 1;
            foreach ($grouped as $tgl => $items) {
                $laporan[] = [
                    'no'         => $no++,
                    'hari'       => Carbon::parse($tgl)->translatedFormat('d F Y'),
                    'pendapatan' => $items->sum('subtotal'),
                ];
            }
        } else { // tahunan
            $grouped = $transaksis->groupBy(fn($t) => $t->created_at->format('Y-m'));
            $no = 1;
            foreach ($grouped as $bulan => $items) {
                $laporan[] = [
                    'no'         => $no++,
                    'bulan'      => Carbon::parse($bulan . '-01')->translatedFormat('F Y'),
                    'pendapatan' => $items->sum('subtotal'),
                ];
            }
        }

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
            'harian'  => 'Periode: ' . Carbon::parse($date)->translatedFormat('d F Y'),
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
                'judulPeriode',
                'filter'
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

        // Loop semua transaksi → detail → produk
        foreach ($transaksis as $t) {
            foreach ($t->detail as $item) {
                $produk = $item->produk;
                if (!$produk || !$item->produk_id) continue;

                $id = (int) $item->produk_id;

                if (!isset($produkTerlaris[$id])) {
                    $produkTerlaris[$id] = [
                        'produk'     => $produk->nama_produk,
                        'terjual'    => 0,
                        'pendapatan' => 0,
                    ];
                }

                $jumlah = (int) $item->jumlah;
                $harga  = $item->total_harga ?? ($jumlah * ($item->harga_satuan ?? 0));

                $produkTerlaris[$id]['terjual'] += $jumlah;
                $produkTerlaris[$id]['pendapatan'] += $harga;
            }
        }

        // Urutkan berdasarkan jumlah terjual, jika sama urutkan pendapatan
        usort($produkTerlaris, fn($a, $b) => $b['terjual'] <=> $a['terjual'] ?: $b['pendapatan'] <=> $a['pendapatan']);

        $laporan = collect(array_values($produkTerlaris))->map(function ($item, $index) {
            return [
                'no'         => $index + 1,
                'produk'     => $item['produk'],
                'terjual'    => $item['terjual'],
                'pendapatan' => $item['pendapatan'],
            ];
        });

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
            'harian'  => 'Periode: ' . Carbon::parse($date)->translatedFormat('d F Y'),
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

        if ($export === 'pdf') {
            $pdf = Pdf::loadView('laporan.PDF.terlaris_pdf', compact('laporan', 'judulPeriode'))
                ->setPaper('a4', 'portrait');
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

        $transaksis = $query->orderBy('created_at', 'asc')->get();

        $laporan = collect();

        if ($filter === 'harian') {
            $laporan = $transaksis->values()->map(function ($t, $index) {
                return [
                    'no'             => $index + 1,
                    'kode_transaksi' => $t->kode_transaksi,
                    'metode'         => strtoupper($t->metode_pembayaran),
                    'nominal'        => $t->subtotal,
                ];
            });
        } elseif ($filter === 'bulanan') {
            $laporan = $transaksis->values()->map(function ($t, $index) {
                return [
                    'no'      => $index + 1,
                    'tanggal' => $t->created_at->translatedFormat('d F Y'),
                    'metode'  => strtoupper($t->metode_pembayaran),
                    'nominal' => $t->subtotal,
                ];
            });
        } elseif ($filter === 'tahunan') {
            $grouped = $transaksis->groupBy(fn($t) => $t->created_at->format('Y-m'));
            $no = 1;
            $rows = collect();
            foreach ($grouped as $bulanKey => $items) {
                $label     = Carbon::parse($bulanKey . '-01')->translatedFormat('F Y');
                $cashTotal = $items->where('metode_pembayaran', 'cash')->sum('subtotal');
                $qrisTotal = $items->where('metode_pembayaran', 'qris')->sum('subtotal');

                if ($cashTotal > 0 && $qrisTotal > 0) {
                    $metodeLabel = 'CASH & QRIS';
                } elseif ($cashTotal > 0) {
                    $metodeLabel = 'CASH';
                } else {
                    $metodeLabel = 'QRIS';
                }

                $rows->push([
                    'no'      => $no++,
                    'bulan'   => $label,
                    'metode'  => $metodeLabel,
                    'nominal' => $items->sum('subtotal'),
                ]);
            }
            $laporan = $rows;
        }

        // Summary
        $cash = $transaksis->where('metode_pembayaran', 'cash');
        $qris = $transaksis->where('metode_pembayaran', 'qris');

        $totalCash        = $cash->sum('subtotal');
        $totalQris        = $qris->sum('subtotal');
        $totalKeseluruhan = $transaksis->sum('subtotal');
        $jumlahCash       = $cash->count();
        $jumlahQris       = $qris->count();

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
            'harian'  => 'Periode: ' . Carbon::parse($date)->translatedFormat('d F Y'),
            'bulanan' => 'Periode: ' . ($months[$month] ?? '') . ' ' . $year,
            'tahunan' => 'Periode: Tahun ' . $year,
        };

        // === Export Excel ===
        if ($export === 'excel') {
            $filename = "Metode_Pembayaran_" . date('Ymd_His') . ".xlsx";
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

        // === Export PDF ===
        if ($export === 'pdf') {
            $pdf = Pdf::loadView('laporan.PDF.metode_pdf', compact(
                'laporan',
                'totalCash',
                'totalQris',
                'totalKeseluruhan',
                'jumlahCash',
                'jumlahQris',
                'judulPeriode',
                'filter'
            ))->setPaper('a4', 'portrait');

            return $pdf->download('metode-pembayaran.pdf');
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
