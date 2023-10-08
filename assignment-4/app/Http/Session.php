<?php

namespace App\Http;

class Session
{
    public static function put(string $name, string $value): void
    {
        if (!isset($_SESSION[$name])) {
            $_SESSION[$name] = $value;
        }
    }

    public static function get(string $name): ?string
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }

        return null;
    }

    public static function forget(string $name): void
    {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }

    public static function destory(): void
    {
        if(session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
            session_regenerate_id();
        }
    }
}
