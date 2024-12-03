document.addEventListener('DOMContentLoaded', () => {
    
    const editInfo = document.querySelectorAll('button[name="editProduct"]');
    const editInfoContainer = document.querySelector('.edit');
    const add_container = document.querySelector('.add-container');
    const removeContainer = document.querySelector('.removeProduct')

    document.querySelector('.new').addEventListener('click', () =>{

        if(add_container.style.display === 'none'){
            add_container.style.display = 'block';
            editInfoContainer.style.display = 'none'
            removeContainer.style.display='none'
        }else{
            add_container.style.display = 'none';

        }
    })


    editInfo.forEach(edit => {
        edit.addEventListener('click', () => {
            // show edit container
            if (editInfoContainer.style.display === 'none') {
                editInfoContainer.style.display = 'flex';
                add_container.style.display = 'none'
                removeContainer.style.display='none'
            } else {
                editInfoContainer.style.display = 'none';
     
            }

            // Correctly find and log the user ID
            const container = edit.closest('tr'); // Get the closest table row
            const productIDInput = container.querySelector('input[name="product_ID"]');
            const productID = productIDInput.value;

            const productNameInput = container.querySelector('input[name="product_name"]')
            const productName = productNameInput.value;

            const productPriceInput = container.querySelector('input[name="product_price"]')
            const productPrice = productPriceInput.value;

            const productStatusInput = container.querySelector('input[name="product_status"]')
            const productStatus = productStatusInput.value;



            console.log('product ID:', productID); 
            console.log('product ID:', productName); 
            console.log('product ID:', productStatus); 
   


            const editUser_ID = document.querySelector('.edit .input-field-edit input[name="product_ID"]').value = productID;
            const editUser_Name = document.querySelector('.edit .input-field-edit input[name="product_name"]').value = productName;
            const editUser_Price = document.querySelector('.edit .input-field-edit input[name="product_price"]').value = productPrice;
            const editUser_Pass = document.querySelector('.edit .input-field-edit select[name="product_status"]').value = productStatus;
          


        });
    });

    const removeButton = document.querySelectorAll('button[name="removeProduct"]')


    removeButton.forEach(remove =>{
    remove.addEventListener('click', ()=>{

        if(removeContainer.style.display === 'none'){
            removeContainer.style.display = 'flex'
            editInfoContainer.style.display = 'none'
            add_container.style.display = 'none'
        }else{
            removeContainer.style.display = 'none'
        }

        const container = remove.closest('tr');
        const removeIDInput = container.querySelector('input[name="product_ID"]');
        const removeID = removeIDInput.value

        const removeNAMEInput = container.querySelector('input[name="product_name"]')
        const removeNAME = removeNAMEInput.value

        const removeUser_ID = document.querySelector('.removeProduct input[name="delete_product_ID"]').value = removeID

        const displayNAME = document.getElementById('user_name').innerHTML = removeNAME

    })
})

    

    
    document.querySelectorAll('#cancel').forEach(hide =>{
        hide.addEventListener('click', () =>{

                editInfoContainer.style.display = 'none';
                add_container.style.display = 'none'
                removeContainer.style.display = 'none'
        })
    })


})