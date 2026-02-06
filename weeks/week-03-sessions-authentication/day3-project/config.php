<?php
session_start();


$db = mysqli_connect("localhost", "root", "", "auth_system");

if($db){
    echo "";
}
else{
    echo "Not connected";
}

?>