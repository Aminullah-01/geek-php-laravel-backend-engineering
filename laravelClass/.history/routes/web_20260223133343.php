<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;




Route::get("register/user/{id}", function($id){
    $user = ['name' => 'John', 'email' => 'H6h1w@example.com', 'id' => $id];
    return view("user.resgister")->with(['user' => $user, 'id' => $id]);
});

Route::get("user/record", [UserController::class, 'index']);
Route::get("user/create", [UserController::class, 'create'])->name("user.create");


Route::name("site.")->prefix("site")->group(function(){
    Route::get("/", function(){
        return "Welcome";
    })->name("home");

    Route::prefix("admin")->name("admin.")->group(function(){
        Route::get("users", function(){
            return "This user page";
        });
    });
});

Route::get("/welcome", function(){
    return to_route("site.home");
});