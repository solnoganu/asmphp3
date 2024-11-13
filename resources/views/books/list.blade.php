@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Danh mục: {{ $category->name }}</h1>

    <div class="row">
        <div class="col-md-3">
            <h4>Danh Mục</h4>
            <ul>
                @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('category.show', $cat->id) }}">{{ $cat->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-9">
            <div class="row">
                @foreach($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ $book->image }}" class="card-img-top" alt="{{ $book->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">{{ $book->author }}</p>
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Hiển thị phân trang -->
            {{ $books->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
