<?php

include(SITE_ROOT . "/context/db.php");
$errMsg = '';
$id = '';
$name = '';
$description = '';
$topics = selectAll('category');
$repeatName='';
$buy_date = '';
$email = selectOne('user',['id'=>$_SESSION['id']]);
$order = selectOne('ordep',['email'=>$email['email'],
'buy_date'=>$_SESSION['buy_date'],
]);

if ($order) {
    $order = selectOne('ordep',['email'=>$email['email'],
    'buy_date'=>$_SESSION['buy_date'],]);
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
    $cartFilter = [
        'id'=>$id,
        'email'=>$user['email'],
        'buy_date'=>$_SESSION['buy_date'],
    ];
    if (selectOne('cart',$cartFilter) && selectOne('ordep',['buy_date'=>$_SESSION['buy_date']]) ) {

        if(selectOne('cart',['id'=>$id, 'buy_date'=>$_SESSION['buy_date']])){
         $count = selectOne('cart',['id'=>$id,'buy_date'=>$_SESSION['buy_date']]);
         $idCart = UpdateCartCount('cart',$id,['count'=>$count['count']+1],$_SESSION['buy_date']);
        }
    }
    else{
    if ($order === '') {

        $order = [
            'email' => $user['email'],
            'buy_date'=>$_SESSION['buy_date'],
          ];

          $orderCart = [
            'email' => $user['email'],
            'buy_date'=> $_SESSION['buy_date'],
            'id'=>$id,
            'count'=>1
          ];
          $id = Insert('ordep',$order);
          $idCart = Insert('cart',$orderCart);
    }
    else{


        $orderCart = [
            'email' => $user['email'],
            'buy_date'=>$_SESSION['buy_date'],
            'id'=>$id,
            'count'=>1
        ];
     
          $idCart = Insert('cart',$orderCart);
    }

}
header('location:' . BASE_URL . 'index.php');

}
else{
    echo 'GET';
}

//Удаление из Корзины
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['deleted_id'])) {
    $id = $_GET['deleted_id'];
    $user = selectOne('user',['id'=>$_SESSION['id']]);
    $buy_date = (string)$_SESSION['buy_date'];
    DeleteCart('cart',$id,$user['email'],$buy_date);
    header('location:' . BASE_URL . '1.php');
}
//управление количеством товара
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['upcount_id'])) {

    $id = $_GET['upcount_id'];
    $user = selectOne('user',['id'=>$_SESSION['id']]);
    $count = selectOne('cart',['id'=>$id,'buy_date'=>$_SESSION['buy_date']]);
   $idCart = UpdateCartCount('cart',$id,['count'=>$count['count']+1],$_SESSION['buy_date']);
    header('location:' . BASE_URL . '1.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['downcount_id'])) {

    $id = $_GET['downcount_id'];
    $user = selectOne('user',['id'=>$_SESSION['id']]);
    $count = selectOne('cart',['id'=>$id,'buy_date'=>$_SESSION['buy_date']]);
    if ($count['count']<=1) {
        $errMsg = "Минимальное допустимое количество товара";
    }
    else{
    $idCart = UpdateCartCount('cart',$id,['count'=>$count['count']-1],$_SESSION['buy_date']);
    header('location:' . BASE_URL . '1.php');
    }
}
//Оформление заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay_button'])) {
    $sum = 0;
    $pay = $_POST['pay_method'];
    $oplata = time();
    $adress = $_POST['adress'];
    $buy_date = (string)$_SESSION['buy_date'];
    $email = selectOne('user',['id'=>$_SESSION['id']]);
    $posts = selectAllFromPostsWithCart('posts','cart',$buy_date,$email['email']);
    if ($posts) {
        foreach($posts as $post){
            $sum = $sum + $post['price'];
      }
      $transaction = [
          'transaction_number'=>$oplata,
          'pay_method'=>$pay,
          'pay_sum'=>$sum,
      ];
  
      $transaction = Insert('transaction',$transaction);
      $ordep = [
          'adress_pickup'=>$adress,
          'transaction_number'=>$oplata,
      ];
      $r = UpdateForOrdep('ordep',$email['email'],$ordep,$buy_date);
       $_SESSION['buy_date'] = time();
          $order = [
              'email' => $email['email'],
              'buy_date'=> $_SESSION['buy_date'],
            ];
          $order = Insert('ordep',$order);
    }
    else{
        $errMsg = "Не выбрано ни одного товара!";
    }
 
}

