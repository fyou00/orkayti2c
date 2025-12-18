<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Generates random orders and transactions with Japanese names
     */
    public function run(): void
    {
        $faker = Faker::create('ja_JP'); // Japanese locale
        
        $menus = Menu::where('status', 'tersedia')->get();
        $tables = Table::where('status', 'tersedia')->get();
        $metodePembayaran = ['Tunai', 'Transfer', 'QRIS', 'Kartu Debit/Kredit'];
        
        // Character names from Genshin Impact & Mobile Legends
        $characterNames = [
            // Genshin Impact
            'Zhongli', 'Raiden Shogun', 'Venti', 'Nahida', 'Furina',
            'Neuvillette', 'Hu Tao', 'Ganyu', 'Kamisato Ayaka', 'Kaedehara Kazuha',
            'Xiao', 'Yelan', 'Alhaitham', 'Nilou', 'Tighnari',
            'Cyno', 'Kokomi', 'Yoimiya', 'Eula', 'Tartaglia',
            
            // Mobile Legends
            'Fanny', 'Granger', 'Gusion', 'Ling', 'Lancelot',
            'Chou', 'Kagura', 'Guinevere', 'Claude', 'Wanwan',
            'Yin', 'Valentina', 'Beatrix', 'Paquito', 'Brody',
            'Hayabusa', 'Grock', 'Khufra', 'Atlas', 'Layla',
            'Melissa', 'Xavier', 'Novaria', 'Julian', 'Joy',
            'Arlott', 'Nolan'
        ];

        // Generate 15 orders dengan berbagai status
        for ($i = 1; $i <= 15; $i++) {
            // Random status dengan distribusi:
            // 20% menunggu, 30% diproses, 50% selesai
            $rand = rand(1, 10);
            if ($rand <= 2) {
                $status = 'menunggu';
                $createdAt = now()->subMinutes(rand(5, 30));
            } elseif ($rand <= 13) {
                $status = 'diproses';
                $createdAt = now()->subMinutes(rand(20, 60));
            } else {
                $status = 'selesai';
                $createdAt = now()->subHours(rand(1, 72)); // 1-3 hari lalu
            }

            // 30% chance untuk take away, 70% meja
            $tableId = (rand(1, 10) <= 7 && $tables->isNotEmpty()) 
                ? $tables->random()->id 
                : null;

            // Create order
            $order = Order::create([
                'nama_pelanggan' => $faker->randomElement($characterNames),
                'table_id' => $tableId,
                'status' => $status,
                'total' => 0, // Will be calculated
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Add 2-5 random items
            $itemCount = rand(2, 5);
            $total = 0;

            for ($j = 0; $j < $itemCount; $j++) {
                $menu = $menus->random();
                $qty = rand(1, 3);
                $harga = $menu->harga;
                $subtotal = $qty * $harga;
                $total += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'qty' => $qty,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            // Update total
            $order->update(['total' => $total]);

            // Jika status selesai, buat transaksi
            if ($status === 'selesai') {
                Transaction::create([
                    'order_id' => $order->id,
                    'metode_pembayaran' => $faker->randomElement($metodePembayaran),
                    'status_pembayaran' => 'Lunas',
                    'total' => $total,
                    'created_at' => $createdAt->addMinutes(rand(5, 15)),
                    'updated_at' => $createdAt->addMinutes(rand(5, 15)),
                ]);
            }
        }
    }
}
