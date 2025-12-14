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
        User::where('email', 'admin@kopipaste.com')->delete();
        User::where('email', 'kasir@kopipaste.com')->delete();

        User::create([
            'name' => 'Admin Kopi Paste',
            'email' => 'admin@kopipaste.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Kasir Kopi Paste',
            'email' => 'kasir@kopipaste.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'email_verified_at' => now(),
        ]);
    }
}
