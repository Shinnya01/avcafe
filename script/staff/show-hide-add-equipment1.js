document.addEventListener('DOMContentLoaded', () => {
    
    const editInfo = document.querySelectorAll('button[name="editEquipment"]');
    const editInfoContainer = document.querySelector('.edit');
    const add_container = document.querySelector('.add-container');
    const removeContainer = document.querySelector('.removeEquipment')

    document.querySelector('.new').addEventListener('click', () =>{

        if(add_container.style.display === 'none'){
            add_container.style.display = 'block';
            editInfoContainer.style.display = 'none'
            removeContainer.style.display ='none'
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
                removeContainer.style.display ='none'
            } else {
                editInfoContainer.style.display = 'none';
     
            }

            // Correctly find and log the user ID
            const container = edit.closest('tr'); // Get the closest table row
            const equipmentIDInput = container.querySelector('input[name="equipment_ID"]');
            const equipmentID = equipmentIDInput.value;

            const equipmentNameInput = container.querySelector('input[name="equipment_name"]')
            const equipmentName = equipmentNameInput.value;

            const equipmentStatusInput = container.querySelector('input[name="equipment_status"]')
            const equipmentStatus = equipmentStatusInput.value;



            console.log('product ID:', equipmentID); 
            console.log('equipmet ID:', equipmentName); 
            console.log('equipmet ID:', equipmentStatus); 


            const editEquipment_ID = document.querySelector('.edit .input-field-edit input[name="equipment_ID"]').value = equipmentID;
            const editEquipment_Name = document.querySelector('.edit .input-field-edit input[name="equipment_name"]').value = equipmentName;
            const editEquipment_Pass = document.querySelector('.edit .input-field-edit select[name="equipment_status"]').value = equipmentStatus;


        });
    });

    
    document.querySelectorAll('#cancel').forEach(hide =>{
        hide.addEventListener('click', () =>{

                editInfoContainer.style.display = 'none';
                add_container.style.display = 'none'
                removeContainer.style.display='none'
        })
    })



    const removeEquipment = document.querySelectorAll('button[name="removeEquipment"]')


    removeEquipment.forEach(remove =>{
    remove.addEventListener('click', ()=>{

        if(removeContainer.style.display === 'none'){
            removeContainer.style.display = 'flex'
            editInfoContainer.style.display = 'none'
            add_container.style.display = 'none'
        }else{
            removeContainer.style.display = 'none'
        }

        const container = remove.closest('tr');
        const removeIDInput = container.querySelector('input[name="equipment_ID"]');
        const removeID = removeIDInput.value

        const removeNAMEInput = container.querySelector('input[name="equipment_name"]')
        const removeNAME = removeNAMEInput.value

        const removeUser_ID = document.querySelector('.removeEquipment input[name="delete_equipment_ID"]').value = removeID

        const displayNAME = document.getElementById('user_name').innerHTML = removeNAME

    })
})

})