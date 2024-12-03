document.addEventListener('DOMContentLoaded', () => {
    
    const editInfo = document.querySelectorAll('button[name="editStaff-list"]');
    const removeUser = document.querySelectorAll('button[name="removeStaff-list"]')

    const removeContainer = document.querySelector('.removeUser')    
    const editInfoContainer = document.querySelector('.edit');
    const add_container = document.querySelector('.add-container');


    document.querySelector('.new').addEventListener('click', () =>{

        if(add_container.style.display === 'none'){
            add_container.style.display = 'block';
            editInfoContainer.style.display = 'none'
            removeContainer.style.display = 'none'
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
            const staffIDInput = container.querySelector('input[name="staff_ID"]');
            const staffID = staffIDInput.value;

            const staffNameInput = container.querySelector('input[name="staff_name"]')
            const staffName = staffNameInput.value;

            const staffPassInput = container.querySelector('input[name="staff_pass"]')
            const staffPass = staffPassInput.value;

            const staffEmailInput = container.querySelector('input[name="staff_email"]')
            const staffEmail = staffEmailInput.value;



            console.log('product ID:', staffID); 
            console.log('equipmet ID:', staffName); 
            console.log('equipmet ID:', staffEmail); 
            console.log('equipmet ID:', staffPass); 


            const editStaff_ID = document.querySelector('.edit .input-field input[name="staff_ID"]').value = staffID;
            const editStaff_Name = document.querySelector('.edit .input-field input[name="staff_name"]').value = staffName;
            const editStaff_Pass = document.querySelector('.edit .input-field input[name="staff_pass"]').value = staffPass;
            const editStaff_Email = document.querySelector('.edit .input-field input[name="staff_email"]').value = staffEmail;


        });
    });




    
    document.querySelectorAll('#cancel').forEach(hide =>{
        hide.addEventListener('click', () =>{

                editInfoContainer.style.display = 'none';
                add_container.style.display = 'none'
                removeContainer.style.display ='none'
        })
    })

    removeUser.forEach(remove =>{
        remove.addEventListener('click', ()=>{

            if(removeContainer.style.display === 'none'){
                removeContainer.style.display = 'flex'
                editInfoContainer.style.display = 'none'
                add_container.style.display = 'none'
            }else{
                removeContainer.style.display = 'none'
            }

            const container = remove.closest('tr');
            const removeIDInput = container.querySelector('input[name="staff_ID"]');
            const removeID = removeIDInput.value

            const removeNAMEInput = container.querySelector('input[name="staff_name"]')
            const removeNAME = removeNAMEInput.value

            const removeUser_ID = document.querySelector('.removeUser input[name="delete_user_ID"]').value = removeID

            const displayNAME = document.getElementById('user_name').innerHTML = removeNAME

        })
    })
})