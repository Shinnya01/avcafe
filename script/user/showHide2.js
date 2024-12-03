const showCart = document.querySelector('.bi-cart');
const showUser = document.querySelector('.bi-person');

const hideCart = document.querySelectorAll('.bi-x');

const cart = document.querySelector('.cart-container');


const cancelUserDetail = document.querySelector('#cancelUserDetail')
// CART
showCart.addEventListener('click', () => {
    if(!cart){
        userDetail.style.display = 'block'
    }else{
    
        if (cart.style.right === '-50%') {
            cart.style.right = '0';
            userDetail.style.display = 'none'
        } else {
            cart.style.right = '-50%';
        }
    }




});



showUser.addEventListener('click', () => {
    
    if (userDetail.style.display === 'none') {
        userDetail.style.display = 'block';
        if(cart){
            cart.style.right = '-50%'
        }

    } else {
        userDetail.style.display = 'none';
    }
});



hideCart.forEach(hide => {
    hide.addEventListener('click', () =>{

        if(cart){
            cart.style.right = '-50%'
        }

    userDetail.style.display = 'none'

    })
})

cancelUserDetail.addEventListener('click', ()=>{

    userDetail.style.display ='none'
    location.reload();
})