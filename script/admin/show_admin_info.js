const adminInfo = document.querySelector('.adminDetail')
document.querySelector('.bi-person').addEventListener('click', () =>{


    if(adminInfo.style.display === 'none'){
        adminInfo.style.display = 'block'
    }else{
        adminInfo.style.display = 'none'
    }
})

document.querySelector('#cancelUserDetail').addEventListener('click', ()=>{
    adminInfo.style.display ='none'
})


document.querySelector('.bi-x').addEventListener('click', ()=>{
    adminInfo.style.display = 'none'
})