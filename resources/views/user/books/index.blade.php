@extends('layouts.app')

@section('content')
    <h1>Tất Cả Sách</h1>

    <!-- Form tìm kiếm theo danh mục -->
    <form action="{{ route('books.searchByCategory') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <select name="category_id" class="form-select">
                    <option value="">Chọn Danh Mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success">Tìm Kiếm</button>
            </div>
        </div>
    </form>

    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $book->thumbnail) }}" class="card-img-top" alt="{{ $book->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">Tác giả: {{ $book->author }}</p>
                        <a href="{{ route('user.books.show', $book->id) }}" class="btn btn-primary">Xem Chi Tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $books->links('vendor.pagination.bootstrap-5') }} <!-- Hiển thị phân trang -->
@endsection
