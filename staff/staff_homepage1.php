<?php
session_start();
$staff_ID = $_SESSION['staff_ID'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>

  <!-- <link rel="stylesheet" href="../../style/staff/homepage-admin.css" /> -->
  <link rel="stylesheet" href="../style/staff/homepage-admin.css" />

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

  <link rel="stylesheet" href="../style/staff/staff-Detail2.css">

  <style>
    .sign_out {

      display: flex;
      align-items: flex-end;



      & button {
        background-color: transparent;
        border: none;

        display: flex;


        gap: .5rem;
        cursor: pointer;


      }

      & button:hover {
        text-decoration: underline;
      }
    }
  </style>
</head>

<body>
  <header>
    <a href=""><img src="../IMG/logo/logo_1.png" alt="" /></a>

    <i class="bi bi-person" onclick="showStaff()"></i>
  </header>

  <main>
    <nav class="side-nav">
      <ul>
        <!-- DASHBOARD -->
        <li class="links active">
          <a href="#dashboard" onclick="refreshIframe('dashboard')">
            <i class="bi bi-house-door"></i>
            <h5>Dashboard</h5>
          </a>
        </li>


        <!-- EQUIPMENTS -->
        <li class="links">
          <a href="#equipments" onclick="refreshIframe('equipments')">
            <i class="bi bi-gear"></i>
            <h5>Equipments</h5>
          </a>
        </li>

        <!-- EQUIPMENTS -->
        <li class="links">
          <a href="#inventory" onclick="refreshIframe('inventory')">
            <i class="bi bi-box-seam"></i>
            <h5>Inventory</h5>
          </a>
        </li>





      </ul>
    </nav>

    <aside class="staffDetail" style="display: none;">
      <div class="user-container-header" style="display: flex; justify-content:space-between; align-items:center; font-size: 2rem;">
        <h1 style="font-size: 3rem;">User Information</h1>
        <h3 style="cursor: pointer;" onclick="document.querySelector('.staffDetail').style.display='none'"><i class="bi bi-x"></i></h3>
      </div>
      <?php
      require_once "../config/connect.php";

      $sql = "SELECT * FROM staff WHERE staff_ID = :staff_ID";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':staff_ID', $staff_ID);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      ?>


      <form action="../config/staff/staff-config.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="staff_ID" value="<?php echo $staff_ID ?>">



        <section class="user-info">

          <ul>
            <li>
              <label for="staff_name">Name:</label>
              <input type="text" name="staff_name" id="staff_name" value="<?php echo $result['staff_name'] ?>">
            </li>

          </ul>
          <ul>

            <li>
              <label for="staff_pass">Password</label>
              <input type="text" name="staff_pass" id="staff_pass" value="<?php echo $result['staff_pass'] ?>">
            </li>
          </ul>

        </section>
        <div class="email-input">
          <label for="staff_email">Email</label>
          <input type="email" name="staff_email" id="staff_email" value="<?php echo $result['staff_email'] ?>">
        </div>



        <div class="info-action-btn">
          <div class="sign_out">
            <button name="log-out"><i class="bi bi-arrow-left"></i>LOG OUT</button>
          </div>
          <div class="actionBTN">
            <button name="saveStaffDetail">SAVE</button>
            <div id="cancelUserDetail" style="cursor:pointer" onclick="document.querySelector('.staffDetail').style.display='none'">CANCEL</div>
          </div>

        </div>
      </form>
    </aside>

    <section class="hero">
      <!-- DASHBOARD MAPPING ABOVE -->
      <aside class="map-info">
        <i class="bi bi-house-door"></i>
        <h3 id="mapping">Dashboard</h3>
      </aside>

      <div class="contents">
        <!-- DASHBOARD START -->
        <iframe id="dashboard" src="iframes/dashboard.php"></iframe>


        <!-- EQUPMENTS -->
        <iframe id="equipments" src="iframes/equipments.php"></iframe>

        <!-- EQUIPMENTS END -->

        <!-- PRODUCT SECTION -->

        <iframe id="inventory" src="iframes/inventory3.php"></iframe>
        <!-- PRODUCT SECTION END -->

      </div>
    </section>
    <style>
      .update-success {
        position: fixed;
        top: -10rem;
        left: 50%;
        transform: translateX(-50%);

        padding: .5rem 3rem;

        border-radius: 30px;

        text-align: center;

        z-index: 10;

        background-color: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(5px);

        transition: all .3s ease;


        font-size: 1.5rem;

        display: flex;
        align-items: center;

        gap: 1rem;


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
          updateSuccess.style.top = '3rem';
        }, 500);

        setTimeout(function() {
          updateSuccess.style.display = 'none';
        }, 3000);
      </script>
    <?php } ?>
  </main>

  <script src="../script/staff_homepage2.js"></script>

  <!-- <script src="../script/staff/showHideDetail1.js"></script> -->

  <script src="../script/staff/showStaff.js"></script>

  <script src="../script/staff/breadcrumb.js"></script>
</body>

</html>