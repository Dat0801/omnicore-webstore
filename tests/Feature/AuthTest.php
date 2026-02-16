<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_is_redirected_to_dashboard(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => 'on',
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);

        $this->assertAuthenticated();
    }

    public function test_user_can_login_and_is_redirected_to_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login.store'), [
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_credentials_show_error_on_login_page(): void
    {
        $response = $this->from(route('login'))->post(route('login.store'), [
            'email' => 'wrong@example.com',
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect(route('login'));

        $this->followRedirects($response)
            ->assertSee('The provided credentials do not match our records.');
    }

    public function test_user_can_logout_and_is_redirected_home(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('home'));

        $this->assertGuest();
    }

    public function test_guest_sees_auth_links_in_header(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Sign in');
        $response->assertSee('Create account');
        $response->assertDontSee('Admin');
        $response->assertDontSee('Account');
    }

    public function test_authenticated_user_sees_account_and_admin_links_in_header(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Account');
        $response->assertSee('Admin');
        $response->assertDontSee('Sign in');
        $response->assertDontSee('Create account');
    }
}
