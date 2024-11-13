<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Thể Thao']);
        Category::create(['name' => 'Kinh Tế']);
        Category::create(['name' => 'Pháp Luật']);
        Category::create(['name' => 'Tiểu Thuyết']);
    }
}
