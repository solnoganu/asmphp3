<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASM PHP3</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="https://png.pngtree.com/png-clipart/20230121/original/pngtree-book-logo-design-inspiration-png-image_8925017.png" alt="Website Logo" style="height: 150px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}"><h3>Trang Chủ</h3></a>
                    </li>
    
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}"><h3>Dashboard</h3></a>
                        </li>
                    @endif
                </ul>
                
                @if(Auth::check())
                    <div class="d-flex align-items-center ms-3">
                        <span class="me-3">Xin chào, {{ Auth::user()->fullname }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Đăng Xuất</button>
                        </form>
                    </div>
                @else
                    <a class="btn btn-primary ms-3" href="{{ route('login') }}">Đăng Nhập</a>
                @endif
                <form class="d-flex ms-3" action="{{ route('books.search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Tìm kiếm sách" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </nav>    
    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="bg-light text-center py-3">
        <div class="container">
            <p>&copy; {{ date('Y') }} Nguyễn Tiến Đạt.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
