<?php

namespace App\Http\Controller;

use App\Http\Request;
use App\Http\Session;
use App\Responses\ErrorResponse;
use App\Service\CustomerService;
use App\User\Customer;

class DashboardController
{
    private CustomerService $bank;
    private Customer $authUser;

    public function __construct() {
        if(
            is_null(Session::get("auth_user")) ||
            Session::get("is_admin")
        ) {
            header("Location: /");
        } 
        
        $this->authUser = unserialize(Session::get("auth_user"));
        $this->bank = new CustomerService;
    }
    public function index()
    {
        $balance = $this->bank->balance($this->authUser);
        $response = $this->bank->transactions($this->authUser);

        if($response instanceof ErrorResponse) {
            $response = []; 
        }

        return view("customer/dashboard", compact("balance", "response"));
    }

    public function viewDeposit()
    {
        $balance = $this->bank->balance($this->authUser);

        return view("customer/deposit", compact("balance"));
    }

    public function deposit()
    {
        $amount = Request::get("amount");
        $response = $this->bank->deposit($this->authUser, $amount);
        Session::put("response", $response->getMessage());

        if($response instanceof ErrorResponse) {
            header("Location: /" . Request::currentURL());
            return;
        }

        header("Location: /dashboard");
    }

    public function viewTransfer()
    {
        $balance = $this->bank->balance($this->authUser);

        return view("customer/transfer", compact("balance"));
    }

    public function transfer()
    {
        $request = Request::only(["email", "amount"]);
        $response = $this->bank->transfer($this->authUser, $request);
        Session::put("response", $response->getMessage());

        if($response instanceof ErrorResponse) {
            header("Location: /" . Request::currentURL());
            return;
        }

        header("Location: /dashboard");
    }

    public function viewWithdraw()
    {
        $balance = $this->bank->balance($this->authUser);

        return view("customer/withdraw", compact("balance"));
    }
    
    public function withdraw()
    {
        $amount = Request::get("amount");
        $response = $this->bank->withdraw($this->authUser, $amount);
        Session::put("response", $response->getMessage());
        
        if($response instanceof ErrorResponse) {
            header("Location: /" . Request::currentURL());
            return;
        }

        header("Location: /dashboard");
    }
}