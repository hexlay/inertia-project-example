<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use function now;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = 'admin@wubbleyou.co.uk';

        if (!User::whereEmail($adminEmail)->exists()) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]);
            $admin->assignRole('Admin');
        }
    }
}
