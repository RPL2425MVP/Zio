<?php

namespace Database\Seeders;

use App\Models\AccountAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        AccountAdmin::create([
            'nama' => 'Admin Utama',
            'email' => 'admin@tokoku.com',
            'password' => Hash::make('rahasia123'),
        ]);
    }
}
