<?php
include_once "Connection.php";

class user{
    private $username;
    private $faves;
    private $email;
    public function __construct($uname, $password) {
        $con = Connection::getInstance();
        $encpassword = md5($password);
        $res = $con->query("select * from users where users_Name='$uname' and users_Password='$encpassword';")->fetch();
        if (gettype($res)!=="boolean"){
            $this->email = $res[0];
            $this->username = $res[1];
            $this->faves = explode(" ",$res[3]);
        }
        else{
            echo "Incorrect Username or Password";
        }
    }

    public function getName(){return $this->username;}
    public function getFaves(){return $this->faves;}
    public function getEmail(){return $this->email;}

    public function isVerified(){
        $con = Connection::getInstance();
        $res = $con->query('select * from inactivate_users where username="'.$this->username.'"')->fetchall();
        if(sizeof($res)>0){
            return false;
        }
        else{
            return true;
        }
    }
}
?>