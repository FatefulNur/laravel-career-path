<?php

namespace App\Class\Transaction;

use App\Class\User\User;
use App\Enum\TransactionType;
use DateTime;

class TransferTransaction extends Transaction
{
    public function __construct(User $user, float $amount) {
        $this->transactionType = TransactionType::TRANSFER; 
        $this->user = $user;
        $this->amount = $amount;
        $this->createdAt = (new DateTime())->format('Y/m/d');
    }
}