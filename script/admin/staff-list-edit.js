document.addEventListener('DOMContentLoaded', () => {
    const editInfo = document.querySelectorAll('button[name="editBtn"]');
    const editInfoContainer = document.querySelector('.edit-customer');

    editInfo.forEach(edit => {
        edit.addEventListener('click', () => {
            // show edit container
            if (editInfoContainer.style.display === 'none') {
                editInfoContainer.style.display = 'flex';
            } else {
                editInfoContainer.style.display = 'none';
            }

            // Correctly find and log the user ID
            const container = edit.closest('tr'); // Get the closest table row
            const userIDInput = container.querySelector('input[name="user_ID"]');
            const userID = userIDInput.value;

            const userNameInput = container.querySelector('td:nth-child(2)')
            const userName = userNameInput.textContent;

            const userPassInput = container.querySelector('td:nth-child(3)')
            const userPass = userPassInput.textContent;

            const userEmailInput = container.querySelector('td:nth-child(4)')
            const userEmail = userEmailInput.textContent;


            console.log('User ID:', userID); 
            console.log('User ID:', userName); 
            console.log('User ID:', userPass); 
            console.log('User ID:', userEmail); 

            const editUser_ID = document.querySelector('.edit-customer .input-field input[name="staff_ID"]').value = userID;
            const editUser_Name = document.querySelector('.edit-customer .input-field input[name="staff_name"]').value = userName;
            const editUser_Pass = document.querySelector('.edit-customer .input-field input[name="staff_pass"]').value = userPass;
            const editUser_Email = document.querySelector('.edit-customer .input-field input[name="staff_email"]').value = userEmail;


        });
    });
});
