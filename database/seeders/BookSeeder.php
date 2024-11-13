<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        for ($i = 1; $i <= 50; $i++) {
            Book::create([
                'title' => 'Sách ' . $i,
                'author' => 'Tác giả ' . $i,
                'thumbnail' => 'https://picsum.photos/200/300?random=' . $i,
                'category_id' => $categories->random()->id, // Lấy ngẫu nhiên category_id
                'description' => 'Mô tả sách ' . $i,
                'publication' => now()->subDays(rand(1, 365))->format('Y-m-d'), // Ngày xuất bản ngẫu nhiên trong năm qua
                'view_count' => rand(0, 100), // Lượt xem ngẫu nhiên
            ]);
        }
    }
}
