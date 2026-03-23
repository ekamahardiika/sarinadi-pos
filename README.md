# 🛒 Sarinadi POS

**Sarinadi POS** adalah aplikasi Point of Sale (POS) berbasis web yang dirancang khusus untuk membantu toko retail dan warung dalam mengelola transaksi penjualan secara digital, cepat, dan efisien.

---

## 📌 Tentang Proyek

Sarinadi POS hadir sebagai solusi kasir modern untuk usaha kecil dan menengah. Dengan tampilan yang sederhana dan fitur yang lengkap, aplikasi ini memudahkan pemilik toko dalam mencatat penjualan, memantau stok barang, hingga menghasilkan laporan keuangan — semuanya dalam satu platform.

---

## ✨ Fitur Utama

- 📦 **Manajemen Produk** — Tambah, edit, dan hapus data produk beserta harga dan kategori.
- 🛍️ **Transaksi / Kasir** — Proses penjualan yang cepat dengan antarmuka kasir yang intuitif.
- 📊 **Manajemen Stok** — Pantau ketersediaan stok barang secara real-time.
- 📈 **Laporan Penjualan** — Lihat ringkasan dan riwayat transaksi penjualan.
- 📤 **Export Excel** — Ekspor data laporan ke format `.xlsx` untuk keperluan arsip atau analisis.
- 🧾 **Cetak PDF / Struk** — Cetak struk transaksi dan laporan dalam format PDF.
- 💳 **Payment Gateway (Midtrans)** — Mendukung pembayaran digital melalui integrasi Midtrans.

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Versi |
|---|---|
| PHP | ^8.1 |
| Laravel | ^10.10 |
| Laravel UI | ^4.6 |
| Laravel Sanctum | ^3.3 |
| Midtrans PHP SDK | ^2.6 |
| Maatwebsite Excel | ^3.1 |
| DomPDF (barryvdh) | ^3.1 |
| Vite | — |

---

## ⚙️ Cara Instalasi

### Prasyarat
Pastikan kamu sudah menginstal:
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL / MariaDB

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/ekamahardiika/sarinadi-pos.git
cd sarinadi-pos

# 2. Install dependensi PHP
composer install

# 3. Install dependensi Node.js
npm install

# 4. Salin file environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Konfigurasi database di file .env
# DB_DATABASE=nama_database
# DB_USERNAME=username
# DB_PASSWORD=password

# 7. Jalankan migrasi dan seeder
php artisan migrate --seed

# 8. Build assets
npm run build

# 9. Jalankan server
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

---

## 🔑 Konfigurasi Midtrans

Tambahkan konfigurasi berikut pada file `.env`:

```env
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

> Dapatkan Server Key dan Client Key dari dashboard [Midtrans](https://dashboard.midtrans.com).

---

## 📁 Struktur Direktori

```
sarinadi-pos/
├── app/                  # Logic aplikasi (Controllers, Models, dll)
├── config/               # Konfigurasi aplikasi
├── database/             # Migrasi dan seeder
├── public/               # Aset publik
├── resources/            # Views (Blade), CSS, JS
├── routes/               # Definisi route
├── storage/              # File upload dan log
└── tests/                # Unit & Feature tests
```

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

---

## 👤 Developer

Dibuat oleh **[ekamahardiika](https://github.com/ekamahardiika)**