<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sebar - Pembeli</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link ke Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .hero {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 100px 0;
        }
        .cta-button {
            background-color: #ff6600;
            color: #fff;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .cta-button:hover {
            font-size: 16px;
            padding: 9px 19px;
        }
        .product-image-container {
        width: 100%;
        height: 250px; /* Tinggi tetap untuk semua gambar */
        overflow: hidden;
        margin-bottom: 15px;
        border-radius: 10px;
    }
        .product {
            background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        height: 100%; /* Membuat card sama tinggi */
        display: flex;
        flex-direction: column;
    }
        .product img {
            width: 100%;
        height: 100%;
        object-fit: cover; /* Memastikan gambar menutupi container tanpa distorsi */
        object-position: center; /* Memastikan gambar selalu di tengah */
    }
        .price {
            font-size: 20px;
            color: #333;
            margin: 10px 0;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        .stock {
        color: #666;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .btn-secondary:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo_sebar.png') }}" alt="Logo SEBAR" style="width: 200px; height: 50px; margin-right: 10px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Tentang Kami</a></li>
                </ul>
                <div class="d-flex">
                    <form action="{{ route('search.products') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-primary">Cari</button>
                    </form>
                </div>
                <div>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('buyer.profile') }}">
                            <i class="fas fa-user-circle" style="font-size: 30px; margin-bottom:20px"></i>
                        </a>
                    </li>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Temukan Produk Terbaik untuk Rumah Anda</h1>
            <p>Belanja furnitur, elektronik, dan banyak lagi dengan harga terbaik.</p>
        </div>
    </section>

    <section class="container py-5">
        <h2 class="text-center mb-5">Produk Terbaru</h2>
        <div class="row g-4">
            @forelse ($products as $product)
                <!-- Update bagian card produk -->
                <div class="col-md-4 mb-4">
                    <div class="product">
                        <div class="product-image-container">
                            <img src="{{ asset('storage/' . $product->foto) }}"
                                alt="{{ $product->nama_produk }}"
                                class="product-image">
                        </div>
                        <h3>{{ $product->nama_produk }}</h3>
                        <p class="price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <p class="stock">Stok: {{ $product->stok }}</p>
                        @auth
                            @if($product->stok > 0)
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary mt-auto">Beli</a>
                            @else
                                <button class="btn btn-secondary mt-auto" disabled>Stok Habis</button>
                            @endif
                        @else
                            <a href="{{ route('buyer.login.form') }}" class="btn btn-primary mt-auto">Beli</a>
                        @endauth
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada produk yang tersedia saat ini.</p>
            @endforelse
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Marketplace</p>
    </footer>

    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
