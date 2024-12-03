const adminInfo = document.querySelector('.staffDetail')
document.querySelector('.bi-person').addEventListener('click', () =>{


    if(adminInfo.style.display === 'none'){
        adminInfo.style.display = 'block'
    }else{
        adminInfo.style.display = 'none'
    }
})

document.querySelector('#cancelStaffDetail').addEventListener('click', ()=>{
    adminInfo.style.display ='none'
    location.reload();
})

document.querySelector('.bi-x').addEventListener('click', ()=>{
    adminInfo.style.display = 'none'

    location.reload();
})