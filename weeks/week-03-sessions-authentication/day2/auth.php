<?php

$password = "123456";

$password_encrypted = password_hash($password, PASSWORD_DEFAULT);
echo $password_encrypted."<br/>";

if(password_verify($password, $password_encrypted)){
    echo "The password is currected <br/>";
}else{
    echo "invalid password"."<br/>";
}