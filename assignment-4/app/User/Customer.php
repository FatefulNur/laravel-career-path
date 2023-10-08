<?php

namespace App\User;

use App\Enum\UserRole;

class Customer extends User
{
    public function __construct(
        ?string $name = null, 
        ?string $email = null, 
        ?string $password = null
    ) {
        parent::__construct(UserRole::CUSTOMER, $name, $email, $password);
    } 

    public static function redirectPath(): string
    {
        return "/dashboard";
    }
}