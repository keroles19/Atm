<?php

namespace App\Models;

use App\Enums\TransactionStatusEnum;
use App\Enums\TransactionTypeEnum;
use App\Http\Requests\WithdrawFormRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Transaction extends Model
{
    use HasFactory;

    protected $hidden = [
        'deleted_at'
    ];
    protected $casts = [
        'status' => TransactionStatusEnum::class,
        'operation' => TransactionTypeEnum::class
    ];

    public function checkStatus(): bool
    {
        return $this->status == TransactionStatusEnum::Success;
    }

    public function setAccountID(int $accountId): self
    {
        $this->account_id = $accountId;
        return $this;
    }

    public function setOperation($operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function setReferenceNumber()
    {
        $this->reference_number = fake()->uuid();
        return $this;
    }


    // ==> Scopes
    public function scopeAccountTransaction(Builder $builder, $bank_id): Builder
    {
        return $builder->where('account_id', $bank_id);
    }

    public function scopeSuccessTransaction(Builder $builder): Builder
    {
        return $builder->where('status', TransactionStatusEnum::Success);
    }

    public function scopeWithdrawTransaction(Builder $builder): Builder
    {
        return $builder->where('operation', TransactionTypeEnum::Withdraw);
    }

    public function scopeToDayRecord(Builder $builder): Builder
    {
        return $builder->whereDate('created_at', now());
    }


    // ==> Relations

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
