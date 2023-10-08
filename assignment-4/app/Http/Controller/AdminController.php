<?php

namespace App\Http\Controller;

use App\Http\Request;
use App\Http\Session;
use App\Responses\ErrorResponse;
use App\Service\AdminService;
use App\User\Admin;

class AdminController
{
    private AdminService $bank;
    private Admin $authUser;

    public function __construct() {
        if(
            is_null(Session::get("auth_user")) ||
            !Session::get("is_admin")
        ) {
            header("Location: /");
        } 
        
        $this->authUser = unserialize(Session::get("auth_user"));
        $this->bank = new AdminService;
    }

    public function index()
    {
        $response = $this->bank->customers();

        if($response instanceof ErrorResponse) {
            $response = []; 
        }

        return view("admin/customers", compact("response"));
    }

    public function viewTransactions()
    {
        $response = $this->bank->transactions($this->authUser);

        if($response instanceof ErrorResponse) {
            $response = []; 
        }
        
        return view("admin/transactions", compact("response"));
    }

    public function viewUserTransactions()
    {
        $email = Request::query("email");
        $name = $this->bank->getUserNameByEmail($email);
        
        $response = $this->bank->userTransactions($email);

        if($response instanceof ErrorResponse) {
            $response = []; 
        }

        return view("admin/customer_transactions", compact("response", "name"));
    }
    
    public function viewAddCustomer()
    {
        return view("admin/add_customer");
    }
    
    public function addCustomer()
    {
        $request = Request::only(["first_name", "last_name", "email", "password"]);
        $response = $this->bank->addCustomer($request);
        Session::put("response", $response->getMessage());
        if($response instanceof ErrorResponse) {
            header("Location: /" . Request::currentURL());
            return;
        }

        header("Location: /admin");
    }
}