<?php

namespace App\Model;

use App\AuthSystem;
use App\User\User;
use App\Contract\Storage;
use App\Responses\Response;

class Account extends Model
{
    private AuthSystem $auth;
    
    public function __construct(Storage $storage) {
        parent::__construct($storage);

        $this->auth = new AuthSystem($this->storage);
    }

    public function create(User $user): Response
    {
        return $this->auth->register($user);
    }

    public function authenticate(string $email, string $password): Response|User
    {
        return $this->auth->login($email, $password);
    }

    public function getAllUsers(): array
    {
        return $this->auth->getEntries();
    }
}