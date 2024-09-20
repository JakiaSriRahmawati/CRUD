<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'jek',
            'email' => 'jek@gmail.com',
            'phone' => '0868578798',
            'password' => bcrypt('1'),
            'tgl_lahir' => '12-09-2024',
            'role' => 'pengguna'
        ]);
        User::create([
            'name' => 'jeki',
            'email' => 'jeki@gmail.com',
            'phone' => '086886877798',
            'password' => bcrypt('2'),
            'tgl_lahir' => '12-12-2024',
            'role' => 'admin'
        ]);
    }
}
