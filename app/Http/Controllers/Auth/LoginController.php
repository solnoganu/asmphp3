<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Lấy người dùng theo username
        $user = User::where('username', $request->username)->first();

        // Kiểm tra nếu người dùng tồn tại và mật khẩu nhập vào trùng khớp (không mã hóa)
        if ($user) {
            // Kiểm tra trạng thái kích hoạt của người dùng
            if (!$user->active) {
                return redirect()->back()->withErrors(['username' => 'Tài khoản đã bị khóa.']);
            }

            // Kiểm tra mật khẩu
            if ($user->password === $request->password) {
                Auth::login($user); // Đăng nhập thủ công

                // Kiểm tra vai trò người dùng
                if ($user->role === 'admin') {
                    return redirect()->intended('admin/dashboard'); // Redirect đến trang dashboard admin
                } elseif ($user->role === 'user') {
                    return redirect()->intended('/'); // Redirect đến trang danh sách sách
                }
            }
        }

        // Nếu không tìm thấy tài khoản hoặc thông tin không đúng
        return redirect()->back()->withErrors(['username' => 'Thông tin đăng nhập không đúng.']);
    }
}
