<?php
    $serverType = "localhost";
    $dbName = "php_class";
    $dbUsername = "root";
    $dbPassword = "37858023";

    try{
        $pdo = new PDO("mysql:host=$serverType;dbname=$dbName", $dbUsername, $dbPassword);

    }catch(Exception $error){
        echo $error;
    }


?>