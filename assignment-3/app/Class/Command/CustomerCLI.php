<?php

namespace App\Class\Command;

use App\Class\Account\AdminAccount;
use App\Class\Bank\AdminBank;
use App\Class\Bank\CustomerBank;
use App\Class\FileStorage;
use App\Class\User\Customer;
use App\Enum\UserRole;

class CustomerCLI extends CLIApp
{
    private const LOGIN = 1; 
    private const REGISTER = 2;

    private array $options = [
        self::LOGIN => "Login",
        self::REGISTER => "Register",
    ];

    public function __construct(CustomerBank $bank) {
        $this->bank = $bank;
    }

    public function execute()
    {
        while(true) {
            printf(PHP_EOL . "-------------------------------------" . PHP_EOL);
            printf("select from the following menu" . PHP_EOL);
            foreach($this->options as $option => $label) {
                printf("%d. %s" . PHP_EOL, $option, $label);
            }
            printf("-------------------------------------" . PHP_EOL);
            
            $choice = (int) readline("Get a Choice: ");
            
            switch($choice) {
                case self::LOGIN:
                    $email = readline("E-mail: ");
                    $password = readline("Password: ");
                    if($this->bank->account->authenticate($email, $password)) {
                        $this->authUser = $this->bank->account->getAuthenticateUser();
                        if($this->authUser->getRole() === UserRole::ADMIN) {
                            $this->bank = new AdminBank(
                                new AdminAccount,
                                new FileStorage
                            );
                            return $this->adminMenu();
                        } else {
                            return $this->customerMenu();
                        }
                    }
                    break;
                case self::REGISTER:
                    $email = readline("E-mail: ");
                    $name = readline("Name: ");
                    $password = readline("Password: ");
                    $this->bank->account->create(
                        new Customer($email, $name, $password)
                    );
                    break;
                default:
                    return;
            }
        }    
    }
}