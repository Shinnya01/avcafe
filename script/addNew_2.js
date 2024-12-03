const newBtn = document.querySelectorAll('.new')
const newContainerShow = document.querySelector('.add-container')

const editContainerShow = document.querySelector('.edit')



// EDIT CUSTOMER
newBtn.forEach(showNew =>{
    showNew.addEventListener('click', () =>{

        if(newContainerShow.style.display === 'none'){
            newContainerShow.style.display = 'block'
        }

    })
})



document.querySelectorAll('#cancel').forEach(hide =>{
    hide.addEventListener('click', () =>{

        if (editInfoContainer.style.display === 'flex') {
            editInfoContainer.style.display = 'none';
        } else {
            editInfoContainer.style.display = 'flex';
        }

    })
})