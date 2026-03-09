<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{

    public function index()
    {

        Carbon::setLocale('id');

        $today = Carbon::today();
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        // Earnings hari ini
        $earningsDaily = Transaksi::whereDate('created_at', $today)
            ->sum('subtotal');

        // Earnings bulan ini
        $earningsMonthly = Transaksi::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('subtotal');

        // Earnings tahun ini
        $earningsAnnual = Transaksi::whereYear('created_at', $year)
            ->sum('subtotal');

        // Total transaksi
        $totalTransactions = Transaksi::count();

        // Transaksi hari ini
        $todayTransactions = Transaksi::whereDate('created_at', $today)->count();

        // Data chart per bulan
        $monthlyData = [];

        for ($i = 1; $i <= 12; $i++) {

            $monthlyData[] = Transaksi::whereMonth('created_at', $i)
                ->whereYear('created_at', $year)
                ->sum('subtotal');
        }

        return view('dashboard.index', compact(
            'earningsDaily',
            'earningsMonthly',
            'earningsAnnual',
            'totalTransactions',
            'todayTransactions',
            'monthlyData'
        ));
    }
}
