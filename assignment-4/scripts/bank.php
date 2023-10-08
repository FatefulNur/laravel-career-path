<?php

require_once __DIR__ . "/../vendor/autoload.php";

use App\Command\CustomerCLI;

$app = new CustomerCLI;

$app->execute();