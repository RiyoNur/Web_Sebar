<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .hero {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 80px 0;
            position: relative;
        }
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.2rem;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .feature {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }
        .feature i {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 10px;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="images/logo_sebar.png" alt="Logo SEBAR" style="width: 200px; height: 50px; margin-right: 10px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Tentang Kami</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <!-- Hero Section -->
<section class="hero">
    <div class="container">
        <img src="images/1.jpg" alt="Tentang Kami" class="img-fluid" style="max-width: 100%; height: 300px; border-radius: 10px; margin-bottom: 20px;">
    </div>
</section>

    <section class="container py-5">
        <h2 class="text-center mb-4">Selamat Datang di SEBAR</h2>
        <div class="feature">
            <i class="fas fa-shopping-cart"></i>
            <h3>Marketplace Terpercaya</h3>
            <p>SEBAR adalah platform marketplace yang didedikasikan untuk memberikan pengalaman belanja terbaik bagi Anda.</p>
        </div>
        <div class="feature">
            <i class="fas fa-tags"></i>
            <h3>Produk Berkualitas</h3>
            <p>Kami menawarkan berbagai produk berkualitas, mulai dari furnitur, elektronik, hingga kebutuhan sehari-hari, semua dengan harga yang kompetitif.</p>
        </div>
        <div class="feature">
            <i class="fas fa-headset"></i>
            <h3>Layanan Pelanggan</h3>
            <p>Di SEBAR, kami percaya bahwa setiap pelanggan berhak mendapatkan pengalaman belanja yang menyenangkan.</p>
        </div>
        <p>
            Misi kami adalah untuk memudahkan Anda sebagai anak kos dalam menemukan produk/barang yang Anda butuhkan dengan cara yang cepat dan efisien. Kami bekerja sama dengan berbagai penyedia untuk memastikan bahwa Anda mendapatkan produk terbaik dengan layanan yang memuaskan.
        </p>
        <p>
            Terima kasih telah memilih SEBAR sebagai tempat belanja Anda. Kami berharap
