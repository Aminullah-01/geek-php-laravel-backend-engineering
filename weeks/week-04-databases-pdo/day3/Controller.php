<?php

class Controller{

    protected function index(){
        return "Hello world";
    }

    public function store(){
        return $this->index();
    }
}

class Auth extends Controller{

    public $conn;
    public function __construct($dbName)
    {
        $this->conn = new PDO("mysql:localhost;dbname=$dbName", "root", "37858023");
    }
    public function update()
    {
        return $this->conn->query("SELECT * FROM users");
    }
}
$class = new Auth("book_managment");
echo $class->update();
