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
        <h2>Laporan Penjualan</h2>
        <p>{{ $judulPeriode }}</p>
    </div>
    <div class="divider"></div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                @if ($filter == 'harian')
                    <th>Kode Transaksi</th>
                @elseif($filter == 'bulanan')
                    <th>Hari</th>
                @else
                    <th>Bulan</th>
                @endif
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $row)
                <tr>
                    <td>{{ $row['no'] }}</td>
                    @if ($filter == 'harian')
                        <td>{{ $row['kode_transaksi'] }}</td>
                    @elseif($filter == 'bulanan')
                        <td>{{ $row['hari'] }}</td>
                    @else
                        <td>{{ $row['bulan'] }}</td>
                    @endif
                    <td>Rp {{ number_format($row['pendapatan'], 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr class="empty-row">
                    <td colspan="3">Tidak ada data untuk periode ini</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total Pendapatan</th>
                <th>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y, H:i') }} WIB
    </div>
</body>

</html>
