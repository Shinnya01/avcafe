<?php
require_once "../../config/connect.php";


$sql = "SELECT 
        (SELECT COUNT(product_ID) FROM product) AS totalProducts, 
        (SELECT COUNT(user_ID) FROM user) AS totalUser";

$stmt = $pdo->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$totalProducts = $result['totalProducts'];
$totalUser  = $result['totalUser'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- SOLO LINK -->
  <link
    rel="stylesheet"
    href="../../style/staff/iframes/dashboard_admin.css" />

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

  <link rel="stylesheet" href="../../style/staff/iframes/edit_info.css" />


</head>

<body>
  <!-- TOP SECTION -->

  <section class="top">
    <!-- TOTALS -->

    <!-- TOTAL PRODUCT -->
    <div class="products">
      <!-- CONTENT -->
      <section class="title">
        <i class="bi bi-box-seam"> </i>
        <h4>Total Products</h4>
      </section>

      <section class="total"><?php echo $totalProducts ?></section>
    </div>



    <!-- TOTAL CUSTOMER -->
    <div class="customers">
      <!-- CONTENT -->
      <section class="title"><i class="bi bi-people"></i> Total User</section>

      <section class="total"><?php echo $totalUser ?></section>
    </div>

    <!-- END TOTAL -->
  </section>

  <!-- BOTTOM SECTION -->

  <section class="bottom">

    <!-- TO DO LIST -->
    <div class="to-do-list">
      <!-- LIST HEADER -->
      <section class="list-header">
        <section class="title">
          <i class="bi bi-card-checklist"></i>To do list
        </section>
      </section>

      <!-- LIST CONTAINER -->

      <?php

      require_once "../../config/connect.php";


      $sql = "SELECT * FROM to_do_list WHERE list_status = 'pending' ORDER BY list_created ASC";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (COUNT($result) < 1) {
        echo "<h2 style='text-align:center'>TO DO LIST IS EMPTY</h2>";
      } else {
      ?>
        <section class="data-container">
          <table>
            <thead>
              <tr>
                <th>No.</th>
                <th>List Name</th>
                <th>Time Created</th>
                <th>Status</th>
                <th>Assigned To</th>
                <th></th>
              </tr>
            </thead>
            <form action="../../config/insert.php" method="post">
              <?php
              $num = 1;
              foreach ($result as $list):
              ?>
                <tbody>
                  <tr>
                    <td><?php echo $num ?></td>
                    <td><?php echo $list['list_name'] ?></td>
                    <td><?php echo $list['list_created'] ?></td>
                    <td><?php echo $list['list_status'] ?></td>
                    <td><?php echo $list['list_assigned'] ?></td>
                    <td><button name="done_list" value="<?php echo $list['list_ID'] ?>">DONE</button></td>
                  </tr>
              <?php $num++;
              endforeach;
            } ?>
                </tbody>
            </form>
          </table>
        </section>
        <!-- data container end -->
    </div>
    <!-- to do list end -->
  </section>

  <!-- END DASHBOARD -->

  <!-- ADD NEW -->
  <section class="add-container" style="z-index: 10; display: none;">
    <form
      action="../../config/insert.php"
      method="post">
      <div class="input-container">
        <h3>ADD TO DO LIST</h3>

        <section class="input-field">
          <!-- INPUT ITEM INFORMATION SECTION -->

          <!-- PRODUCT NAME -->
          <div class="info-input-field">
            <label for="to-do-list-name">To do list name</label>

            <input
              type="text"
              name="list_name"
              id="to-do-list-name"
              placeholder="Enter List Name" />
          </div>

          <!-- PRODUCT STATUS -->
          <div class="info-input-field">
            <label for="list-status">Status</label>

            <select name="list_status" id="list-status" required>
              <option value="pending">PENDING</option>
              <option value="done">DONE</option>
            </select>
          </div>
          <div class="info-input-field">
            <label for="assign-to">Assign to</label>

            <select name="list_assigned" id="assign-to" required>
              <option selected disabled>SELECT</option>
              <option value="duterte">DUTERTE</option>
              <option value="bato">BATO</option>
            </select>
          </div>

          <!-- ITEM INFO END -->
        </section>
        <section class="add-btn">
          <button name="addList">ADD LIST</button>
          <div id="cancel">CANCEL</div>
        </section>
      </div>
    </form>
  </section>

  <!-- <script src="../../script/dashboard/show_add-list.js"></script> -->
  <script src="../../script/pop-menu.js"></script>

  <script src="../../script/addNew_2.js"></script>
</body>

</html>