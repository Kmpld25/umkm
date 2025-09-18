<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Belanjain')</title>
    @stack('style')

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- DeskApp CSS -->
    <link rel="stylesheet" href="{{ asset('vendors/styles/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/styles/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/styles/responsive.css') }}" />

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .hero-banner {
            background: url('{{ asset('aset/finalisasi logo.png') }}') no-repeat center center;
            background-size: cover;
            height: 300px;
            position: relative;
        }

        .hero-banner::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .hero-banner-content {
            position: relative;
            z-index: 1;
            color: white;
            padding: 60px 30px;
            text-align: center;
        }

        .navbar {
            display: flex;
            align-items: center;
            background-color:rgba(0, 0, 0, 0.1);
            justify-content: space-between;
            height: 70px;
            /* atau lebih kecil, misalnya 60px */
            padding: 0 2rem;
            /* hindari padding vertikal */
            overflow: hidden;
            /* potong jika ada elemen yang lebih tinggi */
            backdrop-filter: blur(6px);
        }

        

.navbar-logo {
            height: auto;
            max-height: 180px;
            /* batas maksimum tinggi logo */
            object-fit: contain;
            transform-origin: left center;
            transform: scale(1.2);
        }

        .navbar-nav .nav-link {
            color: white !important;
        }

        .main-content {
            margin-top: 2rem;
        }

        .main-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 1rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        footer {
            background-color: #343a40;
            /* warna gelap */
            color: white;
            padding: 1rem 0;
            text-align: center;
        }


        .text-color {
            color: black;
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold text-white"
                href="{{ route('pembeli.dashboard') }}">
                <img src="{{ asset('aset/finalisasi logo.png') }}" alt="UMKM Logo" class="navbar-logo me-2" />
                
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pembeli.dashboard') ? 'active' : '' }}"
                            href="{{ route('pembeli.dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pembeli.produk.index') ? 'active' : '' }}"
                            href="{{ route('pembeli.produk.index') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pembeli.pesanan.index') ? 'active' : '' }}"
                            href="{{ route('pembeli.pesanan.index') }}">Pesanan</a>
                    </li>
                </ul>

                <form class="d-flex" method="GET" action="{{ route('pembeli.dashboard') }}">
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari produk..."
                        value="{{ request('search') }}" />
                    <button class="btn btn-outline-light" type="submit">Cari</button>
                </form>

                <ul class="navbar-nav ms-3">
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('pembeli.keranjang.index') }}">
                            <i class="bi bi-cart" style="font-size: 1.5rem;"></i>
                            @if($totalKeranjang > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $totalKeranjang }}
                                </span>
                            @endif
                        </a>
                    </li>
                    {{-- Notifikasi Pesanan Dikirim --}}
                    <li class="nav-item dropdown me-2">
                        <a class="nav-link position-relative dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-truck" style="font-size: 1.5rem;"></i>
                            @if($notifikasiDikirim->count() > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                                    {{ $notifikasiDikirim->count() }}
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if($notifikasiDikirim->count() > 0)
                                @foreach($notifikasiDikirim as $notif)
                                    <li>
                                        <a class="dropdown-item small" href="{{ route('pembeli.pesanan.index') }}">
                                            📦 Pesanan "{{ $notif->produk->nama }}" sedang dikirim
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-center" href="{{ route('pembeli.pesanan.index') }}">Lihat
                                        Semua</a>
                                </li>
                            @else
                                <li><span class="dropdown-item text-muted">Tidak ada notifikasi</span></li>
                            @endif
                        </ul>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('pembeli.profile.show') }}"><i
                                        class="bi bi-person-circle me-2"></i>Profil</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Hero Banner --}}
    <section class="hero-banner d-flex align-items-center justify-content-center">
        <div class="hero-banner-content">
            <h1 class="display-5 fw-bold">Selamat Datang di UMKM Indramayu</h1>
            <p class="lead">Belanja Produk UMKM Lokal Lebih Mudah dan Menyenangkan!</p>
        </div>
    </section>

    {{-- Main Content --}}
    <main class="container main-content">
        <div class="main-card">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-dark py-4 mt-5">
        <div class="container text-center">
            <p class="mb-2">&copy; {{ date('Y') }} UMKM Indramayu - Kelompok 7</p>
            <small>Powered by Laravel & Bootstrap | Designed by Belanjain</small>
        </div>
    </footer>


    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
</body>

</html>