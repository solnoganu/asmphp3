<!-- admin/users/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Danh Sách Người Dùng</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Username</th>
                <th>Role</th>
                <th>Trạng Thái</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->active ? 'Kích hoạt' : 'Không kích hoạt' }}</td>
                    <td>
                        <form action="{{ route('admin.users.toggle-active', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn {{ $user->active ? 'btn-warning' : 'btn-success' }} btn-sm" onclick="return confirm('Bạn có chắc chắn muốn {{ $user->active ? 'khóa' : 'kích hoạt' }} người dùng này không?');">
                                {{ $user->active ? 'Khóa' : 'Kích hoạt' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE') <!-- Chỉ định phương thức DELETE -->
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }} <!-- Hiển thị phân trang -->
</div>
@endsection
