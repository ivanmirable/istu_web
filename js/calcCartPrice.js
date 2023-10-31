function calcCartPrice(){

    const product = document.querySelectorAll('.product');
    let totalPrice =0
    let totalCount = 0;
    console.log(product);

    product.forEach(function(item){
        console.log(item);
        const amountEL= item.querySelector('[data-counter]').value;
        const priceEL = item.querySelector('.product__price').innerText;

        console.log(amountEL,priceEL);
        const currentPrice = parseInt(amountEL)* parseInt(priceEL);
         console.log(currentPrice);
         totalPrice += currentPrice;
         totalCount += parseInt(amountEL);
         console.log(totalPrice);
         console.log(totalCount);

    })
    document.querySelector('.cart-footer__count').innerText = totalCount;
    document.querySelector('.cart-footer__price').innerText = totalPrice;

}