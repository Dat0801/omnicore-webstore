<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserSeederTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Seeder should create admin and user once even when run multiple times.
     */
    public function test_admin_and_user_seeder_is_idempotent(): void
    {
        $this->seed(AdminUserSeeder::class);
        $this->seed(AdminUserSeeder::class);

        $this->assertDatabaseHas('users', [
            'email' => 'admin@omnicore.test',
            'name' => 'Webstore Admin',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'user@omnicore.test',
            'name' => 'Webstore User',
        ]);

        $this->assertSame(
            1,
            User::where('email', 'admin@omnicore.test')->count(),
        );

        $this->assertSame(
            1,
            User::where('email', 'user@omnicore.test')->count(),
        );
    }
}
