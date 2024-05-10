<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat pengguna contoh 1
        User::create([
            'nama_akun' => 'admin',
            'nama_toko' => 'Toko 1',
            'email' => 'contoh1@email.com',
            'gender' => 'Perempuan',
            'umur' => '27',
            'tgl_lahir' => '2002-09-10',
            'alamat' => 'Alamat contoh 1',
            'rate' => 5,
            'produk_terbaik' => 'Produk Terbaik Contoh 1',
            'deskripsi' => 'Deskripsi Contoh 1',
            // 'password' => Hash::make('password123'), // Enkripsi password
        ]);

        // Buat pengguna contoh 2
        User::create([
            'nama_akun' => 'merchant1',
            'nama_toko' => 'Toko 2',
            'email' => 'contoh2@email.com',
            'gender' => 'Perempuan',
            'umur' => '41',
            'tgl_lahir' => '1980-04-14',
            'alamat' => 'Alamat contoh 2',
            'rate' => 4,
            'produk_terbaik' => 'Produk Terbaik Contoh 2',
            'deskripsi' => 'Deskripsi Contoh 2',
            // 'password' => Hash::make('password456'), // Enkripsi password
        ]);

        // Tambahkan pengguna lain jika diperlukan
    }
}
