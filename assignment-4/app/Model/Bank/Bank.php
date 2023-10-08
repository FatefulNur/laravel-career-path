<?php

namespace App\Model\Bank;

use App\Model\Account;
use App\Transaction\ReceiveTransaction;
use App\Transaction\Transaction;
use App\Transaction\TransferTransaction;
use App\User\User;
use App\Contract\Storage;
use App\Enum\TransactionType;
use App\Enum\UserRole;
use App\Model\Model;
use App\Responses\ErrorResponse;
use App\Responses\Response;

class Bank extends Model
{
    private array $transactions = [];
    public Account $account;
    protected Storage $storage;

    public function __construct(Storage $storage) {
        parent::__construct($storage);

        $this->transactions = $this->storage->load(Transaction::getModelName());
    }

    protected function getTransactions(): array
    {
        return $this->transactions;
    }

    protected function getUserTransactions(string $email): array
    {
        $transactions = [];

        foreach($this->transactions as $transaction) {
            if($transaction->getUser()->getEmail() === $email) {
                $transactions[] = $transaction;
            }
        }
        return $transactions;
    }

    protected function setTransactions(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }
    
    protected function transferMoney(User $user, float $amount): ?Response
    {
        if(!$this->isExistTransaction($user->getEmail())) {
            return new ErrorResponse("**Transaction doesn't not exist!");
        } 
        
        $transfer = new TransferTransaction($user, $amount);
        $this->transactions[] = $transfer;
        $this->saveTransaction(Transaction::getModelName());

        return null;
    }

    protected function receiveMoney(User $user, float $amount): void
    {
        $receive = new ReceiveTransaction($user, $amount);
        $this->transactions[] = $receive;
        $this->saveTransaction(Transaction::getModelName());
    }

    protected function getExistingUser(string $email): ?User
    {
        foreach($this->account->getAllUsers() as $user) {
            if($user->getEmail() === $email) {
                return $user;
            }
        }

        return null;
    }

    protected function isExistCustomer(): bool
    {
        foreach($this->account->getAllUsers() as $user) {
            if($user->getRole() === UserRole::CUSTOMER) {
                return true;
            }
        }

        return false;
    }

    protected function isExistTransaction(string $email): bool
    {
        foreach($this->transactions as $transaction) {
            if($transaction->getUser()->getEmail() === $email) {
                return true;
            }
        }

        return false;
    }

    protected function isDepositOrReceived(Transaction $transaction): bool
    {
        return $transaction->getTransactionType() === TransactionType::DEPOSIT ||
                $transaction->getTransactionType() === TransactionType::RECEIVE;
    }

    protected function isWithdrawOrTransferred(Transaction $transaction): bool
    {
        return $transaction->getTransactionType() === TransactionType::WITHDRAW ||
                $transaction->getTransactionType() === TransactionType::TRANSFER;
    }

    protected function saveTransaction(string $model): void
    {
        $this->storage->store($model, $this->transactions);
    }
}