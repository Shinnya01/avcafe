const addContainer = document.querySelector('.add-container')

function newList(){

    if(addContainer.style.display ==='none'){
        addContainer.style.display ='block'
    }else{
        addContainer.style.display = 'none'
    }
}

const completedTask = document.querySelector('.completed-task-container')

function showCompletedTask(){
    if(completedTask.style.display ==='none'){
        completedTask.style.display ='block'
    }else{
        completedTask.style.display = 'none'
    }

}


document.querySelector('#cancel').addEventListener('click', ()=>{
    addContainer.style.display = 'none';
})

document.querySelector('.bi-x').addEventListener('click', ()=>{
    completedTask.style.display ='none'
})