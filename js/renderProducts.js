const productsContainer = document.querySelector('.col-md-6')

async function getProducts() {
  const response = await fetch('./js/products.json')
  console.log(response)
  //достаем данные из json файла
  const productsArray = await response.json()
  console.log(productsArray)
  renderProducts(productsArray)
}

function renderProducts(productsArray) {
  productsArray.forEach(function (item) {
    const productHTML = `
                  <div class="col-md-6">
                      <div class="card md-4" data-id="${item.id}" id="product-container">
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
                            <div class="card__price card__price--discount">135 000</div>
                            <div class="card__price card__price--common">150 000</div>
                          </div>
                          <!-- Ссылка-название товара -->
                          <a href="#" class="card__title">
                            Смартфон Apple IPhone 14 Pro Max 256Gb, золотой
                          </a>
                          <!-- Кнопка добавить в корзину -->
                          <a href="1.html?"> <button data-cart class="card__add"> В корзину</button></a> 
                        </div>
                      </div>
                  </div>`
    productsContainer.insertAdjacentHTML('beforeend', productHTML)
  })
}
