@extends('layouts.admin')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap');

        :root {
            --orange: #d35400;
            --orange-light: #e8680a;
            --orange-pale: rgba(211, 84, 0, 0.08);
            --dark: #1a1008;
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
            font-family: 'Playfair Display', serif;
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

        /* ── FORM CARD ── */
        .form-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(211, 84, 0, 0.06);
            max-width: 680px;
        }

        .form-card-header {
            background: var(--dark);
            padding: 18px 28px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-header-icon {
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

        .form-header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: white;
        }

        .form-card-body {
            padding: 28px;
        }

        /* ── FIELD ── */
        .field-group {
            margin-bottom: 22px;
        }

        .field-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .field-input {
            width: 100%;
            padding: 11px 14px;
            background: #faf7f4;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            outline: none;
            transition: all 0.25s;
            box-sizing: border-box;
        }

        .field-input::placeholder {
            color: var(--text-sub);
        }

        .field-input:focus {
            border-color: var(--orange);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(211, 84, 0, 0.1);
        }

        .field-input.is-invalid {
            border-color: #e74c3c;
            background: #fff8f8;
        }

        .field-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 0.78rem;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .field-hint {
            font-size: 0.75rem;
            color: var(--text-sub);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ── FILE UPLOAD ── */
        .upload-area {
            border: 2px dashed var(--border);
            border-radius: 12px;
            padding: 28px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s;
            background: #faf7f4;
            position: relative;
        }

        .upload-area:hover {
            border-color: var(--orange);
            background: var(--orange-pale);
        }

        .upload-area.has-preview {
            border-style: solid;
            border-color: var(--orange);
            padding: 16px;
        }

        .upload-icon {
            font-size: 2rem;
            color: var(--text-sub);
            margin-bottom: 10px;
            display: block;
        }

        .upload-text {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 4px;
            font-weight: 500;
        }

        .upload-hint {
            font-size: 0.75rem;
            color: var(--text-sub);
        }

        .upload-input {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .preview-wrap {
            display: none;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .preview-wrap.show {
            display: flex;
        }

        .preview-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid var(--border);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .preview-name {
            font-size: 0.78rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .preview-change {
            font-size: 0.75rem;
            color: var(--orange);
            font-weight: 600;
            cursor: pointer;
        }

        /* ── DIVIDER ── */
        .form-divider {
            border: none;
            border-top: 1px solid var(--border);
            /* margin: 24px 0; */
        }

        /* ── FOOTER BUTTONS ── */
        .form-footer {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-simpan {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 28px;
            background: var(--orange);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 700;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(211, 84, 0, 0.3);
        }

        .btn-simpan:hover {
            background: var(--orange-light);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(211, 84, 0, 0.4);
        }

        .btn-batal {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 22px;
            background: white;
            color: var(--text-muted);
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.25s;
        }

        .btn-batal:hover {
            border-color: var(--dark);
            color: var(--dark);
        }
    </style>

    <div class="container-fluid px-4 py-2">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <h1 class="page-title">Tambah <em>Produk</em></h1>
            </div>
            <a href="{{ route('produk.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- FORM CARD --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-header-icon"><i class="fas fa-plus"></i></div>
                <div class="form-header-title">Form Tambah Produk</div>
            </div>

            <div class="form-card-body">
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Produk --}}
                    <div class="field-group">
                        <label class="field-label" for="nama_produk">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk"
                            class="field-input @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk') }}"
                            placeholder="Masukkan nama produk">
                        @error('nama_produk')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Harga & Stok (2 kolom) --}}
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">

                        <div class="field-group">
                            <label class="field-label" for="harga">Harga</label>
                            <input type="number" id="harga" name="harga"
                                class="field-input @error('harga') is-invalid @enderror" value="{{ old('harga') }}"
                                placeholder="0">
                            @error('harga')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="stok">Stok</label>
                            <input type="number" id="stok" name="stok"
                                class="field-input @error('stok') is-invalid @enderror" value="{{ old('stok') }}"
                                placeholder="0">
                            @error('stok')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    {{-- <hr class="form-divider"> --}}

                    {{-- Gambar --}}
                    <div class="field-group">
                        <label class="field-label">Gambar Produk</label>

                        <div class="upload-area" id="uploadArea">
                            <input type="file" name="gambar" class="upload-input" accept="image/*"
                                onchange="previewImage(event)" id="inputGambar">

                            {{-- Default state --}}
                            <div id="uploadDefault">
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <div class="upload-text">Klik untuk upload gambar</div>
                                <div class="upload-hint">JPG, PNG, JPEG — Maks. 2MB</div>
                            </div>

                            {{-- Preview state --}}
                            <div class="preview-wrap" id="previewWrap">
                                <img id="preview" class="preview-img" src="" alt="Preview">
                                <div class="preview-name" id="previewName"></div>
                                <div class="preview-change">Klik untuk ganti gambar</div>
                            </div>
                        </div>
                    </div>

                    <hr class="form-divider">

                    {{-- Footer --}}
                    <div class="form-footer">
                        <button type="submit" class="btn-simpan">
                            <i class="fas fa-check"></i> Simpan Produk
                        </button>
                        <a href="{{ route('produk.index') }}" class="btn-batal">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                const previewWrap = document.getElementById('previewWrap');
                const uploadDefault = document.getElementById('uploadDefault');
                const uploadArea = document.getElementById('uploadArea');
                const previewName = document.getElementById('previewName');

                preview.src = reader.result;
                previewName.textContent = file.name;
                previewWrap.classList.add('show');
                uploadDefault.style.display = 'none';
                uploadArea.classList.add('has-preview');
            };
            reader.readAsDataURL(file);
        }
    </script>
@endpush
