// Handle Quantity for Buy Now Section
const plusBtn = document.querySelectorAll('.addBuy');
const minusBtn = document.querySelectorAll('.minusBuy');

let quantityValueBuy = 1;

plusBtn.forEach(plus => {
    plus.addEventListener('click', () => {
        quantityValueBuy++;
        document.getElementsByClassName('quantityValueBuy')[0].innerHTML = quantityValueBuy;
        document.querySelector('.buyProduct-container .quantity input[name="product_quantity-buy"]').value = quantityValueBuy;
    });
});

minusBtn.forEach(minus => {
    minus.addEventListener('click', () => {
        if (quantityValueBuy > 1) {
            quantityValueBuy--;
            document.getElementsByClassName('quantityValueBuy')[0].innerHTML = quantityValueBuy;
            document.querySelector('.buyProduct-container .quantity input[name="product_quantity-buy"]').value = quantityValueBuy;
        }
    });
});

// Handle Quantity for Add to Cart Section
const plusBtnCart = document.querySelectorAll('.add');
const minusBtnCart = document.querySelectorAll('.minus');

let quantityValueCart = 1;

plusBtnCart.forEach(plusB => {
    plusB.addEventListener('click', () => {
        quantityValueCart++;
        document.getElementsByClassName('quantityValue')[0].innerHTML = quantityValueCart;
        document.querySelector('.addCart-container .quantity input[name="product_quantity"]').value = quantityValueCart;
    });
});

minusBtnCart.forEach(minusB => {
    minusB.addEventListener('click', () => {
        if (quantityValueCart > 1) {
            quantityValueCart--;
            document.getElementsByClassName('quantityValue')[0].innerHTML = quantityValueCart;
            document.querySelector('.addCart-container .quantity input[name="product_quantity"]').value = quantityValueCart;
        }
    });
});

