<?php

namespace Database\Factories;

use App\Enums\TransactionStatusEnum;
use App\Enums\TransactionTypeEnum;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => Account::factory(),
            'operation' => fake()->randomElement(TransactionTypeEnum::cases()),
            'status' => fake()->randomElement(TransactionStatusEnum::cases()),
            'amount' => fake()->numberBetween(1000, 90000),
            'reference_number' => fake()->uuid,
        ];
    }
}
