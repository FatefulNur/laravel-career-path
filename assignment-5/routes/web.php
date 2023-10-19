<?php

use App\Http\Controllers\FolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return view("welcome");
});

Route::get('/home', [FolioController::class, "index"]);
Route::get('/experiences', [FolioController::class, "experiences"]);
Route::get('/projects', [FolioController::class, "projects"]);
Route::get('/project/{projectId}', [FolioController::class, "project"]);
