# Banking CLI Application

This is a simple banking application with some ligthweight features implemented for using in command line.

## Usage

To run this application follow the given instruction.
* Download `assignment-3` folder from https://github.com/FatefulNur/laravel-career-path.git
* Open folder inside your IDE.
* Open a CLI tools in you IDE or OS.
* Run `cd assignment-3/` to change CLI path.
* Run `composer dump-autoload` to create autoloader files.
* Run `php bank.php`.
* You will see the given interface. Register a customer:

    ```
        -------------------------------------
        select from the following menu
        1. Login
        2. Register
        -------------------------------------
        Get a Choice: 
    ```
* After login you will see following interface:

    ```
        -------------------------------------
        select from the following menu
        1. Show my transactions
        2. Deposit money
        3. Withdraw money
        4. Show current balance
        5. Transfer money
        -------------------------------------
        Get a Choice:
    ```
* Follow instruction to deposit, withdraw, and transfer money,

## To create an admin

* Open a CLI tools in you IDE or OS.
* Run `php create-admin.php` .
* Then run `php bank.php` and login as an admin.
* you will see the given interface:

    ```
        -------------------------------------
        select from the following menu
        1. Show all transactions
        2. Show specific user transactions
        3. Show all customers
        -------------------------------------
        Get a Choice:
    ```
* Here you can see transactions and customers information.

## Greeting

There we go. We see an awesome lightweight project. Bye.