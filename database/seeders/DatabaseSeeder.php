<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Panggil ProdukSeeder
        $this->call(ProdukSeeder::class);
    }
}