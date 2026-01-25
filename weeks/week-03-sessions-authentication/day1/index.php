<?php
    session_start();

    $_SESSION['name'] = "Muhammad Adamu";
    $_SESSION['email'] = "muhmmad@gmail.com";
    $_SESSION['phone_number'] = "08037589034";

    // header("location:profile.php");

    #cookie

    setcookie("name", "Abubakar Sadiq");

    echo $_COOKIE['name'];

    setcookie("name", "");

    echo $_COOKIE['name']. "Is deleted";
?>