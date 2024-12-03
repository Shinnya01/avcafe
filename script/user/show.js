const userDetail = document.querySelector('.userDetail')
const userLogin = document.querySelector('.userLogin')

function showUser(){

    if(!userDetail){
        userLogin.style.display = 'block'
    }else{
        userDetail.style.display = 'block'
    }
}

const cartContainer = document.querySelector('.cart-container')

function showCart(){

    if(cartContainer){
        if(cartContainer.style.right='-50%'){
            cartContainer.style.right='0'
            userDetail.style.display = 'none'
        }else{
            cartContainer.style.right='-50%'
        }
    }else{
        if(userLogin){
            userLogin.style.display='block'
        }
    }

    
}


document.querySelectorAll('.bi-x').forEach(remove=>{
    remove.addEventListener("click", ()=>{

        if(cartContainer){
            cartContainer.style.right ='-50%'
        }

        if(userDetail){
            userDetail.style.display='none'
        }

        if(userLogin){
            userLogin.style.display='none'
        }

    })
})



// FROM PLACE ORDER

function editInfo(){
    userDetail.style.display = 'block'
}







