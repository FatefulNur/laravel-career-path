<?php

namespace App\User;

use App\Contract\Model;
use App\Enum\UserRole;

abstract class User implements Model
{
    public function __construct(
        protected UserRole $role,
        protected ?string $name,
        protected ?string $email,
        private ?string $password,
    ) {}

    abstract public static function redirectPath(): string;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRole(): UserRole
    {
        return $this->role;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function isAdmin(UserRole $role): bool
    {
        return UserRole::ADMIN === $role;
    }

    public static function getModelName(): string
    {
        return "users";
    }
}
