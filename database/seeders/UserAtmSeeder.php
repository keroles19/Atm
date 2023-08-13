<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserAtmSeeder extends Seeder
{
    /**
     * Users' Credentials are
     *
     *  Card_number => 1234567890123 [0-9]
     *  PIN         => 123456
     *
     */


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->has(

            Account::factory()->count(2)->has(

                Transaction::factory()->count(5),
                'transactions'),

            'accounts')
            ->state(new Sequence(
                fn($sequence) => [
                    'card_number' => '1234567890123' . $sequence->index,
                ]
            ))
            ->create();
    }
}
