<?php  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="loginform1.css" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>

  <section class="company-logo-hl">
    <img src="img/logo/icon.png" alt="" />
  </section>

  <section class="input-field-container">
    <div class="login-type">
      Login Type:
      <!-- STAFF LOGIN -->

      <input
        type="radio"
        name="login-type"
        value="staff_login"
        id="staff_login"
        checked />
      <label for="staff_login"> Staff </label>
      <!-- ADMIN LOGIN -->

      <input
        type="radio"
        name="login-type"
        value="admin_login"
        id="admin_login" />
      <label for="admin_login"> Admin </label>
    </div>

    <!-- STAFF LOGIN -->
    <form action="config/login-config.php" method="post">
      <div class="login-type_staff" style="display: flex">
        <div class="input-field">
          <input type="email" name="staff_email" placeholder="Email" autofocus />
        </div>
        <div class="input-field">
          <input
            type="password"
            name="staff_password"
            placeholder="Password" />

        </div>
        <?php if (isset($_GET['error'])) { ?>
          <p style="color: red; text-align: center">Invalid Email or password</p>
        <?php } ?>
        <button name="staff-login">LOG IN</button>
      </div>

      <!-- ADMIN LOGIN -->
      <div class="login-type_admin" style="display: none">
        <div class="input-field">
          <input type="email" name="admin_email" placeholder="Email" autofocus />
        </div>
        <div class="input-field">
          <input
            type="password"
            name="admin_password"
            placeholder="Password" />
        </div>
        <?php if (isset($_GET['error'])) { ?>
          <p style="color: red; text-align: center">Invalid Email or password</p>
        <?php } ?>
        <button name="admin-login">LOG IN</button>
      </div>
      <a href="user/userHomepage1.php" style=" color:white; display:flex;align-items:center;gap:.5rem"><i class="bi bi-arrow-left" style="font-size: 1.1rem;"></i>User Homepage</a>
    </form>
  </section>

  <script src="loginform.js"></script>
</body>

</html>