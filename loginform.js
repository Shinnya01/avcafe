const loginType = document.querySelectorAll('input[name="login-type"]')

loginType.forEach(login =>{
    login.addEventListener('click', () =>{

        const staffLogin = document.querySelector('.login-type_staff')
        const adminLogin = document.querySelector('.login-type_admin')

        const staffBtn = document.querySelector('button[name="staff-login"]')
        const adminBtn = document.querySelector('button[name="admin-login"]')


        

        if(login.value === 'staff_login'){
            
            document.querySelector('input[name=staff_email]').value = ''
            document.querySelector('input[name=staff_password]').value = ''

            staffLogin.style.display='flex';
            adminLogin.style.display='none';



        }else if(login.value === 'admin_login'){


            document.querySelector('input[name=admin_email]').value = ''
            document.querySelector('input[name=admin_password]').value = ''

            adminLogin.style.display='flex'
            staffLogin.style.display='none'
        }

    })
})