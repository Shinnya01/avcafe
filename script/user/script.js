document.addEventListener('DOMContentLoaded', () => {
    const buyProductInfo = document.querySelector('.buyProduct-container');

    const buyProducts = document.querySelectorAll('button[name="buy"]'); // Select all elements with name 'buy'

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
            const hiddenInputOutside = document.querySelector('input[name="product_ID"]:not(.menu-item input[name="product_ID"])');
            hiddenInputOutside.value = productID;

            // Update the popup with the clicked product details
            document.querySelector('.buyProduct-container .buyProductImg').src = container.querySelector('img').src;
            document.querySelector('.buyProduct-container #product_name').value = container.querySelector('input[name="product_name"]').value;
            document.querySelector('.buyProduct-container .productDetail[for="product_name"]').textContent = container.querySelector('input[name="product_name"]').value;
            document.querySelector('.buyProduct-container #product_price').value = container.querySelector('input[name="product_price"]').value;
            document.querySelector('.buyProduct-container .productDetail[for="product_price"]').textContent = '₱ ' + container.querySelector('input[name="product_price"]').value;
        });
    });

    const addCartButtons = document.querySelectorAll('button[name="cart"]');

    addCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const container = button.closest('.menu-item'); // Get the closest menu-item element
            const productIDInput = container.querySelector('input[name="product_ID"]');

            const productID = productIDInput.value; // Get the value of the hidden input for product ID

            console.log('Product ID:', productID); // Log the product ID for debugging

            if (buyProductInfo.style.display === 'none') {
                buyProductInfo.style.display = 'grid';
            }

            // Update the value of the hidden input field outside the loop
            const hiddenInputOutside = document.querySelector('input[name="product_ID"]:not(.menu-item input[name="product_ID"])');
            hiddenInputOutside.value = productID;

            // Update the popup with the clicked product details
            document.querySelector('.buyProduct-container .buyProductImg').src = container.querySelector('img').src;
            document.querySelector('.buyProduct-container #product_name').value = container.querySelector('input[name="product_name"]').value;
            document.querySelector('.buyProduct-container .productDetail[for="product_name"]').textContent = container.querySelector('input[name="product_name"]').value;
            document.querySelector('.buyProduct-container #product_price').value = container.querySelector('input[name="product_price"]').value;
            document.querySelector('.buyProduct-container .productDetail[for="product_price"]').textContent = '₱ ' + container.querySelector('input[name="product_price"]').value;

            const buyName = button.getAttribute('name');

            if (buyName === 'buyProduct') {
                button.setAttribute('name', 'addCart');
                button.textContent = 'Add to Cart';
            } else if (buyName === 'addCart') {
                button.setAttribute('name', 'buyProduct');
                button.textContent = 'Buy Now';
            }
        });
    });

    const cancelBtn = document.querySelector('button[name="cancelBtn"]');

    cancelBtn.addEventListener('click', () => {
        if (buyProductInfo.style.display === 'grid') {
            buyProductInfo.style.display = 'none';
        }
        if (cartProductInfo.style.display === 'grid') {
            cartProductInfo.style.display = 'none';
        }
    });
});
