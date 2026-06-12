<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $menus = Menu::where('status', 'tersedia')->get();
        $tables = Table::where('status', 'tersedia')->get();
        $metodePembayaran = ['Tunai', 'Transfer', 'QRIS', 'Kartu Debit/Kredit'];
        
        $mhsNames = [
            'Ahmad Aulia Fahlevi', 'Alvi Syahril', 'Faizul Abrar', 'Hafidz Maulana', 'Hayzar Muhaiyar', 
            'Faqriyadi Andika', 'Fathan Mubina', 'Hamizan Putra Zulia', 'Ilham Syahdienar', 'Imam Nawawi', 
            'M. Hafidz Firansyah', 'M. Iqbal Sayuti', 'Izzati Nurvira', 'Jelita Anggraini', 'Khairatil Aini', 
            'Khalisha Zafira', 'Lediana Berasa', 'Liza Aulia Siregar', 'Malia Ulfa', 'Fariz Hafiz', 'Amirullah'
        ];

        // Generate data untuk 1 bulan (01/01/2026 - 31/01/2026)
        $startDate = Carbon::create(2026, 1, 1, 0, 0, 0);
        $endDate = Carbon::create(2026, 1, 31, 23, 59, 59);
        
        $currentDate = $startDate->copy();
        $transactionCount = 0;

        while ($currentDate <= $endDate) {
            // Buat 5-20 transaksi per hari (realistic distribution)
            // Lebih banyak di akhir pekan
            $dayOfWeek = $currentDate->dayOfWeek; // 0 = Sunday, 6 = Saturday
            $isWeekend = $dayOfWeek == 0 || $dayOfWeek == 6;
            $isSpecialDay = in_array($currentDate->format('m-d'), ['01-01', '12-25', '06-01', '08-17']); // Special days
            
            // Tentukan jumlah transaksi
            if ($isSpecialDay) {
                $dailyTransactions = rand(25, 35);
            } elseif ($isWeekend) {
                $dailyTransactions = rand(18, 25);
            } else {
                $dailyTransactions = rand(10, 18);
            }

            for ($t = 0; $t < $dailyTransactions; $t++) {
                // Random waktu dalam sehari (6 AM - 10 PM)
                $hour = rand(6, 21);
                $minute = rand(0, 59);
                $second = rand(0, 59);
                
                $orderTime = $currentDate->copy()->setTime($hour, $minute, $second);
                
                // 95% orders selesai (dengan transaksi), 5% pending
                $isCompleted = rand(1, 100) <= 95;
                $status = $isCompleted ? 'selesai' : 'menunggu';

                // 35% chance untuk take away, 65% meja
                $tableId = (rand(1, 100) <= 65 && $tables->isNotEmpty()) 
                    ? $tables->random()->id 
                    : null;

                // Create order
                $order = Order::create([
                    'nama_pelanggan' => $mhsNames[array_rand($mhsNames)],
                    'table_id' => $tableId,
                    'status' => $status,
                    'total' => 0,
                    'created_at' => $orderTime,
                    'updated_at' => $orderTime,
                ]);

                // Add 1-5 items (realistis, kebanyakan 1-3)
                $itemCount = rand(1, 5);
                $weights = [1 => 40, 2 => 35, 3 => 15, 4 => 7, 5 => 3];
                foreach ($weights as $count => $weight) {
                    if (rand(1, 100) <= $weight) {
                        $itemCount = $count;
                        break;
                    }
                }
                
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
                        'created_at' => $orderTime,
                        'updated_at' => $orderTime,
                    ]);
                }

                // Update total
                $order->update(['total' => $total]);

                // Jika completed, buat transaksi dengan waktu 5-15 menit kemudian
                if ($isCompleted) {
                    $transactionTime = $orderTime->copy()->addMinutes(rand(5, 15));
                    
                    Transaction::create([
                        'order_id' => $order->id,
                        'metode_pembayaran' => $metodePembayaran[array_rand($metodePembayaran)],
                        'status_pembayaran' => 'Lunas',
                        'total' => $total,
                        'created_at' => $transactionTime,
                        'updated_at' => $transactionTime,
                    ]);
                    
                    $transactionCount++;
                }
            }

            $currentDate->addDay();
        }

        $this->command->info("Generated {$transactionCount} realistic transactions for 1 month!");
    }
}
