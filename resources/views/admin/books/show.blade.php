@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $book->title }}</h1>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                @if ($book->thumbnail)
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="{{ $book->title }}" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                    </div>
                @else
                    <div class="text-center">
                        <img src="https://via.placeholder.com/300" alt="No image available" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                    </div>
                @endif
            </div>

            <div class="col-md-6">
                <div class="mb-4">
                    <strong>Mô Tả:</strong>
                    <p>{{ $book->description }}</p>
                </div>

                <div class="mb-4">
                    <strong>Thể Loại:</strong>
                    <p class="badge bg-secondary">{{ $book->category->name }}</p>
                </div>

                <div class="text-center">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-primary">Trở Về</a>
                </div>
            </div>
        </div>
    </div>
@endsection
