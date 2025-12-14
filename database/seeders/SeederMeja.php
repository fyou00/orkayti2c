<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Table;

class SeederMeja extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
