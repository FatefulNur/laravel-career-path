<?php

require_once __DIR__ . "/vendor/autoload.php";

use App\Class\Account\AdminAccount;
use App\Class\Bank\AdminBank;
use App\Class\Command\AdminCLI;
use App\Class\FileStorage;

$app = new AdminCLI(
    new AdminBank(new AdminAccount, new FileStorage)
);

$app->execute();