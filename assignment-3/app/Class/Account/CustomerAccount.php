<?php

namespace App\Class\Account;

use App\Class\User\Customer;
use App\Contract\Storage;

class CustomerAccount extends Account
{
    public function __construct() {
        parent::__construct(new Customer);
    }
}