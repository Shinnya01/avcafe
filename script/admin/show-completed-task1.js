const showCompletedTaskBtn = document.querySelector('.completed-task-btn')
const completedTask = document.querySelector('.completed-task-container')

// SHOW CONTAINER

showCompletedTaskBtn.addEventListener('click' , () => {
    if(completedTask.style.display === 'none'){
        completedTask.style.display = 'flex'
    }else{
        completedTask.style.display = 'none'
    }
})

// EXIT BUTTON

const exitBtn = document.querySelector('.exit');

exitBtn.addEventListener('click', () => {
        completedTask.style.display = 'none';
});



const add_container = document.querySelector('.add-container')

document.querySelector('.new').addEventListener('click', () =>{
 

    if(add_container.style.display==='none'){
        add_container.style.display='flex'
    }else{
        add_container.style.display='none'
    }
})

document.querySelector('#cancel').addEventListener('click', () =>{
    add_container.style.display = 'none';
})