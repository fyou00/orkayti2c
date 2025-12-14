<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Support\Facades\Hash;

class MenuSeeder extends Seeder
{
    public function run(): void
    {        
        $menus = [
            // ========== KOPI PANAS ==========
            [
                'nama' => 'Espresso',
                'kategori' => 'Kopi',
                'harga' => 12000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Americano',
                'kategori' => 'Kopi',
                'harga' => 15000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Cappuccino',
                'kategori' => 'Kopi',
                'harga' => 18000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Cafe Latte',
                'kategori' => 'Kopi',
                'harga' => 18000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Flat White',
                'kategori' => 'Kopi',
                'harga' => 20000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Mocha',
                'kategori' => 'Kopi',
                'harga' => 22000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Caramel Macchiato',
                'kategori' => 'Kopi',
                'harga' => 23000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Kopi Susu Gula Aren',
                'kategori' => 'Kopi',
                'harga' => 16000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Kopi Tubruk',
                'kategori' => 'Kopi',
                'harga' => 10000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Kopi Susu',
                'kategori' => 'Kopi',
                'harga' => 15000,
                'status' => 'tersedia',
                'foto' => null,
            ],

            // ========== KOPI DINGIN ==========
            [
                'nama' => 'Iced Americano',
                'kategori' => 'Kopi',
                'harga' => 16000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Iced Latte',
                'kategori' => 'Kopi',
                'harga' => 20000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Iced Cappuccino',
                'kategori' => 'Kopi',
                'harga' => 20000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Iced Mocha',
                'kategori' => 'Kopi',
                'harga' => 24000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Iced Caramel Macchiato',
                'kategori' => 'Kopi',
                'harga' => 25000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Es Kopi Susu',
                'kategori' => 'Kopi',
                'harga' => 17000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Es Kopi Susu Gula Aren',
                'kategori' => 'Kopi',
                'harga' => 18000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Cold Brew',
                'kategori' => 'Kopi',
                'harga' => 22000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Affogato',
                'kategori' => 'Kopi',
                'harga' => 25000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Vietnamese Coffee',
                'kategori' => 'Kopi',
                'harga' => 19000,
                'status' => 'tersedia',
                'foto' => null,
            ],

            // ========== NON-KOPI ==========
            [
                'nama' => 'Matcha Latte',
                'kategori' => 'Non-Kopi',
                'harga' => 22000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Chocolate',
                'kategori' => 'Non-Kopi',
                'harga' => 18000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Teh Tarik',
                'kategori' => 'Non-Kopi',
                'harga' => 12000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Thai Tea',
                'kategori' => 'Non-Kopi',
                'harga' => 15000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Lemon Tea',
                'kategori' => 'Non-Kopi',
                'harga' => 13000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Green Tea Latte',
                'kategori' => 'Non-Kopi',
                'harga' => 20000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Red Velvet',
                'kategori' => 'Non-Kopi',
                'harga' => 23000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Vanilla Milkshake',
                'kategori' => 'Non-Kopi',
                'harga' => 24000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Strawberry Smoothie',
                'kategori' => 'Non-Kopi',
                'harga' => 25000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Mango Smoothie',
                'kategori' => 'Non-Kopi',
                'harga' => 25000,
                'status' => 'tersedia',
                'foto' => null,
            ],

            // ========== MAKANAN ==========
            [
                'nama' => 'Nasi Goreng Spesial',
                'kategori' => 'Makanan',
                'harga' => 28000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Mie Goreng',
                'kategori' => 'Makanan',
                'harga' => 25000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Nasi Goreng Ayam',
                'kategori' => 'Makanan',
                'harga' => 30000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Nasi Goreng Seafood',
                'kategori' => 'Makanan',
                'harga' => 35000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Spaghetti Carbonara',
                'kategori' => 'Makanan',
                'harga' => 32000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Spaghetti Bolognese',
                'kategori' => 'Makanan',
                'harga' => 32000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Chicken Katsu',
                'kategori' => 'Makanan',
                'harga' => 35000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'French Fries',
                'kategori' => 'Makanan',
                'harga' => 18000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Chicken Wings',
                'kategori' => 'Makanan',
                'harga' => 28000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Club Sandwich',
                'kategori' => 'Makanan',
                'harga' => 30000,
                'status' => 'tersedia',
                'foto' => null,
            ],

            // ========== SNACK ==========
            [
                'nama' => 'Croissant',
                'kategori' => 'Snack',
                'harga' => 15000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Chocolate Croissant',
                'kategori' => 'Snack',
                'harga' => 18000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Donut',
                'kategori' => 'Snack',
                'harga' => 12000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Brownies',
                'kategori' => 'Snack',
                'harga' => 15000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Cheese Cake',
                'kategori' => 'Snack',
                'harga' => 22000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Tiramisu',
                'kategori' => 'Snack',
                'harga' => 25000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Banana Bread',
                'kategori' => 'Snack',
                'harga' => 15000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Cookies',
                'kategori' => 'Snack',
                'harga' => 10000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Waffle',
                'kategori' => 'Snack',
                'harga' => 20000,
                'status' => 'tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Pancake',
                'kategori' => 'Snack',
                'harga' => 20000,
                'status' => 'tersedia',
                'foto' => null,
            ],

            // ========== SPECIAL MENU (Beberapa Tidak Tersedia) ==========
            [
                'nama' => 'Kopi Luwak',
                'kategori' => 'Kopi',
                'harga' => 50000,
                'status' => 'tidak tersedia',
                'foto' => null,
            ],
            [
                'nama' => 'Signature Blend',
                'kategori' => 'Kopi',
                'harga' => 28000,
                'status' => 'tidak tersedia',
                'foto' => null,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}