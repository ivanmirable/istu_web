const btnUp = document.querySelector('[class="count__up"]')
const btnDown = document.querySelector('[class="count__down"]')
const counter = document.getElementById('inp1')

btnUp.addEventListener('click', function () {
  console.log('Up Click')
  counter.value = ++counter.value
})

btnDown.addEventListener('click', function () {
  console.log('Down Click')
  if (counter.value > 1) {
    counter.value = counter.value - 1
  } else {
    counter.value = 1
  }
})
