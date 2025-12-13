<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MenuSeeder::class,
            TableSeeder::class,
        ]);
    }
}


// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus user lama jika ada
        User::where('email', 'admin@kopipaste.com')->delete();
        User::where('email', 'kasir@kopipaste.com')->delete();

        // Create Admin
        User::create([
            'name' => 'Admin Kopi Paste',
            'email' => 'admin@kopipaste.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        echo "✅ Admin created: admin@kopipaste.com | password\n";

        // Create Cashier
        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@kopipaste.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'email_verified_at' => now(),
        ]);

        echo "✅ Cashier created: kasir@kopipaste.com | password\n";

        // Create additional cashiers (optional)
        User::create([
            'name' => 'Kasir 2',
            'email' => 'kasir2@kopipaste.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'email_verified_at' => now(),
        ]);

        echo "✅ Extra users created successfully!\n";
    }
}


// database/seeders/MenuSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing menus
        Menu::truncate();

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

        echo "✅ " . count($menus) . " menus created successfully!\n";
        echo "   - Kopi: 22 items\n";
        echo "   - Non-Kopi: 10 items\n";
        echo "   - Makanan: 10 items\n";
        echo "   - Snack: 10 items\n";
    }
}


// database/seeders/TableSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing tables
        Table::truncate();

        $tables = [
            // Meja kecil (2 orang)
            ['nomor' => 1, 'kapasitas' => 2, 'status' => 'tersedia'],
            ['nomor' => 2, 'kapasitas' => 2, 'status' => 'tersedia'],
            ['nomor' => 3, 'kapasitas' => 2, 'status' => 'tersedia'],
            ['nomor' => 4, 'kapasitas' => 2, 'status' => 'tersedia'],
            ['nomor' => 5, 'kapasitas' => 2, 'status' => 'terisi'],

            // Meja sedang (4 orang)
            ['nomor' => 6, 'kapasitas' => 4, 'status' => 'tersedia'],
            ['nomor' => 7, 'kapasitas' => 4, 'status' => 'tersedia'],
            ['nomor' => 8, 'kapasitas' => 4, 'status' => 'terisi'],
            ['nomor' => 9, 'kapasitas' => 4, 'status' => 'tersedia'],
            ['nomor' => 10, 'kapasitas' => 4, 'status' => 'tersedia'],

            // Meja besar (6 orang)
            ['nomor' => 11, 'kapasitas' => 6, 'status' => 'tersedia'],
            ['nomor' => 12, 'kapasitas' => 6, 'status' => 'tersedia'],
            ['nomor' => 13, 'kapasitas' => 6, 'status' => 'reserved'],

            // VIP area (8 orang)
            ['nomor' => 14, 'kapasitas' => 8, 'status' => 'tersedia'],
            ['nomor' => 15, 'kapasitas' => 8, 'status' => 'tersedia'],
        ];

        foreach ($tables as $table) {
            Table::create($table);
        }

        echo "✅ " . count($tables) . " tables created successfully!\n";
        echo "   - Kapasitas 2 orang: 5 meja\n";
        echo "   - Kapasitas 4 orang: 5 meja\n";
        echo "   - Kapasitas 6 orang: 3 meja\n";
        echo "   - Kapasitas 8 orang: 2 meja\n";
    }
}


// database/seeders/SampleOrderSeeder.php (BONUS - untuk testing)
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Menu;
use App\Models\Table;

class SampleOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * OPTIONAL: Untuk testing aja
     */
    public function run(): void
    {
        // Sample Order 1 - Menunggu
        $order1 = Order::create([
            'nama_pelanggan' => 'Budi Santoso',
            'table_id' => 1,
            'status' => 'menunggu',
            'total' => 51000,
            'waktu' => now()->subMinutes(10),
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'menu_id' => Menu::where('nama', 'Cappuccino')->first()->id,
            'qty' => 2,
            'harga' => 18000,
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'menu_id' => Menu::where('nama', 'Croissant')->first()->id,
            'qty' => 1,
            'harga' => 15000,
        ]);

        // Sample Order 2 - Diproses
        $order2 = Order::create([
            'nama_pelanggan' => 'Ani Wijaya',
            'table_id' => 8,
            'status' => 'diproses',
            'total' => 88000,
            'waktu' => now()->subMinutes(25),
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'menu_id' => Menu::where('nama', 'Nasi Goreng Spesial')->first()->id,
            'qty' => 2,
            'harga' => 28000,
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'menu_id' => Menu::where('nama', 'Es Kopi Susu')->first()->id,
            'qty' => 2,
            'harga' => 17000,
        ]);

        // Sample Order 3 - Selesai dengan Transaksi
        $order3 = Order::create([
            'nama_pelanggan' => 'Citra Dewi',
            'table_id' => null, // Take away
            'status' => 'selesai',
            'total' => 45000,
            'waktu' => now()->subHours(1),
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'menu_id' => Menu::where('nama', 'Iced Latte')->first()->id,
            'qty' => 2,
            'harga' => 20000,
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'menu_id' => Menu::where('nama', 'Brownies')->first()->id,
            'qty' => 1,
            'harga' => 15000,
        ]);

        Transaction::create([
            'order_id' => $order3->id,
            'metode_pembayaran' => 'Tunai',
            'status_pembayaran' => 'Lunas',
            'total' => 45000,
        ]);

        echo "✅ 3 sample orders created for testing!\n";
    }
}