@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tìm Kiếm Sách: "{{ $query }}"</h1>

    @if($books->isEmpty())
        <div class="alert alert-warning">Không tìm thấy sách nào với từ khóa "{{ $query }}".</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Sách</th>
                    <th>Tác Giả</th>
                    <th>Thể Loại</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category->name ?? 'Không có' }}</td>
                        <td>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info">Xem</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $books->links('vendor.pagination.bootstrap-5') }} <!-- Hiển thị phân trang -->
    @endif
</div>
@endsection
