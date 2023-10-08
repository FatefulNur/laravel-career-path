<?php

namespace App\Class\User;

use App\Enum\UserRole;

class Customer extends User
{
    public function __construct(
        ?string $email = null, 
        ?string $name = null, 
        ?string $password = null
    ) {
        parent::__construct(UserRole::CUSTOMER, $email, $name, $password);
    } 
}