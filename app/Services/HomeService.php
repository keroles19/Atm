<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeService extends BaseService
{
    public function homeData(): array
    {
        return [
            'userAccounts' => $this->getAllAccount(),
            'userTransactions' => $this->getLimitTransactions()
        ];
    }


    protected function getAllAccount()
    {
        return currentUser()
            ->accounts()
            ->select(['id', 'account_number', 'holder_name', 'balance'])
            ->get();
    }

    protected function getLimitTransactions(int $limitations = 5)
    {
        return currentUser()
            ->transactions()
            ->with(['account:id,holder_name,account_number'])
            ->latest()
            ->limit($limitations)
            ->get();
    }

}
