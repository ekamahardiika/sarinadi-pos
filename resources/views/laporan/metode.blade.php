@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h3 class="mb-4">Laporan Metode Pembayaran</h3>

        <form id="filterForm" class="row g-2 mb-3">
            <div class="col-md-3">
                <select name="filter" id="filterSelect" class="form-select">
                    <option value="harian" {{ $filter == 'harian' ? 'selected' : '' }}>Harian</option>
                    <option value="bulanan" {{ $filter == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahunan" {{ $filter == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </div>

            <div class="col-md-2 filter-harian">
                <input type="date" name="date" class="form-control" value="{{ $date ?? '' }}">
            </div>

            <div class="col-md-2 filter-bulanan">
                @php
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
                        12 => 'Desember',
                    ];
                @endphp
                <select name="month" class="form-select">
                    @foreach ($months as $num => $name)
                        <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 filter-year">
                <input type="number" name="year" min="2000" max="2100" class="form-control"
                    value="{{ $year ?? '' }}">
            </div>

            <div class="col-md-3">
                <a id="btnExcel" href="#" class="btn btn-success">
                    <i class="fas fa-file-excel me-1"></i>Excel
                </a>
                <a id="btnPdf" href="#" class="btn btn-danger ms-1">
                    <i class="fas fa-file-pdf me-1"></i>PDF
                </a>
            </div>
        </form>

        {{-- Summary Cards --}}
        <div class="row mb-4" id="summaryCards">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1" style="font-size:12px;">Total Cash</p>
                                <h5 class="mb-0 fw-bold">Rp {{ number_format($totalCash, 0, ',', '.') }}</h5>
                                <small class="text-muted">{{ $jumlahCash }} transaksi</small>
                            </div>
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-money-bill-wave text-success fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1" style="font-size:12px;">Total QRIS</p>
                                <h5 class="mb-0 fw-bold">Rp {{ number_format($totalQris, 0, ',', '.') }}</h5>
                                <small class="text-muted">{{ $jumlahQris }} transaksi</small>
                            </div>
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-qrcode text-primary fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1" style="font-size:12px;">Total Keseluruhan</p>
                                <h5 class="mb-0 fw-bold">Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</h5>
                                <small class="text-muted">{{ $jumlahCash + $jumlahQris }} transaksi</small>
                            </div>
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-chart-bar text-warning fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel --}}
        <div id="tableWrapper">
            <table class="table table-bordered datatable" id="tabelMetode">
                <thead>
                    <tr>
                        <th>No</th>
                        @if ($filter == 'harian')
                            <th>Kode Transaksi</th>
                        @elseif ($filter == 'bulanan')
                            <th>Tanggal</th>
                        @else
                            <th>Bulan</th>
                        @endif
                        <th>Metode</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $row)
                        <tr>
                            <td>{{ $row['no'] }}</td>
                            @if ($filter == 'harian')
                                <td>{{ $row['kode_transaksi'] }}</td>
                            @elseif ($filter == 'bulanan')
                                <td>{{ $row['tanggal'] }}</td>
                            @else
                                <td>{{ $row['bulan'] }}</td>
                            @endif
                            <td>
                                @if ($row['metode'] === 'CASH')
                                    <span class="badge bg-success">CASH</span>
                                @else
                                    <span class="badge bg-primary">QRIS</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($row['nominal'], 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total Keseluruhan</th>
                        <th id="totalKeseluruhan">Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            function updateFilterInputs() {
                let val = $('#filterSelect').val();
                $('.filter-harian, .filter-bulanan, .filter-year').hide();
                if (val === 'harian') $('.filter-harian, .filter-year').show();
                else if (val === 'bulanan') $('.filter-bulanan, .filter-year').show();
                else $('.filter-year').show();
            }

            function updateExportButtons() {
                let params = $('#filterForm').serialize();
                let baseUrl = "{{ route('laporan.metode') }}";
                $('#btnExcel').attr('href', baseUrl + '?' + params + '&export=excel');
                $('#btnPdf').attr('href', baseUrl + '?' + params + '&export=pdf');
            }

            function initDataTable() {
                if ($.fn.DataTable.isDataTable('.datatable')) {
                    $('.datatable').DataTable().destroy();
                }
                $('.datatable').DataTable({
                    retrieve: true,
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50],
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        emptyTable: "Tidak ada data yang tersedia",
                        paginate: {
                            previous: "Prev",
                            next: "Next"
                        }
                    }
                });
            }

            $(document).ready(function() {
                updateFilterInputs();
                updateExportButtons();
                initDataTable();

                $('#filterSelect').change(function() {
                    updateFilterInputs();
                    updateExportButtons();
                });

                $('#filterForm select, #filterForm input').on('change', function() {
                    updateExportButtons();
                    $.ajax({
                        url: "{{ route('laporan.metode') }}",
                        type: 'GET',
                        data: $('#filterForm').serialize(),
                        success: function(res) {
                            let $res = $(res);

                            if ($.fn.DataTable.isDataTable('.datatable')) {
                                $('.datatable').DataTable().destroy();
                            }

                            $('#tableWrapper').html($res.find('#tableWrapper').html());
                            $('#summaryCards').html($res.find('#summaryCards').html());

                            initDataTable();
                            updateExportButtons();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
