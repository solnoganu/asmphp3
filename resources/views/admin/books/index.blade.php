@extends('layouts.app')

@section('content')
    <h1 class="text-center">Danh Sách Sách</h1>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Thêm Sách</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Tiêu Đề</th>
                <th>Thumbnail</th>
                <th>Thể Loại</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>
                        @if ($book->thumbnail)
                            <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="{{ $book->title }}"
                                style="max-width: 150px;">
                        @else
                            <p>Không có hình ảnh</p>
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
    <div class="d-flex justify-content-center">
        {{ $books->links('vendor.pagination.bootstrap-5') }} <!-- Hiển thị các liên kết phân trang -->
    </div>
@endsection
