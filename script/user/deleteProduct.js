const deleteProduct = document.querySelectorAll('.removeProductCart');

deleteProduct.forEach(deleteP =>{
    deleteP.addEventListener('click', () =>{

        document.querySelector('.removeProduct_fromCart').style.display = 'flex'

        const container = deleteP.closest('.cart-product-container')
        const getCartID = container.querySelector('input[name="cart_ID"]')
        const cartID = getCartID.value
        
        const getProductName = container.querySelector('input[name="product_name-edit"]')
        const productName = getProductName.value

        console.log(productName)
        

       document.querySelector('.removeProduct_fromCart input[name="cart_ID"]').value = cartID
       document.querySelector('.removeProduct_fromCart #product_ID').innerHTML = productName
    })
})
