<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->admin()->create();

        // Create regular users
        User::factory(10)->create();

        // Create categories
        $categories = [
            [
                'name' => 'Hantaran Seserahan',
                'slug' => 'hantaran-seserahan',
                'description' => 'Koleksi hantaran seserahan pernikahan elegan dan berkualitas',
                'icon' => 'gift',
                'sort_order' => 1,
            ],
            [
                'name' => 'Kotak Hantaran',
                'slug' => 'kotak-hantaran',
                'description' => 'Berbagai ukuran dan desain kotak hantaran',
                'icon' => 'box',
                'sort_order' => 2,
            ],
            [
                'name' => 'Bunga Artificial',
                'slug' => 'bunga-artificial',
                'description' => 'Bunga artificial premium untuk dekorasi hantaran',
                'icon' => 'flower',
                'sort_order' => 3,
            ],
            [
                'name' => 'Aksesoris Pernikahan',
                'slug' => 'aksesoris-pernikahan',
                'description' => 'Aksesoris lengkap untuk kebutuhan pernikahan',
                'icon' => 'ring',
                'sort_order' => 4,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create products
        $products = [
            [
                'category_id' => 1,
                'name' => 'Luxury White',
                'slug' => 'luxury-white',
                'description' => 'Hantaran seserahan dengan tema putih elegan, dilengkapi dengan bunga artificial premium dan pita satin. Cocok untuk pernikahan dengan konsep modern dan minimalis.',
                'price' => 75000,
                'stock' => 15,
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Crystal Double',
                'slug' => 'crystal-double',
                'description' => 'Set hantaran ganda dengan hiasan kristal yang memukau. Desain mewah dengan sentuhan glamour untuk momen spesial Anda.',
                'price' => 100000,
                'stock' => 10,
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Ring Box',
                'slug' => 'ring-box',
                'description' => 'Kotak cincin pernikahan dengan desain eksklusif. Terbuat dari bahan berkualitas dengan lapisan beludru lembut di dalamnya.',
                'price' => 50000,
                'stock' => 25,
                'is_featured' => false,
            ],
            [
                'category_id' => 1,
                'name' => 'Gold Elegance',
                'slug' => 'gold-elegance',
                'description' => 'Hantaran dengan tema gold yang mewah dan elegan. Dilengkapi dengan hiasan rantai emas dan bunga premium.',
                'price' => 150000,
                'stock' => 8,
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Pink Romance',
                'slug' => 'pink-romance',
                'description' => 'Hantaran berwarna pink yang romantis dan manis. Sempurna untuk pernikahan dengan tema warna-warni ceria.',
                'price' => 85000,
                'stock' => 12,
                'is_featured' => false,
            ],
            [
                'category_id' => 3,
                'name' => 'Bunga Mawar Premium',
                'slug' => 'bunga-mawar-premium',
                'description' => 'Bunga mawar artificial premium dengan kualitas terbaik. Tampilan seperti bunga asli dan tahan lama.',
                'price' => 45000,
                'stock' => 30,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, [
                'main_image' => 'products/' . $product['slug'] . '.jpg',
                'min_order' => 1,
                'specifications' => json_encode([
                    'Material' => 'Kayu Jati/MDF',
                    'Ukuran' => '30x30 cm',
                    'Warna' => 'Sesuai tema',
                    'Berat' => '1-2 kg',
                ]),
                'is_active' => true,
                'view_count' => rand(10, 500),
            ]));
        }

        // Create testimonials
        $testimonials = [
            [
                'customer_name' => 'Sarah & Ahmad',
                'rating' => 5,
                'content' => 'Pelayanan sangat memuaskan, hasil hantaran sangat cantik dan rapi! Timnya sangat profesional dan responsif terhadap permintaan kami.',
                'wedding_date' => 'Maret 2024',
                'status' => 'approved',
                'is_featured' => true,
            ],
            [
                'customer_name' => 'Dewi & Budi',
                'rating' => 5,
                'content' => 'Sangat recommended untuk yang mencari hantaran pernikahan berkualitas. Harga sesuai dengan hasil yang diberikan.',
                'wedding_date' => 'Januari 2024',
                'status' => 'approved',
                'is_featured' => true,
            ],
            [
                'customer_name' => 'Rina & Doni',
                'rating' => 4,
                'content' => 'Pengiriman tepat waktu, packaging aman, dan hasilnya memukau! Terima kasih Amelia Hantaran.',
                'wedding_date' => 'Februari 2024',
                'status' => 'approved',
                'is_featured' => false,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        // Create settings
        \App\Models\Setting::set('company_name', 'Amelia Hantaran', 'string', 'general');
        \App\Models\Setting::set('company_tagline', 'Make Your Wedding Hantaran Truly Special', 'string', 'general');
        \App\Models\Setting::set('company_description', 'Elegant hantaran decoration, premium rental boxes, and complete seserahan packages for your unforgettable wedding moment.', 'string', 'general');
        \App\Models\Setting::set('company_address', 'Jl. Mawar No. 123, Jakarta Selatan', 'string', 'contact');
        \App\Models\Setting::set('company_phone', '0812-3456-7890', 'string', 'contact');
        \App\Models\Setting::set('company_email', 'hello@ameliahantaran.com', 'string', 'contact');
        \App\Models\Setting::set('whatsapp_number', '6281234567890', 'string', 'contact');
        \App\Models\Setting::set('google_maps', 'https://maps.google.com', 'string', 'contact');
        \App\Models\Setting::set('bank_name', 'Bank Central Asia', 'string', 'payment');
        \App\Models\Setting::set('bank_account', '1234567890', 'string', 'payment');
        \App\Models\Setting::set('bank_account_name', 'PT Amelia Hantaran', 'string', 'payment');
        \App\Models\Setting::set('shipping_cost', 15000, 'integer', 'payment');
    }
}
