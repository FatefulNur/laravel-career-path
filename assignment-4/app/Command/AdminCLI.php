<?php

namespace App\Command;

use App\Model\Account;
use App\Storage\DBStorage;
use App\Storage\FileStorage;
use App\User\Admin;

class AdminCLI extends CLIApp
{
    public function execute()
    {
        $name = readline("Name: ");
        $email = readline("E-mail: ");
        $password = readline("Password: ");
        $response = (new Account(
            new FileStorage
        ))->create(
            new Admin($name, $email, $password)
        );
        
        $response = (new Account(
            new DBStorage
        ))->create(
            new Admin($name, $email, $password)
        );
        $this->displayResponse($response);
    }
}