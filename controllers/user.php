<?php
 include("context/db.php");
 require("path.php");
    $errMsg = '';
    $errLogin ='';
    $errEmail ='';
    $errPass ='';
// Код для формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {

    $login = trim($_POST['login']);//trim удаляет пробелы
    $email =trim( $_POST['email']);
    $passF = trim($_POST['repeat_password']);
    $passS = trim($_POST['password']);
    $findEl = '';
 //    $pass = password_hash($_POST['repeat_password'], PASSWORD_DEFAULT);
    $admin = 0;
    $findEl = selectOnePeace('user',['email'=>$email],'email');

    if ($findEl !== '') {
        $errMsg = "Пользователь с таким email уже существует!";
    }
    if ($login ==='' ||$email ==='' ||$passF ==='') {
        $errMsg = "Не все поля заполнены!";
        if ($login ==='') {
            $errLogin = "Введите логин!";
        }
        if ($email ==='') {
            $errEmail = "Введите email!";
        }
        else{ 
            $errPass = "Введите пароль!";
        }
    }elseif ($findEl['email']=== $email) {
        $errMsg = "Пользователь с таким email уже существует!";
    }
    elseif(mb_strlen($login,'UTF8')<2){ //валидация длины логина
        $errMsg = "Логин должен быть юолее 2-х символов";
    }
    elseif($passF!==$passS){
       $errMsg = "Пароли в обеих полях должны совпадать!"; 
    }
    else {
         // ассоциативный массив, для работы с функциями базы данных
         $pass = password_hash($passF,PASSWORD_DEFAULT);
        $post = [
            'admin' => $admin,
            'username' => $login,
            'email' => $email,
            'password'=> $pass
          ];
        $id = Insert('user',$post);
        $user = selectOne('user',['id'=>$id]);
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['username'];
        $_SESSION['admin'] = $user['admin'];

        if ($_SESSION['admin']) {
            header('location:'. BASE_URL . "admin/posts/index.php");
        }
        else{
            header('location: ' . BASE_URL);
        }
    }

}
else {

    $login = '';
    $email ='';
}

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['button-log'])) {

    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    if ($email ==='' || $pass==='') {
        $errMsg = "Не все поля заполнены";
    }
    else{
        $existance = selectOne('user',['email'=>$email]);// массив с пользователем
        if ($existance && password_verify($pass, $existance['password'])) {
            $_SESSION['id'] = $existance['id'];
            $_SESSION['login'] = $existance['username'];
            $_SESSION['admin'] = $existance['admin'];
    
            if ($_SESSION['admin']) {
                header('location:'. BASE_URL . "admin/posts/index.php");
            }
            else{
                header('location: ' . BASE_URL);
            }
        }else{
            $errMsg = "Данные не верные";
        }
    }

}else{
    $email ='';
}
