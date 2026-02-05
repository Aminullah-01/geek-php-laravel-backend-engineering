<?php
include "index.php";

try{

    $stmt = $pdo->prepare("INSERT INTO users(`users`,`email`, `password`) VALUES(:users, :email, :password)");

    $stmt->execute([
        ':users' => "Muhammadedd",
        ':email' => "muhmmad@gmail.comddd",
        ':password' => 12345,
    ]);
    echo "Insterted successful";
}catch(PDOException $error){
    print_r($error);
}