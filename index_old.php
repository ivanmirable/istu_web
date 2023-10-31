<?php
$connection = mysqli_connect('localhost', 'root', '', 'test_db');
if ($connection == false) {
  echo 'Не удалось подключиться к базен данных!<br>';
  echo mysqli_connect_error();
  exit();
}
$result = $connection->query("SELECT * FROM `user`");
$rows = $result->num_rows;
if (mysqli_num_rows($result) == 0) {
  echo 'Не найдено ни одной записи';
}
for ($i = 0; $i < $rows; $i++) {
  $result->data_seek($i); //проходимся по каждой строке таболицы 'user'
  echo 'Name of user:' . $result->fetch_assoc()['name'] . '<br>'; //достаем информацию из каждой строки по индексу
} { ?>
  <ul>
    <?php
    while (($cat = mysqli_fetch_assoc($result))) {
      $articlescount = mysqli_query($connection, "SELECT COUNT(`id`) AS `total_count` FROM `articles` 
                WHERE `categorie_id` =" . $cat['id']);
      echo 'Записей найдено:' . mysqli_num_rows($result);
      $articlescount_result = mysqli_fetch_assoc($articlescount);
      echo '<li>' . $cat['tittle'] . '(' . $articlescount_result['total_count'] . ') </li>';
    }
    ?>
  </ul>
<?php
}
?>
<?php
mysqli_close($connection);
?>