<?php
require_once "../connect.php";
session_start();


switch (isset($_POST)) {

    case isset($_POST['saveAdminDetail']):
        try {
            $admin_name = $_POST['admin_name'];
            $admin_pass = $_POST['admin_pass'];
            $admin_email = $_POST['admin_email'];
            $admin_ID = $_POST['admin_ID'];




            $sql = "UPDATE admin 
                    SET admin_name = :admin_name, 
                        admin_pass = :admin_pass, 
                        admin_email = :admin_email
             
                        WHERE admin_ID = :admin_ID";

            $stmt = $pdo->prepare($sql);


            $stmt->bindParam(':admin_name', $admin_name);
            $stmt->bindParam(':admin_pass', $admin_pass);
            $stmt->bindParam(':admin_email', $admin_email);

            $stmt->bindParam(':admin_ID', $admin_ID);

            $stmt->execute();

            header("Location: ../../admin/admin-homepage3.php?updateSuccess");
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
}
