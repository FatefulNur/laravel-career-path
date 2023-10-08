<?php

namespace App\User;

use App\Enum\UserRole;

class Admin extends User
{
    public function __construct(
        ?string $name = null, 
        ?string $email = null, 
        ?string $password = null
    ) {
        parent::__construct(UserRole::ADMIN, $name, $email, $password);
    }

    public static function redirectPath(): string
    {
        return "/admin";
    }
}