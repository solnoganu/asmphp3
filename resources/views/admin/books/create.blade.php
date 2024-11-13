@extends('layouts.app')

@section('content')
    <h1>Thêm Sách Mới</h1>

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu Đề</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Tác Giả</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Thể Loại</label>
            <select class="form-select" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="publication" class="form-label">Ngày Xuất Bản</label>
            <input type="date" class="form-control" id="publication" name="publication" placeholder="YYYY-MM-DD" required>
        </div>
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Hình Ảnh</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Thêm Sách</button>
    </form>
@endsection
