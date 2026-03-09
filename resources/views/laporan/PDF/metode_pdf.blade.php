<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
            color: #212529;
            padding: 30px 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .header p {
            font-size: 11px;
            color: #6c757d;
        }

        .divider {
            border-top: 2px solid #343a40;
            margin-bottom: 16px;
        }

        /* Summary boxes */
        .summary {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-collapse: separate;
            border-spacing: 8px;
        }

        .summary-box {
            display: table-cell;
            width: 33%;
            padding: 10px 14px;
            border-radius: 6px;
        }

        .summary-box.cash {
            background-color: #d1e7dd;
        }

        .summary-box.qris {
            background-color: #cfe2ff;
        }

        .summary-box.total {
            background-color: #fff3cd;
        }

        .summary-box p {
            font-size: 10px;
            color: #555;
            margin-bottom: 3px;
        }

        .summary-box h4 {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .summary-box small {
            font-size: 10px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        thead tr {
            background-color: #343a40;
            color: #ffffff;
        }

        thead th {
            padding: 8px 10px;
            text-align: left;
            font-size: 11px;
        }

        thead th:first-child {
            text-align: center;
            width: 8%;
        }

        thead th:last-child {
            text-align: right;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tbody td {
            padding: 7px 10px;
            border-bottom: 1px solid #dee2e6;
            font-size: 11px;
        }

        tbody td:first-child {
            text-align: center;
        }

        tbody td:last-child {
            text-align: right;
        }

        .badge-cash {
            background-color: #198754;
            color: #fff;
            padding: 2px 7px;
            border-radius: 4px;
            font-size: 10px;
        }

        .badge-qris {
            background-color: #0d6efd;
            color: #fff;
            padding: 2px 7px;
            border-radius: 4px;
            font-size: 10px;
        }

        tfoot tr {
            background-color: #f8f9fa;
        }

        tfoot th {
            padding: 8px 10px;
            font-size: 11px;
            border-top: 2px solid #343a40;
        }

        tfoot th:last-child {
            text-align: right;
        }

        .empty-row td {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-style: italic;
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            color: #6c757d;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Laporan Metode Pembayaran</h2>
        <p>{{ $judulPeriode }}</p>
    </div>
    <div class="divider"></div>

    {{-- Summary --}}
    <div class="summary">
        <div class="summary-box cash">
            <p>Total Cash</p>
            <h4>Rp {{ number_format($totalCash, 0, ',', '.') }}</h4>
            <small>{{ $jumlahCash }} transaksi</small>
        </div>
        <div class="summary-box qris">
            <p>Total QRIS</p>
            <h4>Rp {{ number_format($totalQris, 0, ',', '.') }}</h4>
            <small>{{ $jumlahQris }} transaksi</small>
        </div>
        <div class="summary-box total">
            <p>Total Keseluruhan</p>
            <h4>Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</h4>
            <small>{{ $jumlahCash + $jumlahQris }} transaksi</small>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Metode</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $row)
                <tr>
                    <td>{{ $row['no'] }}</td>
                    <td>{{ $row['tanggal'] }}</td>
                    <td>
                        @if ($row['metode'] === 'CASH')
                            <span class="badge-cash">CASH</span>
                        @else
                            <span class="badge-qris">QRIS</span>
                        @endif
                    </td>
                    <td>Rp {{ number_format($row['nominal'], 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr class="empty-row">
                    <td colspan="4">Tidak ada data untuk periode ini</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Keseluruhan</th>
                <th>Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y, H:i') }} WIB
    </div>

</body>

</html>
