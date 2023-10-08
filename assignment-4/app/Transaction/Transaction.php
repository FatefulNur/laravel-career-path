<?php

namespace App\Transaction;

use App\User\User;
use App\Contract\Model;
use App\Enum\TransactionType;

class Transaction implements Model
{
    protected TransactionType $transactionType;
    protected User $user;
    protected float $amount;
    protected string $createdAt; 

    public function getTransactionType(): TransactionType
    {
        return $this->transactionType;
    }

    public function getUser(): User
    {
        return $this->user;
    }
    
    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public static function getModelName(): string
    {
        return "transactions";
    }
}