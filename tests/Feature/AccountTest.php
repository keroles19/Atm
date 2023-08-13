<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    private mixed $user, $account;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
        $this->account = Account::factory()->create([
            'user_id' => $this->user->id
        ]);
    }

    public function test_cnu_create_user()
    {
        $data = $this->fakeData();
        $response = $this->actingAs($this->user)->post(route('atm.account.store'), $data);
        $response->assertRedirect()->assertSessionHasNoErrors();
        $this->assertDatabaseHas('accounts', ['account_number' => $data['account_number']]);
    }

    public function test_cnu_create_user_in_case_invalid_data()
    {
        $data = [];
        $response = $this->actingAs($this->user)->post(route('atm.account.store'), $data);
        $response->assertRedirect()->assertSessionHasErrors();
    }

    public function test_cnu_show_account()
    {
        $response = $this->actingAs($this->user)
            ->get(route('atm.account.show', $this->account->id));

        $response->assertOk();
        $response->assertViewIs('account.show');
        $response->assertViewHas([
            'account', 'transactions', 'totalWithdrawalsAmount', 'withdrawalsLis'
        ]);
    }

    public function test_cnu_show_account_in_case_not_found()
    {
        $response = $this->actingAs($this->user)
            ->get(route('atm.account.show', fake()->randomNumber(5, true)));

       $response->assertStatus(404);
    }


    private function fakeData(): array
    {
        return [
            'account_number' => '1231231231231231',
            'holder_name' => '123123',
        ];
    }

}

