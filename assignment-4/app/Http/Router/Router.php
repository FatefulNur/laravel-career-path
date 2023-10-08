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

    public static function run(): void
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
                [$controller, $action] = $route["action"];
                (new $controller)->$action();
                return;
            }
        }

        http_response_code(404);
        throw new \Exception("Page Not Found", 404);
    }
}