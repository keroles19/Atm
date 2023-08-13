<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    private mixed $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
    }

    public function test_cnu_go_to_home()
    {
        $response = $this->actingAs($this->user)->get(route('atm.home'));
        $response->assertOk();
        $response->assertViewIs('home.index');
        $response->assertViewHas(['userAccounts', 'userTransactions']);
    }

    public function test_auth_middleware()
    {
        $response = $this->get(route('atm.home'));
        $response->assertRedirect(route('login'));
    }
}

