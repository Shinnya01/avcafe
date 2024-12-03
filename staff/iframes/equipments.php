<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- solo link -->
  <link rel="stylesheet" href="../../style/staff/iframes/list_6.css" />


  <!-- bootstrap link -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<!-- for insert -->
<link rel="stylesheet" href="../../style/staff/iframes/edit_info.css" />

<link rel="stylesheet" href="../../style/staff/edit-product1.css">

<link rel="stylesheet" href="../../style/staff/deleteEquipment.css">

<body>
  <section class="data-container">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>EQUIPMENT ID</th>
          <th>NAME</th>
          <th>STATUS</th>

          <th><button class="new">NEW</button></th>
        </tr>
      </thead>
      <?php
      require_once "../../config/connect.php";

      $sql = "SELECT * FROM equipment";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <tbody>
        <?php $number_count = 1;
        foreach ($result as $equipment): ?>
          <tr>
            <td><?php echo $number_count ?></td>
            <td>
              <?php echo $equipment['equipment_ID'] ?>
              <input type="hidden" name="equipment_ID" value="<?php echo $equipment['equipment_ID'] ?>">
            </td>
            <td>
              <?php echo $equipment['equipment_name'] ?>
              <input type="hidden" name="equipment_name" value="<?php echo $equipment['equipment_name'] ?>">
            </td>
            <td style="text-transform: capitalize;">
              <?php echo $equipment['equipment_status'] ?>
              <input type="hidden" name="equipment_status" value="<?php echo $equipment['equipment_status'] ?>">
            </td>

            <td style="position: relative">
              <i class="bi bi-three-dots-vertical pop-menu"></i>

              <div class="action-menu" style="position: absolute">
                <button name="editEquipment">EDIT</button>
                <button name="removeEquipment">REMOVE</button>
              </div>
            </td>
          </tr>

        <?php $number_count++;
        endforeach; ?>
      </tbody>
    </table>
  </section>

  <section class="add-container" style="z-index: 10; display: none">
    <h3>ADD EQUIPMENT</h3>
    <form action="../../config/insert.php" method="post">
      <div class="input-field">
        <label for="equipment_name">Equipment Name:</label>
        <input type="text" name="equipment_name" id="equipment_name" />

        <label for="equipment_status">Status:</label>
        <select name="equipment_status" id="equipment_status" required>
          <option selected disabled>SELECT</option>
          <option value="available">AVAILABLE</option>
          <option value="unavailable">UNAVAILABLE</option>
        </select>
      </div>

      <div class="add-btn">
        <button name="addEquipment">ADD</button>
        <div id="cancel">CANCEL</div>
      </div>
    </form>
  </section>


  <section class="edit" style="display:none;">
    <form action="../../config/staff/staff-config.php" method="post">
      <h3>EDIT EQUIPMENT</h3>
      <div class="input-field-edit">
        <input type="hidden" name="equipment_ID" value="0">

        <label for="staff_name">Name:</label>
        <input type="text" name="equipment_name" id="staff_name" value="" style="padding-inline: 5px;" />

        <label for="staff_pass">Status:</label>
        <select name="equipment_status" id="">
          <option value="available">AVAILABLE</option>
          <option value="unavailable">UNAVAILABLE</option>
        </select>

      </div>

      <div class="add-btn">
        <button name="editEquipment">SUBMIT</button>
        <div id="cancel">CANCEL</div>
      </div>
    </form>
  </section>


  <form action="../../config/staff/staff-config.php" method="post">
    <section class="removeEquipment" style="display: none;">
      <div class="remove-icon">
        <i class="bi bi-trash3"></i>
      </div>

      <input type="hidden" name="delete_equipment_ID" value="0">
      <div class="delete-info">
        <h1>Confirm delete equipment: <span id="user_name"></span> ?</h1>
      </div>

      <div class="del-action-btn">
        <button name="deleteEquipment">DELETE</button>
        <div id="cancel">CANCEL</div>
      </div>

    </section>
  </form>



  <style>
    .update-success,
    .delete-success,
    .fill-everything {
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

  <?php if (isset($_GET['updateSuccess'])) { ?>
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
  <?php } else if (isset($_GET['error'])) { ?>
    <div class="fill-everything">
      <i class="bi bi-x"></i>
      <p>Please fill up everything</p>
    </div>
    <script>
      const fillUp = document.querySelector('.fill-everything');

      setTimeout(function() {
        fillUp.style.top = '1rem';
      }, 500);

      setTimeout(function() {
        fillUp.style.display = 'none';
      }, 3000);
    </script>
  <?php } ?>


  <script src="../../script/pop-menu.js"></script>
  <!-- <script src="../../script/addNew_2.js"></script> -->

  <script src="../../script/staff/show-hide-add-equipment1.js"></script>
</body>

</html>