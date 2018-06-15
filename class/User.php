<?php
class User {

  private $db;

  public function __construct() {
    $this->db = new Database();
  }
  
  public function check($type,$value) {
    switch($type){
      case "email":
        $this->db->bind("email",$value);
        return $this->db->single("SELECT count(*) FROM user WHERE email = :email ");
      break;

      default:
        return 0;
      break;
    }
  }

  public function updatePaid($userid) {
    $this->db->bind("userid",$userid);
    $this->db->query("UPDATE user SET paid = 1 WHERE id = :userid");
  }
  
  public function add($firstName,$lastName,$email,$password) {
    $this->db->bind("firstName",$firstName);
    $this->db->bind("lastName",$lastName);
    $this->db->bind("email",$email);
    $this->db->bind("password",password_hash($password, PASSWORD_DEFAULT));
    $this->db->query("INSERT INTO user(firstName,lastName,email,password) VALUES(:firstName,:lastName,:email,:password)");
  }

  public function login($email,$password) {
    $this->db->bind("email",$email);
    $hash = $this->db->single("SELECT password FROM user WHERE email = :email ");
    if(password_verify($password,$hash)){
      $this->db->bind("email",$email);
      return $this->db->single("SELECT id FROM user WHERE email = :email");
    }else{
      return "false";
    }
  }

}
?>