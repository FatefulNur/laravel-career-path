<?php

namespace App\Class\User;

use App\Contract\Model;
use App\Enum\UserRole;

class User implements Model
{
    protected UserRole $role;
    private ?string $password;
    protected ?string $email;
    protected ?string $name;

    public function __construct(
        UserRole $role, 
        ?string $email, 
        ?string $name, 
        ?string $password
    ) {
        $this->role = $role;
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

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

    public static function getModelName(): string
    {
        return "users";
    }    
}