<?php
require "conn.php";
if(!isset($_SESSION['email'])){
    header("location:login.php?message=Sorry you can't access the profile without login");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Hi, <b><?= $_SESSION['username'] ?></b> Welcome to your dashboard and your email is <b><?= $_SESSION['email'] ?></b></p>



    <a href="logout.php">Log out</a>
</body>
</html>