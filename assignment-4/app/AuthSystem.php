<?php

namespace App;

use App\Contract\Storage;
use App\User\User;
use App\Responses\ErrorResponse;
use App\Responses\Response;
use App\Responses\SuccessResponse;

class AuthSystem
{
    private array $entries = [];
    public Storage $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        
        $this->entries = $this->storage->load(User::getModelName());
    }

    public function getEntries(): array
    {
        return $this->entries;
    }

    public function login(string $email, string $password): Response|User
    {
        if(!empty($this->entries)) {
            foreach ($this->entries as $entry) {
                if ($email === $entry->getEmail() && $password === $entry->getPassword()) {
                    return $entry;
                } 
            }
        }
        
        return new ErrorResponse("**Sorry the given Credentials didn't match!");
    }

    public function register(User $user): Response
    {
        if($this->validateData($user) !== true) {
            return $this->validateData($user);
        }

        if(!empty($this->entries)) {
            foreach ($this->entries as $entry) {
                if ($user->getEmail() === $entry->getEmail()) {
                    return new ErrorResponse("**User already exists!");
                }
            }
        }
        
        $this->entries[] = $user;
        $this->storage->store(User::getModelName(), $this->entries);
        return new SuccessResponse("Registered Successfully");
    }

    private function validateData(User $user): Response|bool
    {
        $email = trim($user->getEmail());
        $name = trim($user->getName());
        $password = trim($user->getPassword());

        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return new ErrorResponse("**Email is invalid!");
        }

        if(empty($name) || strlen($name) < 3) {
            return new ErrorResponse("**Name should contains minimum 3 character!");
        }

        if(empty($password) || strlen($password) < 3) {
            return new ErrorResponse("**Password should contains minimum 3 character!");
        }

        return true;
    }
}
