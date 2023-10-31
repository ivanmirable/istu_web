<?php
require_once("context/DBClass.php");
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];

$login = isset($login) && empty($login)? $login: "Логин отсутсвтует";
$password = isset($password) && empty($password)? $password: "Введите пароль";


$db = new DBClass();
$db->InsertUser($login,$email,$password);

