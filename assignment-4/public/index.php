<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../vendor/autoload.php";

require_once __DIR__ . "/../routes/web.php";

use App\Http\Router\Router;

Router::run();