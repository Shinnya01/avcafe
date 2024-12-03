<?php
require_once "../../config/connect.php";


$sql = "SELECT 
        (SELECT COUNT(product_ID) FROM product) AS totalProducts, 
        (SELECT COUNT(staff_ID) FROM staff) AS totalStaff";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$totalProducts = $result['totalProducts'];
$totalStaff  = $result['totalStaff'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- SOLO LINK -->
    <link rel="stylesheet" href="../../style/admin/adminDashboard1.css">

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
            <section class="title"><i class="bi bi-people"></i> Total Staff</section>

            <section class="total"><?php echo $totalStaff ?></section>
        </div>

        <!-- END TOTAL -->
    </section>

    <!-- BOTTOM SECTION -->

    <section class="bottom">


        <!-- TO DO LIST -->
        <div class="to-do-list">
            <!-- LIST HEADER -->
            <section class="list-header" style="justify-content: space-between;">
                <section class="title">
                    <i class="bi bi-card-checklist"></i>To do list
                </section>
                <section>
                    <button class="completed-task-btn" onclick="showCompletedTask()">COMPLETED TASK</button>
                    <button class="new" onclick="newList()">NEW</button>
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
                                        <td><button name="done_list_admin" value="<?php echo $list['list_ID'] ?>">DONE</button></td>
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


    <!-- FOR VIEW COMPLETED TASK -->
    <div class="completed-task-container" style="display: none;">
        <div class="completed-task-header">
            <h3>COMPLETED TASK</h3>
            <i class="bi bi-x exit"></i>

        </div>
        <?php $sql = "SELECT * FROM to_do_list WHERE list_status = 'done' ORDER BY list_created ASC ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (COUNT($result) < 1) {
            echo "<h2 style='text-align:center'>EMPTY</h2>";
        } else {

        ?>
            <section class="completed-task-data-container">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>List Name</th>
                            <th>Status</th>
                            <th>Assigned To</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $num = 1;
                        foreach ($result as $list): ?>
                            <tr>
                                <td><?php echo $num ?></td>
                                <td><?php echo $list['list_name'] ?></td>
                                <td><?php echo $list['list_status'] ?></td>
                                <td><?php echo $list['list_assigned'] ?></td>
                            </tr>
                    <?php $num++;
                        endforeach;
                    } ?>
                    </tbody>
                </table>
            </section>
    </div>
    <!-- ADD NEW -->
    <section class="add-container" style="z-index: 20; display:none">
        <form
            action="../../config/insert.php"
            method="post">
            <div class="input-container">
                <h3>ADD TO DO LIST</h3>

                <section class="input-field">
                    <!-- INPUT ITEM INFORMATION SECTION -->

                    <!-- TO DO LIST NAME -->
                    <div class="info-input-field">
                        <label for="to-do-list-name">To do list name</label>

                        <input
                            type="text"
                            name="list_name"
                            id="to-do-list-name"
                            placeholder="Enter List Name" />
                    </div>

                    <div class="info-input-field">
                        <label for="assign-to">Assign to</label>

                        <?php
                        $sql = "SELECT staff_name FROM staff";
                        $stmt = $pdo->query($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


                        ?>
                        <select name="list_assigned" id="assign-to" required>
                            <option selected disabled>SELECT</option>
                            <?php foreach ($result as $staff): ?>
                                <option value="<?php echo $staff['staff_name'] ?>"><?php echo $staff['staff_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- ITEM INFO END -->
                </section>
                <section class="add-btn">
                    <button name="addListAdmin">ADD LIST</button>
                    <div id="cancel">CANCEL</div>
                </section>
            </div>
        </form>
    </section>
    <style>
        .addList,
        .update-success,
        .delete-success,
        .invalid {
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


    <?php
    if (isset($_GET['listAdded'])) { ?>
        <div class="addList">
            <i class="bi bi-check"></i>
            <p>List added</p>
        </div>
        <script>
            const listSuccess = document.querySelector('.addList');

            setTimeout(function() {
                listSuccess.style.top = '12.5rem';
            }, 500);

            setTimeout(function() {
                listSuccess.style.display = 'none';
            }, 3000);
        </script>
    <?php } else if (isset($_GET['invalid'])) { ?>

        <div class="invalid">
            <i class="bi bi-x"></i>
            <p>Please try again</p>
        </div>
        <script>
            const invalid = document.querySelector('.invalid');

            setTimeout(function() {
                invalid.style.top = '12.5rem';
            }, 500);

            setTimeout(function() {
                invalid.style.display = 'none';
            }, 3000);
        </script>
    <?php } ?>

    <!-- <script src="../../script/dashboard/show_add-list.js"></script> -->
    <script src="../../script/pop-menu.js"></script>
    <script src="../../script/admin/show-hide-admin.js"></script>

    <!-- <script src="../../script/admin/show-completed-task1.js"></script> -->
</body>

</html>