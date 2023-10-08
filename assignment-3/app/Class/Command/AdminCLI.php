<?php

namespace App\Class\Command;

use App\Class\Bank\AdminBank;
use App\Class\User\Admin;

class AdminCLI extends CLIApp
{
    public function __construct(AdminBank $bank) {
        $this->bank = $bank;
    }

    public function execute()
    {
        $email = readline("E-mail: ");
        $name = readline("Name: ");
        $password = readline("Password: ");
        $this->bank->account->create(
            new Admin($email, $name, $password)
        );
    }
}