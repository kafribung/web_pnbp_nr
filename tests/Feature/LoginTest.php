<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function halaman_login_dapat_dikunjungi()
    {
        $this->get('login')
                ->assertStatus(200);
    }

    /** @test */
    public function sesorang_dapat_login()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $response = $this->post('login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect('dashboard');
    }

}
