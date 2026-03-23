@extends('layouts.admin')

@section('title', 'Edit Produk')

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

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
        }

        .page-title {
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
            font-size: 1rem;
            font-weight: 700;
            color: white;
        }

        .form-card-body {
            padding: 28px;
        }

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

        .form-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 24px 0;
        }

        /* ── GAMBAR SAAT INI ── */
        .current-img-wrap {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: #faf7f4;
            border: 1px solid var(--border);
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .current-img {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--border);
            flex-shrink: 0;
        }

        .current-img-empty {
            width: 72px;
            height: 72px;
            border-radius: 10px;
            background: #f0ece8;
            border: 2px dashed var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-sub);
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .current-img-info {
            flex: 1;
        }

        .current-img-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .current-img-name {
            font-size: 0.83rem;
            color: var(--dark);
            font-weight: 500;
        }

        .current-img-hint {
            font-size: 0.75rem;
            color: var(--text-sub);
            margin-top: 2px;
        }

        /* ── UPLOAD AREA ── */
        .upload-area {
            border: 2px dashed var(--border);
            border-radius: 12px;
            padding: 22px 20px;
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

        .upload-area.is-invalid {
            border-color: #e74c3c;
            background: #fff8f8;
        }

        .upload-icon {
            font-size: 1.8rem;
            color: var(--text-sub);
            margin-bottom: 8px;
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
            gap: 8px;
        }

        .preview-wrap.show {
            display: flex;
        }

        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--border);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        }

        .preview-name {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .preview-change {
            font-size: 0.72rem;
            color: var(--orange);
            font-weight: 600;
        }

        /* ── FOOTER ── */
        .form-footer {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-update {
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

        .btn-update:hover {
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
                <h1 class="page-title">Edit <em>Produk</em></h1>
            </div>
            <a href="{{ route('produk.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- FORM CARD --}}
        <div class="form-card">

            <div class="form-card-header">
                <div class="form-header-icon"><i class="fas fa-pen"></i></div>
                <div class="form-header-title">Form Edit Produk</div>
            </div>

            <div class="form-card-body">
                <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama Produk --}}
                    <div class="field-group">
                        <label class="field-label" for="nama_produk">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk"
                            class="field-input @error('nama_produk') is-invalid @enderror"
                            value="{{ old('nama_produk', $produk->nama_produk) }}" placeholder="Masukkan nama produk">
                        @error('nama_produk')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Harga & Stok --}}
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">

                        <div class="field-group">
                            <label class="field-label" for="harga">Harga</label>
                            <input type="number" id="harga" name="harga"
                                class="field-input @error('harga') is-invalid @enderror"
                                value="{{ old('harga', $produk->harga) }}" placeholder="0">
                            @error('harga')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="stok">Stok</label>
                            <input type="number" id="stok" name="stok"
                                class="field-input @error('stok') is-invalid @enderror"
                                value="{{ old('stok', $produk->stok) }}" placeholder="0">
                            @error('stok')
                                <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    {{-- Gambar Saat Ini --}}
                    <div class="field-group">
                        <label class="field-label">Gambar Saat Ini</label>
                        <div class="current-img-wrap">
                            @if ($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}" class="current-img"
                                    alt="{{ $produk->nama_produk }}">
                                <div class="current-img-info">
                                    <div class="current-img-label">Gambar Aktif</div>
                                    <div class="current-img-name">{{ basename($produk->gambar) }}</div>
                                    <div class="current-img-hint">Upload baru untuk mengganti</div>
                                </div>
                            @else
                                <div class="current-img-empty"><i class="fas fa-image"></i></div>
                                <div class="current-img-info">
                                    <div class="current-img-label">Belum Ada Gambar</div>
                                    <div class="current-img-hint">Upload gambar produk di bawah</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Upload Gambar Baru --}}
                    <div class="field-group">
                        <label class="field-label">Ganti Gambar <span
                                style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--text-sub)">(opsional)</span></label>

                        <div class="upload-area @error('gambar') is-invalid @enderror" id="uploadArea">
                            <input type="file" name="gambar" class="upload-input" accept="image/*"
                                onchange="previewImage(event)">

                            <div id="uploadDefault">
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <div class="upload-text">Klik untuk upload gambar baru</div>
                                <div class="upload-hint">JPG, PNG, JPEG — Maks. 2MB — Kosongkan jika tidak ingin mengganti</div>
                            </div>

                            <div class="preview-wrap" id="previewWrap">
                                <img id="preview" class="preview-img" src="" alt="Preview">
                                <div class="preview-name" id="previewName"></div>
                                <div class="preview-change">Klik untuk ganti gambar</div>
                            </div>
                        </div>

                        {{-- Error ukuran (JS) --}}
                        <div id="uploadError" class="invalid-feedback" style="display:none;">
                            <i class="fas fa-exclamation-circle"></i> Ukuran gambar melebihi batas maksimal 5MB.
                        </div>

                        {{-- Error dari server (Laravel validation) --}}
                        @error('gambar')
                            <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="form-divider">

                    {{-- Footer --}}
                    <div class="form-footer">
                        <button type="submit" class="btn-update">
                            <i class="fas fa-check"></i> Update Produk
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
    let fileValid = true; // track status file

    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;

        const maxSize = 2 * 1024 * 1024; // 5MB
        const errorEl   = document.getElementById('uploadError');
        const uploadArea = document.getElementById('uploadArea');

        if (file.size > maxSize) {
            // Tandai file tidak valid
            fileValid = false;

            errorEl.style.display = 'flex';
            uploadArea.classList.add('is-invalid');
            uploadArea.classList.remove('has-preview');

            // Reset preview & input
            document.getElementById('previewWrap').classList.remove('show');
            document.getElementById('uploadDefault').style.display = '';
            event.target.value = ''; // reset input file
            return;
        }

        // File valid
        fileValid = true;
        errorEl.style.display = 'none';
        uploadArea.classList.remove('is-invalid');

        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('preview').src = reader.result;
            document.getElementById('previewName').textContent = file.name;
            document.getElementById('previewWrap').classList.add('show');
            document.getElementById('uploadDefault').style.display = 'none';
            uploadArea.classList.add('has-preview');
        };
        reader.readAsDataURL(file);
    }

    // Blokir submit jika file tidak valid
    document.querySelector('form').addEventListener('submit', function (e) {
        if (!fileValid) {
            e.preventDefault();
            document.getElementById('uploadError').style.display = 'flex';
            document.getElementById('uploadArea').classList.add('is-invalid');
        }
    });
</script>
@endpush