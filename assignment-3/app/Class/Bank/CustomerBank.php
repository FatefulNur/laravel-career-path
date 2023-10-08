<?php

namespace App\Class\Bank;

use App\Class\Transaction\DepositTransaction;
use App\Class\Transaction\Transaction;
use App\Class\Transaction\WithdrawTransaction;
use App\Class\User\User;
use App\Enum\TransactionType;

class CustomerBank extends Bank
{    
    public function showTransactions(User $user): void
    {
        if(!$this->existTransaction($user->getEmail())) {
            printf("**Transaction doesn't not exist!" . PHP_EOL);
            return;
        }    

        print_r("=================================================" . PHP_EOL);
        print_r("Name ----- Amount ----- Created At ---- Type" . PHP_EOL);
        foreach($this->getTransactions() as $transaction) {
            if($transaction->getUser()->getEmail() === $user->getEmail()) {
                printf(
                    "%s ------ %d ------ %s ------ %s" . PHP_EOL,
                    $transaction->getUser()->getName(),
                    $transaction->getAmount(),
                    $transaction->getCreatedAt(),
                    strtolower($transaction->getTransactionType()->name),
                );
            }
        }
        print_r("=================================================" . PHP_EOL);
    }

    public function deposit(User $user, float $amount): void
    {
        if($amount === 0) {
            printf("**Amount cannot be 0!" . PHP_EOL);
            return;
        } 

        $deposit = new DepositTransaction($user, $amount);
        $this->setTransactions($deposit);
        $this->saveTransaction(Transaction::getModelName());
        
        printf("Deposit balance successful :)" . PHP_EOL);
    }

    public function withdraw(User $user, float $amount): void
    {
        if($amount <= 0) {
            printf("**Amount cannot be 0!" . PHP_EOL);
            return;
        }

        if($this->balance($user) < $amount) {
            printf("**Sorry currently you have %d!" . PHP_EOL, $this->balance($user));
            return;
        }

        if(!$this->existTransaction($user->getEmail())) {
            printf("**Transaction doesn't not exist!" . PHP_EOL);
            return;
        } 
        
        $withdraw = new WithdrawTransaction($user, $amount);
        $this->setTransactions($withdraw);
        $this->saveTransaction(Transaction::getModelName());

        printf("Withdraw balance successful :)" . PHP_EOL);
    }

    public function balance(User $user): float
    {
        $savings = 0;
        foreach($this->getTransactions() as $transaction) {
            if($transaction->getUser()->getEmail() === $user->getEmail()) {
                if(
                    $transaction->getTransactionType() === TransactionType::DEPOSIT ||
                    $transaction->getTransactionType() === TransactionType::RECEIVE
                ) {
                    $savings += $transaction->getAmount();
                } else if(
                    $transaction->getTransactionType() === TransactionType::WITHDRAW ||
                    $transaction->getTransactionType() === TransactionType::TRANSFER
                ) {
                    $savings -= $transaction->getAmount();
                }
            }
        }
        printf("Your balance is: %d" . PHP_EOL, $savings);
        return $savings;
    }


    public function transfer(User $user, string $toEmail, string $toAmount, string $password): void
    {
        if($toAmount === 0) {
            printf("**Amount cannot be 0!" . PHP_EOL);
            return;
        }

        if(!$this->existTransaction($user->getEmail())) {
            printf("**Transaction doesn't not exist!" . PHP_EOL);
            return;
        } 

        if($user->getEmail() === $toEmail) {
            printf("**Try with other existing email!" . PHP_EOL);
            return;
        }

        if(is_null($this->getExistingUser($toEmail))) {
            printf("**Email do not exist!" . PHP_EOL);
            return;
        } 

        if($this->balance($user) < $toAmount) {
            printf("**Sorry currently you have %d!" . PHP_EOL, $this->balance($user));
            return;
        }

        if($user->getPassword() !== $password) {
            printf("**Password is wrong!" . PHP_EOL);
            return; 
        }

        $this->transferMoney($user, $toAmount);
        $this->receiveMoney($this->getExistingUser($toEmail), $toAmount);
        printf("Transfered succussfully :)" . PHP_EOL);
    }
}