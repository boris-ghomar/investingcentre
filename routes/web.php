<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::controller(CustomerController::class)->name("customer.")->group(function () {
    Route::get("/", "index")->name("dashboard");
    Route::post("/logout", "logout")->name("logout");

    Route::get("/login", "login")->name("login");
    Route::post("/login", "authorize")->name("authorize");

    Route::get("/register", "register")->name("register");
    Route::post("/register", "register")->name("register");

    Route::get("/registration-success", "registrationSuccess")->name("registration-success");
});

