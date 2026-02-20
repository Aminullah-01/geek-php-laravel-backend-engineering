<?php
require "config.php";
require_once "classes/UserRepository.php";
require_once "classes/AuthService.php";

$userRepo = new UserRepository($pdo);
$auth = new AuthService($userRepo);

$auth->logout();
header("Location: login.php");
exit;


?>