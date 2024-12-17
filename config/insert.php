<?php
require_once "connect.php";


// ADD SECTION

switch (isset($_POST)) {
    case isset($_POST['addProduct']): //ADD PRODUCT
        try {
            $product_name = $_POST['product_name'];
            $product_category = $_POST['product_category'];
            $product_price = $_POST['product_price'];



            $product_status = $_POST['product_status'];


            $product_img = $_POST['product_img'];



            $sql = "INSERT INTO product (product_name, product_img, product_category, product_price, product_status) 
                    VALUES (:product_name, :product_img, :product_category, :product_price, :product_status)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':product_name', $product_name);
            $stmt->bindParam(':product_img', $product_img);
            $stmt->bindParam(':product_category', $product_category);
            $stmt->bindParam(':product_price', $product_price);
            $stmt->bindParam(':product_status', $product_status);


            $stmt->execute();

            header("Location: ../staff/iframes/inventory3.php?addSuccess");


            exit;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                header("Location: ../staff/iframes/inventory3.php?fillEverything");
            }
        }
        break;

    case isset($_POST['addEquipment']): // ADD EQUIPMENT

        try {
            $equipment_name = $_POST['equipment_name'];
            $equipment_status = $_POST['equipment_status'];

            $sql = "INSERT INTO equipment (equipment_name, equipment_status) VALUES (:equipment_name, :equipment_status)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':equipment_name', $equipment_name);
            $stmt->bindParam(':equipment_status', $equipment_status);

            $stmt->execute();

            header("Location: ../staff/iframes/equipments.php");
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                header("Location: ../staff/iframes/equipments.php?error");
            }
        }
        break;

    case isset($_POST['addStaff']): // ADD STAFF
        try {
            $staff_name = $_POST['staff_name'];
            $staff_pass = $_POST['staff_pass'];
            $staff_email = $_POST['staff_email'];


            $sql = "INSERT INTO staff (staff_name, staff_pass, staff_email) VALUES (:staff_name, :staff_pass, :staff_email)";
            $stmt = $pdo->prepare($sql); // Bind parameters 
            $stmt->bindParam(':staff_name', $staff_name);
            $stmt->bindParam(':staff_pass', $staff_pass);
            $stmt->bindParam(':staff_email', $staff_email); // Execute the statement 
            $stmt->execute();


            header("Location: ../admin/iframes/staff-list1.php?staffAdded");
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                header("Location: ../admin/iframes/staff-list1.php?emailError");
            }
        }
        break;
    case isset($_POST['addListAdmin']): // ADD TO DO LIST

        try {
            $list_name = $_POST['list_name'];
            $list_assigned = $_POST['list_assigned'];

            $sql = "INSERT INTO to_do_list (list_name,list_assigned ) VALUES (:list_name, :list_assigned)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':list_name', $list_name);
            $stmt->bindParam(':list_assigned', $list_assigned);

            $stmt->execute();

            header("Location: ../admin/iframes/admin-dashboard2.php?listAdded");
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                header("Location: ../admin/iframes/admin-dashboard2.php?invalid");
            }
        }
        break;
}

// EDIT SECTION

switch (isset($_POST)) {
    case isset($_POST['editStaff']): // EDIT STAFF INFO
        try {
            $edit_ID = $_POST['staff_ID'];
            $edit_name = $_POST['staff_name'];
            $edit_pass = $_POST['staff_pass'];
            $edit_email = $_POST['staff_email'];

            $sql = "UPDATE staff SET staff_name = :staff_name, staff_pass = :staff_pass, staff_email = :staff_email WHERE staff_ID = :staff_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':staff_ID', $edit_ID);
            $stmt->bindParam(':staff_name', $edit_name);
            $stmt->bindParam(':staff_pass', $edit_pass);
            $stmt->bindParam(':staff_email', $edit_email);
            $stmt->execute();



            header("Location: ../admin/iframes/staff-list1.php?updateSuccess");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
    case isset($_POST['done_list']): // IF THE LIST IS DONE
        try {

            $list_ID = $_POST['done_list'];


            var_dump($list_ID);

            $sql = "UPDATE to_do_list SET list_status = 'done' WHERE list_ID = :done_list";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':done_list', $list_ID);
            $stmt->execute();

            header("Location: ../staff/iframes/dashboard.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        break;
    case isset($_POST['done_list_admin']): // IF THE LIST 
        try {

            $list_ID = $_POST['done_list_admin'];


            var_dump($list_ID);

            $sql = "UPDATE to_do_list SET list_status = 'done' WHERE list_ID = :done_list_admin";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':done_list_admin', $list_ID);
            $stmt->execute();

            header("Location: ../admin/iframes/admin-dashboard2.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        break;
    case isset($_POST['editEquipment']): // EDIT EQUIPMENT
        $equipment_ID = $_POST['equipment_ID'];
        $equipment_name = $_POST['equipment_name'];
        $equipment_status = $_POST['equipment_status'];

        $sql = "UPDATE equipment SET equipment_name = :equipment_name, equipment_status = :equipment_status WHERE equipment_ID = :equipment_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':equipment_ID', $equipment_ID);
        $stmt->bindParam(':equipment_name', $equipment_name);
        $stmt->bindParam(':equipment_status', $equipment_status);

        $stmt->execute();

        header("Location: ../staff/admin/equipments.php");


        break;
}


// DELETE SECTION

switch (isset($_POST)) {


    case isset($_POST['deleteStaff']):
        $del_ID = $_POST['delete_user_ID'];

        var_dump($del_ID);

        $sql = "DELETE FROM staff WHERE staff_ID = :delete_user_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':delete_user_ID', $del_ID);
        $stmt->execute();

        header("Location: ../admin/iframes/staff-list1.php?deleteSuccess");

        break;
}
