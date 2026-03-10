<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class SmartWatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category ID 4 is Smartwatch based on CategorySeeder

        $products = [
            [
                'category_id' => 4,
                'name' => 'Apple Watch Ultra 2 Titanium',
                'slug' => 'apple-watch-ultra-2-titanium',
                'brand' => 'Apple',
                'price' => 21990000,
                'sale_price' => 20990000,
                'image' => 'apple-watch-ultra-2.jpg',
                'description' => 'Apple Watch Ultra 2 viền Titanium, dây đeo Alpine Loop, chip S9 SiP mạnh mẽ nhất, màn hình sáng nhất từ Apple.',
                'movement_type' => 'Pin',
                'stock' => 15,
            ],
            [
                'category_id' => 4,
                'name' => 'Apple Watch Series 9 Thép',
                'slug' => 'apple-watch-series-9-thep',
                'brand' => 'Apple',
                'price' => 18990000,
                'sale_price' => null,
                'image' => 'apple-watch-s9-steel.jpg',
                'description' => 'Apple Watch Series 9 viền thép không gỉ, dây thể thao, màn hình Always-On Retina sáng hơn, tính năng Chạm Hai Lần.',
                'movement_type' => 'Pin',
                'stock' => 10,
            ],
            [
                'category_id' => 4,
                'name' => 'Apple Watch SE 2023 Nhôm',
                'slug' => 'apple-watch-se-2023-nhom',
                'brand' => 'Apple',
                'price' => 6490000,
                'sale_price' => 5990000,
                'image' => 'apple-watch-se-2023.jpg',
                'description' => 'Apple Watch SE 2023 thiết kế năng động, chip S8 SiP, đầy đủ tính năng sức khỏe và an toàn cần thiết.',
                'movement_type' => 'Pin',
                'stock' => 50,
            ],
            [
                'category_id' => 4,
                'name' => 'Samsung Galaxy Watch 6 Classic',
                'slug' => 'samsung-galaxy-watch-6-classic',
                'brand' => 'Samsung',
                'price' => 8990000,
                'sale_price' => 7490000,
                'image' => 'galaxy-watch-6-classic.jpg',
                'description' => 'Samsung Galaxy Watch 6 Classic với vòng bezel vật lý xoay biểu tượng, theo dõi sức khỏe toàn diện.',
                'movement_type' => 'Pin',
                'stock' => 25,
            ],
            [
                'category_id' => 4,
                'name' => 'Samsung Galaxy Watch 6',
                'slug' => 'samsung-galaxy-watch-6',
                'brand' => 'Samsung',
                'price' => 6990000,
                'sale_price' => 5490000,
                'image' => 'galaxy-watch-6.jpg',
                'description' => 'Samsung Galaxy Watch 6 thiết kế viền mỏng hơn, màn hình lớn hơn, theo dõi giấc ngủ chuyên sâu.',
                'movement_type' => 'Pin',
                'stock' => 30,
            ],
            [
                'category_id' => 4,
                'name' => 'Garmin Venu 3',
                'slug' => 'garmin-venu-3',
                'brand' => 'Garmin',
                'price' => 12290000,
                'sale_price' => null,
                'image' => 'garmin-venu-3.jpg',
                'description' => 'Garmin Venu 3 huấn luyện viên giấc ngủ, phát hiện giấc ngủ ngắn, chế độ xe lăn, pin lên đến 14 ngày.',
                'movement_type' => 'Pin',
                'stock' => 20,
            ],
            [
                'category_id' => 4,
                'name' => 'Huawei Watch GT 4',
                'slug' => 'huawei-watch-gt-4',
                'brand' => 'Huawei',
                'price' => 5990000,
                'sale_price' => 4990000,
                'image' => 'huawei-watch-gt-4.jpg',
                'description' => 'Huawei Watch GT 4 thiết kế hình học thẩm mỹ, quản lý calo thông minh, pin lên đến 2 tuần.',
                'movement_type' => 'Pin',
                'stock' => 40,
            ],
            [
                'category_id' => 4,
                'name' => 'Xiaomi Watch 2 Pro',
                'slug' => 'xiaomi-watch-2-pro',
                'brand' => 'Xiaomi',
                'price' => 6290000,
                'sale_price' => 5790000,
                'image' => 'xiaomi-watch-2-pro.jpg',
                'description' => 'Xiaomi Watch 2 Pro chạy Wear OS by Google, vi xử lý Snapdragon W5+ Gen 1, khung viền thép không gỉ.',
                'movement_type' => 'Pin',
                'stock' => 20,
            ]
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']], // Check duplicate slug
                $product
            );
        }
    }
}
