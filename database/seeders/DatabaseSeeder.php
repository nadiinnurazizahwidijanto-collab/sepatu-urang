<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==============================
        // User Admin
        // ==============================
        User::updateOrCreate(
            ['email' => 'kodit@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('12345678'),
                'is_admin' => 1,
            ]
        );

        // ==============================
        // Categories
        // ==============================
        $categories = ['Men', 'Women', 'Kids'];
        foreach ($categories as $name) {
            Category::updateOrCreate(['name' => $name], ['name' => $name]);
        }

        // ==============================
        // Products
        // ==============================
        $products = [
            // Men
            ['category_id' => 1, 'name' => 'Sepatu Selop Tutup', 'price' => 68000, 'description' => "Sepatu tradisional Jawa ...", 'image_path' => 'men1.png'],
            ['category_id' => 1, 'name' => 'Sandal Kulit Ukir Jepara', 'price' => 60000, 'description' => "Sandal kulit asli ...", 'image_path' => 'men2.png'],
            ['category_id' => 1, 'name' => 'Selop Kanvas/Bludru Hitam', 'price' => 55000, 'description' => "Alas kaki tertutup ...", 'image_path' => 'men3.png'],
            ['category_id' => 1, 'name' => 'Sandal Kayu Bakiak Ukir', 'price' => 50000, 'description' => "Versi ini memiliki kayu ...", 'image_path' => 'men4.png'],
            ['category_id' => 1, 'name' => 'Sepatu Selop Tutup 2', 'price' => 59000, 'description' => "Sepatu tradisional Jawa ...", 'image_path' => 'men5.png'],
            ['category_id' => 1, 'name' => 'Sandal Kayu motif batik', 'price' => 59000, 'description' => "Versi kayu dihaluskan ...", 'image_path' => 'men6.png'],
            ['category_id' => 1, 'name' => 'Sepatu Selop Tutup 3', 'price' => 59000, 'description' => "Sepatu tradisional Jawa ...", 'image_path' => 'men7.png'],
            ['category_id' => 1, 'name' => 'Sepatu Selop Tutup 4', 'price' => 59000, 'description' => "Sepatu tradisional Jawa ...", 'image_path' => 'men8.png'],
            ['category_id' => 1, 'name' => 'Sandal Kayu motif batik 2', 'price' => 59000, 'description' => "Versi kayu dihaluskan ...", 'image_path' => 'men9.png'],

            // Women
            ['category_id' => 2, 'name' => 'Kelom Geulis (Tasikmalaya)', 'price' => 68000, 'description' => "Sandal kayu cantik ...", 'image_path' => 'women1.png'],
            ['category_id' => 2, 'name' => 'Selop Bordir Payet', 'price' => 60000, 'description' => "Sandal tertutup bordir ...", 'image_path' => 'women2.png'],
            ['category_id' => 2, 'name' => 'Sandal Tarumpah (Klasik Sunda)', 'price' => 55000, 'description' => "Sandal tradisional ...", 'image_path' => 'women3.png'],

            // Kids
            ['category_id' => 3, 'name' => 'Kelom Anak Mini', 'price' => 68000, 'description' => "Versi kecil Kelom Geulis ...", 'image_path' => 'kids1.png'],
            ['category_id' => 3, 'name' => 'Selop Anak Batik', 'price' => 55000, 'description' => "Selop kecil motif batik ...", 'image_path' => 'kids2.png'],
            ['category_id' => 3, 'name' => 'Sandal Kulit Jari', 'price' => 50000, 'description' => "Sandal kulit pelindung jari ...", 'image_path' => 'kids3.png'],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(
                ['name' => $p['name'], 'category_id' => $p['category_id']],
                $p
            );
        }

        // ==============================
        // Promo
        // ==============================
        $promos = [
            ['name' => 'promonatal', 'promo' => 10000],
            ['name' => 'promonyepi', 'promo' => 30000],
        ];

        foreach ($promos as $promo) {
            Promo::updateOrCreate(['name' => $promo['name']], $promo);
        }
    }
}
