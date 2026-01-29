<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Đồng hồ Nam', 'slug' => 'dong-ho-nam'],
            ['name' => 'Đồng hồ Nữ', 'slug' => 'dong-ho-nu'],
            ['name' => 'Đồng hồ Cơ', 'slug' => 'dong-ho-co'],
            ['name' => 'Smartwatch', 'slug' => 'smartwatch'],
            ['name' => 'Đồng hồ Thể thao', 'slug' => 'dong-ho-the-thao'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
