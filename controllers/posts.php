<?php

include(SITE_ROOT . "/context/db.php");
$errMsg = '';
$id = '';
$tittle = '';
$price = '';
$img = '';
$topic ='';

$topics = selectAll('category');
$posts = selectAll('posts');

$postsAdm = selectAllFromPostsWithUsers('posts','user');



//Создание записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) { 

    if (!empty($_FILES['img']['name'])) {
        $imgName =time() . "_" .  $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\images\posts\\" . $imgName;
        if (strpos($fileType, 'image')===false) {
            die("Можно загружать только изображения");
        }

        $result = move_uploaded_file($fileTmpName,$destination);

        if ($result) {
            $_POST['img'] = $imgName;
        }else{
            $errMsg = "Ошибка загрузки картинки на сервер ";
        }
    }
    else{
        $errMsg = "Ошибка загрузки картинки";
    }

    $tittle = trim($_POST['tittle']);//trim удаляет пробелы
    $price =trim( $_POST['price']);
    $topic =trim( $_POST['topics']); 
    $img = trim($_POST['img']);
    $publish = isset( $_POST['publish']) ? 1 : 0;

     //    $pass = password_hash($_POST['repeat_password'], PASSWORD_DEFAULT);
    if ($tittle ==='' ||$price ===''|| $topic ==='' ) {
        $errMsg = "Не все поля заполнены!";
    }
    elseif(mb_strlen($tittle,'UTF8')<2){ //валидация длины логина
        $errMsg = "Наименование товара должно быть юолее 2-х символов";
    }
    else {

            $post = [
               'admin'=>$_SESSION['id'],
                'tittle' => $tittle,
                'img'=>$img,
                'price' => $price,
                'status'=>$publish,
                'category'=>$topic
              ];
        
              $post = Insert('posts',$post);
              $post = selectOne('posts',['id'=>$id]);
              header('location:' . BASE_URL . 'admin/posts/index.php');
    }
}
else {
    $tittle = '';
    $price ='';
    $publish = '';
    $topic='';
}
//редактирование Товара
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $post = selectOne('posts',['id'=>$_GET['id']]);
    $id = $post['id'];
    $tittle =$post['tittle'];
    $price = $post['price'];
    $topic = $post['category'];
    $publish = $post['status'];
}

if ($_SERVER['REQUEST_METHOD']=== 'POST' && isset($_POST['edit_post'])) {

    $tittle = trim($_POST['tittle']);//trim удаляет пробелы
    $price =trim( $_POST['price']);
    $topic =trim( $_POST['topics']); 

    $publish = isset( $_POST['publish']) ? 1 : 0;

    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . "_" .  $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\images\posts\\" . $imgName;
        if (strpos($fileType, 'image')===false) {
            die("Можно загружать только изображения");
        }

        $result = move_uploaded_file($fileTmpName,$destination);

        if ($result) {
            $_POST['img'] = $imgName;
        }else{
            $errMsg = "Ошибка загрузки картинки на сервер ";
        }
    }
    else{
        $errMsg = "Ошибка загрузки картинки";
    }

     //    $pass = password_hash($_POST['repeat_password'], PASSWORD_DEFAULT);
    if ($tittle ==='' ||$price ===''|| $topic ==='' ) {
        $errMsg = "Не все поля заполнены!";
    }
    elseif(mb_strlen($tittle,'UTF8')<2){ //валидация длины логина
        $errMsg = "Наименование товара должно быть юолее 2-х символов";
    }
    else {

            $post = [
               'admin'=>$_SESSION['id'],
                'tittle' => $tittle,
                'img'=>$_POST['img'],
                'price' => $price,
                'status'=>$publish,
                'category'=>$topic
              ];
        
              $post = update('posts',$_POST['id'],$post);
              header('location:' . BASE_URL . 'admin/posts/index.php');
    }
}
else {
    $tittle = $_POST['tittle'];
    $price =$_POST['price'];
    $publish = isset($_POST['publish']) ? 1 : 0;
    $topic=$_POST['category'];
}
//удаление товара
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    Delete('posts',$_GET['delete_id']);
    header('location:' . BASE_URL . 'admin/posts/index.php');
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
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {

    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update('posts',$id,['status'=> $publish]);
    header('location:' . BASE_URL . 'admin/posts/index.php');

}
//Удаление категории
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    Delete('category',$_GET['del_id']);
    header('location:' . BASE_URL . 'admin/topics/index.php');
    exit();
}