<?php

include(SITE_ROOT . "/context/db.php");
$errMsg = '';
$id = '';
$name = '';
$description = '';
$topics = selectAll('category');
$repeatName='';
$email = selectOne('user',['id'=>$_SESSION['id']]);
if (selectOne('ordep',['email'=>$email['email']])) {
    $order = selectOne('ordep',['email'=>$email['email']]);
}
else{
    $order = '';
}

//Создание категории
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])) {
    $name = trim($_POST['name']);//trim удаляет пробелы
    $description =trim( $_POST['description']);
 //    $pass = password_hash($_POST['repeat_password'], PASSWORD_DEFAULT);
    if ($name ==='' ||$description ==='') {
        $errMsg = "Не все поля заполнены!";
    }
    elseif(mb_strlen($name,'UTF8')<2){ //валидация длины логина
        $errMsg = "Категория должен быть юолее 2-х символов";
    }
    else {
         // ассоциативный массив, для работы с функциями базы данных
         $existance = selectOne('category',['name'=>$name]);
         if ($existance['name']==$name) {
            $errMsg = "Такая категория уже есть в базе данных";
         }
         else{
            $topic = [
                'name' => $name,
                'description' => $description,
              ];
              $id = Insert('category',$topic);
              $topic = selectOne('category',['id'=>$id]);
              header('location:' . BASE_URL . 'admin/topics/index.php');
         }
    }
}
else {
    $name = '';
    $description ='';
}
//редактирование категории 
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectOne('category',['id'=>$_GET['id']]);
    $id = $topic['id']; 
    $name = $topic['name'];
    $description = $topic['description'];
}

if ($_SERVER['REQUEST_METHOD']=== 'POST' && isset($_POST['topic-edit'])) {
    $id = $_POST['id'];
    $namerep =$_POST['namerep'];
    $name = trim($_POST['name']);//trim удаляет пробелы
    $description =trim( $_POST['description']);
 //    $pass = password_hash($_POST['repeat_password'], PASSWORD_DEFAULT);
    if ($name ==='' ||$description ==='') {
        $errMsg = "Не все поля заполнены!";
    }
    elseif(mb_strlen($name,'UTF8')<2){ //валидация длины логина
        $errMsg = "Категория должен быть юолее 2-х символов";
    }
    else {
         // ассоциативный массив, для работы с функциями базы данных
         $existance = selectOne('category',['name'=>$name]);
         if (($name!==$namerep) && ($existance['name']==$name)) {
            $errMsg = "Такая категория уже есть в базе данных";
         }
         else{
            $topic = [
                'name' => $name,
                'description' => $description,
              ];
              $id = $_POST['id'];
              $topic_id = Update('category',$id,$topic);
              header('location:' . BASE_URL . 'admin/topics/index.php');
         }
    }
}
//Удаление категории
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    Delete('category',$_GET['del_id']);
    header('location:' . BASE_URL . 'admin/topics/index.php');

}

//Добавление в корзину товара(поста)
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['add_cart_button']) ) {

    $id = $_POST['id'];
    $post = selectOne('posts',['id'=> $id]);
    $user = selectOne('user',['id'=>$_SESSION['id']]);
    $count = selectOne('cart',['id'=>$id]);
    if (selectOne('cart',['id'=>$post['id']])) {
        if(selectOne('cart',['id'=>$id])){
         $count = selectOne('cart',['id'=>$id]);
         $idCart = update('cart',$id,['count'=>$count['count']+1]);
        }
        else{
         $idCart = update('cart',$id,['count'=>1]);
        }
    }
    else{
    if ($order === '') {
        $order = [
            'email' => $user['email'],
            'buy_date'=>time(),
          ];
          $orderCart = [
            'email' => $user['email'],
            'buy_date'=>time(),
            'id'=>$id,
          ];
          $id = Insert('ordep',$order);
          $idCart = Insert('cart',$orderCart);
          

    }
    else{
        $orderCart = [
            'email' => $user['email'],
            'buy_date'=>$order['buy_date'],
            'id'=>$id,
          ];
          $idCart = Insert('cart',$orderCart);
    }
}
}
