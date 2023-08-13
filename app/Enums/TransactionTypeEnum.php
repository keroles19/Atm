<?php

namespace App\Enums;

enum TransactionTypeEnum: string
{
    case Addition = 'addition';
    case Withdraw = 'withdraw';
    case Hold = 'on_hold';
    case Receive = 'receive';
}
