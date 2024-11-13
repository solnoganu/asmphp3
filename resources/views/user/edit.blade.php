@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Chỉnh sửa thông tin cá nhân</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="fullname" class="form-label">Họ và Tên</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $user->fullname }}" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Tên Đăng Nhập</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật Khẩu Mới</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới (nếu có)">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Xác Nhận Mật Khẩu</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu mới (nếu có)">
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
