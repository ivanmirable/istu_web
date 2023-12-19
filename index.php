<?php 
session_start();
include("path.php");
include("controllers/topics.php");
$posts = selectAll('posts', ['status'=>1]); 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!--Font awesome-->
    <script src="https://kit.fontawesome.com/e923b74977.js" crossorigin="anonymous"></script>
      <!--Custom style-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Мой блог</title>
  </head>
  <body>
  <?php include("include/header.php");?>
    <!--блок карусели-->
    <div class= "container">
      <div class="row">
        <h2 class="slider-tittle">Топ публикации</h2>
      </div>
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/image_1.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5><a href="">slide label</a></h5>       
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/image_2.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5><a href="">slide label</a></h5>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/image_3.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5><a href="">slide label</a></h5>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div> 
    <!--блок карусели-->
          
    <!--Блок main-->
    <div class="container mb-5">
        <div class="row">
          <div class="main-content col-md-9">
            <div class="row">
             <h2>Новые публикации</h2>
              <!-- Карточка товара -->
              <?php foreach ($posts as $post): ?>
            <form method = "post" enctype="multipart/form-data" class="col-md-6"  action = "index.php">
              <input type="hidden" name="id" value="<?=$post['id']?>">
                  <div class="card md-4" data-id="1" id="1">
                    <!-- Верхняя часть -->
                    <div class="card__top">
                      <!-- Изображение-ссылка товара -->
                      <a href="#" class="card__image">
                        <img
                          src="<?=BASE_URL . 'img/posts/' . $post['img'];?>"
                          alt="<?=$post['tittle'];?>"
                        />
                      </a>
                      <!-- Скидка на товар -->
                      <div class="card__label">-10%</div>
                    </div>
                    <!-- Нижняя часть -->
                    <div class="card__bottom">
                      <!-- Цены на товар (с учетом скидки и без)-->
                      <div class="card__prices">
                        <div class="card__price card__price--discount">135000</div>
                        <div class="card__price card__price--common"><?=$post['price']?></div>
                      </div>
                      <!-- Ссылка-название товара -->
                      <a href="" class="card__title">
                        <?=$post['tittle']?>
                      </a>
                      <!-- Кнопка добавить в корзину -->
                    <button name ="add_cart_button" type="submit" data-cart class="card__add"> В корзину</button>         
                      </div>
                  </div>
              </form>
              <?php endforeach;?>
                  <div class="col-md-6" id="2">
                    <div class="card md-4" data-id="2" id="2">
                      <!-- Верхняя часть -->
                      <div class="card__top">
                        <!-- Изображение-ссылка товара -->
                        <a href="#" class="card__image">
                          <img
                            src="./image/iphone-14-pro-max-gold.png"
                            alt="Apple IPhone 14 PRO Max Gold"
                          />
                        </a>
                        <!-- Скидка на товар -->
                        <div class="card__label">-10%</div>
                      </div>
                      <!-- Нижняя часть -->
                      <div class="card__bottom">
                        <!-- Цены на товар (с учетом скидки и без)-->
                        <div class="card__prices">
                          <div class="card__price card__price--discount">135000</div>
                          <div class="card__price card__price--common">150000</div>
                        </div>
                        <!-- Ссылка-название товара -->
                        <a href="#" class="card__title">
                          AirPods 3
                        </a>
                        <!-- Кнопка добавить в корзину -->
                        <a href=""> <button data-cart class="card__add"> В корзину</button></a> 
                      </div>
                    </div>
                  </div>

                    <div class="col-md-6" id="3">
                      <div class="card md-4" data-id="3" id="3">
                        <!-- Верхняя часть -->
                        <div class="card__top">
                          <!-- Изображение-ссылка товара -->
                          <a href="#" class="card__image">
                            <img
                              src="./image/iphone-14-pro-max-gold.png"
                              alt="Apple IPhone 14 PRO Max Gold"
                            />
                          </a>
                          <!-- Скидка на товар -->
                          <div class="card__label">-10%</div>
                        </div>
                        <!-- Нижняя часть -->
                        <div class="card__bottom">
                          <!-- Цены на товар (с учетом скидки и без)-->
                          <div class="card__prices">
                            <div class="card__price card__price--discount">135000</div>
                            <div class="card__price card__price--common">150000</div>
                          </div>
                          <!-- Ссылка-название товара -->
                          <a href="#" class="card__title">
                            Смартфон Apple IPhone 14 Pro Max 256Gb, золотой
                          </a>
                          <!-- Кнопка добавить в корзину -->
                          <a href="1.html?"> <button data-cart class="card__add"> В корзину</button></a> 
                        </div>
                      </div>
                    </div>
                    
                <!-- Карточка товара -->
                <div class="col-md-6" id="4">
                  <div class="card" data-id="4" id="product-container">
                    <!-- Верхняя часть -->
                    <div class="card__top">
                      <!-- Изображение-ссылка товара -->
                      <a href="#" class="card__image">
                        <img
                          src="./image/iphone-14-pro-max-gold.png"
                          alt="Apple IPhone 14 PRO Max Gold"
                        />
                      </a>
                      <!-- Скидка на товар -->
                      <div class="card__label">-10%</div>
                    </div>
                    <!-- Нижняя часть -->
                    <div class="card__bottom">
                      <!-- Цены на товар (с учетом скидки и без)-->
                      <div class="card__prices">
                        <div class="card__price card__price--discount">135000</div>
                        <div class="card__price card__price--common">150000</div>
                      </div>
                      <!-- Ссылка-название товара -->
                      <a href="#" class="card__title">
                        Смартфон Apple IPhone 14 Pro Max 256Gb, золотой
                      </a>
                      <!-- Кнопка добавить в корзину -->
                      <a href="1.html?"> <button data-cart class="card__add"> В корзину</button></a>                   
                      </div>
                  </div>
                </div>
              </div>
              <!-- <div class="post row">
                <div class="img col-12 col-md-4">
                  <img src="images/image_1.png" alt="" class="img-thumbnail">
                </div>
                <div class="text_post col-12 col-md-8">
                    <h3> 
                      <a href="#">Основные маршруты...</a>
                    </h3>
                    <i class="far fa-user"> Имя автора</i>
                    <i class="far fa-calendar"> Sen 11, 2023</i>
                    <p class="preview-text">
                      Какой либо текст......
                    </p>
                </div>
              </div>
              <div class="post row">
                <div class="img col-12 col-md-4">
                  <img src="images/image_1.png" alt="" class="img-thumbnail">
                </div>
                <div class="text_post col-12 col-md-8">
                    <h3> 
                      <a href="#">Основные маршруты...</a>
                    </h3>
                    <i class="far fa-user"> Имя автора</i>
                    <i class="far fa-calendar"> Sen 11, 2023</i>
                    <p class="preview-text">
                      Какой либо текст......
                    </p>
                </div>
              </div>
              <div class="post row">
                <div class="img col-12 col-md-4">
                  <img src="images/image_1.png" alt="" class="img-thumbnail">
                </div>
                <div class="text_post col-12 col-md-8">
                    <h3> 
                      <a href="#">Основные маршруты...</a>
                    </h3>
                    <i class="far fa-user"> Имя автора</i>
                    <i class="far fa-calendar"> Sen 11, 2023</i>
                    <p class="preview-text">
                      Какой либо текст......
                    </p>
                </div>
              </div> -->
            </div>
               <!--sidebar col-md-3-->
          <div class="sidebar col-md-3 col-12">
            <div class="section search">
              <h3>Поиск</h3>
              <form action="/" method="post">
                <input type="text" name="search-term" class="text-input" placeholder="Search...">
              </form>
            </div>

          <div class="section topics">
            <h3>Категории</h3>
            <ul class="forfilter" >
              <?php foreach ($topics as $key => $topic):?>
              <li data-id="1" id="1">
                <a id="1"><?=$topic['name'];?></a>
              </li>
              <?php endforeach;?>
            </ul>
          </div>
        </div>
        </div>
            <!--sidebar col-md-3-->
    </div>
  </div>

  <?php include("include/footer.php");?>
  </div>
 
    <!--sidebar col-md-3-->

     <!--Блок main-->
    <!-- Optional JavaScript; choose one of the two! -->

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