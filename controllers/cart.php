<?php

include(SITE_ROOT . "/context/db.php");




if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['buy_date'])) {
    $id = $_GET['buy_date'];
    $carts = selectAll('cart',['buy_date'=>$_GET['buy_date']]);
}