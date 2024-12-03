
const mapping = document.querySelector('#mapping');

document.querySelector('a[href="#dashboard"]').addEventListener('click' , () =>{
    mapping.innerHTML ='Dashboard';
})

document.querySelector('a[href="#equipments"]').addEventListener('click' , () =>{
    mapping.innerHTML ='Dashboard / Equipments';
})

document.querySelector('a[href="#inventory"]').addEventListener('click' , () =>{
    mapping.innerHTML ='Dashboard / Inventory';
})
