<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo_sebar.png') }}" alt="Logo SEBAR" style="width: 200px; height: 50px; margin-right: 10px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
