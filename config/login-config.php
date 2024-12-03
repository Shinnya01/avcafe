<?php
require_once "connect.php";
session_start();




switch (isset($_POST)) {
    case isset($_POST['staff-login']):
        $staff_email = $_POST['staff_email'];
        $staff_password = $_POST['staff_password'];

        var_dump($staff_email . $staff_password);

        $sql = "SELECT staff_email, staff_pass, staff_ID FROM staff WHERE staff_email = :staff_email AND staff_pass = :staff_password";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':staff_email', $staff_email);
        $stmt->bindParam(':staff_password', $staff_password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            // var_dump($result['staff_ID']);

            $_SESSION['staff_ID'] = $result['staff_ID'];

            header("Location: ../staff/staff_homepage1.php");
        } else {
            header("Location: ../loginform.php?error");
        }
        break;

    case isset($_POST['admin-login']):

        $admin_email = $_POST['admin_email'];
        $admin_password = $_POST['admin_password'];

        var_dump($admin_email . $admin_password);

        $sql = "SELECT admin_ID, admin_email, admin_pass FROM admin WHERE admin_email = :admin_email AND admin_pass = :admin_password";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':admin_email', $admin_email);
        $stmt->bindParam(':admin_password', $admin_password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            // var_dump($result['admin_ID']);

            $_SESSION['admin_ID'] = $result['admin_ID'];
            header("Location: ../admin/admin-homepage3.php");
        } else {
            header("Location: ../loginform.php?error");
        }
        break;
    case isset($_POST['user-login']):

        $user_email = $_POST['user_email'];
        $user_pass = $_POST['user_pass'];



        $sql = "SELECT user_ID, user_email, user_pass FROM user WHERE user_email = :user_email AND user_pass = :user_pass";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_email', $user_email);
        $stmt->bindParam(':user_pass', $user_pass);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['user_ID'] = $result['user_ID'];
            header("Location: ../user/userHomepage1.php?home");
        } else {
            header("Location: ../user/userHomepage1.php?error");
        }

        break;
    case isset($_POST['user-login-menu']):

        $user_email = $_POST['user_email'];
        $user_pass = $_POST['user_pass'];



        $sql = "SELECT user_ID, user_email, user_pass FROM user WHERE user_email = :user_email AND user_pass = :user_pass";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_email', $user_email);
        $stmt->bindParam(':user_pass', $user_pass);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['user_ID'] = $result['user_ID'];
            header("Location: ../user/menu5.php?menu");
        } else {

            header("Location: ../user/menu5.php?error");
        }

        break;

    case isset($_POST['log-out']):
        session_unset();
        session_destroy();
        header("Location: ../user/menu5.php");
        break;

    case isset($_POST['user-reg']):

        try {
            $user_name = $_POST['user_name'];
            $user_pass = $_POST['user_pass'];
            $user_email = $_POST['user_email'];


            $sql = "INSERT INTO user (user_name, user_pass, user_email) VALUES (:user_name, :user_pass, :user_email)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':user_pass', $user_pass);
            $stmt->bindParam(':user_email', $user_email);

            $stmt->execute();
            header("Location: ../user/userHomepage1.php");
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                header("Location: ../user/userHomepage1.php?emailError");
            }
        }
        break;

    case isset($_POST['user-reg-menu']):

        try {
            $user_name = $_POST['user_name'];
            $user_pass = $_POST['user_pass'];
            $user_email = $_POST['user_email'];


            $sql = "INSERT INTO user (user_name, user_pass, user_email) VALUES (:user_name, :user_pass, :user_email)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':user_pass', $user_pass);
            $stmt->bindParam(':user_email', $user_email);

            $stmt->execute();
            header("Location: ../user/menu5.php");
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                header("Location: ../user/menu5.php?emailError");
            }
        }
        break;
}
