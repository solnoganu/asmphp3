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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tên sách
            $table->string('author'); // Tác giả
            $table->string('thumbnail')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Khóa ngoại đến bảng categories
            $table->text('description')->nullable(); // Mô tả
            $table->string('publication'); // Ngày xuất bản
            $table->integer('view_count')->default(0); // Lượt xem
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
