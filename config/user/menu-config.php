<?php
session_start();
require_once "../connect.php";



switch (isset($_POST)) {
    case isset($_POST['buyProduct']): // BUY PRODUCT


        $user_ID = $_POST['user_ID'];

        $buyProduct_ID = $_POST['product_ID'];
        $buyProduct_name = $_POST['product_name'];
        $buyProduct_price = $_POST['product_price'];
        $buyProduct_size = $_POST['product_size-buy'];
        $buyProduct_Quantity = $_POST['product_quantity-buy'];

        $buyProduct_addOns = $_POST['product_addOns-buy'];



        switch ($buyProduct_size) {

            case 'grande':
                $buyProduct_price = $buyProduct_price;
                break;

            case 'venti':
                $buyProduct_price = $buyProduct_price + 10;
                break;
        }
        $addOn_Price = 0;
        switch ($buyProduct_addOns) {
            case 'No Add Ons':
                $addOn_Price = 0;
                break;
            case 'Espresso Shot':
                $addOn_Price = 40;
                break;
            case 'Syrup':
                $addOn_Price = 15;
                break;
            case 'Sauce':
                $addOn_Price = 20;
                break;
            case 'Sea Salt':
                $addOn_Price = 40;
                break;
        } // Store information in the session
        $_SESSION['buyProduct_ID'] = $buyProduct_ID;
        $_SESSION['buyProduct_Quantity'] = $buyProduct_Quantity;
        $_SESSION['buyProduct_Size'] = $buyProduct_size;
        $_SESSION['user_ID'] = $user_ID;
        $_SESSION['buyProduct_AddOns'] = $buyProduct_addOns;
        $_SESSION['addOns_price'] = $addOn_Price;

        header("Location: ../../user/place-order.php");

        break;

    case isset($_POST['addtoCart']): // ADD TO CART




        $user_ID = $_POST['user_ID'];

        $addCartProduct_ID = $_POST['product_ID'];
        $addCartProduct_name = $_POST['product_name'];
        $addCartProduct_price = $_POST['product_price'];
        $addCartProduct_size = $_POST['product_size'];
        $addCartProduct_Quantity = $_POST['product_quantity'];


        $addCart_addOns = $_POST['product_addOns_buy'];


        switch ($addCartProduct_size) {

            case 'small':
                $addCartProduct_price = $addCartProduct_price;
                break;

            case 'medium':
                $addCartProduct_price = $addCartProduct_price + 15;
                break;
            case 'large':
                $addCartProduct_price = $addCartProduct_price + 30;
                break;
        }
        $addOn_Price = 0;

        switch ($addOn_Price) {
            case 'No Add Ons':
                $addOn_Price = 0;
                break;
            case 'Espresso Shot':
                $addOn_Price = 40;
                break;
            case 'Syrup':
                $addOn_Price = 15;
                break;
            case 'Sauce':
                $addOn_Price = 20;
                break;
            case 'Sea Salt':
                $addOn_Price = 40;
                break;
        }


        // VERIFY IF THE PRODUCT IS ON THE CART

        $sql = "SELECT user_ID, product_name, product_size, product_quantity, product_addOns FROM cart 
        WHERE product_addOns = :product_addOns_buy AND product_name = :product_name AND product_size = :product_size AND user_ID = :user_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':product_name', $addCartProduct_name);
        $stmt->bindParam(':product_size', $addCartProduct_size);
        $stmt->bindParam(':product_addOns_buy', $addCart_addOns);
        $stmt->bindParam(':user_ID', $user_ID);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            // IF THE PRODUCT IS ON THE CART 
            $addCartProduct_Quantity = $result['product_quantity'] + $_POST['product_quantity'];



            $sql = "UPDATE cart 
            SET product_quantity = :product_quantity 
            WHERE product_addOns = :product_addOns_buy AND product_name = :product_name AND product_size = :product_size AND user_ID = :user_ID";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':product_quantity', $addCartProduct_Quantity);
            $stmt->bindParam(':product_addOns_buy', $addCart_addOns);
            $stmt->bindParam(':product_name', $addCartProduct_name);
            $stmt->bindParam(':product_size', $addCartProduct_size);
            $stmt->bindParam(':user_ID', $user_ID);


            $stmt->execute();

            header('Location: ../../user/menu5.php?itemAdded');
        } else {

            $addCartProduct_Quantity =  $_POST['product_quantity'];

            //  IF PRODUCT IS'NT ON THE CART 
            $sql = "INSERT INTO cart (user_ID ,product_ID, product_name, product_addOns ,product_price, product_size, product_quantity) 
            VALUES (:user_ID, :product_ID, :product_name, :product_addOns  ,:product_price, :product_size, :product_quantity)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':product_ID', $addCartProduct_ID);
            $stmt->bindParam(':product_size', $addCartProduct_size);
            $stmt->bindParam(':product_name', $addCartProduct_name);
            $stmt->bindParam(':product_price', $addCartProduct_price);
            $stmt->bindParam(':product_quantity', $addCartProduct_Quantity);
            $stmt->bindParam(':product_addOns', $addCart_addOns);
            $stmt->bindParam(':user_ID', $user_ID);


            $stmt->execute();

            header('Location: ../../user/menu5.php?itemAdded');
        }
        break;
    case isset($_POST['check-out']); // CHECK OUT

        var_dump($_POST['user_ID']);

        $_SESSION['user_ID'] = $_POST['user_ID'];
        header("Location: ../../user/place-order-from_cart.php");
        break;

    case isset($_POST['saveUserDetail']):

        try {
            $user_name = $_POST['user_name'];
            $user_pass = $_POST['user_pass'];
            $user_email = $_POST['user_email'];
            $user_ID = $_POST['user_ID'];


            $sql = "UPDATE user 
                    SET user_name = :user_name, 
                        user_pass = :user_pass, 
                        user_email = :user_email
       
                        WHERE user_ID = :user_ID";

            $stmt = $pdo->prepare($sql);


            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':user_pass', $user_pass);
            $stmt->bindParam(':user_email', $user_email);
            $stmt->bindParam(':user_ID', $user_ID);

            $stmt->execute();

            header("Location: ../../user/userHomepage1.php?update");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
    case isset($_POST['saveUserDetail-menu']):

        try {
            $user_name = $_POST['user_name'];
            $user_pass = $_POST['user_pass'];
            $user_email = $_POST['user_email'];
            $user_ID = $_POST['user_ID'];


            $sql = "UPDATE user 
                    SET user_name = :user_name, 
                        user_pass = :user_pass, 
                        user_email = :user_email
       
                        WHERE user_ID = :user_ID";

            $stmt = $pdo->prepare($sql);


            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':user_pass', $user_pass);
            $stmt->bindParam(':user_email', $user_email);
            $stmt->bindParam(':user_ID', $user_ID);

            $stmt->execute();

            header("Location: ../../user/menu5.php?update");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;

    case isset($_POST['log-out-user']):

        session_unset();
        session_destroy();

        header("Location: ../../user/userHomepage1.php?logout");

        break;

    case isset($_POST['log-out-menu']):

        session_unset();
        session_destroy();

        header("Location: ../../user/menu5.php?logout");

        break;




    case isset($_POST['editProduct-menu']):

        $cart_ID = $_POST['cart_ID_edit'];


        $sql = "SELECT * FROM cart WHERE cart_ID = :cart_ID_edit";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cart_ID_edit', $cart_ID);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {

            $product_ID = $result[0]['product_ID'];


            $product_price = $_POST['product_price_edit'];

            $product_size = $_POST['product_size_edit'];
            $product_quantity = $_POST['editProduct_quantity'];
            $product_addOns = $_POST['product_addOns_edit'];


            $sql = "SELECT product_price FROM product WHERE product_ID = :product_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':product_ID', $product_ID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);


            switch ($product_size) {

                case 'Grande':
                    $product_price = $result['product_price'];

                    break;

                case 'Venti':
                    $product_price = $result['product_price'] + 10;

                    break;
            }

            $sql = "UPDATE cart 
            SET 
            product_size = :product_size_edit, product_quantity = :editProduct_quantity, product_price = :product_price_edit, product_addOns = :product_addOns_edit
            WHERE cart_ID = :cart_ID_edit";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':product_size_edit', $product_size);
            $stmt->bindParam(':product_price_edit', $product_price);
            $stmt->bindParam(':editProduct_quantity', $product_quantity);
            $stmt->bindParam(':product_addOns_edit', $product_addOns);
            $stmt->bindParam(':cart_ID_edit', $cart_ID);

            $stmt->execute();

            header("Location: ../../user/menu5.php?update");

            break;
        }

    case isset($_POST['editProduct']):

        $cart_ID = $_POST['cart_ID_edit'];


        $sql = "SELECT * FROM cart WHERE cart_ID = :cart_ID_edit";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cart_ID_edit', $cart_ID);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {

            $product_ID = $result[0]['product_ID'];


            $product_price = $_POST['product_price_edit'];

            $product_size = $_POST['product_size_edit'];
            $product_quantity = $_POST['editProduct_quantity'];
            $product_addOns = $_POST['product_addOns_edit'];


            $sql = "SELECT product_price FROM product WHERE product_ID = :product_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':product_ID', $product_ID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);


            switch ($product_size) {

                case 'Grande':
                    $product_price = $result['product_price'];

                    break;

                case 'Venti':
                    $product_price = $result['product_price'] + 10;

                    break;
            }

            $sql = "UPDATE cart 
            SET 
            product_size = :product_size_edit, product_quantity = :editProduct_quantity, product_price = :product_price_edit, product_addOns = :product_addOns_edit
            WHERE cart_ID = :cart_ID_edit";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':product_size_edit', $product_size);
            $stmt->bindParam(':product_price_edit', $product_price);
            $stmt->bindParam(':editProduct_quantity', $product_quantity);
            $stmt->bindParam(':product_addOns_edit', $product_addOns);
            $stmt->bindParam(':cart_ID_edit', $cart_ID);

            $stmt->execute();

            header("Location: ../../user/userHomepage1.php?update");

            break;
        }


    case isset($_POST['order_now_cart']):



        $user_ID = $_POST['user_ID'];


        $sql = "SELECT product_ID, product_quantity FROM cart WHERE user_ID = :user_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_ID', $user_ID);
        $stmt->execute();
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Loop through the cart items to get the product IDs and quantities
        foreach ($cartItems as $item) {
            $product_ID = $item['product_ID'];
            $product_quantity = $item['product_quantity'];

            var_dump($product_ID . "____" . $product_quantity);

            // Fetch the current product orders
            $sql = "SELECT product_orders FROM product WHERE product_ID = :product_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':product_ID', $product_ID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $new_product_quantity = $result['product_orders'] + $product_quantity;

                // Update product orders
                $sql = "UPDATE product SET product_orders = :product_quantity WHERE product_ID = :product_ID";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':product_ID', $product_ID);
                $stmt->bindParam(':product_quantity', $new_product_quantity);

                // Debugging Output
                var_dump($product_ID . "____" . $new_product_quantity);

                // Execute the update statement
                $stmt->execute();
            }
        }

        // Clear the cart for the user
        $sql = "DELETE FROM cart WHERE user_ID = :user_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_ID', $user_ID);
        $stmt->execute();

        $_SESSION['payment'] = $_POST['payment_method'];
        $user_ID = $_SESSION['user_ID'];
        header("Location: ../../user/order-placed.php");




        break;


    case isset($_POST['order_now']):

        $user_ID = $_POST['user_ID'];
        $product_quantity = $_SESSION['buyProduct_Quantity'];
        $product_ID = $_SESSION['buyProduct_ID'];



        $sql = "SELECT product_orders FROM product WHERE product_ID = :buyProduct_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':buyProduct_ID', $product_ID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $new_product_quantity = $result['product_orders'] + $product_quantity;



            // Update product orders
            $sql = "UPDATE product SET product_orders = :buyProduct_quantity WHERE product_ID = :buyProduct_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':buyProduct_ID', $product_ID);
            $stmt->bindParam(':buyProduct_quantity', $new_product_quantity);


            // Debugging Output

            // Execute the update statement
            $stmt->execute();

            $_SESSION['payment'] = $_POST['payment_method'];
            $user_ID = $_SESSION['user_ID'];

            header("Location: ../../user/order-placed.php");
        }


        break;

    case isset($_POST['removeProduct_fromCart-menu']):

        $cart_ID = $_POST['cart_ID'];
        $user_ID = $_POST['user_ID'];

        $sql = "DELETE FROM cart WHERE cart_ID = :cart_ID AND user_ID = :user_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cart_ID', $cart_ID);
        $stmt->bindParam(':user_ID', $user_ID);
        $stmt->execute();

        header("Location: ../../user/menu5.php?itemRemoved");

        break;

    case isset($_POST['removeProduct_fromCart']):

        $cart_ID = $_POST['cart_ID'];
        $user_ID = $_POST['user_ID'];

        $sql = "DELETE FROM cart WHERE cart_ID = :cart_ID AND user_ID = :user_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cart_ID', $cart_ID);
        $stmt->bindParam(':user_ID', $user_ID);
        $stmt->execute();

        header("Location: ../../user/userHomepage1.php?itemRemoved");

        break;
}
