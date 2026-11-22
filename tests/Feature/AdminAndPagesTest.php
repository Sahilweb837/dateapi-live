<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminAndPagesTest extends TestCase
{
    public function test_homepage_loads_successfully()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Find Your');
        $response->assertSee('Real Connections');
    }

    public function test_radar_page_loads_successfully()
    {
        $response = $this->get('/radar');
        $response->assertStatus(200);
        $response->assertSee('Nearby Radar');
    }

    public function test_community_pages_load_successfully()
    {
        $this->get('/community/lgbtq')->assertStatus(200);
        $this->get('/community/lesbian')->assertStatus(200);
        $this->get('/community/gay')->assertStatus(200);
        $this->get('/community/transgender')->assertStatus(200);
    }

    public function test_admin_login_portal_loads()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('RESTRICTED COMMAND CENTER');
    }

    public function test_admin_can_login_with_admin_admin123()
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }
}
