@extends('layouts.app') <!-- Thay 'layouts.app' bằng tên file layout của bạn nếu khác -->

@section('content')
    <h1 class="text-center">Chào mừng đến với Dashboard Admin</h1>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng Số Sản Phẩm</h5>
                    <p class="card-text">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.users.index') }}" class="card text-decoration-none text-dark">
                <div class="card-body">
                    <h5 class="card-title">Tổng Số Người Dùng</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tổng Số Lượt Xem</h5>
                    <p class="card-text">{{ $totalViews }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.categories.index') }}" class="card text-decoration-none text-dark">
                <div class="card-body">
                    <h5 class="card-title">Tổng Số Danh Mục</h5>
                    <p class="card-text">{{ $totalCategories }}</p> <!-- Hiển thị tổng số danh mục -->
                </div>
            </a>
        </div>
    </div>

    <h1 class="text-center mt-5">Danh Sách Sách</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Thêm Sách</a>
        <form action="{{ route('admin.books.searchByCategory') }}" method="GET" class="d-flex">
            <select name="category_id" class="form-select me-2">
                <option value="">Chọn Danh Mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success">Tìm Kiếm</button>
        </form>
    </div>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>Tiêu Đề</th>
                <th>Thumbnail</th>
                <th>Thể Loại</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>
                        @if($book->thumbnail)
                            <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="Thumbnail" style="max-width: 100px; max-height: 100px;">
                        @else
                            Không có hình ảnh
                        @endif
                    </td>
                    <td>{{ $book->category->name }}</td>
                    <td>
                        <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                        <a href="{{ route('admin.books.show', $book) }}" class="btn btn-info">Chi Tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        <nav>
            {{ $books->links('vendor.pagination.bootstrap-5') }}
        </nav>
    </div>
@endsection
