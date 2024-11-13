<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::paginate(10); // Phân trang với 10 người dùng mỗi trang
        return view('admin.users.index', compact('users'));
    }

    // Thay đổi trạng thái người dùng
    public function toggleActive(User $user)
    {
        $user->active = !$user->active; // Đảo ngược trạng thái active
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Trạng thái người dùng đã được cập nhật.');
    }

    // Cập nhật role người dùng
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Role người dùng đã được cập nhật.');
    }

    // Xóa người dùng
    public function destroy(User $user)
    {
        // Kiểm tra nếu người dùng đang hoạt động (không bị khóa) trước khi xóa
        if ($user->active) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể xóa người dùng đang hoạt động.');
        }

        // Xóa người dùng
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa thành công.');
    }
}
