<?php

namespace App\Class\Account;

use App\Class\User\Admin;
use App\Contract\Storage;

class AdminAccount extends Account
{
    public function __construct() {
        parent::__construct(new Admin);
    }
}