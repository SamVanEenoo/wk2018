<?php
session_start();
include("../autoload.php");


$email = $_POST["email"];
$password = $_POST["password"]; 

	$user = new User();

	if($user->check('email',$email) == 0){  
		$output = json_encode(array(
	    	'status' => 'false',
	    	'msg' => 'Email/Password combination is incorrect. Please try again.'
	    ));
	    die($output);

	} else {
		$userid = $user->login($email,$password);

		if($userid != "false"){
		    $_SESSION["userid"] = $userid;
			$output = json_encode(array(
	    		'status' => 'true'
		    ));
		    die($output);
		}else{
			$output = json_encode(array(
		    	'status' => 'false',
		    	'msg' => 'Email/Password combination is incorrect. Please try again.'
		    ));
		    die($output);
		}
	}
?>