# Banking Application

Welcome to a well featured banking application with implementation of both CLI and web application parts. You can access all the simple features that are the fundamentals of a banking application.

## Installation

* Download `assignment-4` folder from https://github.com/FatefulNur/laravel-career-path.git

## Usage

### Web Part

* Open `assignment-4` folder inside your IDE.
* Open a CLI tools in you IDE or OS.
* Change terminal path to `assignment-4` folder destination.
* Run `composer dump-autoload` to generate autoloader files.
* Open mysql server and create `bank` database.
* Run `php scripts/migration.php` to create tables;
* Finally run command `php -S localhost:900 -t public/` and you will see your development server in http://localhost:900

### CLI Part

* Open `assignment-4` folder inside your IDE.
* Open a CLI tools in you IDE or OS.
* Change terminal path to `assignment-4` folder destination.
* Run `composer dump-autoload` to generate autoloader files.
* Run `php scripts/bank.php`.
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
**<font color="red">NOTE: </font>** <font color="orange">Don't forget to connect and create `bank` database first. Because the command for creating admin will affect both database and filestorage.</font>

* Open a CLI tools in you IDE or OS.
* Run `php scripts/create-admin.php` .
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

There we go. We see an awesome project. Bye.