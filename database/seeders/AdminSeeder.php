<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        $adminUser = User::create([
            'name'     => 'Ain',
            'email'    => 'tehaiium@gmail.com',
            'password' => Hash::make('secret'),
            'role_id'  => 1, // Admin role
        ]);

        // Create the corresponding admin profile
        Admin::create([
            'ad_name'     => 'Ain',
            'ad_email'    => 'tehaiium@gmail.com',
            'ad_password' => Hash::make('secret'),
            'user_id'     => $adminUser->id,
        ]);
    }
}
