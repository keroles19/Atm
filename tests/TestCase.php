<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected bool $seed = true;


    protected function createUser()
    {
        return User::factory()->create([
            'card_number' => '12345671234123',
            'pin'         =>  Hash::make('123456')
        ]);
    }
}
