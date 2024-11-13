<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Lấy tất cả danh mục
        $categories = Category::all();
        $books = Book::with('category')->latest()->paginate(10);
        return view('admin.books.index', compact('books','categories'));
    }

    public function create()
    {
        $categories = Category::all(); // Lấy tất cả các thể loại
        return view('admin.books.create', compact('categories'));
    }

    // Lưu sách vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'publication' => 'required|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra hình ảnh
        ]);

        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->category_id = $request->input('category_id');
        $book->publication = $request->input('publication');

        // Xử lý hình ảnh
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('books', 'public'); // Lưu hình ảnh
            $book->thumbnail = $thumbnailPath;
        }

        $book->save(); // Lưu sách vào cơ sở dữ liệu

        return redirect()->route('admin.books.index')->with('success', 'Sách đã được thêm thành công!');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|string',
        ]);

        $book->title = $request->title;
        $book->description = $request->description;
        $book->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('books', 'public');
            $book->image = $path;
        }

        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Cập nhật sách thành công!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Xóa sách thành công!');
    }

    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
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
    public function listByCategory($id = 1) // Mặc định category_id là 1
    {
        $books = Book::where('category_id', $id)->get();
        $categories = Category::all(); // Lấy tất cả các danh mục
        $category = Category::find($id); // Lấy thông tin danh mục hiện tại
        return view('books.list', compact('books', 'category', 'categories'));
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

    return view('admin.books.index', compact('books', 'categories'));
}
}
