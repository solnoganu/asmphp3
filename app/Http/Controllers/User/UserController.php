<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Nhập mô hình User

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đang đăng nhập
        return view('user.edit', compact('user')); // Trả về view chỉnh sửa thông tin người dùng
    }

    public function update(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed', // Kiểm tra mật khẩu
        ]);

        $user = Auth::user();
        
        if ($user) { // Kiểm tra nếu người dùng tồn tại
            $user->fullname = $request->fullname;
            $user->username = $request->username;

            // Cập nhật mật khẩu nếu có
            if ($request->filled('password')) {
                $user->password = $request->password; // Không mã hóa mật khẩu
            }

            $user->save(); // Gọi phương thức save trên đối tượng User

            return redirect()->route('home')->with('success', 'Thông tin đã được cập nhật thành công!');
        }

        return redirect()->back()->withErrors(['user' => 'Người dùng không tồn tại.']);
    }
}
