<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductImagesSeeder extends Seeder
{
    /**
     * Điền ảnh phụ (images JSON) cho tất cả sản phẩm từ Unsplash public images
     */
    public function run(): void
    {
        $productImages = [
            // ===== ĐỒNG HỒ NAM CAO CẤP =====
            'dong-ho-rolex-submariner-date' => [
                'https://images.unsplash.com/photo-1547996160-81dfa63595aa?w=400&q=80',
                'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&q=80',
                'https://images.unsplash.com/photo-1587836374828-4dbafa94cf0e?w=400&q=80',
                'https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?w=400&q=80',
            ],
            'dong-ho-omega-seamaster' => [
                'https://images.unsplash.com/photo-1612817288484-6f916006741a?w=400&q=80',
                'https://images.unsplash.com/photo-1548171915-e79a380a2a4b?w=400&q=80',
                'https://images.unsplash.com/photo-1533139502658-0198f920d8e8?w=400&q=80',
                'https://images.unsplash.com/photo-1495856458515-0637185db551?w=400&q=80',
            ],
            'dong-ho-casio-g-shock-ga-2100' => [
                'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=400&q=80',
                'https://images.unsplash.com/photo-1585123334904-845d60e97b29?w=400&q=80',
                'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=400&q=80',
                'https://images.unsplash.com/photo-1544376664-80b17f09d399?w=400&q=80',
            ],
            'dong-ho-tag-heuer-carrera' => [
                'https://images.unsplash.com/photo-1619946794135-5bc917a27793?w=400&q=80',
                'https://images.unsplash.com/photo-1434056886845-dac89ffe9b56?w=400&q=80',
                'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=400&q=80',
                'https://images.unsplash.com/photo-1526045612212-70caf35c14df?w=400&q=80',
            ],

            // ===== ĐỒNG HỒ NỮ =====
            'dong-ho-cartier-ballon-bleu' => [
                'https://images.unsplash.com/photo-1590736704728-f4730bb30770?w=400&q=80',
                'https://images.unsplash.com/photo-1614350292382-c448d0110dfa?w=400&q=80',
                'https://images.unsplash.com/photo-1612817159949-195a4080c26c?w=400&q=80',
                'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=400&q=80',
            ],
            'dong-ho-tissot-le-locle-automatic' => [
                'https://images.unsplash.com/photo-1606744888344-493238951221?w=400&q=80',
                'https://images.unsplash.com/photo-1601593346740-925612772716?w=400&q=80',
                'https://images.unsplash.com/photo-1617704548623-340376564e68?w=400&q=80',
                'https://images.unsplash.com/photo-1622434641406-a158123450f9?w=400&q=80',
            ],

            // ===== ĐỒNG HỒ CƠ =====
            'dong-ho-seiko-presage-cocktail-time' => [
                'https://images.unsplash.com/photo-1539874754764-5a96559165b0?w=400&q=80',
                'https://images.unsplash.com/photo-1542496658-e33a6d0d50f6?w=400&q=80',
                'https://images.unsplash.com/photo-1524592094714-0f0654e20314?w=400&q=80',
                'https://images.unsplash.com/photo-1531591258577-c33e0c7de0da?w=400&q=80',
            ],
            'dong-ho-orient-bambino' => [
                'https://images.unsplash.com/photo-1547996160-81dfa63595aa?w=400&q=80',
                'https://images.unsplash.com/photo-1585123334904-845d60e97b29?w=400&q=80',
                'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=400&q=80',
                'https://images.unsplash.com/photo-1434056886845-dac89ffe9b56?w=400&q=80',
            ],

            // ===== SMARTWATCH =====
            'apple-watch-series-9' => [
                'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&q=80',
                'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=400&q=80',
                'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=400&q=80',
                'https://images.unsplash.com/photo-1544376664-80b17f09d399?w=400&q=80',
            ],
            'apple-watch-ultra-2-titanium' => [
                'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&q=80',
                'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=400&q=80',
                'https://images.unsplash.com/photo-1585123334904-845d60e97b29?w=400&q=80',
                'https://images.unsplash.com/photo-1565689157206-0fddef7589a2?w=400&q=80',
            ],
            'apple-watch-series-9-thep' => [
                'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&q=80',
                'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=400&q=80',
                'https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?w=400&q=80',
                'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=400&q=80',
            ],
            'apple-watch-se-2023-nhom' => [
                'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&q=80',
                'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=400&q=80',
                'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=400&q=80',
                'https://images.unsplash.com/photo-1585123334904-845d60e97b29?w=400&q=80',
            ],
            'samsung-galaxy-watch-6-classic' => [
                'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&q=80',
                'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=400&q=80',
                'https://images.unsplash.com/photo-1565689157206-0fddef7589a2?w=400&q=80',
                'https://images.unsplash.com/photo-1544376664-80b17f09d399?w=400&q=80',
            ],
            'samsung-galaxy-watch-6' => [
                'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&q=80',
                'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=400&q=80',
                'https://images.unsplash.com/photo-1565689157206-0fddef7589a2?w=400&q=80',
                'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=400&q=80',
            ],
            'garmin-venu-3' => [
                'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&q=80',
                'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=400&q=80',
                'https://images.unsplash.com/photo-1544376664-80b17f09d399?w=400&q=80',
                'https://images.unsplash.com/photo-1585123334904-845d60e97b29?w=400&q=80',
            ],
            'dong-ho-garmin-fenix-7' => [
                'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&q=80',
                'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=400&q=80',
                'https://images.unsplash.com/photo-1544376664-80b17f09d399?w=400&q=80',
                'https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?w=400&q=80',
            ],
            'huawei-watch-gt-4' => [
                'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&q=80',
                'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=400&q=80',
                'https://images.unsplash.com/photo-1565689157206-0fddef7589a2?w=400&q=80',
                'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=400&q=80',
            ],
            'xiaomi-watch-2-pro' => [
                'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&q=80',
                'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=400&q=80',
                'https://images.unsplash.com/photo-1585123334904-845d60e97b29?w=400&q=80',
                'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=400&q=80',
            ],
        ];

        // Ảnh mặc định cho sản phẩm chưa có ảnh phụ
        $defaultImages = [
            'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&q=80',
            'https://images.unsplash.com/photo-1612817288484-6f916006741a?w=400&q=80',
            'https://images.unsplash.com/photo-1547996160-81dfa63595aa?w=400&q=80',
            'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&q=80',
        ];

        $products = Product::all();
        foreach ($products as $product) {
            $images = $productImages[$product->slug] ?? $defaultImages;
            $product->update(['images' => $images]);
        }

        $this->command->info('✅ Đã cập nhật ảnh phụ cho ' . $products->count() . ' sản phẩm!');
    }
}
