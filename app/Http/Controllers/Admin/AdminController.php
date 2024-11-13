<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Lấy tổng số liệu
        $categories = Category::all();
        $totalCategories = Category::count(); // Tổng số danh mục
        $totalProducts = Book::count(); // Đếm tổng số sản phẩm
        $totalUsers = User::count();     // Đếm tổng số người dùng
        $totalViews = Book::sum('view_count');                 // Thay thế bằng logic thực tế nếu bạn theo dõi lượt xem
        $books = Book::latest()->paginate(10);           // Lấy tất cả sách

        return view('admin.dashboard', compact('totalProducts', 'totalUsers', 'totalViews', 'books','categories','totalCategories'));
    }
    
}

