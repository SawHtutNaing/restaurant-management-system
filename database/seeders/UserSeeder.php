<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('11111111'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('11111111'),
            'role' => 'customer',
        ]);

        User::factory()->create([
            'name' => 'waiter',
            'email' => 'waiter@gmail.com',
            'password' => bcrypt('11111111'),
            'role' => 'waiter',
        ]);




    }
}
