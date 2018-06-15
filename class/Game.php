<?php
class Game {

  private $db;

  public function __construct() {
    $this->db = new Database();
  }
  
  public function getActiveGames() {
    return $this->db->query("SELECT * FROM game ORDER BY starttime ASC");
  }

  public function getDatum($id) {
    $this->db->bind("id",$id);
    return $this->db->single("SELECT starttime FROM game WHERE id = :id");
  }

}
?>