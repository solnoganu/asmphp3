<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
      // Danh sách tất cả các danh mục
      public function index()
      {
          $categories = Category::paginate(10); // Sử dụng phân trang nếu cần
          return view('admin.categories.index', compact('categories'));
      }
  
      // Trang thêm danh mục
      public function create()
      {
          return view('admin.categories.create');
      }
  
      // Xử lý khi thêm mới danh mục
      public function store(Request $request)
      {
          $request->validate([
              'name' => 'required|string|max:255', // Validate tên danh mục
          ]);
  
          Category::create([
              'name' => $request->name,
          ]);
  
          return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được thêm thành công.');
      }
  
      // Trang chỉnh sửa danh mục
      public function edit(Category $category)
      {
          return view('admin.categories.edit', compact('category'));
      }
  
      // Xử lý cập nhật danh mục
      public function update(Request $request, Category $category)
      {
          $request->validate([
              'name' => 'required|string|max:255', // Validate tên danh mục
          ]);
  
          $category->update([
              'name' => $request->name,
          ]);
  
          return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được cập nhật thành công.');
      }
  
      // Xóa danh mục
      public function destroy(Category $category)
      {
          $category->delete();
  
          return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được xóa thành công.');
      }
}
