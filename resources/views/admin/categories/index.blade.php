@extends('layouts.app')

@section('content')
    <h1 class="text-center">Quản Lý Danh Mục</h1>

    <!-- Hiển thị thông báo thành công -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Nút thêm danh mục -->
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Thêm Danh Mục</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tên Danh Mục</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $categories->links('vendor.pagination.bootstrap-5') }} <!-- Sử dụng phân trang Bootstrap 5 -->
    </div>
@endsection
