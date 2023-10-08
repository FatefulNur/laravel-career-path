<?php

require_once __DIR__ . "/vendor/autoload.php";

use App\Class\Account\CustomerAccount;
use App\Class\Bank\CustomerBank;
use App\Class\Command\CustomerCLI;
use App\Class\FileStorage;

$app = new CustomerCLI(
    new CustomerBank(new CustomerAccount, new FileStorage)
);

$app->execute();