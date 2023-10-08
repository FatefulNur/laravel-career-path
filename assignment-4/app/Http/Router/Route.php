<?php 

namespace App\Http\Router;

use Closure;

class Route extends Router
{
    public static function get(string $path, array $class): void
    {
        static::register([
            "method" => "GET",
            "path" => $path,
            "action" => $class
        ]);
    }

    public static function post(string $path, array $class): void
    {
        static::register([
            "method" => "POST",
            "path" => $path,
            "action" => $class
        ]);
    }
}