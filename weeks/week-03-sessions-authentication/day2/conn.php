<?php
    session_start();
    $db = mysqli_connect("localhost", "root", "37858023", "php_class");

    if($db){
        return $db;
    }
    else{
        echo "error to connect";
    }