<?php

namespace App\Enums;

enum TransactionStatusEnum: string
{
    case Success = 'success';
    case Failed = 'failed';
}
