<?php
    
    include "conn.php";
    if(isset($_GET)){
        echo $_GET['message'];
    }
    if(isset($_SESSION['email'])){
        header("location:profile.php");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // TODO: Get user from database
        $result = $db->query("SELECT * FROM users WHERE users = '$username'");
        $user = mysqli_fetch_assoc($result);
        if($user && password_verify($password, $user['password'])){
            $_SESSION['username'] = $user['users'];
            $_SESSION['email'] = $user['email'];
            header("location:profile.php");
        }else{
            echo "invalid login details";
        }
        // print_r($user);
    }
?>

<form method="POST">
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>