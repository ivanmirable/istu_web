<?php
try {
        $connection = new PDO('mysql:dbname=test_db;host=localhost', 'root', '');
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e)
{
    die($e->getMessage());
}
    $name ='andrei';
    $age = '12';
    $login = 'user';
    $query = $connection->prepare('UPDATE `user` SET `name` = :name WHERE `id_user` = :id_user');
    $query->execute(['name'=> 'Kirill', 'id_user'=>1]);

    /// запись данных
    // $sth = $connection->prepare("SELECT `name` FROM `user`");
    // $sth->execute();
    // $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    // print_r($array);
    // $query = $connection->prepare('UPDATE `user` SET `name` = :name WHERE `id_user` = :id_user');
    // $query->execute(['name'=> 'Kirill', 'id_user'=>1]);
    // $insert_id = $connection->lastInsertId();
?>
