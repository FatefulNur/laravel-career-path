<?php

namespace App\Service;

use App\Contract\Storage;
use App\Model\Bank\CustomerBank;
use App\Responses\Response;
use App\User\Customer;
use App\Storage\DBStorage;
use App\User\User;

class CustomerService
{
    private Storage $db;
    private CustomerBank $bank;

    public function __construct() {
        $this->db = new DBStorage;
        $this->bank = new CustomerBank($this->db);
    }

    public function balance(Customer $user): float
    {
        return $this->bank->getBalance($user);
    }

    public function transactions(User $user): Response|array
    {
        return $this->bank->transactions($user);
    }

    public function deposit(Customer $user, float $amount): Response
    {
        return $this->bank->deposit($user, $amount);
    }

    public function transfer(Customer $user, object $request): Response
    {
        return $this->bank->transfer($user, $request->email, $request->amount);
    }

    public function withdraw(Customer $user, float $amount): Response
    {
        return $this->bank->withdraw($user, $amount);
    }
}