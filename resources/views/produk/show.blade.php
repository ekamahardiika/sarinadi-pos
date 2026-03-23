@extends('layouts.admin')

@section('title', 'Detail Produk')

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

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.83rem;
            font-weight: 600;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.25s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .btn-back:hover {
            border-color: var(--orange);
            color: var(--orange);
            box-shadow: 0 4px 14px rgba(211, 84, 0, 0.12);
        }

        /* ── DETAIL LAYOUT ── */
        .detail-wrap {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* ── IMAGE CARD ── */
        .img-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(211, 84, 0, 0.06);
        }

        .img-card-header {
            background: var(--dark);
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .img-card-icon {
            width: 28px;
            height: 28px;
            background: var(--orange);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        .img-card-title {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 0.88rem;
            font-weight: 700;
            color: white;
        }

        .img-body {
            padding: 20px;
            text-align: center;
        }

        .produk-img-detail {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            display: block;
        }

        .produk-img-empty {
            width: 100%;
            height: 180px;
            border-radius: 12px;
            background: #faf7f4;
            border: 2px dashed var(--border);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--text-sub);
        }

        .produk-img-empty i {
            font-size: 2.5rem;
        }

        .produk-img-empty span {
            font-size: 0.78rem;
        }

        /* ── INFO CARD ── */
        .info-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(211, 84, 0, 0.06);
        }

        .info-card-header {
            background: var(--dark);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card-icon {
            width: 28px;
            height: 28px;
            background: var(--orange);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        .info-card-title {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 0.88rem;
            font-weight: 700;
            color: white;
        }

        .info-card-body {
            padding: 24px;
        }

        /* ── INFO ROWS ── */
        .info-row {
            display: flex;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #faf7f4;
            gap: 16px;
        }

        .info-row:last-of-type {
            border-bottom: none;
        }

        .info-row-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--orange-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--orange);
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .info-row-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 3px;
        }

        .info-row-value {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--dark);
            line-height: 1.3;
        }

        .info-row-value.orange {
            font-family: font-family: var(--font-body);
            font-display: var(--font-body);
            font-size: 1.05rem;
            color: var(--orange);
        }

        /* Status badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.72rem;
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

        /* ── ACTION FOOTER ── */
        .action-footer {
            display: flex;
            gap: 10px;
            padding-top: 20px;
            margin-top: 4px;
            border-top: 1px solid var(--border);
        }

        .btn-edit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: rgba(41, 128, 185, 0.1);
            color: var(--blue);
            border: 1px solid rgba(41, 128, 185, 0.2);
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-edit:hover {
            background: var(--blue);
            color: white;
            border-color: var(--blue);
            box-shadow: 0 4px 14px rgba(41, 128, 185, 0.3);
        }

        .btn-hapus {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: rgba(192, 57, 43, 0.1);
            color: var(--red);
            border: 1px solid rgba(192, 57, 43, 0.2);
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-hapus:hover {
            background: var(--red);
            color: white;
            border-color: var(--red);
            box-shadow: 0 4px 14px rgba(192, 57, 43, 0.3);
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

        @media (max-width: 768px) {
            .detail-wrap {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="container-fluid px-4 py-2">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Detail <em>Produk</em></h1>
            </div>
            <a href="{{ route('produk.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- DETAIL WRAP --}}
        <div class="detail-wrap">

            {{-- IMAGE CARD --}}
            <div class="img-card">
                <div class="img-card-header">
                    <div class="img-card-icon"><i class="fas fa-image"></i></div>
                    <div class="img-card-title">Foto Produk</div>
                </div>
                <div class="img-body">
                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="produk-img-detail"
                            alt="{{ $produk->nama_produk }}">
                    @else
                        <div class="produk-img-empty">
                            <i class="fas fa-image"></i>
                            <span>Belum ada gambar</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- INFO CARD --}}
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon"><i class="fas fa-box-open"></i></div>
                    <div class="info-card-title">Informasi Produk</div>
                </div>
                <div class="info-card-body">

                    <div class="info-row">
                        <div class="info-row-icon"><i class="fas fa-tag"></i></div>
                        <div>
                            <div class="info-row-label">Nama Produk</div>
                            <div class="info-row-value">{{ $produk->nama_produk }}</div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-row-icon"><i class="fas fa-coins"></i></div>
                        <div>
                            <div class="info-row-label">Harga</div>
                            <div class="info-row-value orange">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-row-icon"><i class="fas fa-cubes"></i></div>
                        <div>
                            <div class="info-row-label">Stok</div>
                            <div class="info-row-value">{{ $produk->stok }} unit</div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-row-icon"><i class="fas fa-circle"></i></div>
                        <div>
                            <div class="info-row-label">Status</div>
                            <div class="info-row-value">
                                @if ($produk->stok > 0)
                                    <span class="status-badge badge-tersedia">
                                        <i class="fas fa-check-circle"></i> Tersedia
                                    </span>
                                @else
                                    <span class="status-badge badge-habis">
                                        <i class="fas fa-times-circle"></i> Stok Habis
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-row-icon"><i class="fas fa-calendar-alt"></i></div>
                        <div>
                            <div class="info-row-label">Dibuat</div>
                            <div class="info-row-value">{{ $produk->created_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>

                    {{-- Action buttons --}}
                    <div class="action-footer">
                        <a href="{{ route('produk.edit', $produk->id) }}" class="btn-edit">
                            <i class="fas fa-pen"></i> Edit Produk
                        </a>
                        <button class="btn-hapus btnHapus" data-id="{{ $produk->id }}"
                            data-nama="{{ $produk->nama_produk }}">
                            <i class="fas fa-trash"></i> Hapus Produk
                        </button>
                    </div>

                </div>
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
                        <button type="button" class="btn-modal-batal" data-bs-dismiss="modal">Batal</button>
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
    </script>
@endpush
