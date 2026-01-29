<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Đồng hồ Rolex Submariner Date',
                'slug' => 'dong-ho-rolex-submariner-date',
                'brand' => 'Rolex',
                'price' => 285000000,
                'sale_price' => null,
                'image' => 'rolex-submariner.jpg',
                'description' => 'Đồng hồ Rolex Submariner Date cao cấp, thiết kế sang trọng, chống nước 300m.',
                'movement_type' => 'Cơ tự động',
                'stock' => 5,
            ],
            [
                'category_id' => 1,
                'name' => 'Đồng hồ Omega Seamaster',
                'slug' => 'dong-ho-omega-seamaster',
                'brand' => 'Omega',
                'price' => 125000000,
                'sale_price' => 115000000,
                'image' => 'omega-seamaster.jpg',
                'description' => 'Đồng hồ Omega Seamaster lặn biển chuyên nghiệp, độ chính xác cao.',
                'movement_type' => 'Cơ tự động',
                'stock' => 8,
            ],
            [
                'category_id' => 2,
                'name' => 'Đồng hồ Cartier Ballon Bleu',
                'slug' => 'dong-ho-cartier-ballon-bleu',
                'brand' => 'Cartier',
                'price' => 95000000,
                'sale_price' => null,
                'image' => 'cartier-ballon-bleu.jpg',
                'description' => 'Đồng hồ nữ Cartier Ballon Bleu sang trọng, thiết kế tinh tế.',
                'movement_type' => 'Quartz',
                'stock' => 10,
            ],
            [
                'category_id' => 1,
                'name' => 'Đồng hồ Casio G-Shock GA-2100',
                'slug' => 'dong-ho-casio-g-shock-ga-2100',
                'brand' => 'Casio',
                'price' => 3500000,
                'sale_price' => 3200000,
                'image' => 'casio-gshock.jpg',
                'description' => 'Đồng hồ thể thao Casio G-Shock chống sốc, chống nước, thiết kế mạnh mẽ.',
                'movement_type' => 'Pin',
                'stock' => 25,
            ],
            [
                'category_id' => 3,
                'name' => 'Đồng hồ Seiko Presage Cocktail Time',
                'slug' => 'dong-ho-seiko-presage-cocktail-time',
                'brand' => 'Seiko',
                'price' => 12500000,
                'sale_price' => null,
                'image' => 'seiko-presage.jpg',
                'description' => 'Đồng hồ cơ Seiko Presage với mặt số độc đáo lấy cảm hứng từ cocktail.',
                'movement_type' => 'Cơ tự động',
                'stock' => 15,
            ],
            [
                'category_id' => 4,
                'name' => 'Apple Watch Series 9',
                'slug' => 'apple-watch-series-9',
                'brand' => 'Apple',
                'price' => 11000000,
                'sale_price' => 10500000,
                'image' => 'apple-watch-9.jpg',
                'description' => 'Smartwatch Apple Watch Series 9 với nhiều tính năng sức khỏe và thể thao.',
                'movement_type' => 'Pin',
                'stock' => 30,
            ],
            [
                'category_id' => 5,
                'name' => 'Đồng hồ Garmin Fenix 7',
                'slug' => 'dong-ho-garmin-fenix-7',
                'brand' => 'Garmin',
                'price' => 18500000,
                'sale_price' => null,
                'image' => 'garmin-fenix-7.jpg',
                'description' => 'Đồng hồ thể thao Garmin Fenix 7 chuyên dụng cho leo núi và chạy bộ.',
                'movement_type' => 'Pin',
                'stock' => 12,
            ],
            [
                'category_id' => 2,
                'name' => 'Đồng hồ Tissot Le Locle Automatic',
                'slug' => 'dong-ho-tissot-le-locle-automatic',
                'brand' => 'Tissot',
                'price' => 15500000,
                'sale_price' => 14000000,
                'image' => 'tissot-le-locle.jpg',
                'description' => 'Đồng hồ nữ Tissot Le Locle Automatic thanh lịch, phong cách cổ điển.',
                'movement_type' => 'Cơ tự động',
                'stock' => 18,
            ],
            [
                'category_id' => 1,
                'name' => 'Đồng hồ TAG Heuer Carrera',
                'slug' => 'dong-ho-tag-heuer-carrera',
                'brand' => 'TAG Heuer',
                'price' => 85000000,
                'sale_price' => null,
                'image' => 'tag-heuer-carrera.jpg',
                'description' => 'Đồng hồ TAG Heuer Carrera phong cách thể thao sang trọng.',
                'movement_type' => 'Cơ tự động',
                'stock' => 7,
            ],
            [
                'category_id' => 3,
                'name' => 'Đồng hồ Orient Bambino',
                'slug' => 'dong-ho-orient-bambino',
                'brand' => 'Orient',
                'price' => 4500000,
                'sale_price' => 4200000,
                'image' => 'orient-bambino.jpg',
                'description' => 'Đồng hồ cơ Orient Bambino giá tốt, thiết kế cổ điển thanh lịch.',
                'movement_type' => 'Cơ tự động',
                'stock' => 20,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
