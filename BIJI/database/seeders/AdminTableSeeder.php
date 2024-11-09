<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::table('users')->insert([
            'email' => 'admin@admin.com',
            'username' => 'admin220',
            'password' => bcrypt('admin123'),
            'verified' => true,
            'role_id' => '1'
        ]);
    }
}
