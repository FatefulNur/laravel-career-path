<?php

namespace App\Http\Controller;

use App\Http\Request;
use App\Http\Session;
use App\Responses\ErrorResponse;
use App\Service\AccountService;

class AccountController
{
    private AccountService $account;

    public function __construct() {
        if(!is_null(Session::get('redirectTo'))) {
            header("Location: " . Session::get("redirectTo"));
        }

        $this->account = new AccountService;
    }

    public function index()
    {
        return view("login");
    }

    public function viewRegister()
    {
        return view("register");
    }

    public function register(): void
    {
        $request = Request::only([
            "name", "email", "password"
        ]);
        
        $response = $this->account->create($request);
        Session::put("response", $response->getMessage());

        if($response instanceof ErrorResponse) {
            header("Location: /" . Request::currentURL());
            return;
        } 

        header("Location: /");
        return;
    }

    public function login(): void
    {
        $request = Request::only([
            "email", "password"
        ]);            

        $response = $this->account->authenticate($request);
        if($response instanceof ErrorResponse) {
            Session::put("response", $response->getMessage());
            header("Location: /");
            return;
        } 
        
        Session::put("redirectTo", $response::redirectPath());
        Session::put("auth_user", serialize($response));
        Session::put("auth_username", $response->getName());
        Session::put("auth_useremail", $response->getEmail());
        Session::put("is_admin", $response->isAdmin($response->getRole()));

        header("Location: " . Session::get("redirectTo"));
        return;
    }

    public function logout(): void
    {
        Session::destory();
    }
}