<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        foreach (range(1, 1000000) as $i) {
            User::create([
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'email'             => $faker->unique()->safeEmail,
                'phone'             => $faker->phoneNumber,
                'date_of_birth'     => $faker->date('Y-m-d', '-18 years'),
                'address'           => $faker->address,
                'city'              => $faker->city,
                'country'           => $faker->country,
                'occupation'        => $faker->jobTitle,
                'status'            => $faker->randomElement(['Active', 'Inactive', 'Suspended']),
                'email_verified_at' => now(),
                'password'          => Hash::make('password'), // Default password
                'remember_token'    => \Str::random(10),
            ]);
        }
    }
}
