<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
     app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        Permission::firstOrCreate(['name' => 'view users']);
        Permission::firstOrCreate(['name' => 'edit users']);
        Permission::firstOrCreate(['name' => 'view own profile']);

        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(['view users', 'edit users']);
        $userRole->givePermissionTo(['view own profile']);

        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'sam@gmail.com'],
            [
                'first_name' => 'Sam',
                'last_name' => 'Admin',
                'phone' => '1234567890',
                'date_of_birth' => '1990-01-01',
                'address' => 'Admin Street',
                'city' => 'Purnea',
                'country' => 'India',
                'occupation' => 'Administrator',
                'status' => 'Active',
                'password' => Hash::make('123456789'),
            ]
        );
        $admin->assignRole($adminRole);

        // Create Normal User
        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'first_name' => 'Normal',
                'last_name' => 'User',
                'phone' => '9876543210',
                'date_of_birth' => '1995-01-01',
                'address' => 'User Address',
                'city' => 'Patna',
                'country' => 'India',
                'occupation' => 'Employee',
                'status' => 'Active',
                'password' => Hash::make('123456789'),
            ]
        );
        $user->assignRole($userRole);
    }
}

