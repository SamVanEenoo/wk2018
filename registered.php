<?php
session_start();
include("autoload.php");
if(isset($_SESSION["userid"])){
	include("html/header.html");
	if($_SESSION["userid"] == 1 OR $_SESSION["userid"] == 4){
		include("inc/registered.php");
	}
	include("html/footer.html");
}
?>