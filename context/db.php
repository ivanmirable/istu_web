<?php

session_start();
require('index2.php');
function tt($value){
   echo '<pre>';
   print_r($value);
   echo'</pre>';
   exit();
}

// Запрост а получение данных из одной таблицы
function selectAll($table,$params =[]){
   global $connection;
   $sql = "SELECT * FROM $table ";
   if (!empty($params)) {
      $i=0;
      foreach($params as $key => $value){
         if (!is_numeric($value)) {
            $value = "'".$value."'";// конкотенация для того чтобы форич формировал правильный запрос с одинарными ковычками 
         }
         if ($i === 0) {
            $sql = $sql . " WHERE  $key = $value";
         }
         else{
            $sql = $sql . " AND $key = $value"; 
         }
         $i++;
      }
   }

   $query = $connection->prepare($sql);
   $query->execute();
  dbCheckError($query);
   $date = $query->fetchAll();
  return $date;
}
// поиск по заголовкам
function search($text,$table){
   $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
   global $connection;
   $sql = "SELECT * FROM $table   where status=1 AND tittle LIKE '%$text%' ";

   $query = $connection->prepare($sql);
   $query->execute();
  dbCheckError($query);
   $date = $query->fetchAll();
  return $date;
}
// запрос на получение одной строки с выбранной одной таблицы
function selectOne($table,$params =[]){
   global $connection;
   $sql = "SELECT * FROM $table";
   if (!empty($params)) {
      $i=0;
      foreach($params as $key => $value){
         if (!is_numeric($value)) {
            $value = "'".$value."'";// конкотенация для того чтобы форич формировал правильный запрос с одинарными ковычками 
         }
         if ($i === 0) {
            $sql = $sql . " WHERE  $key = $value";
         }
         else{
            $sql = $sql . " AND $key = $value"; 
         }
         $i++;
      }
   }
   $query = $connection->prepare($sql);
   $query->execute();
   dbCheckError($query);
   $date = $query->fetch();

  return $date;
}

function selectOnePeace($table,$params =[],$data){
   global $connection;
   $sql = "SELECT $data FROM $table";
   if (!empty($params)) {
      $i=0;
      foreach($params as $key => $value){
         if (!is_numeric($value)) {
            $value = "'".$value."'";// конкотенация для того чтобы форич формировал правильный запрос с одинарными ковычками 
         }
         if ($i === 0) {
            $sql = $sql . " WHERE  $key = $value";
         }
         else{
            $sql = $sql . " AND $key = $value"; 
         }
         $i++;
      }
   }
   $query = $connection->prepare($sql);
   $query->execute();
  dbCheckError($query);
   $date = $query->fetch();

  return $date;
}

// проверка выполнения запросы к бд
function dbCheckError($query){
   $errInfo =$query->errorInfo();
  
   if ($errInfo[0] !==PDO::ERR_NONE) {
      echo $errInfo[2];
      exit();
   }
   return true;
}

$params = [
   'admin' => 0,
   'username' => "andrei"
 ];
//Запись в бд
function Insert($table, $params){
   global $connection;

   $i =0;
   $coll = '';
   $mask = '';
   $length = count($params);

   foreach($params as $key => $value){
   
      if ($i == $length-1) {
         $key = $key;
         $value = "'".$value."'";
      }
      else{
         $value = "'".$value."'".",";
         $key = $key.",";
      }

      $coll = $coll . $key;
      $mask = $mask . $value;
      $i++;
   }
   $sql = "INSERT INTO $table ($coll) VALUE($mask)";

   $query = $connection ->prepare($sql);
   $query -> execute($params);// пробрасывание параметров в sql запрос
   dbCheckError($query);
    return $connection->lastInsertId();
}

//обновление данных
function Update($table, $id, $params){
   global $connection;

   $i =0;
   $str = '';
   $length = count($params);
   foreach($params as $key => $value){
      if ($i == $length-1) {
         $value = "'".$value."'";
         $key = "`" .$key. "`";
      }
      else{
         $key = "`" .$key. "`";
         $value = "'".$value."'".",";
      }
  
      $str = $str." ". $key . "=" . $value;
      $i++;
   }
   $sql = "UPDATE $table SET $str WHERE id = $id";

   $query = $connection ->prepare($sql);
   $query -> execute($params);
   dbCheckError($query);
    
}
function UpdateForOrdep($table, $email, $params,$buy_date){
   global $connection;

   $i =0;
   $str = '';
   $length = count($params);
   foreach($params as $key => $value){
      if ($i == $length-1) {
         $value = "'".$value."'";
         $key = "`" .$key. "`";
      }
      else{
         $key = "`" .$key. "`";
         $value = "'".$value."'".",";
      }
  
      $str = $str." ". $key . "=" . $value;
      $i++;
   }
   $sql = "UPDATE $table SET $str WHERE buy_date = $buy_date AND email = "."'" .$email."'" ;

   $query = $connection ->prepare($sql);
   $query -> execute($params);
   dbCheckError($query);
    
}

function UpdateCartCount($table, $id, $params,$buy_date){
   global $connection;

   $i =0;
   $str = '';
   $length = count($params);
   foreach($params as $key => $value){
      if ($i == $length-1) {
         $value = "'".$value."'";
         $key = "`" .$key. "`";
      }
      else{
         $key = "`" .$key. "`";
         $value = "'".$value."'".",";
      }
  
      $str = $str." ". $key . "=" . $value;
      $i++;
   }
   $sql = "UPDATE $table SET $str WHERE buy_date = $buy_date AND id = $id" ;

   $query = $connection ->prepare($sql);
   $query -> execute($params);
   dbCheckError($query);
    
}

function UpdateForCart($table, $id, $params){
   global $connection;

   $i =0;
   $str = '';
   $length = count($params);
   foreach($params as $key => $value){
      if ($i == $length-1) {
         $value = "'".$value."'";
         $key = "`" .$key. "`";
      }
      else{
         $key = "`" .$key. "`";
         $value = "'".$value."'".",";
      }
  
      $str = $str." ". $key . "=" . $value;
      $i++;
   }
   $sql = "UPDATE $table SET $str WHERE articule = $id";

   $query = $connection ->prepare($sql);
   $query -> execute($params);
   dbCheckError($query);
    
}
$arrData = [
   'password'=>'ENG',
];

function Delete($table,$id){
   global $connection;
   $i = 0;
   $sql = "DELETE FROM $table WHERE id =". $id;

   $query = $connection ->prepare($sql);
   $query -> execute();
   dbCheckError($query);
    
}
function DeleteCart($table,$id,$email,$buy_date){
   global $connection;
   $i = 0;
   $sql = "DELETE FROM $table WHERE buy_date =" .$buy_date. " AND id =" . $id. " AND email ="."'" .$email."'";

   $query = $connection ->prepare($sql);
   $query -> execute();
   dbCheckError($query);
    
}
// Выборка записей(товары) с автором в админку
function selectAllFromOrderWithCart($table1,$table2,$buy_date){
   global $connection;
   $sql = "SELECT 
      t1.id,
      t1.tittle,
      t1.img,
      t1.price,
      t1.status,
      t1.category,
      t1.created_data,
      t2.email,
      t2.buy_date,
      t2.id,
      t2.count
    FROM $table1 AS t1 
    JOIN $table2 AS t2  ON t1.id = t2.id
    AND  t2.buy_date = $buy_date";
   $query = $connection ->prepare($sql);
   $query -> execute();
   dbCheckError($query);
   return $query->fetchAll();
}
function selectAllFromPostsWithUsers($table1,$table2){
   global $connection;
   $sql = "SELECT 
      t1.id,
      t1.tittle,
      t1.img,
      t1.price,
      t1.status,
      t1.category,
      t1.created_data,
      t2.username
    FROM $table1 AS t1 
    JOIN $table2 AS t2  ON t1.admin = t2.id ";
   $query = $connection ->prepare($sql);
   $query -> execute();
   dbCheckError($query);
   return $query->fetchAll();
}

function selectAllFromPostsWithCart($table1,$table2,$buy_date,$email){
   global $connection;
   $sql = "SELECT 
      t1.id,
      t1.tittle,
      t1.img,
      t1.price,
      t1.status,
      t1.category,
      t2.email,
      t2.count
    FROM $table1 AS t1 
    Inner JOIN $table2 AS t2  ON t1.id = t2.id
    AND t2.buy_date = $buy_date
    AND t2.email="."'".$email."'";
   
   $query = $connection ->prepare($sql);
  
   $query -> execute();
   dbCheckError($query);
   return $query->fetchAll();
}