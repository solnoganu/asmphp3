@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Đăng Nhập</div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username" required>
                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        </form>
        <div class="mt-3">
            <span>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></span>
        </div>
    </div>
</div>
@endsection
