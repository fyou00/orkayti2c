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
                'foto' => '../images/espresso.png',
            ],
            [
                'nama' => 'Americano',
                'kategori' => 'Kopi',
                'harga' => 15000,
                'status' => 'tersedia',
                'foto' => '../images/americano.png',
            ],
            [
                'nama' => 'Cappuccino',
                'kategori' => 'Kopi',
                'harga' => 18000,
                'status' => 'tersedia',
                'foto' => '../images/cappuccino.png',
            ],
            [
                'nama' => 'Cafe Latte',
                'kategori' => 'Kopi',
                'harga' => 18000,
                'status' => 'tersedia',
                'foto' => '../images/cafe-latte.png',
            ],
            [
                'nama' => 'Flat White',
                'kategori' => 'Kopi',
                'harga' => 20000,
                'status' => 'tersedia',
                'foto' => '../images/flat-white.png',
            ],
            [
                'nama' => 'Mocha',
                'kategori' => 'Kopi',
                'harga' => 22000,
                'status' => 'tersedia',
                'foto' => '../images/mocha.png',
            ],
            [
                'nama' => 'Caramel Macchiato',
                'kategori' => 'Kopi',
                'harga' => 23000,
                'status' => 'tersedia',
                'foto' => '../images/caramel-macchiato.png',
            ],
            [
                'nama' => 'Kopi Susu Gula Aren',
                'kategori' => 'Kopi',
                'harga' => 16000,
                'status' => 'tersedia',
                'foto' => '../images/kopi-susu-gula-aren.png',
            ],
            [
                'nama' => 'Kopi Tubruk',
                'kategori' => 'Kopi',
                'harga' => 10000,
                'status' => 'tersedia',
                'foto' => '../images/kopi-tubruk.png',
            ],
            [
                'nama' => 'Kopi Susu',
                'kategori' => 'Kopi',
                'harga' => 15000,
                'status' => 'tersedia',
                'foto' => '../images/kopi-susu.png',
            ],

            // ========== KOPI DINGIN ==========
            [
                'nama' => 'Iced Americano',
                'kategori' => 'Kopi',
                'harga' => 16000,
                'status' => 'tersedia',
                'foto' => '../images/americano.png',
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
                'nama' => 'Nasi Goreng',
                'kategori' => 'Makanan',
                'harga' => 28000,
                'status' => 'tersedia',
                'foto' => '../images/nasi-goreng.png',
            ],
            [
                'nama' => 'Mie Goreng',
                'kategori' => 'Makanan',
                'harga' => 25000,
                'status' => 'tersedia',
                'foto' => '../images/mie-goreng.png',
            ],
            [
                'nama' => 'Nasi Goreng Ayam',
                'kategori' => 'Makanan',
                'harga' => 30000,
                'status' => 'tersedia',
                'foto' => '../images/nasi-goreng-ayam.png',
            ],
            [
                'nama' => 'Nasi Goreng Seafood',
                'kategori' => 'Makanan',
                'harga' => 35000,
                'status' => 'tersedia',
                'foto' => '../images/nasi-goreng-seafood.png',
            ],
            [
                'nama' => 'Spaghetti Carbonara',
                'kategori' => 'Makanan',
                'harga' => 32000,
                'status' => 'tersedia',
                'foto' => '../images/spaghetti-carbonara.png',
            ],
            [
                'nama' => 'Spaghetti Bolognese',
                'kategori' => 'Makanan',
                'harga' => 32000,
                'status' => 'tersedia',
                'foto' => '../images/spaghetti-bolognese.png',
            ],
            [
                'nama' => 'Chicken Katsu',
                'kategori' => 'Makanan',
                'harga' => 35000,
                'status' => 'tersedia',
                'foto' => '../images/chicken-katsu.png',
            ],
            [
                'nama' => 'French Fries',
                'kategori' => 'Makanan',
                'harga' => 18000,
                'status' => 'tersedia',
                'foto' => '../images/french-fries.png',
            ],

            // ========== SNACK ==========
            [
                'nama' => 'Croissant',
                'kategori' => 'Snack',
                'harga' => 15000,
                'status' => 'tersedia',
                'foto' => '../images/croissant.png',
            ],
            [
                'nama' => 'Matcha Croissant',
                'kategori' => 'Snack',
                'harga' => 18000,
                'status' => 'tersedia',
                'foto' => '../images/matcha-croissant.png',
            ],
            [
                'nama' => 'Donut',
                'kategori' => 'Snack',
                'harga' => 12000,
                'status' => 'tersedia',
                'foto' => '../images/donut.png',
            ],
            [
                'nama' => 'Cheesecake',
                'kategori' => 'Snack',
                'harga' => 22000,
                'status' => 'tersedia',
                'foto' => '../images/cheesecake.png',
            ],
            [
                'nama' => 'Cookies',
                'kategori' => 'Snack',
                'harga' => 10000,
                'status' => 'tersedia',
                'foto' => '../images/cookies.png',
            ],
            [
                'nama' => 'Waffle',
                'kategori' => 'Snack',
                'harga' => 20000,
                'status' => 'tersedia',
                'foto' => '../images/waffle.png',
            ],
            [
                'nama' => 'Pancake',
                'kategori' => 'Snack',
                'harga' => 20000,
                'status' => 'tersedia',
                'foto' => '../images/pancake.png',
            ],

            // ========== SPECIAL MENU (Beberapa Tidak Tersedia) ==========
            [
                'nama' => 'Kopi Luwak',
                'kategori' => 'Kopi',
                'harga' => 50000,
                'status' => 'tidak tersedia',
                'foto' => '../images/kopi-luwak.png',
            ],
            [
                'nama' => 'Signature Blend',
                'kategori' => 'Kopi',
                'harga' => 28000,
                'status' => 'tidak tersedia',
                'foto' => '../images/signature-blend.png',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}