<?php

namespace App\Http;

use stdClass;

class Request 
{
    public static function all(array $inputs = []): stdClass
    {
        if(!empty($inputs)) {
            return self::only($inputs);
        }

        return (object) $_POST;
    }

    public static function get(string $name): string
    {
        return $_POST[$name];
    }

    public static function only(array $inputs): stdClass
    {
        return (object) array_filter($_POST, function ($key) use ($inputs) {
            if(in_array($key, $inputs)) {
                return $_POST;
            }
        }, ARRAY_FILTER_USE_KEY);
    }

    public static function query(string $string): string
    {
        if(isset($_GET[$string])) {
            return $_GET[$string];
        }
    }

    public static function currentURL()
    {
        $urlSegment = explode("?", $_SERVER["REQUEST_URI"]);
        return trim($urlSegment[0], "/");
    }

    public static function method()
    {
        return $_SERVER["REQUEST_METHOD"];
    }
}