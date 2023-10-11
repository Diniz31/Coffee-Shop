// Mobile menu button
const nav = document.querySelector('.navbar');
const menuBtn = document.querySelector('.menu');
const btnIcon = document.querySelector('.menu i');

menuBtn.addEventListener('click', function(){
   const visibility = nav.getAttribute('data-visible');

   if(visibility === "false") {
    nav.setAttribute('data-visible', true);
    menuBtn.setAttribute('aria-expanded', true);
    // change icon ***************
    let isActive = menuBtn.classList.contains('fa-solid fa-bars');

    btnIcon.classList = isActive
    ? 'fa-solid fa-bars'
    : 'fa-solid fa-xmark'
    //********************** 
} 
else if(visibility === "true") {
    nav.setAttribute('data-visible', false)
    menuBtn.setAttribute('aria-expanded', false);
    // change icon (X) *************
    let isActive = menuBtn.classList.contains('fa-solid fa-xmark');

    btnIcon.classList = isActive
    ? 'fa-solid fa-xmark'
    : 'fa-solid fa-bars'
   }
    //********************
});

   // Filtrar por tipo de produto
   
function applyFilter() {
    let selectedCategory = document.getElementById('category').value;

    let items = document.getElementsByClassName('item');
    for (let i = 0; i < items.length; i++) {
        let item = items[i];
        let tipo = item.getAttribute('data-category');

        if (selectedCategory === 'all' || selectedCategory === tipo) {
            item.style.display = 'block';
        } else {
             item.style.display = 'none';
        }
    }
}

  // ******************************************************************
