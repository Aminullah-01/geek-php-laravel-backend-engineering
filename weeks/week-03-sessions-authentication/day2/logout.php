<?php
    include "conn.php";

    session_destroy();
    header("location:login.php?message=You hav been logout from the system");
?>