@extends('layouts.admin')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap');

        :root {
            --orange: #d35400;
            --orange-light: #e8680a;
            --orange-pale: rgba(211, 84, 0, 0.08);
            --dark: #1a1008;
            --green: #27ae60;
            --red: #c0392b;
            --blue: #2980b9;
            --text-muted: #7f8c8d;
            --text-sub: #b0bec5;
            --border: #f0ece8;
        }

        body,
        * {
            font-family: 'DM Sans', sans-serif;
        }

        /* ── HEADER ── */
        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
        }

        .page-eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-eyebrow::before {
            content: '';
            width: 20px;
            height: 2px;
            background: var(--orange);
            border-radius: 2px;
        }

        .page-title {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
        }

        .page-title em {
            color: var(--orange);
            font-style: italic;
        }

        .btn-tambah {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            background: var(--orange);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(211, 84, 0, 0.3);
            white-space: nowrap;
        }

        .btn-tambah:hover {
            background: var(--orange-light);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(211, 84, 0, 0.4);
        }

        /* ── TABLE CARD ── */
        .table-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(211, 84, 0, 0.06);
        }

        .table-card-header {
            background: var(--dark);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-header-icon {
            width: 34px;
            height: 34px;
            background: var(--orange);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .table-header-title {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1rem;
            font-weight: 700;
            color: white;
        }

        /* ── TABLE ── */
        .produk-table {
            width: 100%;
            border-collapse: collapse;
        }

        .produk-table thead tr {
            background: #faf7f4;
            border-bottom: 2px solid var(--border);
        }

        .produk-table th {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 13px 16px;
            white-space: nowrap;
        }

        .produk-table td {
            padding: 12px 16px;
            font-size: 0.875rem;
            color: var(--dark);
            border-bottom: 1px solid #faf7f4;
            vertical-align: middle;
        }

        .produk-table tbody tr:last-child td {
            border-bottom: none;
        }

        .produk-table tbody tr:hover td {
            background: #fdf9f6;
        }

        .no-cell {
            color: var(--text-sub);
            font-size: 0.78rem;
            font-weight: 600;
        }

        /* Product image */
        .produk-img {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid var(--border);
            display: block;
        }

        .produk-img-empty {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            background: #faf7f4;
            border: 1px dashed var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-sub);
            font-size: 1.1rem;
        }

        .produk-name {
            font-weight: 600;
            color: var(--dark);
        }

        .harga-cell {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-weight: 700;
            font-size: 0.92rem;
            color: var(--orange);
        }

        .stok-cell {
            font-weight: 700;
            color: var(--dark);
        }

        /* Status badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .badge-tersedia {
            background: rgba(39, 174, 96, 0.12);
            color: var(--green);
            border: 1px solid rgba(39, 174, 96, 0.2);
        }

        .badge-habis {
            background: rgba(192, 57, 43, 0.1);
            color: var(--red);
            border: 1px solid rgba(192, 57, 43, 0.2);
        }

        /* Action buttons */
        .action-group {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .btn-aksi {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 7px;
            font-size: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-aksi-detail {
            background: var(--orange-pale);
            color: var(--orange);
            border: 1px solid rgba(211, 84, 0, 0.2);
        }

        .btn-aksi-detail:hover {
            background: var(--orange);
            color: white;
            box-shadow: 0 3px 10px rgba(211, 84, 0, 0.25);
        }

        .btn-aksi-edit {
            background: rgba(41, 128, 185, 0.1);
            color: var(--blue);
            border: 1px solid rgba(41, 128, 185, 0.2);
        }

        .btn-aksi-edit:hover {
            background: var(--blue);
            color: white;
            box-shadow: 0 3px 10px rgba(41, 128, 185, 0.25);
        }

        .btn-aksi-hapus {
            background: rgba(192, 57, 43, 0.1);
            color: var(--red);
            border: 1px solid rgba(192, 57, 43, 0.2);
        }

        .btn-aksi-hapus:hover {
            background: var(--red);
            color: white;
            box-shadow: 0 3px 10px rgba(192, 57, 43, 0.25);
        }

        /* ── DATATABLE OVERRIDES ── */
        div.dataTables_wrapper div.dataTables_filter input {
            background: #faf7f4;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            outline: none;
            transition: border-color 0.2s;
        }

        div.dataTables_wrapper div.dataTables_filter input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(211, 84, 0, 0.1);
        }

        div.dataTables_wrapper div.dataTables_length select {
            background: #faf7f4;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 5px 10px;
            font-size: 0.85rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            outline: none;
        }

        div.dataTables_wrapper div.dataTables_info {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button {
            border-radius: 6px !important;
            font-size: 0.72rem !important;
            font-family: 'DM Sans', sans-serif !important;
            border: 1px solid var(--border) !important;
            background: #fff !important;
            color: var(--dark) !important;
            margin: 0 1px !important;
            padding: 2px 8px !important;
            line-height: 1.6 !important;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button:hover {
            background: var(--orange-pale) !important;
            border-color: var(--orange) !important;
            color: var(--orange) !important;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button.current,
        div.dataTables_wrapper div.dataTables_paginate .paginate_button.current:hover {
            background: var(--orange) !important;
            border-color: var(--orange) !important;
            color: white !important;
            font-weight: 700 !important;
            box-shadow: 0 2px 8px rgba(211, 84, 0, 0.25) !important;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled,
        div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled:hover {
            color: var(--text-sub) !important;
        }

        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_length {
            padding: 14px 20px 0;
        }

        .dataTables_wrapper .dataTables_info {
            padding: 10px 20px 14px;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding: 8px 20px 14px;
        }

        /* ── MODAL ── */
        .modal-content {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .modal-header-danger {
            background: var(--dark);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: none;
        }

        .modal-header-inner {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-danger-icon {
            width: 36px;
            height: 36px;
            background: rgba(192, 57, 43, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--red);
            font-size: 0.9rem;
        }

        .modal-danger-title {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1rem;
            font-weight: 700;
            color: white;
        }

        .modal-btn-close {
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.5);
            font-size: 1.1rem;
            cursor: pointer;
            transition: color 0.2s;
            padding: 0;
        }

        .modal-btn-close:hover {
            color: white;
        }

        .modal-body-custom {
            padding: 24px 28px;
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.6;
            border-bottom: 1px solid var(--border);
        }

        .modal-body-custom strong {
            color: var(--dark);
        }

        .modal-footer-custom {
            padding: 16px 24px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            background: #faf7f4;
            border: none;
        }

        .btn-modal-batal {
            padding: 8px 20px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.83rem;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-modal-batal:hover {
            border-color: var(--dark);
            color: var(--dark);
        }

        .btn-modal-hapus {
            padding: 8px 20px;
            background: var(--red);
            border: none;
            border-radius: 8px;
            font-size: 0.83rem;
            font-weight: 700;
            color: white;
            cursor: pointer;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'DM Sans', sans-serif;
            box-shadow: 0 4px 12px rgba(192, 57, 43, 0.25);
        }

        .btn-modal-hapus:hover {
            background: #a93226;
            box-shadow: 0 6px 18px rgba(192, 57, 43, 0.35);
        }
    </style>

    <div class="container-fluid px-4 py-2">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Daftar <em>Produk</em></h1>
            </div>
            <a href="{{ route('produk.create') }}" class="btn-tambah">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>

        {{-- TABLE CARD --}}
        <div class="table-card">

            <div class="table-card-header">
                <div class="table-header-icon"><i class="fas fa-box-open"></i></div>
                <div class="table-header-title">Semua Produk</div>
            </div>

            <div class="p-0">
                <table class="produk-table datatable">
                    <thead>
                        <tr>
                            <th width="40">No</th>
                            <th width="70">Gambar</th>
                            <th>Nama Produk</th>
                            <th width="140">Harga</th>
                            <th width="70">Stok</th>
                            <th width="110">Status</th>
                            <th width="190">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $item)
                            <tr>
                                <td class="no-cell">{{ $loop->iteration }}</td>

                                <td>
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="produk-img"
                                            alt="{{ $item->nama_produk }}">
                                    @else
                                        <div class="produk-img-empty"><i class="fas fa-image"></i></div>
                                    @endif
                                </td>

                                <td class="produk-name">{{ $item->nama_produk }}</td>

                                <td class="harga-cell">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>

                                <td class="stok-cell">{{ $item->stok }}</td>

                                <td>
                                    @if ($item->stok > 0)
                                        <span class="status-badge badge-tersedia">
                                            <i class="fas fa-check-circle"></i> Tersedia
                                        </span>
                                    @else
                                        <span class="status-badge badge-habis">
                                            <i class="fas fa-times-circle"></i> Habis
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="action-group">
                                        <a href="{{ route('produk.show', $item->id) }}" class="btn-aksi btn-aksi-detail">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('produk.edit', $item->id) }}" class="btn-aksi btn-aksi-edit">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <button class="btn-aksi btn-aksi-hapus btnHapus" data-id="{{ $item->id }}"
                                            data-nama="{{ $item->nama_produk }}">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal fade" id="modalHapus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header-danger">
                    <div class="modal-header-inner">
                        <div class="modal-danger-icon"><i class="fas fa-trash"></i></div>
                        <div class="modal-danger-title">Konfirmasi Hapus</div>
                    </div>
                    <button type="button" class="modal-btn-close" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="modal-body-custom">
                    Apakah Anda yakin ingin menghapus produk
                    <strong id="namaProduk"></strong>?
                    Tindakan ini tidak dapat dibatalkan.
                </div>

                <div class="modal-footer-custom">
                    <form id="formHapus" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-modal-batal" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn-modal-hapus">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.btnHapus', function() {
            let id = $(this).data('id');
            let nama = $(this).data('nama');
            $('#namaProduk').text(nama);
            $('#formHapus').attr('action', '/produk/' + id);
            $('#modalHapus').modal('show');
        });

        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('.datatable')) {
                $('.datatable').DataTable({
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50],
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        paginate: {
                            previous: "Prev",
                            next: "Next"
                        }
                    }
                });
            }
        });
    </script>
@endpush
