@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h3 class="mb-4">Laporan Produk Terlaris</h3>

        <form id="filterForm" class="row g-2 mb-3">
            <div class="col-md-3">
                <select name="filter" id="filterSelect" class="form-select">
                    <option value="harian" {{ $filter == 'harian' ? 'selected' : '' }}>Harian</option>
                    <option value="bulanan" {{ $filter == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahunan" {{ $filter == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </div>
            <div class="col-md-2 filter-harian" style="display:none;">
                <input type="date" name="date" class="form-control" value="{{ $date ?? '' }}">
            </div>
            <div class="col-md-2 filter-bulanan" style="display:none;">
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
                        <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 filter-year" style="display:none;">
                <input type="number" name="year" min="2000" max="2100" class="form-control"
                    value="{{ $year ?? '' }}">
            </div>
            <div class="col-md-3">
                <a id="btnExcel" href="#" class="btn btn-success">Excel</a>
                <a id="btnPdf" href="#" class="btn btn-danger ms-1">PDF</a>
            </div>
        </form>

        <div id="tableWrapper">
            <table class="table table-bordered" id="tabelTerlaris">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Terjual</th>
                        <th>Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $row)
                        <tr>
                            <td>{{ $row['no'] }}</td>
                            <td>{{ $row['produk'] }}</td>
                            <td>{{ $row['terjual'] }}</td>
                            <td>Rp {{ number_format($row['pendapatan'], 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total</th>
                        <th id="totalTerjual">{{ $laporan->sum('terjual') }}</th>
                        <th id="totalPendapatan">Rp {{ number_format($laporan->sum('pendapatan'), 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function updateFilterInputs() {
                var val = $('#filterSelect').val();
                $('.filter-harian,.filter-bulanan,.filter-year').hide();
                if (val == 'harian') $('.filter-harian,.filter-year').show();
                if (val == 'bulanan') $('.filter-bulanan,.filter-year').show();
                if (val == 'tahunan') $('.filter-year').show();
            }

            function updateExportButtons() {
                var params = $('#filterForm').serialize();
                var baseUrl = "{{ route('laporan.produk.terlaris') }}";
                $('#btnExcel').attr('href', baseUrl + '?' + params + '&export=excel');
                $('#btnPdf').attr('href', baseUrl + '?' + params + '&export=pdf');
            }

            function initDataTable() {
                if ($.fn.DataTable.isDataTable('#tabelTerlaris')) $('#tabelTerlaris').DataTable().destroy();
                $('#tabelTerlaris').DataTable({
                    pageLength: 5,
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

            function fetchData() {
                var params = $('#filterForm').serialize();
                var baseUrl = "{{ route('laporan.produk.terlaris') }}";
                $.get(baseUrl, params, function(html) {
                    var $res = $(html);
                    var newTbody = $res.find('#tabelTerlaris tbody').html();
                    var newTotalTerjual = $res.find('#totalTerjual').text();
                    var newTotalPendapatan = $res.find('#totalPendapatan').text();

                    if ($.fn.DataTable.isDataTable('#tabelTerlaris')) $('#tabelTerlaris').DataTable()
                        .destroy();
                    $('#tabelTerlaris tbody').html(newTbody);
                    $('#totalTerjual').text(newTotalTerjual);
                    $('#totalPendapatan').text(newTotalPendapatan);
                    initDataTable();
                    updateExportButtons();
                });
            }

            $('#filterSelect').on('change', function() {
                updateFilterInputs();
                fetchData();
            });
            $('#filterForm input,#filterForm select').not('#filterSelect').on('change', fetchData);
            updateFilterInputs();
            updateExportButtons();
            initDataTable();
        });
    </script>
@endpush
