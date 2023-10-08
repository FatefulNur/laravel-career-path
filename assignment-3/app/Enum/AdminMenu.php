<?php

namespace App\Enum;

enum AdminMenu: int
{
    case SHOW_ALL_TRANSACTIONS = 1;
    case SHOW_USER_TRANSACTIONS = 2;
    case SHOW_ALL_CUSTOMERS = 3;

    public function getMenu(): string
    {
        return match($this) {
            self::SHOW_ALL_TRANSACTIONS => "Show all transactions",
            self::SHOW_USER_TRANSACTIONS => "Show specific user transactions",
            self::SHOW_ALL_CUSTOMERS => "Show all customers",
        };
    }
}