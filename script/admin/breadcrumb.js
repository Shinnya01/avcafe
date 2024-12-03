
const mapping = document.querySelector('#mapping');



document.querySelector('a[href="#dashboard"]').addEventListener('click' , () =>{
    mapping.innerHTML ='Dashboard';
})
document.querySelector('a[href="#staff-list"]').addEventListener('click' , () =>{
    mapping.innerHTML ='Dashboard / Staff';
})
