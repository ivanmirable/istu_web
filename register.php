<?php
require_once("/index2.php");
$db = new DBClass();
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];

$login = isset($login) && empty($login)? $login: "Логин отсутсвтует";
$password = isset($password) && empty($password)? $password: "Введите пароль";

$db->InsertUser($login,$email,$password);

