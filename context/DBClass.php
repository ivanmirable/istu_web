<?php
class DBClass{
 private $driver = "mysql";
 private $host = "localhost";
 private $db_name = "test_db";
 private $db_user = "root";
 private $db_pass = "";
 private $charset = 'utf8';
 private $link;


public function __construct(){
    $this->link = 
        mysqli_connect(
        $this->$host,
        $this->$db_user,
        $this->$db_pass,
        $this->$db_name);
}

function __destruct(){
    mysqli_close($this->link);
}

function InsertUser($login,$email = null,$password){
    $query = "INSERT INTO user (login,password,email) VALUES($login,$password,$email)";
}
}
