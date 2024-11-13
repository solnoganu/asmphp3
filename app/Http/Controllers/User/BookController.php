<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Lấy tất cả sách
        $books = Book::with('category')->paginate(9); // hoặc take(9) nếu bạn không muốn phân trang
        $categories = Category::all();
        // Lấy các sách xem nhiều nhất và mới nhất (nếu cần thiết)
        $topViewedBooks = Book::orderBy('view_count', 'desc')->take(9)->get();
        $newestBooks = Book::orderBy('publication', 'desc')->take(9)->get();
        $categories = Category::all(); // Lấy tất cả các danh mục sách

        // Truyền các biến vào view
        return view('user.books.index', compact('books', 'topViewedBooks', 'newestBooks', 'categories'));
    }

    public function showAll()
    {
        $books = Book::paginate(10);
        return view('books.listall', compact('books'));
    }


    public function listByCategory($id = 1) // Mặc định category_id là 1
    {
        $books = Book::where('category_id', $id)->get();
        $categories = Category::all(); // Lấy tất cả các danh mục
        $category = Category::find($id); // Lấy thông tin danh mục hiện tại
        return view('books.list', compact('books', 'category', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Kiểm tra nếu query không rỗng
        if ($query) {
            $books = Book::where('title', 'LIKE', "%{$query}%")
                ->orWhere('author', 'LIKE', "%{$query}%")
                ->get();
        } else {
            $books = Book::all(); // Nếu không có query, trả về tất cả sách
        }

        return view('books.search', compact('books', 'query'));
    }
    public function show($id)
    {
        $book = Book::findOrFail($id); // Tìm sách theo ID
        return view('books.show', compact('book')); // Trả về view hiển thị thông tin sách
    }
    public function searchByCategory(Request $request)
{
    $categoryId = $request->input('category_id');
    
    // Kiểm tra nếu người dùng chọn danh mục
    if ($categoryId) {
        // Tìm kiếm sách theo danh mục
        $books = Book::where('category_id', $categoryId)->paginate(9);
    } else {
        // Nếu không chọn danh mục, hiển thị tất cả sách
        $books = Book::paginate(9);
    }

    // Lấy tất cả danh mục để hiển thị trong dropdown
    $categories = Category::all();

    return view('user.books.index', compact('books', 'categories'));
}

}
