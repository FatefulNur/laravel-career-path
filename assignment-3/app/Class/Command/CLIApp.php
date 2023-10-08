<?php

namespace App\Class\Command;

use App\Class\User\User;
use App\Enum\AdminMenu;
use App\Enum\CustomerMenu;

abstract class CLIApp
{
    public $bank;
    protected User $authUser;

    abstract public function execute();

    protected function customerMenu()
    {
        while(true) {
            printf(PHP_EOL . "-------------------------------------" . PHP_EOL);
            printf("select from the following menu" . PHP_EOL);
            foreach(CustomerMenu::cases() as $option) {
                printf("%d. %s" . PHP_EOL, $option->value, $option->getMenu());
            }
            printf("-------------------------------------" . PHP_EOL);
            
            $choice = (int) readline("Get a Choice: ");
            
            switch($choice) {
                case CustomerMenu::TRANSACTIONS->value:
                    $this->bank->showTransactions($this->authUser);
                    break;
                case CustomerMenu::DEPOSIT->value:
                    $amount = (float) readline("Type an amount: ");
                    $this->bank->deposit(
                        $this->authUser,
                        $amount
                    );
                    break;
                case CustomerMenu::WITHDRAW->value:
                    $amount = (float) readline("Type an amount: ");
                    $this->bank->withdraw(
                        $this->authUser,
                        $amount
                    );
                    break;
                case CustomerMenu::BALANCE->value:
                    $this->bank->balance($this->authUser);
                    break;
                case CustomerMenu::TRANSFER->value:
                    $toEmail = readline("Enter an Existing Email* ");
                    $toAmount = (float) readline("Type an amount: ");
                    $password = readline("Retype your password: ");
                    $this->bank->transfer($this->authUser, $toEmail, $toAmount, $password);
                    break;                    
                default:
                    return;
            }
        }    
    }

    protected function adminMenu()
    {
        while(true) {
            printf(PHP_EOL . "-------------------------------------" . PHP_EOL);
            printf("select from the following menu" . PHP_EOL);
            foreach(AdminMenu::cases() as $option) {
                printf("%d. %s" . PHP_EOL, $option->value, $option->getMenu());
            }
            printf("-------------------------------------" . PHP_EOL);
            
            $choice = (int) readline("Get a Choice: ");
            
            switch($choice) {
                case AdminMenu::SHOW_ALL_TRANSACTIONS->value:
                    $this->bank->allTransactions($this->authUser);
                    break;
                case AdminMenu::SHOW_USER_TRANSACTIONS->value:
                    $email = readline("Type an Email: ");
                    $this->bank->userTransactions($email);
                    break;
                case AdminMenu::SHOW_ALL_CUSTOMERS->value:
                    $this->bank->allCustomers($this->authUser);
                    break;                  
                default:
                    return;
            }
        }    
    }
}