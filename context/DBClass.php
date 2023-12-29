<?php
class DBClass{
 private $host = "2070010";
 private $db_name = "j95083k0_shop_db";
 private $db_user = "j95083k0";
 private $db_pass = "LJGGoGbXV8bs";


 private $link;


public function __construct(){
    $this->link = 
        mysqli_connect(
        $this->$host,
        $this->$db_user,
        $this->$db_pass,
        $this->$db_name
    );
}

function __destruct(){
    mysqli_close($this->link);
}

function InsertUser($login,$email = null,$password){
    $query = "INSERT INTO user (username,password,email) VALUES($login,$password,$email)";
}
}
