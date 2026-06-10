<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'eslam gaballah',
            'email' => 'eslam@gmail.com',
            'password' => Hash::make('123456789')
        ]);
        User::create([
            'name' => ' admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789')
        ]);

        User::create([
            'name' => ' User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456789')
        ]);
    }
}
