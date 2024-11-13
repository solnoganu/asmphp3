<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname'); // Tên đầy đủ
            $table->string('username')->unique(); // Tên đăng nhập, không trùng lặp
            $table->string('email')->unique(); // Địa chỉ email, không trùng lặp
            $table->string('password'); // Mật khẩu
            $table->string('avatar')->nullable(); // Hình đại diện (có thể để trống)
            $table->enum('role', ['admin', 'user'])->default('user'); // Vai trò
            $table->boolean('active')->default(1); // Trạng thái hoạt động
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
