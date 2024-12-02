<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Tambahkan ini
use App\Models\Customer; // Tambahkan ini
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'), // Hash password
            'role' => 'admin',
        ]);

        // Buat data user untuk customer
        $user = User::create([
            'name' => 'John Doe', // Nama pelanggan
            'email' => 'customer@gmail.com', // Email pelanggan
            'password' => Hash::make('password123'), // Hash password pelanggan
            'role' => 'customer', // Role pelanggan
        ]);

        // Buat data customer yang terhubung dengan user di atas
        Customer::create([
            'user_id' => $user->id, // Relasi ke tabel users
            'address' => '123 Customer Street, City', // Alamat pelanggan
            'phone' => '081234567890', // Nomor HP pelanggan
        ]);
    }
}
