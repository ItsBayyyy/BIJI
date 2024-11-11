<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'BayuArdana',
            'email' => 'bayuardana213@gmail.com',
            'password' => bcrypt('password123'),
            'verified' => true,
            'role_id' => 0
        ]);
    }
}
