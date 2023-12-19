<?php 
session_start();
include("path.php");
include("controllers/topics.php");
$cart = selectAll('cart');
$posts = selectAllFromPostsWithCart('posts','cart');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
      crossorigin="anonymous" />
    <!--Font awesome-->
    <script
      src="https://kit.fontawesome.com/e923b74977.js"
      crossorigin="anonymous"></script>
    <!--Custom style-->
    <link rel="stylesheet" href="css2/style1.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet" />
    <title>Мой блог</title>
  </head>
  <body>
  <div class="wrapper">
    <header class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-4">
            <h1>
              <a href="/">Страница</a>
            </h1>
          </div>
          <nav class="col-8">
            <ul>
              <li><a href="#">Главная</a></li>
              <li><a href="#">О нас</a></li>
              <li><a href="#">Услуги</a></li>
              <li>
                <a href="#"> <i class="fa fa-user"></i> Кабинет</a>
                <ul>
                  <li><a href="#">Админ панель</a></li>
                  <li><a href="#">Выход</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>

    <!--Корзина-->
    <div class="container2">
      <div class="cart-header">
        <div class="cart-header__tittle">Наименование</div>
        <div class="cart-header__count">Количество</div>
        <div class="cart-header__cost">Стоимость</div>
      </div>
      <div class="products" id="id_products">
      <?php foreach ($posts as $post): ?>
      <section class="product" id="product">
    <div class="product__img col-12 col-md-4">
        <img src="img/MacPro.png" alt="" class="product__img">
    </div>
    <div class="product__tittle"><?=$post['tittle'];?></div>
    <div class="product__count">
        <div class="count">
            <div class="count__box">
                <input type="number" class="count_input" min="1" max="100" value="1" id="inp2" data-counter>
            </div>
            <div class="count__controls">
                <button class="count__up" type="button" data-action="up">
                    <img src="./img/image_4.png" alt="Increase" id="up__img">
                </button>
                <button class="count__down" type="button" data-action="down">
                    <img src="./img/image_5.jpg" alt="Decrease" id = "down__img" >
                </button>
            </div>
        </div>
    </div>
    <div class="product__price"><?=$post['price'];?></div>
    <div class="product__controls">
        <button type="button" id="delete_button" >
            <img src="./img/delete_button.png">
        </button>
    </div>
    </section>
    <?php endforeach;?>
      </div>
      <div class="cart-footer">
        <div class="cart-footer__count">3</div>
        <div class="cart-footer__price">0</div>
      </div>
    </div>


<p space = 3>В этой строке  3 пробела</p>
    <div class="footer container-fluid">
      <div class="footer-content container">
        <div class="row">
          <div class="footer-section about col-md-4 col-12">
            <h3 class="logo-text">Страница</h3>
            <p>Что то о странице....</p>
            <div class="contact">
              <span><i class="fas fa-phone"></i></span>
              <span><i class="fas fa-envelope"></i></span>
            </div>
            <div class="socials">
              <a href="#"><i class="fab fa-facebook"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
          </div>

          <div class="footer-section links col-md-4 col-12">
            <h3>Links</h3>
            <br />
            <ul>
              <a href="#">
                <li>События</li>
              </a>
              <a href="#">
                <li>Команда</li>
              </a>
              <a href="#">
                <li>Упражнения</li>
              </a>
              <a href="#">
                <li>Галлерея</li>
              </a>
              <a href="#">
                <li>Что-то ещё</li>
              </a>
            </ul>
          </div>
          <div class="footer-section contact-form col-md-4 col-12">
            <h3>Контакты</h3>
            <br />
            <form action="index.html" method="post">
              <input
                type="email"
                name="email"
                class="text-input contact-input"
                placeholder="Your email address..." />
              <textarea
                rows="4"
                name="message"
                class="text-input contact-input"
                placeholder="Your message"></textarea>
              <button type="submit" class="btn brn-big contact-btn">
                <i class="fas fa-envelope"></i>
                Отправить
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!--Корзина-->
    <script src="./js/renderProducts.js"></script>
    <script src="./js/cart.js"></script>
    <script src="./js/calcCartPrice.js"></script>
  </body>
</html>
