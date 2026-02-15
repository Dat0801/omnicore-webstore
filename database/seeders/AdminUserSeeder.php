<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@omnicore.test'],
            [
                'name' => 'Webstore Admin',
                'password' => Hash::make('password123'),
            ],
        );

        User::firstOrCreate(
            ['email' => 'user@omnicore.test'],
            [
                'name' => 'Webstore User',
                'password' => Hash::make('password123'),
            ],
        );
    }
}
