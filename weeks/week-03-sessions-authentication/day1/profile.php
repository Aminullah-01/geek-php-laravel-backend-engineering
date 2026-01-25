<?php
    session_start();
    unset($_SESSION['email']);
    echo "Hi, ".$_SESSION['name']. (isset($_SESSION['email']) ?? "Email not exist") . "welcome to our php class";