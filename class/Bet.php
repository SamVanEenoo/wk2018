<?php
class Bet {

  private $db;
  private $userid;

  public function __construct($id = 1){
	$this->db =  new Database();
	$this->id = $id;
  }
  
  public function setUserId($userid){
    $this->userid = $userid;
  }
  
  public function getRightBets($gameid,$odd){
    $this->db->bind("gameid",$gameid);
    $this->db->bind("odd",$odd);
    return $this->db->query("SELECT * FROM bet WHERE gameid = :gameid AND odd = :odd");
  }
  
//  public function getGameBets($gameid){
  //  $this->db->bind("gameid",$gameid);
  //  return $this->db->query("SELECT * FROM bet INNER JOIN ek_user ON bet.userid=ek_user.id WHERE bet.gameid = :gameid ORDER BY ek_user.punten DESC");
//  }
  
  public function getOdd($wid){
    $this->db->bind("userid",$this->userid);
    $this->db->bind("wid",$wid);
    return $this->db->single("SELECT odd FROM bet WHERE userid = :userid AND gameid = :wid");
  }
  
  public function updateOdd($wid,$odd){
    $this->db->bind("wid",$wid);
    $this->db->bind("odd",$odd);
    $this->db->bind("userid",$this->userid);
    $this->db->query("UPDATE bet SET odd = :odd WHERE gameid = :wid AND userid = :userid");
  }
  
  public function addbet($wid,$odd){
    $this->db->bind("wid",$wid);
    $this->db->bind("odd",$odd);
    $this->db->bind("userid",$this->userid);
    $this->db->query("INSERT INTO bet(gameid,userid,odd) VALUES (:wid,:userid,:odd)");
  }
  
  public function getBetAmount($gameid){
    $this->db->bind("userid",$this->userid);
    $this->db->bind("gameid",$gameid);
    return $this->db->single("SELECT count(*) FROM bet WHERE gameid = :gameid AND userid = :userid");
  }
  
  public function getDatum($wid){
    $this->db->bind("userid",$this->userid);
    $this->db->bind("wid",$wid);
    return $this->db->single("SELECT datum FROM bet WHERE userid = :userid AND gameid = :wid");
  }

}
?> 