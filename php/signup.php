<?php
include("../autoload.php");

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$password1 = $_POST["password1"];

if(empty($firstName) or empty($lastName) or empty($email) or empty($password1)){

	$output = json_encode(array(
      'message' => 'Please fill in all fields.'
    ));
    die($output);

}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

    $output = json_encode(array(
      'message' => 'Please enter a valid email address.'
    ));
    die($output);

}else{

	$user = new User();

	if($user->check('email',$email) > 0){    

		$output = json_encode(array(
      	  'message' => 'This email address is already registered.'
	    ));
	    die($output);

	}else {

		$user->add($firstName,$lastName,$email,$password1);

	    $output = json_encode(array(
	       'message' => 'You signed up succesfully.<br />You can now login.'
	    ));
	    die($output);
	}
	
}
?>