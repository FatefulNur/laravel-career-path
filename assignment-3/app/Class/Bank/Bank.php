<?php

namespace App\Class\Bank;

use App\Class\Account\Account;
use App\Class\Transaction\ReceiveTransaction;
use App\Class\Transaction\Transaction;
use App\Class\Transaction\TransferTransaction;
use App\Class\User\User;
use App\Contract\Storage;

class Bank
{
    private array $transactions = [];
    public Account $account;
    protected Storage $storage;

    public function __construct(Account $account, Storage $storage) {
        $this->account = $account; 
        $this->storage = $storage;

        $this->transactions = $this->storage->load(Transaction::getModelName());
    }

    protected function getTransactions(): array
    {
        return $this->transactions;
    }

    protected function setTransactions(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }
    
    protected function transferMoney(User $user, float $amount): void
    {
        if(!$this->existTransaction($user->getEmail())) {
            printf("**Transaction doesn't not exist!" . PHP_EOL);
            return;
        } 
        
        $transfer = new TransferTransaction($user, $amount);
        $this->transactions[] = $transfer;
        $this->saveTransaction(Transaction::getModelName());
    }

    protected function receiveMoney(User $user, float $amount): void
    {
        $receive = new ReceiveTransaction($user, $amount);
        $this->transactions[] = $receive;
        $this->saveTransaction(Transaction::getModelName());
    }

    protected function getExistingUser($email): ?User
    {
        foreach($this->account->getAllUsers() as $user) {
            if($user->getEmail() === $email) {
                return $user;
            }
        }

        return null;
    }

    protected function existTransaction(string $email): bool
    {
        foreach($this->transactions as $transaction) {
            if($transaction->getUser()->getEmail() === $email) {
                return true;
            }
        }

        return false;
    }

    protected function saveTransaction(string $model): void
    {
        $this->storage->store($model, $this->transactions);
    }
}