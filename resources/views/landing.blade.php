<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belanjain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
        }



        .navbar-custom {
            display: flex;
            align-items: center;
            background-color: white;
            justify-content: space-between;
            height: 70px;
            /* atau lebih kecil, misalnya 60px */
            padding: 0 2rem;
            /* hindari padding vertikal */
            overflow: hidden;
            /* potong jika ada elemen yang lebih tinggi */
        }



        .navbar-custom .nav-link {
            color: #000;
            font-weight: 500;
            margin: 0 15px;
        }

        .navbar-custom .nav-link.active {
            border-bottom: 2px solid orange;
        }

        .navbar-custom .btn-signup {
            background-color: orange;
            color: white;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 4px;
        }

        .navbar-logo {
            height: auto;
            max-height: 180px;
            /* batas maksimum tinggi logo */
            object-fit: contain;
            transform-origin: left center;
            transform: scale(1.2);
        }


        .hero {
            position: relative;
            background: url('{{ asset('aset/Logo belanjain final.png') }}') no-repeat center center/cover;
            height: 80vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 5%;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
        }

        .hero h1 {
            font-size: 56px;
            font-weight: 700;
        }

        .hero .btn-explore {
            background-color: orange;
            color: white;
            padding: 12px 30px;
            border: none;
            font-size: 16px;
            font-weight: bold;
            margin-right: 20px;
        }

        .hero .btn-video {
            color: white;
            text-decoration: underline;
            font-size: 16px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 60px;
            margin-bottom: 30px;
            text-align: center;
        }

        .kategori-card {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        .kategori-card .card-img {
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .kategori-card .card-img-overlay {
            background-color: rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
            border-radius: 8px;
        }

        .kategori-card:hover .card-img-overlay {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .kategori-card:hover .card-img {
            transform: scale(1.5);
        }

        .produk-card img {
            height: 200px;
            object-fit: cover;
        }

        footer {
            background: #f8f9fa;
            padding: 2rem 0;
            text-align: center;
        }

        .map-responsive {
            overflow: hidden;
            padding-bottom: 56.25%;
            /* rasio 16:9 */
            position: relative;
            height: 0;
        }

        .map-responsive iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <img src="{{ asset('aset/finalisasi logo.png') }}" alt="Logo UMKM Indramayu"
                    class="navbar-logo img-fluid me-2">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kategori">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                </ul>
                <a href="{{ route('login') }}" class="btn btn-danger">Login</a>
                <a href="{{ route('register') }}" class="btn btn-signup ms-2">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content" style="margin-right: 20px;">
            <h1>EXPLORE THE WORLD<br>WITH US.</h1>
            <div class="mt-4">
                <a href="#produk" class="btn btn-explore">Explore</a>
                <a href="#" class="btn-video"><i class="fas fa-play-circle me-2"></i>Watch Video</a>
            </div>
        </div>
    </section>


    <!-- Kategori Produk -->
    <section id="kategori" class="container">
        <h2 class="section-title">Kategori Produk</h2>
        <div class="accordion" id="kategoriAccordion">
            @forelse($kategoris as $index => $kategori)
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                            aria-controls="collapse{{ $index }}">
                            {{ $kategori->nama }}
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $index }}" data-bs-parent="#kategoriAccordion">
                        <div class="accordion-body">

                            <!-- Gambar Kategori -->
                            <div class="mb-3">
                                <img src="{{ asset('storage/kategori/' . $kategori->gambar) }}"
                                    alt="{{ $kategori->nama }}" class="img-fluid rounded"
                                    style="max-height: 200px; object-fit: cover;">
                            </div>

                            <!-- Subkategori -->
                            @if ($kategori->subkategoris->count())
                                <h5>Subkategori:</h5>
                                <ul>
                                    @foreach ($kategori->subkategoris as $sub)
                                        <li>{{ $sub->nama }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <!-- Produk -->
                            @if ($kategori->produks->count())
                                <h5 class="mt-3">Produk:</h5>
                                <div class="row g-3">
                                    @foreach ($kategori->produks->take(3) as $produk)
                                        <div class="col-md-4">
                                            <div class="card h-100">
                                                <img src="{{ asset('storage/' . $produk->gambar) }}"
                                                    class="card-img-top" alt="{{ $produk->nama }}"
                                                    style="height: 180px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ $produk->nama }}</h6>
                                                    <p class="card-text">
                                                        Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                                                    <a href="{{ route('pembeli.produk.show', $produk->id) }}"
                                                        class="btn btn-sm btn-warning">Lihat Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>Tidak ada produk pada kategori ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Tidak ada kategori ditemukan.</p>
            @endforelse
        </div>
    </section>



    <!-- Produk Terbaru -->
    <section id="produk" class="container mt-5">
        <h2 class="section-title">Produk Terbaru</h2>
        <div class="row g-4">
            @forelse($produks as $produk)
                <div class="col-md-4">
                    <div class="card produk-card">
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top"
                            alt="{{ $produk->nama }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produk->nama }}</h5>
                            <p class="card-text">Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                            <a href="{{ route('pembeli.produk.show', $produk->id) }}" class="btn btn-warning">Lihat
                                Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Tidak ada produk tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Tentang Website -->
    <section id="tentang" class="container mt-5">
        <h2 class="section-title">Tentang Website</h2>
        <div class="text-center mb-4">
            <p>Platform ini dibuat untuk memajukan UMKM di Indramayu melalui digitalisasi penjualan produk lokal.</p>
            <p>Dengan fitur katalog online, pembeli dan penjual dapat terhubung dengan mudah, efisien, dan aman.</p>
        </div>
        <div class="map-responsive">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3551.780347188987!2d108.28970287445466!3d-6.422555593568405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMjUnMjEuMiJTIDEwOMKwMTcnMzIuMiJF!5e1!3m2!1sid!2sid!4v1747576331287!5m2!1sid!2sid"
                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>


    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-1">&copy; {{ date('Y') }} UMKM Indramayu. Kelompok 7.</p>
            <small>Powered by Laravel & Bootstrap</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
