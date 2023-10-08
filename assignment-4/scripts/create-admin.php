<?php

require_once __DIR__ . "/../vendor/autoload.php";

use App\Command\AdminCLI;

$app = new AdminCLI;

$app->execute();