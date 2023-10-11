<?php 

namespace App\Http\Router;

use App\Http\Request;

class Router
{
    protected static array $routes;

    protected static function register(array $data)
    {
        static::$routes[] = $data;
    }

    public static function run()
    {
        $requestURI = Request::currentURL(); 
        $requestMethod = Request::method(); 
        
        foreach (static::$routes as $route) {
            $URI = trim($route["path"], "/");
            $method = $route["method"];

            if(
                $URI === $requestURI &&
                $method === $requestMethod
            ) {
                [$controller, $action] = $route["action"] ?? [null, null];

                if($controller && $action) {
                    return (new $controller)->$action();
                }
            }
        }

        http_response_code(404);
        return view("not-found");
    }
}