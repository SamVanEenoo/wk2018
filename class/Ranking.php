<?php
class Ranking {

  private $db;

  public function __construct() {
    $this->db = new Database();
  }

  public function getRanking() {
    return $this->db->query("SELECT u.firstname, u.lastname, u.paid, f.total FROM user u LEFT JOIN ( SELECT a.userid, SUM(a.result) total FROM ( SELECT b.userid, g.won, g.odd1, g.odd2, g.oddx, b.odd, (CASE b.odd WHEN 'odd1' THEN g.odd1 WHEN 'odd2' THEN g.odd2 ELSE g.oddx END ) result FROM bet b LEFT JOIN game g ON g.id = b.gameid WHERE b.odd = g.won ) AS a GROUP BY a.userid) AS f ON u.id = f.userid ORDER BY f.total DESC");
  }

}
?>
