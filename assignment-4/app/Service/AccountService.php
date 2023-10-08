<?php

namespace App\Service;

use App\Contract\Storage;
use App\Model\Account;
use App\User\User;
use App\Responses\Response;
use App\User\Customer;
use App\Storage\DBStorage;
use stdClass;

class AccountService
{
    private Storage $db;

    public function __construct() {
        $this->db = new DBStorage;
    }

    public function create(stdClass $request): Response
    {
        return (new Account($this->db))->create(
            new Customer(
                $request->name,
                $request->email,
                $request->password
            )
        );
    }

    public function authenticate(stdClass $request): Response|User
    {
        return (new Account($this->db))->authenticate(
            $request->email, 
            $request->password
        );
    }
}