<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LoginUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'first_name' => 'sam',
            'last_name' => 'dev',
            'phone' => '1234567890',
            'date_of_birth' => '1990-01-01',
            'address' => 'purnea bihar',
            'city' => 'purnea',
            'country' => 'India',
            'occupation' => 'Developer',
            'status' => 'Active',
            'role' => 'Admin',
            'email' => 'sam@gmail.com',
            'password' => Hash::make('123456789'), 
        ]);
    }
}
