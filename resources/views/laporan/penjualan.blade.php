@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h3 class="mb-4">Laporan Penjualan</h3>

        <form id="filterForm" class="row g-2 mb-3">
            <div class="col-md-3">
                <select name="filter" class="form-select">
                    <option value="harian" {{ $filter == 'harian' ? 'selected' : '' }}>Harian</option>
                    <option value="bulanan" {{ $filter == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahunan" {{ $filter == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </div>

            <div class="col-md-2 filter-harian">
                <input type="date" name="date" class="form-control" value="{{ $date ?? '' }}">
            </div>

            <div class="col-md-2 filter-bulanan">
                <select name="month" class="form-select">
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
                <a id="btnExcel" href="#" class="btn btn-success">Excel</a>
                <a id="btnPdf" href="#" class="btn btn-danger">PDF</a>
            </div>
        </form>

        <div id="tableWrapper">
            <table class="table table-bordered datatable">
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
                    @forelse($laporan as $row)
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
                            <td colspan="3" class="text-center">Tidak ada data untuk periode ini</td>
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
        </div>
    </div>

    @push('scripts')
        <script>
            function initDataTable() {
                if ($.fn.DataTable.isDataTable('.datatable')) {
                    $('.datatable').DataTable().destroy();
                }
                $('.datatable').DataTable({
                    retrieve: true,
                    language: {
                        emptyTable: "Tidak ada data yang tersedia"
                    }
                });
            }

            function updateFilterInputs() {
                let val = $('select[name="filter"]').val();
                $('.filter-harian, .filter-bulanan, .filter-year').hide();
                if (val === 'harian') $('.filter-harian, .filter-year').show();
                else if (val === 'bulanan') $('.filter-bulanan, .filter-year').show();
                else $('.filter-year').show();
            }

            function updateExportButtons() {
                let params = $('#filterForm').serialize();
                let baseUrl = "{{ route('laporan.penjualan') }}";
                $('#btnExcel').attr('href', baseUrl + '?' + params + '&export=excel');
                $('#btnPdf').attr('href', baseUrl + '?' + params + '&export=pdf');
            }

            $(document).ready(function() {
                updateFilterInputs();
                updateExportButtons();
                initDataTable();

                $('select[name="filter"]').change(function() {
                    updateFilterInputs();
                    updateExportButtons();
                });

                $('#filterForm select, #filterForm input').on('change', function() {
                    updateExportButtons();
                    $.ajax({
                        url: "{{ route('laporan.penjualan') }}",
                        type: 'GET',
                        data: $('#filterForm').serialize(),
                        success: function(res) {
                            if ($.fn.DataTable.isDataTable('.datatable')) $('.datatable')
                            .DataTable().destroy();
                            $('#tableWrapper').html($(res).find('#tableWrapper').html());
                            initDataTable();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
