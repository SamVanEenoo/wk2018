<?php
session_start();
include("autoload.php");
if(isset($_SESSION["userid"])){
	include("html/header.html");
	isset($_GET["id"]) ? $id = $_GET["id"] : $id = "";
	switch ($id) {
		case "ranking":
			include("inc/ranking.php");
		break;

		default:
			include("inc/home.php");
		break;
	}
	include("html/footer.html");
}else{
	include("html/signup.html");
}
?>