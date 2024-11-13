@extends('layouts.app')

@section('content')
    <h1 class="text-center">Chỉnh Sửa Sách</h1>
    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu Đề</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
        </div>
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail">
        
            @if(isset($book) && $book->thumbnail)
                <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="Thumbnail" class="mt-2" style="max-width: 200px; max-height: 200px;">
            @endif
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="description" name="description" required>{{ $book->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Thể Loại</label>
            <select class="form-select" id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Cập Nhật Sách</button>
    </form>
@endsection
