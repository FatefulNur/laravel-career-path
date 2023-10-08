<?php

namespace App\Transaction;

use App\User\User;
use App\Enum\TransactionType;
use DateTime;

class ReceiveTransaction extends Transaction
{
    public function __construct(User $user, float $amount) {
        $this->transactionType = TransactionType::RECEIVE; 
        $this->user = $user;
        $this->amount = $amount;
        $this->createdAt = (new DateTime())->format("j F Y, g:i a");
    }
}