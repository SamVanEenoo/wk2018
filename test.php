<?php
session_start();
include("autoload.php");

$user = new User();
$userid = $user->login("sam_van_eenoo@hotmail.com","D@rkkn8s1989");

echo $userid;

echo $_SESSION["userid"]
?>