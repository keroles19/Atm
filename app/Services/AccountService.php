<?php

namespace App\Services;


use App\Enums\TransactionStatusEnum;
use App\Enums\TransactionTypeEnum;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class AccountService extends BaseService
{

    public function showAccount($account, $limitations = 10): array
    {
        $result = [
            'account' => $account,
            'transactions' => $this->getTransactionsPerAccount($account->id, $limitations),
            'totalWithdrawalsAmount' => $this->getTotalWithdrawalsAmountBerDay($account->id),
            'withdrawalsLis' => $this->getWithdrawalsListBerDay($account->id),
        ];
        return $this->success(200, $result);
    }

    public function createNewAccount(array $data): array
    {
        $data['user_id'] = currentUser()->id;
        Account::create($data);
        return $this->success(200, ['message' => 'New Account has been created successfully']);
    }


    public function withdraw(array $data)
    {
        if ($data['amount'] > 100) {
            return $this->failed(404, 'Opps! The maximum amount for one withdrawal is 100');
        }

        $account = Account::find($data['account_id']);

        if(!$account->checkBalance($data['amount'])){
            return $this->failed(404, 'Opps! Your balance is not enough');
        }

        $transaction = (new Transaction())
            ->setAccountID($data['account_id'])
            ->setAmount($data['amount'])
            ->setStatus(TransactionStatusEnum::Success)
            ->setOperation(TransactionTypeEnum::Withdraw)
            ->setReferenceNumber();

        try {
            DB::beginTransaction();

            $transaction->save();

            // Deduct the amount from the account
            $transaction->account->makeWithdrawOperation($data['amount'])->save();
            DB::commit();

            return $this->success(200, ['message' => 'An amount of ' . $data['amount'] . ' has been withdrawn successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
//            return $this->failed(500, __('common.something_went_wrong'));
            return $this->failed(500, $e->getMessage());
        }
    }


    private function getTransactionsPerAccount(int $account_id, int $limitations)
    {
        return Transaction::where('account_id', $account_id)->latest()->paginate($limitations);
    }

    private function getTotalWithdrawalsAmountBerDay(int $account_id, $number = 10)
    {
        return Transaction::accountTransaction($account_id)
            ->successTransaction()
            ->withdrawTransaction()
            ->toDayRecord()
            ->orderBy('created_at', 'desc')
            ->limit($number)
            ->sum('amount');
    }

    private function getWithdrawalsListBerDay(int $account_id, $number = 10)
    {
        return Transaction::accountTransaction($account_id)
            ->successTransaction()
            ->withdrawTransaction()
            ->toDayRecord()
            ->orderBy('created_at', 'desc')
            ->limit($number)
            ->get();
    }

}
