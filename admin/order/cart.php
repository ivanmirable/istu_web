
<?php session_start();
include("../../path.php");
include("../../controllers/cart.php");
$carts = selectAllFromPostsWithUsers('posts','cart',$_GET['buy_date']);

?>
<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!--Font awesome-->
    <script src="https://kit.fontawesome.com/e923b74977.js" crossorigin="anonymous"></script>
      <!--Custom style-->
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Мой блог</title>
  </head>
  <body>
  <?php include("../../include/header-admin.php");?>
    <div class="conatiner">
        <div class="row">
            <?php include ("../../include/sidebar-admin.php");?>
            <div class="posts col-9">
                <div class="button row">
                    <a href="" class = "col-2 btn btn-success">Создать</a>
                    <span class="col-1"></span>
                    <a href="" class = "col-2 btn btn-warning">Редактировать</a>
                </div>
                <div class="row tittle-table">
                    <h2>Заказы</h2>
                    <div class="col-2">Email</div>
                    <div class="col-4">Шифр заказа</div>
                    <div class="col-2">Артикул</div>
                    <div class="col-2">Количество</div>
                    <div class="col-2">Название</div>
                </div>
                <?php foreach($carts as $key=> $cart):?>

                <div class="row post">
                    <div class="id col-2"><?=$cart['email']?></div>
                    <div class="tittle col-4"><?=$cart['buy_date'];?></div>
                    <div class="price col-2"><?=$cart['id'];?></div>
                    <div class="price col-2"><?=$cart['count'];?></div>
                    <div class="price col-2"><?=$cart['tittle'];?></div>


 
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>

  <?php include("../../include/footer.php");?>
  </div>
 

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="./js/renderProducts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="./js/cart.js"></script>
    <script src="./js/filter.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  </body>
</html>