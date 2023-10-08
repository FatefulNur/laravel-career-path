<?php

namespace App\Enum;

enum CustomerMenu: int
{
    case TRANSACTIONS = 1;
    case DEPOSIT = 2;
    case WITHDRAW = 3;
    case BALANCE = 4;
    case TRANSFER = 5;

    public function getMenu(): string
    {
        return match($this) {
            self::TRANSACTIONS => "Show my transactions",
            self::DEPOSIT => "Deposit money",
            self::WITHDRAW => "Withdraw money",
            self::BALANCE => "Show current balance",
            self::TRANSFER => "Transfer money",
        };
    }
}
