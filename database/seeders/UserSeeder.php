<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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

        // Akun Demo Admin
        User::create([
            'name' => 'Admin Kopi Paste',
            'email' => 'admin@kopipaste.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        echo "✅ Admin created: admin@kopipaste.com | password\n";

        // Akun Demo Kasir
        User::create([
            'name' => 'Kasir Kopi Paste',
            'email' => 'kasir@kopipaste.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'email_verified_at' => now(),
        ]);

        echo "✅ Cashier created: kasir@kopipaste.com | password\n";
    }
}
