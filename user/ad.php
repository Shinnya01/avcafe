<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Av Café Menu</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon" />

    <!-- Swiper CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- BOOTSTRAP ICONS-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../style/user/userMenu.css" />

    <!-- POP UPS -->
    <link rel="stylesheet" href="../style/user/pop/userDetail4.css" />
    <link rel="stylesheet" href="../style/user/pop/buy_Cart1.css">

    <!-- FOR CART -->
    <link rel="stylesheet" href="../style/user/pop/cartContainer6.css">

    <!-- FOOTER -->
    <link rel="stylesheet" href="../style/user/footer-Header1.css" />

    <link rel="stylesheet" href="../style/user/login2.css">

    <style>
        .title {
            font-size: 2rem;
        }

        #cancelUserDetail {
            cursor: pointer;
        }

        .user-img {
            border: 5px solid white;
        }
    </style>

</head>
<?php require_once "../config/connect.php"; ?>

<body>


    <!-- HEADER -->
    <header class=" main-header">
        <!-- LOGO -->
        <a href="user-homepage.php"><img src="../img/logo/logo_1.png" alt="" /></a>
        <!-- NAV LINKS -->
        <nav>
            <ul>
                <li><a href="user-homepage1.php">Home</a></li>
                <li><a href="#about-us">About us</a></li>
                <li><a href="#menu">Menu</a></li>
                <li>
                    <i class="bi bi-cart"></i>
                </li>

                <li>
                    <i class="bi bi-person"></i>
                </li>
            </ul>
        </nav>
    </header>

</body>