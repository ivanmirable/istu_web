const filterBox = document.querySelectorAll('.card');

document.querySelector('.topics').addEventListener('click',(event)=>{
    console.log('клик')
    if (event.target.tagName !== 'A'){ 
        console.log('false')
        return false};
    let filterClass = parseInt(event.target.id);
    console.log(filterClass)
    filterBox.forEach((elem)=>{
        console.log(elem.id)
        elem.classList.remove('hide')
        if (parseInt(elem.id) !== filterClass && filterClass!==6) {
            elem.classList.add('hide');        
        }
    })
        
    
})

