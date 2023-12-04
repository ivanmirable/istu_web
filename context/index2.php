<?php
try {
        $connection = new PDO('mysql:dbname=test_db;host=localhost', 'root', '');
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
} 
catch (PDOException $e)
{
    die($e->getMessage());
}
?>
