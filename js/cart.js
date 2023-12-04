

let cartItemHtml = []
window.addEventListener('click', (event) => {
  if (event.target.hasAttribute('data-cart')) {
    const card = event.target.closest('.card')
 

    const productInfo = {
      id: card.dataset.id,
      imgSrc: card.querySelector('.card__image').getAttribute('src'),
      title: card.querySelector('.card__title').innerText,
      price: card.querySelector('.card__price').innerText,
      discount: card.querySelector('.card__label').innerText,
    }

// заполнение локального хранилища, чтобы при новом нажатии, данные, взятые из прошлого нажатия не пропали
    const existingProducts =
      JSON.parse(localStorage.getItem('productsCart')) || [] //присваивает массив из local storage(хранилище данных, где все в строке), либо пустой массив
      const findEl = existingProducts.find((item)=>{ 
        if (item.id == productInfo.id) {
          return item
      }
      
    })
      if (!findEl) {
        existingProducts.push(productInfo)
        localStorage.setItem('productsCart', JSON.stringify(existingProducts))//кладет в локальное хранилище массив, превращенный в строку,
      }
  }
})

const renderProductsInCart = (() => { 
  const actualProductsCart =
    JSON.parse(localStorage.getItem('productsCart')) ?? []

  const productsInCart = document.getElementById('id_products')

  actualProductsCart.forEach((el) => {
    cartItemHtml.push(`<section class="product" id="product">
    <div class="product__img col-12 col-md-4">
        <img src="img/MacPro.png" alt="" class="product__img">
    </div>
    <div class="product__tittle">${el.title}</div>
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
    <div class="product__price">${el.price}</div>
    <div class="product__controls">
        <button type="button" id="delete_button" >
            <img src="./img/delete_button.png">
        </button>
    </div>
    </section>`)
  })
  if (cartItemHtml.length == 0) {
    document.querySelector('.cart-header').classList.toggle('cart-header-hid')
    document.querySelector('.cart-footer').classList.toggle('cart-footer-hid')
  }
  if (actualProductsCart) {
    productsInCart.insertAdjacentHTML('afterbegin', cartItemHtml)
  }
})()

window.addEventListener("load", function() {
  calcCartPrice()
  const existingProducts = JSON.parse(localStorage.getItem('productsCart'))
  console.log(existingProducts)
}, false); 

window.addEventListener('click', function (event) {
  $flag = false
  if (event.target.id === 'up__img' || event.target.id === 'down__img') {
    $flag = true
  } else {
    $flag = false
  }

  if ($flag) {
    console.log(event.target.id)
    //после срабатывания клика мы проверяем что клик был сделан в одном из элементов с классом class =count
    const count = event.target.closest('.count')
    //находим в классе элемент с атрибутом data-counter
    const counter = count.querySelector('[data-counter]')

    //отслеживаем событие клика на елемент с id = up__img
    if (event.target.id == 'up__img') {
      counter.value = ++counter.value
      calcCartPrice()
    }
    //тоже самое только с минусом
    if (event.target.id == 'down__img') {
      if (counter.value > 1) {
        counter.value = counter.value - 1
        calcCartPrice()
      } else {
        counter.value = 1
        calcCartPrice()
      }
    }
  }

  if (event.target.closest('.product__controls')) {
    const productElement = event.target.closest('.product')
    const productTitle =
      productElement.querySelector('.product__tittle').innerText
  

    productElement.remove()

    
    const existingProducts = JSON.parse(localStorage.getItem('productsCart'))
    const updatedProducts = existingProducts.filter(
      (product) => product.title !== productTitle,
    )
    if (updatedProducts.length==0) {
      console.log(existingProducts.length)
    
      document.querySelector('.cart-header').classList.add('cart-header-hid')
      document.querySelector('.cart-footer').classList.add('cart-footer-hid')
    }
    localStorage.setItem('productsCart', JSON.stringify(updatedProducts))

    calcCartPrice()
  }
})
