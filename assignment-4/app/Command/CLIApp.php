<?php

namespace App\Command;

use App\User\User;
use App\Enum\AdminMenu;
use App\Enum\CustomerMenu;
use App\Responses\Response;

abstract class CLIApp
{
    public $bank;
    protected User $authUser;

    abstract public function execute();

    protected function customerMenu()
    {
        while (true) {
            printf(PHP_EOL . "-------------------------------------" . PHP_EOL);
            printf("select from the following menu" . PHP_EOL);
            foreach (CustomerMenu::cases() as $option) {
                printf("%d. %s" . PHP_EOL, $option->value, $option->getMenu());
            }
            printf("-------------------------------------" . PHP_EOL);

            $choice = (int) readline("Get a Choice: ");

            switch ($choice) {
                case CustomerMenu::TRANSACTIONS->value:
                    $response = $this->bank->transactions($this->authUser);
                    $this->displayUserTransactions($response, $this->authUser->getEmail());
                    break;
                case CustomerMenu::DEPOSIT->value:
                    $amount = (float) readline("Type an amount: ");
                    $response = $this->bank->deposit(
                        $this->authUser,
                        $amount
                    );
                    $this->displayResponse($response);
                    break;
                case CustomerMenu::WITHDRAW->value:
                    $amount = (float) readline("Type an amount: ");
                    $response = $this->bank->withdraw(
                        $this->authUser,
                        $amount
                    );
                    $this->displayResponse($response);
                    break;
                case CustomerMenu::BALANCE->value:
                    $balance = $this->bank->getBalance($this->authUser);
                    printf("Your balance is: %d" . PHP_EOL, $balance);
                    break;
                case CustomerMenu::TRANSFER->value:
                    $toEmail = readline("Enter an Existing Email* ");
                    $toAmount = (float) readline("Type an amount: ");
                    $response = $this->bank->transfer($this->authUser, $toEmail, $toAmount);
                    $this->displayResponse($response);
                    break;
                default:
                    return;
            }
        }
    }

    protected function adminMenu()
    {
        while (true) {
            printf(PHP_EOL . "-------------------------------------" . PHP_EOL);
            printf("select from the following menu" . PHP_EOL);
            foreach (AdminMenu::cases() as $option) {
                printf("%d. %s" . PHP_EOL, $option->value, $option->getMenu());
            }
            printf("-------------------------------------" . PHP_EOL);

            $choice = (int) readline("Get a Choice: ");

            switch ($choice) {
                case AdminMenu::SHOW_ALL_TRANSACTIONS->value:
                    $response = $this->bank->allTransactions($this->authUser);
                    $this->displayAllTransactions($response);
                    break;
                case AdminMenu::SHOW_USER_TRANSACTIONS->value:
                    $email = readline("Type an Email: ");
                    $response = $this->bank->userTransactions($email);
                    $this->displayUserTransactions($response, $email);
                    break;
                case AdminMenu::SHOW_ALL_CUSTOMERS->value:
                    $response = $this->bank->allCustomers();
                    $this->displayUsers($response);
                    break;
                default:
                    return;
            }
        }
    }

    protected function displayResponse(Response $data): void
    {
        printf($data . PHP_EOL);
        return;
    }

    protected function displayAllTransactions(Response|array $datas): void
    {
        if ($datas instanceof Response) {
            $this->displayResponse($datas);
            return;
        }

        if (is_array($datas)) {

            print_r("=================================================" . PHP_EOL);
            print_r("Name ----- Amount ----- Created At" . PHP_EOL);
            foreach ($datas as $transaction) {
                printf(
                    "%s ------ %d(%s) ------ %s" . PHP_EOL,
                    $transaction->getUser()->getName(),
                    $transaction->getAmount(),
                    strtolower($transaction->getTransactionType()->name),
                    $transaction->getCreatedAt(),
                );
            }
            print_r("=================================================" . PHP_EOL);
        }
    }

    protected function displayUserTransactions(Response|array $datas, string $email): void
    {
        if ($datas instanceof Response) {
            $this->displayResponse($datas);
            return;
        }

        if (is_array($datas)) {
            print_r("=================================================" . PHP_EOL);
            print_r("Name ----- Amount ----- Created At" . PHP_EOL);
            foreach ($datas as $transaction) {
                if ($transaction->getUser()->getEmail() === $email) {
                    printf(
                        "%s ------ %d(%s) ------ %s" . PHP_EOL,
                        $transaction->getUser()->getName(),
                        $transaction->getAmount(),
                        strtolower($transaction->getTransactionType()->name),
                        $transaction->getCreatedAt(),
                    );
                }
            }
            print_r("=================================================" . PHP_EOL);
        }
    }

    protected function displayUsers(Response|array $datas): void
    {
        if ($datas instanceof Response) {
            $this->displayResponse($datas);
            return;
        }

        if (is_array($datas)) {
            print_r("=====================================" . PHP_EOL);
            print_r("Name ----- Email ----- Role" . PHP_EOL);
            foreach ($datas as $user) {
                printf(
                    "%s ----- %s ----- %s" . PHP_EOL,
                    $user->getName(),
                    $user->getEmail(),
                    strtolower($user->getRole()->name),
                );
            }
            print_r("=====================================" . PHP_EOL);
        }
    }
}
