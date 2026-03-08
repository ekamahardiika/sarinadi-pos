<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="name" content="Warung Babi Guling Sari Nadi">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Warung Babi Guling Sari Nadi</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS (CDN) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- FontAwesome untuk Ikon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <style>
            body { font-family: 'Figtree', sans-serif; }
            .navbar-brand img { height: 50px; margin-right: 10px; }
            
            /* Smooth Scroll */
            html { scroll-behavior: smooth; }
            
            /* Penting: Scroll padding agar tidak tertutup navbar */
            html { scroll-padding-top: 80px; }
            
            section { padding: 60px 0; }
            .section-title { text-align: center; margin-bottom: 40px; font-weight: bold; color: #d35400; }
            .beranda-img { width: 100%; height: auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
            .card { transition: transform 0.3s; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
            .card:hover { transform: translateY(-5px); }
            .card-img-top { height: 200px; object-fit: cover; }
            .contact-icon { font-size: 2rem; margin-bottom: 10px; }
            .bg-dark-footer { background-color: #212529; color: white; padding: 40px 0; }
            
            /* Styling untuk Nav Link Aktif */
            .nav-link.active {
                font-weight: bold;
                color: #ffc107 !important; /* Warna kuning saat aktif */
            }
        </style>
    </head>
    <body class="antialiased">

        <!-- HEADER / NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container">
                <!-- Logo & Nama Warung -->
                <a class="navbar-brand" href="#">
                    <img src="https://placehold.co/50x50/orange/white?text=W" alt="Logo">
                    Warung Babi Guling Sari Nadi
                </a>

                <!-- Tombol Menu Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu Navigasi & Login -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="#beranda" data-target="beranda">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#lokasi" data-target="lokasi">Lokasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#menu" data-target="menu">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="#kontak" data-target="kontak">Kontak</a></li>
                    </ul>

                    <!-- Bagian Login/Register -->
                    <div class="d-flex align-items-center">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/home') }}" class="btn btn-outline-light me-2">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-warning me-2">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- BAGIAN BERANDA -->
        <section id="beranda" class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://placehold.co/600x400/orange/white?text=Foto+Babi+Guling" alt="Babi Guling" class="beranda-img">
                </div>
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold">Selamat Datang di Sari Nadi</h1>
                    <p class="lead">Nikmati kelezatan Babi Guling asli Bali dengan bumbu rempah pilihan.</p>
                    <p>Kulit yang renyah, daging yang empuk, dan nasi kuning yang wangi adalah kombinasi sempurna.</p>
                    <a href="#menu" class="btn btn-warning btn-lg">Lihat Menu Kami</a>
                </div>
            </div>
        </section>

        <!-- BAGIAN LOKASI -->
        <section id="lokasi" class="bg-light">
            <div class="container">
                <h2 class="section-title">Lokasi Kami</h2>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.066666666666!2d115.1889!3d-8.6705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwNDAnMTMuOCJTIDExNcKwMTExMCJF!5e0!3m2!1sen!2sid!4v1600000000000!5m2!1sen!2sid" 
                            style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        <p class="text-center mt-3">Jl. Raya Sari Nadi, Bali, Indonesia</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- BAGIAN MENU -->
        <section id="menu" class="container">
            <h2 class="section-title">Menu Favorit</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://placehold.co/400x300?text=Paket+Prima" class="card-img-top" alt="Paket Prima">
                        <div class="card-body">
                            <h5 class="card-title">Paket Prima</h5>
                            <p class="card-text">Nasi, Babi Guling, Sate Lilit, Urutan, dan Sambal Matah.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://placehold.co/400x300?text=Paket+Jajan" class="card-img-top" alt="Paket Jajan">
                        <div class="card-body">
                            <h5 class="card-title">Paket Jajan</h5>
                            <p class="card-text">Nasi, Babi Guling, dan Sambal Matah. Cocok untuk makan siang.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://placehold.co/400x300?text=Sate+Lilit" class="card-img-top" alt="Sate Lilit">
                        <div class="card-body">
                            <h5 class="card-title">Sate Lilit</h5>
                            <p class="card-text">Sate khas Bali dari ikan tenggiri dan daging cincang.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- BAGIAN KONTAK -->
        <section id="kontak" class="bg-dark-footer">
            <div class="container text-center">
                <h2 class="section-title text-white">Hubungi Kami</h2>
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <i class="fab fa-whatsapp text-success contact-icon"></i>
                        <h4>WhatsApp</h4>
                        <p>+62 812-3456-7890</p>
                        <a href="#" class="btn btn-outline-success">Chat Sekarang</a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fab fa-instagram text-danger contact-icon"></i>
                        <h4>Instagram</h4>
                        <p>@warungbabigulingsarinadi</p>
                        <a href="#" class="btn btn-outline-danger">Follow</a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-motorcycle text-warning contact-icon"></i>
                        <h4>Grabfood</h4>
                        <p>Siap Antar ke Rumah</p>
                        <a href="#" class="btn btn-outline-warning">Pesan via Grab</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-center py-3 bg-black text-white">
            <small>&copy; 2023 Warung Babi Guling Sari Nadi.</small>
        </footer>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Script untuk Highlight Menu Aktif -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sections = document.querySelectorAll('section');
                const navLinks = document.querySelectorAll('.nav-link');

                function updateActiveMenu() {
                    let current = '';
                    const scrollY = window.pageYOffset;
                    const windowHeight = window.innerHeight;
                    const docHeight = document.documentElement.scrollHeight;

                    // FIX: Jika sudah scroll sampai paling bawah, aktifkan section terakhir (kontak)
                    if (scrollY + windowHeight >= docHeight - 10) {
                        current = sections[sections.length - 1].getAttribute('id');
                    } else {
                        sections.forEach(section => {
                            const sectionTop = section.offsetTop;
                            if (scrollY >= (sectionTop - windowHeight / 3)) {
                                current = section.getAttribute('id');
                            }
                        });
                    }

                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('data-target') === current) {
                            link.classList.add('active');
                        }
                    });
                }

                window.addEventListener('scroll', updateActiveMenu);
                updateActiveMenu();
            });
        </script>
    </body>
</html>