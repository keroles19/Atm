<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    private mixed $user, $account;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
        $this->account = Account::factory()->create([
            'user_id' => $this->user->id,
            'balance' => 10000
        ]);
    }


    public function test_cnu_withdraw_amount()
    {
        $data = $this->fakeData();
        $response = $this->actingAs($this->user)
            ->post(route('atm.account.withdraw'), $data);
        $response->assertRedirect()->assertSessionHasNoErrors();
    }

    public function test_cnu_withdraw_amount_in_valid_data()
    {
        $response = $this->actingAs($this->user)
            ->post(route('atm.account.withdraw'), []);
        $response->assertRedirect()->assertInvalid(['account_id', 'amount']);
    }

    public function test_withdraw_amount_in_case_greater_than_valid_amount()
    {
        $data = $this->fakeData();
        $data['amount'] = 120;
        $response = $this->actingAs($this->user)->post(route('atm.account.withdraw'), $data);
        $response->assertRedirect()->assertSessionHasErrors();
    }


    private function fakeData(): array
    {
        return [
            'account_id' => $this->account->id,
            'amount' => 100
        ];
    }
}

