<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    private mixed $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
    }

    public function test_show_login_page()
    {
        $response = $this->get(route('show_login'));
        $response->assertOk();
        $response->assertViewIs('auth.login');
    }

    public function test_cau_login()
    {
        $response = $this->post(route('login'), [
            'card_number' => '12345671234123',
            'pin' => '123456'
        ]);
        $response->assertRedirect(route('atm.home'));
    }

    public function test_cau_login_in_case_invalid_credentials()
    {
        $response = $this->post(route('login'), [
            'card_number' => '12345671234123',
            'pin' => '123453'
        ]);
        $response->assertRedirect()->assertSessionHasErrors();
    }

    public function test_cau_login_in_case_invalid_data()
    {
        $response = $this->post(route('login'), [
            'card_number' => '123445',
            'pin' => '1234'
        ]);
        $response->assertRedirect()->assertInvalid(['card_number', 'pin']);
    }

    public function test_can_user_logout()
    {
        $response = $this->actingAs($this->user)->post(route('atm.logout'));
        $response->assertRedirect(route('login'));
    }
}

