<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    // User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    // Akun Demo Admin
    User::create([
      'name' => 'Admin Kopi Paste',
      'email' => 'admin@kopipaste.com',
      'password' => Hash::make('password'),
      'role' => 'admin',
    ]);

    // Akun Demo Kasir
    User::create([
      'name' => 'Kasir Kopi Paste',
      'email' => 'kasir@kopipaste.com',
      'password' => Hash::make('password'),
      'role' => 'cashier',
    ]);
  }
}
