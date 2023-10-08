<?php

namespace App\Class;

use App\Class\User\User;
use App\Contract\Storage;

class AuthSystem
{
    private array $entries = [];
    public User $user;
    public Storage $storage;

    public function __construct(Storage $storage, User $user)
    {
        $this->user = $user;
        $this->storage = $storage;

        $this->entries = $this->storage->load(User::getModelName());
    }

    public function getEntries(): array
    {
        return $this->entries;
    }

    public function login(string $email, string $password): bool
    {
        $login = false;
        
        if(!empty($this->entries)) {
            foreach ($this->entries as $entry) {
                if ($email === $entry->getEmail() && $password === $entry->getPassword()) {
                    $this->user = $entry;
                    $login = true;
                }
            }
        }
        
        if(!$login) {
            printf("**Sorry the given Credentials didn't match!" . PHP_EOL);
        }

        return $login;
    }

    public function register(User $user): void
    {
        if(!$this->validateData($user)) {
            return;
        }

        if(!empty($this->entries)) {
            foreach ($this->entries as $entry) {
                if ($user->getEmail() === $entry->getEmail()) {
                    printf("**User already exists!" . PHP_EOL);
                    return;
                }
            }
        }
        
        $this->entries[] = $user;
        $this->storage->store(User::getModelName(), $this->entries);
        printf("Registered Successfully :)" . PHP_EOL);
    }

    private function validateData(User $user): bool
    {
        $email = trim($user->getEmail());
        $name = trim($user->getName());
        $password = trim($user->getPassword());

        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            printf("**Email is invalid!" . PHP_EOL);
            return false;
        }

        if(empty($name) || strlen($name) < 3) {
            printf("**Name should contains minimum 3 character!" . PHP_EOL);
            return false;
        }

        if(empty($password) || strlen($password) < 3) {
            printf("**Password should contains minimum 3 character!" . PHP_EOL);
            return false;
        }

        return true;
    }
}
