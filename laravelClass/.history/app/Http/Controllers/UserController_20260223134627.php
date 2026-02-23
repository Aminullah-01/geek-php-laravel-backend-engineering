<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Vi
    {
        //
        $users = [
            ['name' => 'John', 'email' => 'H6h1w@example.com', 'id' => 1],
            ['name' => 'Jane', 'email' => 'H6h1w@example.com', 'id' => 2],
            ['name' => 'John', 'email' => 'H6h1w@example.com', 'id' => 3],
            ['name' => 'Jane', 'email' => 'H6h1w@example.com', 'id' => 4],
        ];
        return view("user.index", [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return "I'm here to create new record";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
