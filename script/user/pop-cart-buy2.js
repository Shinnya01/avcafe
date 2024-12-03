document.addEventListener('DOMContentLoaded', () => {

    // buy container
    const buyProductInfo = document.querySelector('.buyProduct-container');

    // buy button
    const buyProducts = document.querySelectorAll('button[name="buy"]');




    buyProducts.forEach(product => {
        product.addEventListener('click', () => {
            const container = product.closest('.menu-item'); // Get the closest menu-item element
            const productIDInput = container.querySelector('input[name="product_ID"]');

            const productID = productIDInput.value; // Get the value of the hidden input for product ID

            console.log('Product ID:', productID); // Log the product ID for debugging

            if (buyProductInfo.style.display === 'none') {
                buyProductInfo.style.display = 'grid';

            }

            // Update the value of the hidden input field outside the loop
            const hiddenInputOutside = document.querySelector('input[name="product_ID"]:not(.menu-item input[name="product_ID"], .card input[name="product_ID"])');
            hiddenInputOutside.value = productID;

            // Update the popup with the clicked product details
            document.querySelector('.buyProduct-container .buyProductImg').src = container.querySelector('img').src;
            document.querySelector('.buyProduct-container #product_name').value = container.querySelector('input[name="product_name"]').value;
            document.querySelector('.buyProduct-container .productDetail[for="product_name"]').textContent = container.querySelector('input[name="product_name"]').value;
            document.querySelector('.buyProduct-container #product_price').value = container.querySelector('input[name="product_price"]').value;
            document.querySelector('.buyProduct-container .productDetail[for="product_price"]').textContent = '₱ ' + container.querySelector('input[name="product_price"]').value;

            document.querySelector('label[for="grande-size-buy"]').addEventListener('click', () =>{
                document.querySelector('.buyProduct-container .productDetail[for="product_price"]').textContent = '₱ ' + container.querySelector('input[name="product_price"]').value;
            });
            document.querySelector('label[for="venti-size-buy"]').addEventListener('click', () =>{
                document.querySelector('.buyProduct-container .productDetail[for="product_price"]').textContent = '₱ ' + (parseFloat(container.querySelector('input[name="product_price"]').value) + 10);
            });
            

            const cancelBtn = document.querySelector('.cancelBuyBtn'); 

            cancelBtn.addEventListener('click', () => {
                if(buyProductInfo.style.display == 'grid'){
                    buyProductInfo.style.display = 'none';
                }
                
                quantityValueBuy = 1;
                document.getElementsByClassName('quantityValueBuy')[0].innerHTML = quantityValueBuy;
                document.querySelector('.buyProduct-container .quantity input[name="product_quantity"]').value = quantityValueBuy;
            })
        });
    });

    // buy container
    const cartProductInfo = document.querySelector('.addCart-container');

    // buy button
    const AddCart = document.querySelectorAll('button[name="addCart"]');

    AddCart.forEach(addProduct => {
        addProduct.addEventListener('click', () => {

            // Get the closest element
            const container = addProduct.closest('.menu-item'); 
            const productIDInput = container.querySelector('input[name="product_ID"]');

            const productID = productIDInput.value; // Get the value of the hidden input for product ID

            console.log('Product ID:', productID); // Log the product ID for debugging

            if (cartProductInfo.style.display === 'none') {
                cartProductInfo.style.display = 'grid';
            }

            // Update the value of the hidden input field outside the loop
            const hiddenInputOutside = document.querySelector('input[name="product_ID"]:not(.menu-item input[name="product_ID"], .card input[name="product_ID"])');
            hiddenInputOutside.value = productID;

            // Update the popup with the clicked product details
            document.querySelector('.addCart-container .addCartImg').src = container.querySelector('img').src;
            document.querySelector('.addCart-container #product_name').value = container.querySelector('input[name="product_name"]').value;
            document.querySelector('.addCart-container .productDetail[for="product_name"]').textContent = container.querySelector('input[name="product_name"]').value;
            document.querySelector('.addCart-container #product_price').value = container.querySelector('input[name="product_price"]').value;
            document.querySelector('.addCart-container .productDetail[for="product_price"]').textContent = '₱ ' + container.querySelector('input[name="product_price"]').value;


            
            document.querySelector('label[for="grande-size"]').addEventListener('click', () =>{
                document.querySelector('.addCart-container .productDetail[for="product_price"]').textContent = '₱ ' + container.querySelector('input[name="product_price"]').value;
            });
            document.querySelector('label[for="venti-size"]').addEventListener('click', () =>{
                document.querySelector('.addCart-container .productDetail[for="product_price"]').textContent = '₱ ' + (parseFloat(container.querySelector('input[name="product_price"]').value) + 10);
            });
            

            const cancelCartBtn = document.querySelector('.cancelCartBtn');
            
            cancelCartBtn.addEventListener('click', () => {
                if(cartProductInfo.style.display == 'grid'){
                    cartProductInfo.style.display = 'none';
                }

                quantityValueCart = 1;
                document.getElementsByClassName('quantityValue')[0].innerHTML = quantityValueCart;
                document.querySelector('.addCart-container .quantity input[name="product_quantity"]').value = quantityValueCart;
            })
            
        }); 
    });


    const buyProduct_bestSeller = document.querySelectorAll('button[name="buy-bestSeller"]')
    const addCart_bestSeller = document.querySelectorAll('button[name="addCart-bestSeller"]')


    if(buyProduct_bestSeller){
        buyProduct_bestSeller.forEach(buyBest=>{
            buyBest.addEventListener('click', () =>{
    
                const container = buyBest.closest('.card')
                const bestSellerIDInput = container.querySelector('input[name="product_ID"]')
                const bestSellerID = bestSellerIDInput.value;
    
                console.log(bestSellerID)
    
                if(buyProductInfo.style.display === 'none'){
                    buyProductInfo.style.display = 'grid'
                }
    
                const hiddenInputOutside = document.querySelector('input[name="product_ID"]:not(.menu-item input[name="product_ID"], .card input[name="product_ID"])');
                hiddenInputOutside.value = bestSellerID;
                // Update the popup with the clicked product details
                document.querySelector('.buyProduct-container .buyProductImg').src = container.querySelector('img').src;
                document.querySelector('.buyProduct-container #product_name').value = container.querySelector('input[name="product_name"]').value;
                document.querySelector('.buyProduct-container .productDetail[for="product_name"]').textContent = container.querySelector('input[name="product_name"]').value;
                document.querySelector('.buyProduct-container #product_price').value = container.querySelector('input[name="product_price"]').value;
                document.querySelector('.buyProduct-container .productDetail[for="product_price"]').textContent = '₱ ' + container.querySelector('input[name="product_price"]').value;
    
                document.querySelector('label[for="grande-size-buy"]').addEventListener('click', () =>{
                    document.querySelector('.buyProduct-container .productDetail[for="product_price"]').textContent = '₱ ' + container.querySelector('input[name="product_price"]').value;
                });
                document.querySelector('label[for="venti-size-buy"]').addEventListener('click', () =>{
                    document.querySelector('.buyProduct-container .productDetail[for="product_price"]').textContent = '₱ ' + (parseFloat(container.querySelector('input[name="product_price"]').value) + 10);
                });

                console.log(container.querySelector('input[name="product_price"]').value);
                
                const cancelBuyBtn = document.querySelector('.cancelBuyBtn');
                
                cancelBuyBtn.addEventListener('click', () => {
                    if(buyProductInfo.style.display == 'grid'){
                        buyProductInfo.style.display = 'none';
                    }
                })
    
                
            })
        })
    }

    if(addCart_bestSeller){
        addCart_bestSeller.forEach(cartBest =>{
            cartBest.addEventListener('click', ()=>{
    
                const container = cartBest.closest('.card')
                const bestSellerIDInput = container.querySelector('input[name="product_ID"]')
                const bestSellerID = bestSellerIDInput.value
    
                console.log(bestSellerID)
    
                if(cartProductInfo.style.display === 'none'){
                    cartProductInfo.style.display = 'grid'
                }
    
                const hiddenInputOutside = document.querySelector('input[name="product_ID"]:not(.menu-item input[name="product_ID"], .card input[name="product_ID"])');
                hiddenInputOutside.value = bestSellerID;
                // Update the popup with the clicked product details
                document.querySelector('.addCart-container .addCartImg').src = container.querySelector('img').src;
                document.querySelector('.addCart-container #product_name').value = container.querySelector('input[name="product_name"]').value;
                document.querySelector('.addCart-container .productDetail[for="product_name"]').textContent = container.querySelector('input[name="product_name"]').value;
                document.querySelector('.addCart-container #product_price').value = container.querySelector('input[name="product_price"]').value;
                document.querySelector('.addCart-container .productDetail[for="product_price"]').textContent = '₱ ' + container.querySelector('input[name="product_price"]').value;
    
                         
            document.querySelector('label[for="grande-size"]').addEventListener('click', () =>{
                document.querySelector('.addCart-container .productDetail[for="product_price"]').textContent = '₱ ' + container.querySelector('input[name="product_price"]').value;
            });
            document.querySelector('label[for="venti-size"]').addEventListener('click', () =>{
                document.querySelector('.addCart-container .productDetail[for="product_price"]').textContent = '₱ ' + (parseFloat(container.querySelector('input[name="product_price"]').value) + 10);
            });
    
                const cancelCartBtn = document.querySelector('.cancelCartBtn');
                
                cancelCartBtn.addEventListener('click', () => {
                    if(cartProductInfo.style.display == 'grid'){
                        cartProductInfo.style.display = 'none';
                    }
    
                    quantityValueCart = 1;
                    document.getElementsByClassName('quantityValue')[0].innerHTML = quantityValueCart;
                    document.querySelector('.addCart-container .quantity input[name="product_quantity"]').value = quantityValueCart;
                })
            })
        })
    }

 

    // END
})