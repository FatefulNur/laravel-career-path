<?php

namespace App\Enum;

enum TransactionType
{
    case DEPOSIT;
    case RECEIVE;
    case WITHDRAW;
    case TRANSFER;
}