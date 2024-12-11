<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- solo link -->
  <link rel="stylesheet" href="../../style/staff/iframes/list_6.css" />

  <!-- for insert  -->
  <link rel="stylesheet" href="../../style/staff/iframes/edit_info.css" />

  <link rel="stylesheet" href="../../style/staff/iframes/deleteUser.css">

  <link rel="stylesheet" href="../../style/staff/edit-product1.css">
  <!-- bootstrap link -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />


  <link rel="stylesheet" href="../../style/staff/iframes/search.css">
</head>

<body>
  <section class="data-container" style="z-index: 5">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>ID</th>
          <th>USERNAME</th>
          <th>PASSWORD</th>
          <th>EMAIL</th>
          <th>REGISTRATION DATE</th>

          <th><button class="new">NEW</button></th>
          <th>
            <i class="bi bi-search" id="showSearchBtn" onclick="showSearch()"></i>
            <i class="bi bi-x" id="removeSearchBtn" onclick="removeSearch()" style="display: none; cursor:pointer"></i>

            <form action="staff-list1.php" method="post">
              <div id="search-box" style="display: none;">
                <input type="text" name="findStaff" id="searchField">

                <input type="submit" id="submitSearch" style="display:none">
                <label for="submitSearch"> <i class="bi bi-search"></i></label>
              </div>
            </form>

          </th>
        </tr>
      </thead>
      <?php

      require_once "../../config/connect.php";




      if (isset($_POST['findStaff'])) {
        $findStaff = $_POST['findStaff'] . '%';

        $sql = "SELECT * FROM staff WHERE staff_name LIKE :findStaff";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':findStaff', $findStaff);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (COUNT($result) > 0) {
      ?>
          <tbody>
            <?php
            $staff_count = 1;
            foreach ($result as $staff): ?>
              <tr>
                <td><?php echo $staff_count ?></td>
                <td><?php echo $staff['staff_ID'] ?>
                  <input type="hidden" name="staff_ID" value="<?php echo  $staff['staff_ID'] ?>">
                </td>
                <td><?php echo $staff['staff_name'] ?>
                  <input type="hidden" name="staff_name" value="<?php echo $staff['staff_name'] ?>">
                </td>
                <td><?php echo $staff['staff_pass'] ?>
                  <input type="hidden" name="staff_pass" value="<?php echo $staff['staff_pass'] ?>">
                </td>
                <td><?php echo $staff['staff_email'] ?>
                  <input type="hidden" name="staff_email" value="<?php echo $staff['staff_email'] ?>">
                </td>
                <td><?php echo $staff['staff_reg_date'] ?></td>


                <td style="position: relative">
                  <i class="bi bi-three-dots-vertical pop-menu"></i>

                  <div class="action-menu" style="position: absolute">
                    <button name="editStaff-list">EDIT</button>
                    <button name="removeStaff-list" style="background-color: rgb(255, 26, 26);">REMOVE</button>
                  </div>
                </td>
                <td></td>
              </tr>
            <?php
              $staff_count++;
            endforeach;  ?>
          </tbody>
        <?php
        } else {
        ?>
          <tr>
            <td colspan="10" style="text-align: center;">No seller found</td>
          </tr>
        <?php
        }
      } else {

        $sql = "SELECT * FROM staff";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <tbody>
          <?php
          $staff_count = 1;
          foreach ($result as $staff): ?>
            <tr>
              <td><?php echo $staff_count ?></td>
              <td><?php echo $staff['staff_ID'] ?>
                <input type="hidden" name="staff_ID" value="<?php echo  $staff['staff_ID'] ?>">
              </td>
              <td><?php echo $staff['staff_name'] ?>
                <input type="hidden" name="staff_name" value="<?php echo $staff['staff_name'] ?>">
              </td>
              <td><?php echo $staff['staff_pass'] ?>
                <input type="hidden" name="staff_pass" value="<?php echo $staff['staff_pass'] ?>">
              </td>
              <td><?php echo $staff['staff_email'] ?>
                <input type="hidden" name="staff_email" value="<?php echo $staff['staff_email'] ?>">
              </td>
              <td><?php echo $staff['staff_reg_date'] ?></td>


              <td style="position: relative">
                <i class="bi bi-three-dots-vertical pop-menu"></i>

                <div class="action-menu" style="position: absolute">
                  <button name="editStaff-list">EDIT</button>
                  <button name="removeStaff-list" style="background-color: rgb(255, 26, 26);">REMOVE</button>
                </div>
              </td>
              <td></td>
            </tr>
          <?php
            $staff_count++;
          endforeach;  ?>
        </tbody>
      <?php } ?>
    </table>
  </section>

  <!-- FOR ADD USER -->
  <section class="add-container" style="z-index: 10; display: none">
    <form action="../../config/insert.php" method="post">
      <h3>ADD CUSTOMER</h3>
      <div class="input-field">
        <label for="staff_name">Name:</label>
        <input type="text" name="staff_name" id="staff_name" required />

        <label for="staff_pass">Password:</label>
        <input type="text" name="staff_pass" id="staff_pass" required />

        <label for="staff_email">Email:</label>
        <input type="email" name="staff_email" id="staff_email" required />
      </div>

      <div class="add-btn">
        <button name="addStaff">ADD</button>
        <div id="cancel">CANCEL</div>
      </div>
    </form>
  </section>

  <form action="../../config/insert.php" method="post">
    <section class="edit" style="display: none;">

      <h3>EDIT STAFF</h3>
      <div class="input-field">
        <input type="hidden" name="staff_ID" value="null">

        <label for="staff_name">Name:</label>
        <input type="text" name="staff_name" id="staff_name" value="null" />

        <label for="staff_pass">Password:</label>
        <input type="text" name="staff_pass" id="staff_pass" value="null" />

        <label for="staff_email">Email:</label>
        <input type="email" name="staff_email" id="staff_email" value="null" />
      </div>

      <div class="add-btn">
        <button name="editStaff">SUBMIT</button>
        <div id="cancel">CANCEL</div>
      </div>

    </section>
  </form>

  <form action="../../config/insert.php" method="post">
    <section class="removeUser" style="display: none;">

      <div class="del-icon">
        <i class="bi bi-trash3"></i>
      </div>

      <input type="hidden" name="delete_user_ID" value="null">
      <div class="delete-info">
        <h1>Confirm delete user: <span id="user_name"></span> ?</h1>
      </div>


      <div class="del-action-btn">
        <button name="deleteStaff">DELETE</button>
        <div id="cancel">CANCEL</div>
      </div>

    </section>
  </form>

  <!-- POP UPS -->
  <style>
    .staffAdded,
    .update-success,
    .delete-success,
    .email-error {
      position: fixed;
      top: -10rem;
      left: 50%;
      transform: translateX(-50%);

      padding: .5rem 3rem;

      border-radius: 30px;

      text-align: center;

      z-index: 10;

      background-color: #002050c7;
      backdrop-filter: blur(5px);

      transition: all .3s ease;


      font-size: 1.5rem;

      display: flex;
      align-items: center;

      gap: 1rem;

      color: white;
    }
  </style>
  <?php if (isset($_GET['staffAdded'])) { ?>
    <div class="staffAdded">
      <i class="bi bi-check"></i>
      <p>Staff Added</p>
    </div>
    <script>
      const addSuccess = document.querySelector('.staffAdded');

      setTimeout(function() {
        addSuccess.style.top = '1rem';
      }, 500);

      setTimeout(function() {
        addSuccess.style.display = 'none';
      }, 3000);
    </script>
  <?php } else if (isset($_GET['updateSuccess'])) { ?>
    <div class="update-success">
      <i class="bi bi-check"></i>
      <p>Update success</p>
    </div>
    <script>
      const updateSuccess = document.querySelector('.update-success');

      setTimeout(function() {
        updateSuccess.style.top = '1rem';
      }, 500);

      setTimeout(function() {
        updateSuccess.style.display = 'none';
      }, 3000);
    </script>
  <?php } else if (isset($_GET['deleteSuccess'])) { ?>
    <div class="delete-success">
      <i class="bi bi-check"></i>
      <p>Delete success</p>
    </div>
    <script>
      const delSuccess = document.querySelector('.delete-success');

      setTimeout(function() {
        delSuccess.style.top = '1rem';
      }, 500);

      setTimeout(function() {
        delSuccess.style.display = 'none';
      }, 3000);
    </script>
  <?php } else if (isset($_GET['emailError'])) { ?>
    <div class="email-error">
      <i class="bi bi-x"></i>
      <p>Email is already registered</p>
    </div>
    <script>
      const emailError = document.querySelector('.email-error');

      setTimeout(function() {
        emailError.style.top = '1rem';
      }, 500);

      setTimeout(function() {
        emailError.style.display = 'none';
      }, 3000);
    </script>
  <?php } ?>

  <script src="../../script/pop-menu.js"></script>

  <!-- <script src="../../script/admin/staff-list.js"></script> -->

  <script src="../../script/admin/show-hide-add-staff-list1.js"></script>

  <script src="../../script/staff/search.js"></script>
</body>

</html>