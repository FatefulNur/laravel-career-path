<?php

namespace App\Class\Transaction;

use App\Class\User\User;
use App\Enum\TransactionType;
use DateTime;

class ReceiveTransaction extends Transaction
{
    public function __construct(User $user, float $amount) {
        $this->transactionType = TransactionType::RECEIVE; 
        $this->user = $user;
        $this->amount = $amount;
        $this->createdAt = (new DateTime())->format('Y/m/d');
    }
}