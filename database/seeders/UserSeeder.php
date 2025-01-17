<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Raaz Katwal',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
            'date_of_birth' => fake()->date(),
        ]);
    }
}
