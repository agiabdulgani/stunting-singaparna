<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test halaman login dapat diakses oleh pengguna yang belum login.
     */
    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Test pengguna yang sudah login dapat mengakses dashboard.
     */
    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    /**
     * Test pengguna yang belum login diarahkan ke halaman login
     * ketika mengakses dashboard.
     */
    public function test_guest_is_redirected_to_login_from_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    /**
     * Test halaman utama mengarahkan pengguna ke dashboard.
     */
    public function test_homepage_redirects_to_dashboard(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/dashboard');
    }
}