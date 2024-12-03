const popMenu = document.querySelectorAll('.pop-menu')

popMenu.forEach(showMenu => {
    showMenu.addEventListener('click' , (event) => {
     

        // closest td / show on row
        const menuSelection = event.target.closest('td').querySelector('.action-menu')

        if(menuSelection.style.display === 'block'){
            menuSelection.style.display = 'none'
        }else{

            // hide other menu when click
            document.querySelectorAll('.action-menu').forEach(showOnly => {
                showOnly.style.display = 'none'
            });

            menuSelection.style.display = 'block'
        }
        
    })
})

document.querySelectorAll(".pop-menu").forEach((icon) => {
    icon.addEventListener("click", () => {
      const parentTd = icon.parentNode;
      parentTd.classList.toggle("show-menu"); // Toggle class to show/hide menu
    });
  });