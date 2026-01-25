<?php
    include "conn.php";

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $errors = [];
        
        $username = trim($_POST['username']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        if(empty($username)) $errors[] = "Username is not be empty";
        if(empty($email)) $errors[] = "email is not be empty";
        if(empty($password)) $errors[] = "password is not be empty";

        if(empty($errors)){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            try{
                $insert = $db->query("INSERT INTO users(`users`, `email`, `password`) VALUES('$username', '$email', '$hashed_password')");

                if($insert){
                    echo "Record inserted successful !";
                }
                else{
                    $errors[] = "Database error";
                }
            }catch(Exception $error){
                echo "Internal server error";
            }
            
        }else{
            foreach($errors as $error){

                echo $error."<br/>";
            }
        }
        
    }
?>


<form method="POST">
<input type="text" name="username" placeholder="Username">
<input type="email" name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">
<button type="submit" name="submit">Register</button>
</form>