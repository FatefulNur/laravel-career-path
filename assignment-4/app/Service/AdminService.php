<?php

namespace App\Service;

use App\Contract\Storage;
use App\Model\Account;
use App\Model\Bank\AdminBank;
use App\Responses\Response;
use App\User\Customer;
use App\Storage\DBStorage;
use App\User\User;

class AdminService
{
    private Storage $db;
    private AdminBank $bank;

    public function __construct() {
        $this->db = new DBStorage;
        $this->bank = new AdminBank($this->db);
    }

    public function transactions(User $user): Response|array
    {
        return $this->bank->allTransactions($user);
    }

    public function userTransactions(string $email): Response|array
    {
        return $this->bank->userTransactions($email);
    }

    public function customers(): Response|array
    {
        return $this->bank->allCustomers();
    }

    public function addCustomer(object $request): Response
    {
        $name = $request->first_name . " " . $request->last_name;
        return $this->bank->account->create(
            new Customer(
                $name,
                $request->email,
                $request->password
            )
        );
    }

    public function getUserNameByEmail(string $email): string
    {
        return $this->bank->getUserByEmail($email)->getName();
    }
}