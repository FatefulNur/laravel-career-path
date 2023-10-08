<?php

namespace App\Class\Account;

use App\Class\AuthSystem;
use App\Class\FileStorage;
use App\Class\User\User;

class Account
{
    private AuthSystem $auth;
    
    public function __construct(User $user) {
        $this->auth = new AuthSystem(new FileStorage, $user);
    }

    public function create(User $user): void
    {
        $this->auth->register($user);
    }

    public function authenticate(string $email, string $password): bool
    {
        return $this->auth->login($email, $password);
    }

    public function getAllUsers(): array
    {
        return $this->auth->getEntries();
    }

    public function getAuthenticateUser(): User
    {
        return $this->auth->user;
    }
}