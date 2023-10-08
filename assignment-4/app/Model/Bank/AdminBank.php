<?php

namespace App\Model\Bank;

use App\Model\Account;
use App\Contract\Storage;
use App\Enum\UserRole;
use App\Responses\ErrorResponse;
use App\Responses\Response;
use App\User\User;

class AdminBank extends Bank
{
    public function __construct(Storage $storage) {
        $this->account = new Account($storage);
        parent::__construct($storage);
    }

    public function allTransactions(): Response|array
    {
        if (empty($this->getTransactions())) {
            return new ErrorResponse("**Transaction doesn't not exist!");
        }

        return $this->getTransactions();
    }

    public function userTransactions(string $email): Response|array
    {
        if(!$this->isExistTransaction($email)) {
            return new ErrorResponse("**Transaction doesn't not exist!");
        }  

        return $this->getUserTransactions($email);
    }

    public function allCustomers(): Response|array
    {
        if(!$this->isExistCustomer()) {
            return new ErrorResponse("**Customer doesn't exist!");
        } 
        
        return array_filter(
            $this->account->getAllUsers(), 
            fn($user) => $user->getRole() !== UserRole::ADMIN
        );
    }

    public function getUserByEmail(string $email): User
    {
        return $this->getExistingUser($email);
    }
}
