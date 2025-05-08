<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo_sebar.png') }}" alt="Logo SEBAR" style="width: 200px; height: 50px; margin-right: 10px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Tentang Kami</a></li>
            </ul>
            <a href="{{ route('home') }}" class="nav-link">Home</a>

        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Info',
            text: '{{ session('info') }}',
        });
    @endif
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
        });
    @endif
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
        });
    @endif
</script>
