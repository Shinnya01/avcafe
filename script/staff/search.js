const showSearchBtn = document.querySelector('#showSearchBtn')
const removeSearchBtn = document.querySelector('#removeSearchBtn')

const searchBox = document.querySelector('#search-box')

function showSearch(){
    searchBox.style.display = 'flex'
    
    showSearchBtn.style.display = 'none'
    removeSearchBtn.style.display = 'block'
}

function removeSearch(){
    searchBox.style.display = 'none'
    
    showSearchBtn.style.display = 'block'
    removeSearchBtn.style.display = 'none'
}

