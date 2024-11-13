@extends('layouts.app')

@section('content')
    <h1 class="text-center">Chỉnh Sửa Danh Mục</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tên Danh Mục</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
        </div>

        <button type="submit" class="btn btn-success">Cập Nhật</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
@endsection
