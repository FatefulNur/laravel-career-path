<?php

namespace App\Command;

use App\Model\Bank\AdminBank;
use App\Model\Bank\CustomerBank;
use App\Storage\FileStorage;
use App\User\Customer;
use App\Enum\UserRole;
use App\Responses\Response;

class CustomerCLI extends CLIApp
{
    private const LOGIN = 1; 
    private const REGISTER = 2;

    private array $options = [
        self::LOGIN => "Login",
        self::REGISTER => "Register",
    ];

    public function __construct() {
        $this->bank = new CustomerBank(
            new FileStorage
        );
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
                    $response = $this->bank->account->authenticate($email, $password);
                    if ($response instanceof Response) {
                        $this->displayResponse($response);
                    } else {
                        $this->authUser = $response;
                        if($this->authUser->getRole() === UserRole::ADMIN) {
                            $this->bank = new AdminBank(
                                new FileStorage
                            );
                            return $this->adminMenu();
                        } else {
                            return $this->customerMenu();
                        }
                    }
                    break;
                case self::REGISTER:
                    $name = readline("Name: ");
                    $email = readline("E-mail: ");
                    $password = readline("Password: ");
                    $response = $this->bank->account->create(
                        new Customer($name, $email, $password)
                    );
                    $this->displayResponse($response);
                    break;
                default:
                    return;
            }
        }    
    }
}