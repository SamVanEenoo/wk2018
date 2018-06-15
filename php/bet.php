<?php
session_start();
include("../autoload.php");
$bet = new Bet();
$game = new Game();

if($_POST){
  
  if(isset($_SESSION["userid"])){
	  $bet->setUserId($_SESSION["userid"]);
	  $actiontype = $_POST["action-type"];
	  $actiontype = "add-bet";
	  
	  if($actiontype == "add-bet"){
		$wedstrijdid = $_POST["wedstrijdid"];
		$oddid = $_POST["oddid"];

		if(time() < strtotime($game->getDatum($wedstrijdid))){
			if($bet->getBetAmount($wedstrijdid) > 0){
			  $bet->updateOdd($wedstrijdid,$oddid);
			}else{
			  $bet->addBet($wedstrijdid,$oddid);
			}
			
			$output = json_encode(array('type'=>'success','wid' => $wedstrijdid, 'oddid' => $oddid));
			die($output);	
		}else{
			$output = json_encode(array('type'=>'info', 'txt' => 'It is too late to bet on this game.'));
		}
		
	  }else{
		$output = json_encode(array('type'=>'fail', 'txt' => 'Fout'));
		die($output);
	  }
  }else{
	$output = json_encode(array('type'=>'info', 'txt' => 'You are logged out. Please <a href=\"index.php\">login</a>.'));  
  }
  die($output);
}
?>