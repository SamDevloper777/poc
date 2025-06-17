<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;


class UserSeeder extends Seeder
{
    use HasRoles;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

$faker = Faker::create();
for ($i = 1; $i <= 100000; $i++) {
    DB::table('users')->insert([
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => "user{$i}@gmail.com",
        'phone' => $faker->numerify('##########'),
        'date_of_birth' => $faker->dateTimeBetween('1950-01-01', '2005-12-31')->format('Y-m-d'),
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'country' => $faker->country,
        'occupation' => $faker->jobTitle,
        'status' => $faker->randomElement(['Active', 'Inactive', 'Suspended']),
        'role' => 'User',
        'password' => bcrypt('password'),
    ]);
    }
}
}
