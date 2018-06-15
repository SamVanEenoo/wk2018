<?php
session_start();
include("../autoload.php");
$user = new User();

if($_POST){
  if(isset($_SESSION["userid"])){
  	if($_SESSION["userid"] == 1 or $_SESSION["userid"] == 4){
		$userid = $_POST["userid"];
		$user->updatePaid($userid);
		$output = json_encode(array('type'=>'success'));
  	}
  }  
}
?>