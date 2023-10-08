<?php

use App\Http\Controller\AccountController;
use App\Http\Controller\AdminController;
use App\Http\Controller\DashboardController;
use App\Http\Router\Route;

// Account Management Routes
Route::get("/", [AccountController::class, "index"]);
Route::get("/register", [AccountController::class, "viewRegister"]);
Route::get("/logout", [AccountController::class, "logout"]);
Route::post("/register", [AccountController::class, "register"]);
Route::post("/login", [AccountController::class, "login"]);

// Customers Dashboard Routes
Route::get("/dashboard", [DashboardController::class, "index"]);
Route::get("/dashboard/deposit", [DashboardController::class, "viewDeposit"]);
Route::get("/dashboard/transfer", [DashboardController::class, "viewTransfer"]);
Route::get("/dashboard/withdraw", [DashboardController::class, "viewWithdraw"]);
Route::post("/dashboard/deposit", [DashboardController::class, "deposit"]);
Route::post("/dashboard/withdraw", [DashboardController::class, "withdraw"]);
Route::post("/dashboard/transfer", [DashboardController::class, "transfer"]);

// Admin Management Routes
Route::get("/admin", [AdminController::class, "index"]);
Route::get("/admin/transactions", [AdminController::class, "viewTransactions"]);
Route::get("/admin/customer_transactions", [AdminController::class, "viewUserTransactions"]);
Route::get("/admin/add_customer", [AdminController::class, "viewAddCustomer"]);
Route::post("/admin/add_customer", [AdminController::class, "addCustomer"]);