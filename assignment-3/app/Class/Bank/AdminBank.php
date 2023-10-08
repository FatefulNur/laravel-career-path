<?php

namespace App\Class\Bank;

use App\Class\User\User;

class AdminBank extends Bank
{
    public function allTransactions(): void
    {
        if (empty($this->getTransactions())) {
            printf("**Transaction doesn't not exist!" . PHP_EOL);
            return;
        }

        print_r("=================================================" . PHP_EOL);
        print_r("Name ----- Amount ----- Created At ---- Type" . PHP_EOL);
        foreach ($this->getTransactions() as $transaction) {
            printf(
                "%s ------ %d ------ %s ------ %s" . PHP_EOL,
                $transaction->getUser()->getName(),
                $transaction->getAmount(),
                $transaction->getCreatedAt(),
                strtolower($transaction->getTransactionType()->name),
            );
        }
        print_r("=================================================" . PHP_EOL);
    }

    public function userTransactions(string $email): void
    {
        if(!$this->existTransaction($email)) {
            printf("**Transaction doesn't not exist!" . PHP_EOL);
            return;
        }  

        print_r("=================================================" . PHP_EOL);
        print_r("Name ----- Amount ----- Created At ---- Type" . PHP_EOL);
        foreach($this->getTransactions() as $transaction) {
            if($transaction->getUser()->getEmail() === $email) {
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

    public function allCustomers(User $admin)
    {
        if(count($this->account->getAllUsers()) === 1) {
            printf("**Customer doesn't exist!" . PHP_EOL);
            return;
        } 

        print_r("=====================================" . PHP_EOL);
        print_r("Name ----- Email ----- Role" . PHP_EOL);
        foreach ($this->account->getAllUsers() as $user) {
            if($admin->getEmail() !== $user->getEmail()) {
                printf(
                    "%s ----- %s ----- %s" . PHP_EOL,
                    $user->getName(),
                    $user->getEmail(),
                    strtolower($user->getRole()->name),
                );
            }
        }
        print_r("=====================================" . PHP_EOL);
    }
}
