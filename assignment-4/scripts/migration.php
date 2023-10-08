<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Database\Migration;

$migrate = new Migration;

$migrate->run();