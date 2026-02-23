<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view("welcome");
});


Route::get("register/user/{id}", function($id){
    $user = ['name' => 'John', 'email' => 'H6h1w@example.com', 'id' => $id];
    return view("user.resgister")->with(['user' => $user, 'id' => $id]);
});

Route::get("user/record", [UserController::class, 'index']);
Route::get("user/create", [UserController::class, 'create'])->name("user.create");


Route::name()