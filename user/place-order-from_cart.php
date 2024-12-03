<?php
session_start();
require_once "../config/connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../style/user/place-order4.css" />

  <link rel="stylesheet" href="../style/user/footer-Header1.css">

  <!-- FOR CART -->
  <link rel="stylesheet" href="../style/user/pop/cartContainer8.css">
  <link rel="stylesheet" href="../style/user/pop/userDetail6.css" />
  <!-- BOOTSTRAP ICON -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

  <style>
    a {
      display: flex;
      gap: .5rem;

      text-decoration: none;
      color: black;
    }

    a:hover {
      text-decoration: underline;
    }

    .sign_out {

      display: flex;
      align-items: flex-end;

      & a {
        text-decoration: underline;
      }

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

    #loading {
      display: none;
      width: 100px;
      height: 100px;
      border: 8px solid black;
      border-top: 8px solid blue;
      border-radius: 50%;
      animation: spin 2s linear infinite;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
  </style>
</head>

<body>
  <header class=" main-header">
    <!-- LOGO -->
    <a href="userHomepage1.php"><img src="../img/logo/logo_1.png" alt="" /></a>
    <!-- NAV LINKS -->
    <nav>
      <ul>
        <li><a href="userHomepage1.php">Home</a></li>
        <li><a href="#about-us">About us</a></li>
        <li><a href="menu5.php">Menu</a></li>
        <li>

          <?php
          $user_ID = $_SESSION['user_ID'];
          $sql = "SELECT COUNT(cart_ID) as item_count FROM cart WHERE user_ID = :user_ID";
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':user_ID', $user_ID);
          $stmt->execute();
          $result = $stmt->fetch(PDO::FETCH_ASSOC);

          $item_count = $result['item_count'];


          ?>
          <i class="bi bi-cart" onclick="showCart()">
            <div class="item-count"><?php echo $item_count; ?></div>
          </i>

        </li>

        <li>
          <i class="bi bi-person" onclick="showUser()"></i>
        </li>
      </ul>
    </nav>
  </header>

  <main class="place-Order-container">
    <!-- LEFT SIDE -->
    <?php


    $user_ID = $_SESSION['user_ID'];
    $sql = "SELECT 
            cart.user_ID,
            cart.cart_ID,
            cart.Product_ID,
            cart.product_name,
            cart.product_addOns,
            cart.product_quantity,
            cart.product_size,
            cart.product_price,
            cart.product_addOns,
            SUM(cart.product_price * cart.product_quantity) AS total_price,
            product.product_name,
            product.product_img
            FROM cart
            LEFT JOIN product ON cart.Product_ID = product.product_ID
            WHERE cart.user_ID = :user_ID
            GROUP BY cart.cart_ID
            ORDER BY cart.product_ID ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_ID', $user_ID);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);




    $product_subtotal = 0;
    $addOns_total = 0;

    $product_total = $product_subtotal;

    $product_count = COUNT($result);
    ?>

    <section class="left">
      <?php
      if (COUNT($result) > 0) {

      ?>


        <div class="productOrder-information">
          <div class="user-bought-product-info-header">
            <p>Product: </p>
            <p>
              <?php echo $product_count;
              $_SESSION['product_count'] = $product_count;
              ?>
            </p>
          </div>

          <div class="user-product-info">


            <?php
            foreach ($result as $product):

              $addOn_Price = 0;
              switch ($product['product_addOns']) {
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
            ?>

              <ul>
                <li>
                  <img src="../img/products/<?php echo $product['product_img'] ?>" alt="" />

                </li>
                <li><?php echo $product['product_name'] ?> <br> <span style="font-size: 1.2rem;"> <?php echo $product['product_size'] . ", " . $product['product_addOns'] ?></span> </li>
                <li>₱ <?php echo number_format((float)$product['product_price'], 2, '.', ','); ?></li>
                <li>
                  Quantity: <?php echo $product['product_quantity'] ?>
                  <input type="hidden" name="product_quantity" value="<?php echo $product['product_quantity'] ?>">
                </li>
              </ul>
              <hr>
              <?php
              $product_subtotal += $product['product_price'] * $product['product_quantity'];
              $addOns_total += $addOn_Price *=  $product['product_quantity']; ?>
            <?php endforeach; ?>

            <?php $product_subtotal ?>
            <?php $addOns_total ?>
          </div>
        </div>
        <a href="menu5.php" class="return"><i class="bi bi-arrow-left-short"></i> RETURN TO MENU</a>
    </section>
    <form action="../config/user/menu-config.php" method="post">
      <!-- right side -->
      <section class="right">
        <div class="payment-method">
          <!-- COD -->
          <label class="payment-selection-container" for="COD_payment">
            <div class="payment-selection">
              <span>Cash</span>
              <input
                type="radio"
                name="payment_method"
                id="COD_payment"
                value="Cash"
                checked />
            </div>
          </label>

          <!-- GCASH -->
          <label class="payment-selection-container" for="GCASH_payment">
            <div class="payment-selection">
              <span>Gcash</span>
              <input
                type="radio"
                name="payment_method"
                id="GCASH_payment"
                value="Gcash" />
            </div>
            <img src="../img/qr/OIP.jpeg" alt="" />
          </label>

          <!-- PAYMAYA -->
          <label class="payment-selection-container" for="PAYMAYA_payment">
            <div class="payment-selection">
              <span>Paymaya</span>
              <input
                type="radio"
                name="payment_method"
                id="PAYMAYA_payment"
                value="Paymaya" />
            </div>
            <img src="../img/qr/OIP.jpeg" alt="" />
          </label>
        </div>

        <div class="order-summary">
          <h1>Order Summary</h1>

          <div class="order-subtotal">
            <span>Subtotal (<?php echo $product_count ?> Items)</span>
            <label for="order-subtotal">₱ <?php echo number_format((float)$product_subtotal, 2, '.', ','); ?></label>
            <input type="hidden" name="" id="order-subtotal" />
          </div>

          <div class="order-subtotal">
            <span>Add On</span>
            <label for="order-subtotal">₱ <?php echo number_format((float)$addOns_total, 2, '.', ','); ?></label>
            <input type="hidden" name="" id="order-subtotal" />
          </div>


        </div>

        <hr />

        <div class="place-order">
          <div class="product-total-order">
            <strong>Total</strong>
            <label for="user-order-total">₱
              <?php
              echo number_format((float)$product_total = $product_subtotal + $addOns_total, 2, '.', ',');
              $_SESSION['order_total'] = $product_total;
              ?></label>
          </div>

          <input type="hidden" name="user_ID" value="<?php echo $_SESSION['user_ID'] ?>">
          <button name="order_now_cart" onclick="simulateLoading()" style="cursor: pointer;">ORDER NOW</button>
        </div>

      </section>
    </form>
  <?php

      } ?>


  <?php


  $user_ID = $_SESSION['user_ID'];
  $sql = "SELECT 
          cart.user_ID,
          cart.cart_ID,
          cart.Product_ID,
          cart.product_name,
          cart.product_addOns,
          cart.product_quantity,
          cart.product_size,
          cart.product_price,
          SUM(cart.product_price * cart.product_quantity) AS total_price,
          product.product_name,
          product.product_img
          FROM cart
          LEFT JOIN product ON cart.Product_ID = product.product_ID
          WHERE cart.user_ID = :user_ID
          GROUP BY cart.cart_ID
          ORDER BY cart.product_ID ASC";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':user_ID', $user_ID);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


  $subTotal = 0;
  ?>

  <aside class="cart-container" style="position: fixed; top: 0; right: -50%;">
    <div class="cart-container-header" style="display: flex; justify-content:space-between; align-items:center; font-size: 2rem">
      <h3>CART</h3>
      <h3 style="cursor: pointer;"><i class="bi bi-x"></i></h3>
    </div>
    <?php if (COUNT($result) > 0) {
    ?>

      <ul class="product-order-container-header">
        <li>ADD ONS</li>
        <li>PRICE</li>
        <li>QUANTITY</li>
        <li>TOTAL</li>

      </ul>


      <!-- ORDERS -->
      <div class="order-container">
        <!-- ORDER PRODUCTS -->

        <?php foreach ($result as $cart):
          $addOns_Price = 0;
          switch ($cart['product_addOns']) {
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
          } ?>
          <div class="cart-product-container">
            <section class="cart-left">

              <!-- PRODUCT IMAGE -->
              <img class="product-img" src="../img/products/<?php echo $cart['product_img'] ?>" alt="Product Image">

              <!-- PRODUCT INFO -->
              <div class="product-order-info">
                <ul>

                  <!-- PRODUCT NAME -->
                  <li><?php echo $cart['product_name'] ?></li>

                  <!-- ADD ONS -->
                  <li><?php echo $cart['product_addOns'] ?></li>

                  <!-- SIZE -->
                  <li><?php echo $cart['product_size'] ?></li>

                  <!-- ACTION BUTTONS -->
                  <li>
                    <div class="editProductCart" onclick="alert('Return to Homepage or Menu to edit')">EDIT</div>
                    <div class="removeProductCart" onclick="alert('Return to Homepage or Menu to remove')">REMOVE</div>
                  </li>
                </ul>
              </div>
            </section>

            <ul class="cart-right">
              <!-- ADD ONS PRICE -->
              <li> <?php echo $addOn_Price ?></li>
              <!-- PRODUCT PRICE -->
              <li><?php echo number_format((float)$cart['product_price'], 2, '.', ','); ?> </li>

              <!-- PRODUCT QUANTITY -->
              <li><?php echo $cart['product_quantity'] ?></li>

              <!-- SUBTOTAL -->
              <li><?php echo number_format((float)$cart['total_price'], 2, '.', ','); ?></li>

            </ul>
          </div>
          <hr />
          <!-- ORDER PRODUCTS END -->
          <?php $subTotal = $product_subtotal + $addOns_total ?>
        <?php endforeach;
        ?>
      </div>


      <!-- ORDERS END  -->
      <ul class="product-order-container-footer">
        <li></li>
        <li></li>
        <li>SUBTOTAL</li>
        <li>₱ <?php echo number_format((float)$subTotal, 2, '.', ','); ?></li>
      </ul>

      <!-- ==================================================================== -->
      <!-- ===================== IF CONTAINER IS EMPTY ======================== -->
      <!-- ==================================================================== -->

    <?php } else { ?>
      <h2 style="display: flex; justify-content:center; margin: 10%; color: white">YOUR CART IS EMPTY</h2>
    <?php } ?>
    <div class="checkout-btn" name="check-out" style="display: flex; align-items: center; justify-content: center; cursor: pointer;">CHECK OUT</div>
    <script>
      const clickedCheckout = document.querySelector('.checkout-btn');

      clickedCheckout.addEventListener('click', () => {
        alert('Already on Check out page')
      })
    </script>
  </aside>



  <?php
  $user_ID = $_SESSION['user_ID'];
  $sql = "SELECT * FROM user WHERE user_ID = :user_ID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':user_ID', $user_ID);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  ?>
  <aside class="userDetail">
    <div class="user-container-header" style="display: flex; justify-content:space-between; align-items:center; font-size: 2rem;">
      <h1 style="font-size: 3rem;padding-left: 1rem">User Information</h1>
      <h3 style="cursor: pointer;"><i class="bi bi-x"></i></h3>
    </div>
    <div class="user-info-container">

      <!-- RIGHT SIDE -->
      <div class="userDetail-right">


        <section class="user-info">
          <ul>
            <li><label for="">Name:</label><input type="text" name="" id="" value="<?php echo $result['user_name'] ?>"></li>
            <li><label for="">Password: </label> <input type="text" name="" id="" value="<?php echo $result['user_pass'] ?>"></li>
          </ul>
          <ul>
            <li><label for="">Email:</label><input type="email" name="" id="" value="<?php echo $result['user_email'] ?>"></li>
          </ul>

        </section>
      </div>
    </div>

    <div class="info-action-btn">
      <div class="sign_out">
        <button name="log-out-user"><i class="bi bi-arrow-left"></i>LOG OUT</button>
      </div>
      <div class="actionBTN">
        <button name="saveUserDetail">SAVE</button>
        <div id="cancelUserDetail" onclick="location.reload();">CANCEL</div>
      </div>

    </div>
  </aside>

  <div id="loading" style="display: none;">

  </div>

  </main>

  <footer id="about-us">
    <div class="about">
      <!-- SHOP LOCATION -->
      <section class="shop-location-container">
        <h5>OUR SHOP</h5>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d240.96812726168184!2d120.56127697305598!3d14.909767546278022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33965dbf4662687d%3A0xdbde7eb7a7758d5d!2sAV%20Cafe!5e0!3m2!1sen!2sph!4v1730954514178!5m2!1sen!2sph"
          style="border: 0"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="shop-location"></iframe>

        <ul class="shop-info">
          <li>
            <i class="bi bi-geo-alt"></i>56 G. Del Pilar, Lubao, 2005 Pampanga
          </li>
        </ul>
      </section>

      <!-- SHOP EMAIL -->
      <section class="shop-contact-container">
        <h5>CONTACT US</h5>

        <ul class="shop-contacts">
          <!-- CONTACT NUMBER -->
          <li>
            <a href="tel:09762023738"><i class="bi bi-telephone"></i>+63 976-2023-738
            </a>
          </li>

          <li>
            <a href="mailto:avcafe2024@gmail.com"><i class="bi bi-envelope"></i>avcafe2024@gmail.com</a>
          </li>
        </ul>
      </section>

      <!-- SHOP SOCIAL MEDIA -->
      <section class="shop-soc-meds-container">
        <h5>SUBSCRIBE US</h5>

        <!-- SOCIAL MEDIA LINKS -->
        <ul class="soc-meds">
          <!-- FACEBOOK -->
          <li>
            <a
              href="https://www.facebook.com/profile.php?id=61565382254158&mibextid=ZbWKwL"
              target="_blank"><i class="bi bi-facebook"></i></a>
          </li>

          <!-- INSTAGRAM -->
          <li>
            <a
              href="https://www.instagram.com/avcafe__?igsh=eHd3djMweGlpNnQ0"
              target="_blank"><i class="bi bi-instagram"></i></a>
          </li>
        </ul>
      </section>
    </div>
    <div class="reserved" style="display: flex; color: white; justify-content: flex-start; align-items: flex-end">
      <b style="margin: 0 10px 0 2px;">&copy;</b> 2024 Av Café All rights reserved
    </div>
  </footer>

  <!-- pop ups -->
  <script src="../script/user/show.js"></script>

  <!-- POP CART AND BUY -->
  <script src="../script/user/pop-cart-buy2.js"></script>

  <!-- QUANTITY PLUS MINUS -->
  <script src="../script/user/quantityConfig2.js"></script>

  <script>
    function showLoading() {
      document.querySelector('#loading').style.display = 'block';
    }

    function hideLoading() {
      document.querySelector('#loading').style.display = 'none';
    }

    function simulateLoading() {
      showLoading();
      // Simulate a network request or some async action
      setTimeout(() => {
        hideLoading();
      }, 2000); // Hide after 3 seconds
    }
  </script>
</body>

</html>