<?php
session_start();
$admin_ID = $_SESSION['admin_ID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <!-- <link rel="stylesheet" href="../../style/staff/homepage-admin.css" /> -->
    <link rel="stylesheet" href="../style/staff/homepage-admin.css" />
    <link rel="stylesheet" href="../style/admin/admin-detail3.css">


    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>
    <header>
        <a href=""><img src="../IMG/logo/logo_1.png" alt="" /></a>

        <i class="bi bi-person"></i>
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

                <!-- CUSTOMERS -->
                <li class="links">
                    <a href="#staff-list">
                        <i class="bi bi-person"></i>
                        <h5>Staff</h5>
                    </a>
                </li>

            </ul>
        </nav>

        <aside class="adminDetail">
            <div class="user-container-header" style="display: flex; justify-content:space-between; align-items:center; font-size: 2rem;">
                <h1 style="font-size: 3rem;">User Information</h1>
                <h3 style="cursor: pointer;" onclick="document.querySelector('.adminDetail').style.display='none'"><i class="bi bi-x"></i></h3>
            </div>
            <?php
            require_once "../config/connect.php";

            $sql = "SELECT * FROM admin WHERE admin_ID = :admin_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':admin_ID', $admin_ID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>


            <form action="../config/admin/admin-config.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="admin_ID" value="<?php echo $admin_ID ?>">



                <section class="user-info">

                    <ul>
                        <li>
                            <label for="admin_name">Name:</label>
                            <input type="text" name="admin_name" id="admin_name" value="<?php echo $result['admin_name'] ?>">
                        </li>

                    </ul>
                    <ul>

                        <li>
                            <label for="admin_pass">Password</label>
                            <input type="text" name="admin_pass" id="admin_pass" value="<?php echo $result['admin_pass'] ?>">
                        </li>
                    </ul>

                </section>
                <div class="email-input">
                    <label for="admin_email">Email</label>
                    <input type="email" name="admin_email" id="admin_email" value="<?php echo $result['admin_email'] ?>">
                </div>



                <div class="info-action-btn">
                    <div class="sign_out">
                        <button name="log-out"><i class="bi bi-arrow-left"></i>LOG OUT</button>
                    </div>
                    <div class="actionBTN">
                        <button name="saveAdminDetail">SAVE</button>
                        <div id="cancelUserDetail" style="cursor:pointer" onclick="location.reload()">CANCEL</div>
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
                <iframe id="dashboard" src="iframes/admin-dashboard2.php"></iframe>
                <!-- USER-LIST -->
                <iframe id="staff-list" src="iframes/staff-list1.php"></iframe>
                <!-- USER-LIST END -->

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


        <?php
        if (isset($_GET['updateSuccess'])) { ?>
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

    <script src="../script/admin/show_admin_info.js"></script>


    <script src="../script/admin/breadcrumb.js"></script>
</body>

</html>