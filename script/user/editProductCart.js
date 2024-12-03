const editProductContainer = document.querySelector('.editProduct-container')





const editProductBtn = document.querySelectorAll('.editProductCart')

editProductBtn.forEach(editProduct=>{
    editProduct.addEventListener('click', ()=>{


        const container =  editProduct.closest('.cart-product-container') 
        const getCartID = container.querySelector('input[name="cart_ID"]') 
        const cartID = getCartID.value

        const getProductName = container.querySelector('input[name="product_name-edit"]') 
        const productName = getProductName.value

        const getProductImg = container.querySelector('.product-img') 
        const productImg = getProductImg.src

        const getProductQuantity = container.querySelector('input[name="product_quantity"]') 
        const productQuantity = getProductQuantity.value


        const getProductSize = container.querySelector('input[name="product_size"]')
        const productSize = getProductSize.value

        const getProductPrice = container.querySelector('input[name="product_price"]')
        const productPrice = getProductPrice.value

        console.log(productPrice)



        editProductContainer.style.display = 'grid'

        document.querySelector('input[name="cart_ID_edit"]').value = cartID

        document.getElementById('product-name-edit').innerHTML = productName

        document.querySelector('#product-img-edit').src = productImg

        document.querySelector('.quantityValueEdit').innerHTML = productQuantity

        document.querySelector('input[name="editProduct_quantity"]').value = productQuantity

        document.querySelector('select[name="product_size_edit"]').value = productSize

        document.querySelector('input[name="product_price_edit"]').value = productPrice



        const plusBtnEdit = document.querySelectorAll('.addEdit');
        const minusBtnEdit = document.querySelectorAll('.minusEdit');

        
        let quantityValueEdit = productQuantity
        plusBtnEdit.forEach(plusE=>{
        plusE.addEventListener('click', () => {
        
        quantityValueEdit++;
        document.getElementsByClassName('quantityValueEdit')[0].innerHTML = quantityValueEdit;
        document.querySelector('.editProduct-container .editProduct-quantity input[name="editProduct_quantity"]').value = quantityValueEdit;

    });
})

        quantityValueEdit = productQuantity

        minusBtnEdit.forEach(minusE=>{
        minusE.addEventListener('click', () => {     

        if(quantityValueEdit > 1){
        quantityValueEdit--;
        document.getElementsByClassName('quantityValueEdit')[0].innerHTML = quantityValueEdit;
        document.querySelector('.editProduct-container .editProduct-quantity input[name="editProduct_quantity"]').value = quantityValueEdit;
        }
        })
    })
    
        
    });
})

