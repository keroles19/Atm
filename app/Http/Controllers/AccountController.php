<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountFormRequest;
use App\Http\Requests\WithdrawFormRequest;
use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct(protected AccountService $accountService)
    {
    }


    public function show(Account $account)
    {
        $result = $this->accountService->showAccount($account);
        return view('account.show')->with($result['data']);
    }

    public function store(CreateAccountFormRequest $request): RedirectResponse
    {
        $result = $this->accountService->createNewAccount($request->validated());
        return back()->with('success', $result['data']['message']);
    }

    public function withdraw(WithdrawFormRequest $request): RedirectResponse
    {
        $result = $this->accountService->withdraw($request->validated());

        if ($result['success']) {
            return back()->with('success', $result['data']['message']);

        }
        return back()->withErrors($result['errors']);
    }
}
