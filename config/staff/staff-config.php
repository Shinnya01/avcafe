<?php
require_once "../connect.php";
session_start();

switch (isset($_POST)) {

    case isset($_POST['deleteEquipment']):
        try {
            $remove_ID = $_POST['delete_equipment_ID'];

            var_dump($remove_ID);

            $sql = "DELETE FROM 
                    equipment
                    WHERE 
                    equipment_ID = :delete_equipment_ID";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':delete_equipment_ID', $remove_ID);
            $stmt->execute();

            header("Location: ../../staff/iframes/equipments.php?deleteSuccess");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        break;


    case isset($_POST['editEquipment']):
        try {
            $equipment_ID = $_POST['equipment_ID'];
            $equipment_name = $_POST['equipment_name'];
            $equipment_status = $_POST['equipment_status'];


            $sql = "UPDATE 
                    equipment 
                    SET 
                    equipment_name =:equipment_name, equipment_status = :equipment_status 
                    WHERE equipment_ID = :equipment_ID";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':equipment_ID', $equipment_ID);
            $stmt->bindParam(':equipment_name', $equipment_name);
            $stmt->bindParam(':equipment_status', $equipment_status);

            $stmt->execute();

            header("Location: ../../staff/iframes/equipments.php?updateSuccess");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        break;

    case isset($_POST['deleteProduct']):
        try {
            $remove_ID = $_POST['delete_product_ID'];

            var_dump($remove_ID);

            $sql = "DELETE FROM 
                        product
                        WHERE 
                        product_ID = :delete_product_ID";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':delete_product_ID', $remove_ID);
            $stmt->execute();

            header("Location: ../../staff/iframes/inventory3.php?deleteSuccess");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        break;

    case isset($_POST['editProduct']):
        try {
            $product_ID = $_POST['product_ID'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_status = $_POST['product_status'];



            $sql = "UPDATE 
                            product 
                            SET 
                            product_name =:product_name, product_price = :product_price, 
                            product_status = :product_status
                            WHERE product_ID = :product_ID";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':product_ID', $product_ID);
            $stmt->bindParam(':product_name', $product_name);
            $stmt->bindParam(':product_price', $product_price);
            $stmt->bindParam(':product_status', $product_status);


            $stmt->execute();

            header("Location: ../../staff/iframes/inventory3.php?updateSuccess");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        break;

    case isset($_POST['log-out']):
        session_start();
        session_unset();
        session_destroy();

        header("Location: ../../loginform.php");

        break;


    case isset($_POST['saveStaffDetail']):

        $staff_ID = $_POST['staff_ID'];
        $staff_name = $_POST['staff_name'];
        $staff_pass = $_POST['staff_pass'];
        $staff_email = $_POST['staff_email'];

        $sql = "UPDATE staff 
        SET 
        staff_name = :staff_name, staff_pass = :staff_pass, staff_email = :staff_email WHERE staff_ID = :staff_ID";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':staff_name', $staff_name);
        $stmt->bindParam(':staff_pass', $staff_pass);
        $stmt->bindParam(':staff_email', $staff_email);
        $stmt->bindParam(':staff_ID', $staff_ID);
        $stmt->execute();

        header("Location: ../../staff/staff_homepage1.php?updateSuccess");

        break;
}
