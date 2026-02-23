<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Termwind\Components\Raw;

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
        Route::get("/users", function(){
            return "This user page";
        });
        Route::get("/user/{id}", function($id){
            return "This user page with id: " . $id;
        })->whereNumber("id");
            Route::get("/user/{name}", function($name){
                return "This user page with name: " . $name;
            })->whereIn("name", ['John', 'Jane', 'Doe']);
        });
    });
});

Route::get("/welcome", function(){
    return to_route("site.home");
});