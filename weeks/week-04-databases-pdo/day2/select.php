<?php
include "index.php";

try{

    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();

    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach($records as $record){
        echo $record['users']."<br>";
        echo $record['email']."<br>";
        echo $record['password']."<br>";
        echo "<br/>";
    }

}catch(PDOException $error){
    print_r($error);
}