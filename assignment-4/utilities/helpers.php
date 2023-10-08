<?php

use App\Enum\TransactionType;
use App\Http\Request;

if(!function_exists('view')) {
    function view(string $path, array $data = []): void {
        extract($data);
        require_once __DIR__ . "/../resources/views/{$path}.php";
    }
}

if(!function_exists('database_path')) {
    function database_path(): string {
        return __DIR__ . "/../database/";
    }
}

if(!function_exists('dashboard_active_menu_styles')) {
    function dashboard_active_menu_styles(string $path): string {
        if(Request::currentURL() === trim($path, "/")) {
            return "bg-emerald-700 text-white ";
        }
        return "text-white hover:bg-emerald-500 hover:bg-opacity-75 ";
    }
}

if(!function_exists('admin_active_menu_styles')) {
    function admin_active_menu_styles(string $path): string {
        if(Request::currentURL() === trim($path, "/")) {
            return "bg-sky-700 text-white ";
        }
        return "text-white hover:bg-sky-500 hover:bg-opacity-75 ";
    }
}

if(!function_exists('get_amount_styles')) {
    function get_amount_styles($transaction): string {
        if(
            $transaction->getTransactionType() === TransactionType::DEPOSIT ||
            $transaction->getTransactionType() === TransactionType::RECEIVE
        ) {
            return " text-emerald-600";
        }
        return " text-red-600";
    }
}

if(!function_exists('is_balance_added')) {
    function is_balance_added($transaction): string {
        if(
            $transaction->getTransactionType() === TransactionType::DEPOSIT ||
            $transaction->getTransactionType() === TransactionType::RECEIVE
        ) {
            return true;
        }
        return false;
    }
}

if(!function_exists('get_acronym_word')) {
    function get_acronym_word(string $words): string {
        $word = explode(" ", $words);
        $acronymArr = array_map(fn($i) => substr($i, 0, 1), $word);
        return strtoupper(join("", $acronymArr));
    }
}

if(!function_exists('config')) {
    function config(string $name): stdClass {
        return (object) require_once __DIR__ . "/../config/{$name}.php";
    }
}