<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\BookController as UserBookController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and assigned to 
| the "web" middleware group.
*/

// Route cho trang chủ
Route::get('/', [UserBookController::class, 'index'])->name('home');

// Route cho đăng nhập
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route cho đăng ký
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route cho sách (người dùng)
Route::get('/books', [UserBookController::class, 'index'])->name('user.books.index');
Route::get('/books/{id}', [UserBookController::class, 'show'])->name('user.books.show');
Route::get('/books/search', [UserBookController::class, 'search'])->name('books.search');

// Route cho quản lý sách
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Routes cho sách
    Route::prefix('admin/books')->name('admin.books.')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::post('/', [BookController::class, 'store'])->name('store');
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit');
        Route::put('/{book}', [BookController::class, 'update'])->name('update');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');
        Route::get('/{book}', [BookController::class, 'show'])->name('show');
    });

    // Route cho quản lý danh mục trong admin
    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        // Route cho danh sách danh mục
        Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');

        // Route cho trang tạo danh mục
        Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');

        // Route để lưu danh mục mới
        Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');

        // Route cho trang chỉnh sửa danh mục
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');

        // Route để cập nhật danh mục
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');

        // Route để xóa danh mục
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });
});

// Route cho người dùng (admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::patch('/admin/users/{user}/unactive', [UserController::class, 'unactive'])->name('admin.users.unactive');
    Route::patch('/admin/users/{user}/role', [UserController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::post('/admin/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('admin.users.toggle-active');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::put('/user/profile', [UserController::class, 'update'])->name('user.profile.update');
});

// Route tìm kiếm sách theo danh mục
Route::get('/admin/books/category', [BookController::class, 'searchByCategory'])->name('admin.books.searchByCategory');
Route::get('/books/category', [BookController::class, 'searchByCategory'])->name('books.searchByCategory');

// Route cho logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');
