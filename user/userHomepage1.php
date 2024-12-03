<?php
require_once "../config/connect.php";
session_start();
if (isset($_SESSION['user_ID'])) {
  $user_ID = $_SESSION['user_ID'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Av Café</title>

  <!-- FAVICON -->
  <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon" />

  <!-- BOOTSTRAP ICON -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="../style/user/userHome2.css" />

  <!-- POP UPS -->
  <!-- <link rel="stylesheet" href="../style/user/pop/pop-up.css" /> -->

  <!-- FOR CART -->
  <link rel="stylesheet" href="../style/user/pop/cartContainer8.css">

  <!-- FOOTER -->
  <link rel="stylesheet" href="../style/user/footer-Header1.css" />

  <link rel="stylesheet" href="../style/user/pop/userDetail6.css">

  <link rel="stylesheet" href="../style/user/login2.css">

  <link rel="stylesheet" href="../style/user/pop/editProduct.css">





  <style>
    #cancelUserDetail {
      cursor: pointer;
    }

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

    .editProductCart {
      font-size: .8rem;

      background-color: var(--edit-btn);

      height: 1.8rem;
      padding: 0 .6rem;

      color: white;

      border-radius: 5px;
      border: none;

      cursor: pointer;

      display: flex;
      justify-content: center;
      align-items: center;
    }

    .sign-up {
      display: flex;
      gap: .5rem;
      margin: 1rem 0;

      & span {
        cursor: pointer;


      }

      & span:hover {
        text-decoration: underline;
      }
    }
  </style>

</head>

<body>
  <!-- HEADER -->

  <header class="main-header">
    <!-- LOGO -->
    <a href="userHomepage1.php"><img src="../img/logo/logo_1.png" alt="" /></a>
    <!-- NAV LINKS -->
    <nav>
      <ul>
        <li><a href="#homepage">Home</a></li>
        <li><a href="#about-us">About us</a></li>
        <li><a href="menu5.php">Menu</a></li>
        <li>
          <i class="bi bi-cart" onclick="showCart()">
            <?php

            $sql = "SELECT COUNT(cart.cart_ID) as item_count 
            FROM cart 
            LEFT JOIN product ON cart.product_ID = product.product_ID 
            WHERE cart.user_ID = :user_ID 
            AND product.product_status = 'available'";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_ID', $user_ID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $item_count = $result['item_count'];
            ?>
            <div class="item-count"><?php echo $item_count; ?></div>
          </i>

        </li>

        <li>
          <i class="bi bi-person" onclick="showUser()"></i>
        </li>
      </ul>
    </nav>
  </header>
  <!-- HEADER END -->
  <div id="homepage"></div>
  <main id="home">


    <!-- MAIN / HERO -->

    <div class="highlight-img">
      <!-- HERO IMG -->
      <div class="fade-overlay"></div>
      <div class="ewan-ko">
        <h1>No Bland Days</h1>
        <h3>Looking for the perfect spot to get things done? ☕️ Whether you’re studying, working, or just enjoying a quiet moment, our coffee shop has the cozy vibe you need. Grab a cup, settle in, and let the aroma of fresh coffee fuel your productivity!</h3>

        <!-- view menu button -->
        <button style="color:white"><a href="menu5.php">View Menu</a></button>
      </div>

      <!-- BACKGROUND IMAGE -->
      <div class="main-img">
        <img src="../img/bg-images/bg1.jpeg" alt="">
        <img src="../img/bg-images/img2.jpeg" alt="">
        <img src="../img/bg-images/img4.jpeg" alt="">
        <img src="../img/bg-images/img3.jpeg" alt="">
        <img src="../img/bg-images/img5.jpeg" alt="">
        <img src="../img/bg-images/ig7.jpeg" alt="">
        <img src="../img/bg-images/img10.jpeg" alt="">
        <img src="../img/bg-images/img8.jpeg" alt="">

      </div>


    </div>


    <!-- =================================================================== -->
    <!-- ======================= USER DETAILS POP ========================== -->
    <!-- =================================================================== -->
    <style>
      .log-success,
      .update-success,
      .item-removed,
      .log-out,
      .register {
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
    <?php if (isset($_GET['logout'])) { ?>
      <div class="log-out">
        <i class="bi bi-check"></i>
        <p>log out successfully</p>
      </div>
      <script>
        const logOut = document.querySelector('.log-out');

        setTimeout(function() {
          logOut.style.top = '2rem';
        }, 500);

        setTimeout(function() {
          logOut.style.display = 'none';
        }, 3000);
      </script>
    <?php } else if (isset($_GET['register'])) { ?>
      <div class="register">
        <i class="bi bi-check"></i>
        <p>Registered successfully</p>
      </div>
      <script>
        const registerSuccess = document.querySelector('.register');

        setTimeout(function() {
          registerSuccess.style.top = '2rem';
        }, 500);

        setTimeout(function() {
          registerSuccess.style.display = 'none';
        }, 3000);
      </script>
    <?php } ?>
    <?php if (isset($_SESSION['user_ID'])) { ?>



      <?php
      if (isset($_GET['home'])) { ?>
        <div class="log-success">
          <i class="bi bi-check"></i>
          <p>log in success</p>
        </div>
        <script>
          const logSuccess = document.querySelector('.log-success');

          setTimeout(function() {
            logSuccess.style.top = '2rem';
          }, 500);

          setTimeout(function() {
            logSuccess.style.display = 'none';
          }, 3000);
        </script>
      <?php } else if (isset($_GET['update'])) { ?>
        <div class="update-success">
          <i class="bi bi-check"></i>
          <p>Update success</p>
        </div>
        <script>
          const updateSuccess = document.querySelector('.update-success');

          setTimeout(function() {
            updateSuccess.style.top = '2rem';
          }, 500);

          setTimeout(function() {
            updateSuccess.style.display = 'none';
          }, 3000);
        </script>
      <?php } else if (isset($_GET['itemRemoved'])) { ?>
        <div class="item-removed">
          <i class="bi bi-check"></i>
          <p>Item removed successfully</p>
        </div>
        <script>
          const removedItem = document.querySelector('.item-removed');

          setTimeout(function() {
            removedItem.style.top = '2rem';
          }, 500);

          setTimeout(function() {
            removedItem.style.display = 'none';
          }, 3000);
        </script>
      <?php } ?>

      <aside class="userDetail">
        <div class="user-container-header" style="display: flex; justify-content:space-between; align-items:center; font-size: 2rem;">
          <h1 style="font-size: 3rem;padding-left: 1rem">User Information</h1>
          <h3 style="cursor: pointer;"><i class="bi bi-x"></i></h3>
        </div>

        <form action="../config/user/menu-config.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="user_ID" value="<?php echo $user_ID ?>">
          <div class="user-info-container">

            <!-- LEFT SIDE -->
            <?php $sql = "SELECT * FROM user WHERE user_ID = :user_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_ID', $user_ID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <section class="user-info">
              <ul>
                <li><label for="">Name:</label><input type="text" name="user_name" value="<?php echo $result['user_name'] ?>"></li>
                <li><label for="">Email</label><input type="eemail" name="user_email" value="<?php echo $result['user_email'] ?>"></li>
              </ul>
              <ul>

                <li><label for="">Password</label> <input type="text" name="user_pass" value="<?php echo $result['user_pass'] ?>"></li>
              </ul>

            </section>


          </div>

          <div class="info-action-btn">
            <div class="sign_out">
              <button name="log-out-user"><i class="bi bi-arrow-left"></i>LOG OUT</button>
            </div>
            <div class="actionBTN">
              <button name="saveUserDetail">SAVE</button>
              <div id="cancelUserDetail" onclick="location.reload()">CANCEL</div>
            </div>


          </div>
        </form>
      </aside>
    <?php } else { ?>
      <?php if (isset($_GET['error'])) { ?>

        <!-- USER DETAIL -->
        <style>
          .sign-up {
            display: flex;
            gap: .5rem;
            margin: 1rem 0;

            & span {
              cursor: pointer;
            }

            & span:hover {
              text-decoration: underline;
            }
          }
        </style>

        <aside class="userLogin" style="width: 30vw; display: block;">

          <form action="../config/login-config.php" method="post">
            <div class="user-container-header" style="display: flex; justify-content:space-between; align-items:center; font-size: 2rem;">
              <h1 style="font-size: 2rem">LOGIN</h1>
              <h3 style="cursor: pointer;" onclick="document.getElementById('error').innerHTML = '' "><i class="bi bi-x"></i></h3>
            </div>

            <div class=" input-field" style="margin: 1rem 0;">
              <input type="email" name="user_email" placeholder="Enter Email: " autocomplete="off">
              <input type="password" name="user_pass" placeholder="Enter Password: ">
            </div>
            <?php if (isset($_GET['error'])) { ?>
              <p id="error" style="color: red; text-align: center; margin-bottom:1rem">Invalid Email or password</p>
            <?php } ?>
            <div class="sign-up"> Don't have an account? <span onclick="showRegistration()">Sign up</span> </div>
            <div class="action-btn-user-login">
              <a href="../loginform.php"><i class="bi bi-arrow-left"></i>Admin / Staff Login</a>
              <button name="user-login" style="cursor: pointer;">LOGIN</button>
            </div>
          </form>
        </aside>
        <!-- WITH ERROR -->
      <?php } else { ?>
        <aside class="userLogin" style="width: 30vw; display: none;">

          <form action="../config/login-config.php" method="post">
            <div class="user-container-header" style="display: flex; justify-content:space-between; align-items:center; font-size: 2rem;">
              <h1 style="font-size: 2rem">LOGIN</h1>
              <h3 style="cursor: pointer;"><i class="bi bi-x"></i></h3>
            </div>

            <div class="input-field" style="margin: 1rem 0;">
              <input type="email" name="user_email" placeholder="Enter Email: " autocomplete="off">
              <input type="password" name="user_pass" placeholder="Enter Password: ">
            </div>


            <div class="sign-up"> Don't have an account? <span onclick="showRegistration()">Sign up</span> </div>

            <div class="action-btn-user-login" style="margin-top:1rem;">
              <a href="../loginform.php"><i class="bi bi-arrow-left"></i>Admin / Staff Login</a>
              <button name="user-login" style="cursor: pointer;">LOGIN</button>
            </div>
          </form>
        </aside>




      <?php } ?>
      <!-- IF LOGGED OUT ENDING -->
      <?php if (isset($_GET['emailError'])) { ?>
        <aside class="userRegistration" style="width: 30vw; display:block">

          <form action="../config/login-config.php" method="post">
            <div class="user-container-header" style="display: flex; justify-content:space-between; align-items:center; font-size: 2rem;">
              <h1 style="font-size: 2rem">REGISTER</h1>
              <h3 style="cursor: pointer;"><i class="bi bi-x" onclick="hideReg()"></i></h3>
            </div>

            <div class="input-field" style="margin: 1rem 0;">
              <input type="text" name="user_name" placeholder="Enter Name: " autocomplete="off">
              <input type="password" name="user_pass" placeholder="Enter Password: ">
              <input type="email" name="user_email" placeholder="Enter Email: " autocomplete="off">
            </div>
            <?php if (isset($_GET['emailError'])) { ?>
              <p id="error" style="color: red; text-align: center; margin-bottom:1rem">This email has already in used</p>
            <?php } ?>
            <div class="sign-up"> Already have an account? <span onclick="showUserLogin()">Sign in</span> </div>

            <div class="action-btn-user-login" style="margin-top:1rem;">
              <a href="../loginform.php"><i class="bi bi-arrow-left"></i>Admin / Staff Login</a>
              <button name="user-reg" style="cursor: pointer;">REGISTER</button>
            </div>
          </form>
        </aside>
      <?php } else { ?>
        <aside class="userRegistration" style="width: 30vw; display: none;">

          <form action="../config/login-config.php" method="post">
            <div class="user-container-header" style="display: flex; justify-content:space-between; align-items:center; font-size: 2rem;">
              <h1 style="font-size: 2rem">REGISTER</h1>
              <h3 style="cursor: pointer;"><i class="bi bi-x" onclick="hideReg()"></i></h3>
            </div>

            <div class="input-field" style="margin: 1rem 0;">
              <input type="text" name="user_name" placeholder="Enter Name: " autocomplete="off">
              <input type="password" name="user_pass" placeholder="Enter Password: ">
              <input type="email" name="user_email" placeholder="Enter Email: " autocomplete="off">
            </div>

            <div class="sign-up"> Already have an account? <span onclick="showUserLogin()">Sign in</span> </div>

            <div class="action-btn-user-login" style="margin-top:1rem;">
              <a href="../loginform.php"><i class="bi bi-arrow-left"></i>Admin / Staff Login</a>
              <button name="user-reg" style="cursor: pointer;">REGISTER</button>
            </div>
          </form>
        </aside>
      <?php } ?>
    <?php } ?>
    <!-- =================================================================== -->
    <!-- ======================= PHP JOIN GET DATA ========================= -->
    <!-- =================================================================== -->
    <?php if (isset($_SESSION['user_ID'])): ?>
      <?php
      require_once "../config/connect.php";

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
            WHERE cart.user_ID = :user_ID AND product.product_status = 'available'
            GROUP BY cart.cart_ID
            ORDER BY cart.product_ID ASC";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':user_ID', $user_ID);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $subTotal = 0;
      $quantity = 0;


      ?>


      <!-- =================================================================== -->
      <!-- ======================== CART CONTAINER  ========================== -->
      <!-- =================================================================== -->
      <form action="../config/user/menu-config.php" method="post">
        <input type="hidden" name="user_ID" value="<?php echo $user_ID ?>">
        <?php if (isset($_GET['productRemoved'])) { ?>
          <aside class="cart-container" style="position: fixed; top: 0; right: 0%;">
            <div class="cart-container-header">
              <h3>CART</h3>
              <h3 style="cursor: pointer;"><i class="bi bi-x"></i></h3>
            </div>
            <?php if (count($result) > 0): ?>
              <ul class="product-order-container-header">
                <li>PRICE</li>
                <li>QUANTITY</li>
                <li>TOTAL</li>
              </ul>
              <div class="order-container">
                <?php foreach ($result as $cart): ?>

                  <div class="cart-product-container">
                    <input type="hidden" name="cart_ID" value="<?php echo $cart['cart_ID'] ?>">
                    <section class="left">
                      <img class="product-img" src="../img/products/<?php echo $cart['product_img'] ?>" alt="Product Image">
                      <input type="hidden" name="product_img-edit" value="../img/products/<?php echo $cart['product_img'] ?>">
                      <div class="product-order-info">
                        <ul>
                          <li>
                            <?php echo $cart['product_name']; ?>
                            <input type="hidden" name="product_name-edit" value="<?php echo $cart['product_name']; ?>">
                          </li>
                          <li><?php echo $cart['product_addOns']; ?></li>
                          <li>
                            <?php echo $cart['product_size']; ?>
                            <input type="hidden" name="product_size" value="<?php echo $cart['product_size']; ?>">
                          </li>
                          <li>
                            <div class="editProductCart">EDIT</div>
                            <div class="removeProductCart">REMOVE</div>
                          </li>
                        </ul>
                      </div>
                    </section>
                    <ul class="right">
                      <li>
                        <?php echo number_format((float)$cart['product_price'], 0, '.', ','); ?>
                        <input type="hidden" name="product_price" value="<?php echo $cart['product_price'] ?>">
                      </li>
                      <li>
                        <?php echo $cart['product_quantity']; ?>
                        <input type="hidden" name="product_quantity" value="<?php echo $cart['product_quantity'] ?>">
                      </li>
                      <li><?php echo number_format((float)$cart['total_price'], 0, '.', ','); ?></li>
                    </ul>
                  </div>
                  <hr />
                  <?php $subTotal += $cart['total_price']; ?>
                <?php endforeach; ?>
              </div>
              <ul class="product-order-container-footer">
                <li></li>
                <li>SUBTOTAL</li>
                <li><?php echo number_format((float)$subTotal, 0, '.', ','); ?></li>
              </ul>
              <button class="checkout-btn" type="submit" name="check-out">CHECK OUT</button>
            <?php else: ?>
              <h2 style="text-align: center; margin: 10%; color: white;">YOUR CART IS EMPTY</h2>
              <div class="checkout-btn" style="cursor: pointer;">CHECK OUT</div>
              <script>
                const clickedCheckout = document.querySelector('.checkout-btn');
                clickedCheckout.addEventListener('click', () => {
                  alert('Cart is Empty');
                });
              </script>
            <?php endif; ?>
          </aside>
        <?php } ?>

        <aside class="cart-container" style="position: fixed; top: 0; right: -50%;">
          <div class="cart-container-header">
            <h3>CART</h3>
            <h3 style="cursor: pointer;"><i class="bi bi-x"></i></h3>
          </div>
          <?php if (count($result) > 0): ?>
            <ul class="product-order-container-header">
              <li>ADD ONS</li>
              <li>PRICE</li>
              <li>QUANTITY</li>
              <li>TOTAL</li>
            </ul>
            <div class="order-container">
              <?php
              $addOn_Price = 0;
              foreach ($result as $cart):
                switch ($cart['product_addOns']) {
                  case 'No add ons':
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
                  <input type="hidden" name="cart_ID" value="<?php echo $cart['cart_ID'] ?>">
                  <section class="left">
                    <img class="product-img" src="../img/products/<?php echo $cart['product_img'] ?>" alt="Product Image">
                    <input type="hidden" name="product_img-edit" value="../img/products/<?php echo $cart['product_img'] ?>">
                    <div class="product-order-info">
                      <ul>
                        <li>
                          <?php echo $cart['product_name']; ?>
                          <input type="hidden" name="product_name-edit" value="<?php echo $cart['product_name']; ?>">
                        </li>
                        <li>Add Ons: <?php echo $cart['product_addOns']; ?></li>
                        <li>Size:
                          <?php echo $cart['product_size']; ?>
                          <input type="hidden" name="product_size" value="<?php echo $cart['product_size']; ?>">
                        </li>
                        <li>
                          <div class="editProductCart">EDIT</div>
                          <div class="removeProductCart">REMOVE</div>
                        </li>
                      </ul>
                    </div>
                  </section>
                  <ul class="right">
                    <li>
                      <?php echo number_format((float)$addOn_Price, 0, '.', ','); ?>
                    </li>
                    <li>
                      <?php echo number_format((float)$cart['product_price'], 0, '.', ','); ?>
                      <input type="hidden" name="product_price" value="<?php echo $cart['product_price'] ?>">
                    </li>
                    <li>
                      <?php echo $cart['product_quantity']; ?>
                      <input type="hidden" name="product_quantity" value="<?php echo $cart['product_quantity'] ?>">
                    </li>
                    <li>
                      <?php
                      echo number_format((float)$cart['total_price'] = ($addOn_Price + $cart['product_price']) * $cart['product_quantity'], 0, '.', ',');
                      ?>

                    </li>
                  </ul>
                </div>
                <hr />
                <?php $subTotal += $cart['total_price'] ?>
              <?php endforeach; ?>
            </div>
            <ul class="product-order-container-footer">
              <li></li>
              <li></li>
              <li>SUBTOTAL</li>
              <li><?php echo number_format((float)$subTotal, 0, '.', ','); ?></li>
            </ul>
            <button class="checkout-btn" type="submit" name="check-out">CHECK OUT</button>
          <?php else: ?>
            <h2 style="text-align: center; margin: 10%; color: white;">YOUR CART IS EMPTY</h2>
            <div class="checkout-btn" style="cursor: pointer;">CHECK OUT</div>
            <script>
              clickedCheckout = document.querySelector('.checkout-btn');
              clickedCheckout.addEventListener('click', () => {
                alert('Cart is Empty');
              });
            </script>
          <?php endif; ?>
        </aside>
      </form>


    <?php endif; ?>
    <form action="../config/user/menu-config.php" method="post">
      <input type="hidden" name="cart_ID_edit" value="null">
      <input type="hidden" name="product_price_edit" value="null">
      <section class="editProduct-container" style="z-index: 10;display:none">
        <div class="editProduct-left">
          <img src="" alt="" id="product-img-edit">
        </div>
        <div class="editProduct-right">
          <h4 id="product-name-edit"></h4>

          <div class="editProduct-size">

            <label for="product_size">Size:</label>
            <select name="product_size_edit" id="product_size">
              <option value="Grande">GRANDE</option>
              <option value="Venti">VENTI</option>

            </select>

          </div>

          <label>Add Ons:</label>
          <div class="edit-add-ons">

            <div>
              <input type="radio" name="product_addOns_edit" id="no_add_edit" value="No add ons" checked>
              <label for="no_add_edit">No add ons</label>
            </div>
            <div>
              <input type="radio" name="product_addOns_edit" id="espresso_shot_edit" value="Espresso Shot">
              <label for="espresso_shot_edit">Espresso Shot</label>
              <span>+40</span>
            </div>
            <div>
              <input type="radio" name="product_addOns_edit" id="syrup_edit" value="Syrup">
              <label for="syrup_edit">Syrup</label>
              <span>+15</span>
            </div>
            <div>
              <input type="radio" name="product_addOns_edit" id="sauce_edit" value="Sauce">
              <label for="sauce_edit">Sauce</label>
              <span>+20</span>
            </div>
            <div>
              <input type="radio" name="product_addOns_edit" id="sea_salt_edit" value="Sea Salt">
              <label for="sea_salt_edit">Sea Salt</label>
              <span>+40</span>
            </div>

          </div>



          <div class="editProduct-quantity">

            <label for="product_quantity">Quantity:</label>

            <div class="quantity-action-btn">

              <div class="minusEdit">-</div>
              <div style="width: 3rem; display:flex; align-items:center; border: none; justify-content:center">
                <h2 class="quantityValueEdit">1</h2>
              </div>

              <div class="addEdit">+</div>

            </div>

            <input type="hidden" name="editProduct_quantity" id="editProduct" value="null">

          </div>

          <div class="editProduct-action-btn">

            <button name="editProduct">CONFIRM</button>
            <div class="cancelEditBtn" onclick="location.reload()">CANCEL</div>
          </div>

        </div>
      </section>
    </form>


    <style>
      .removeProduct_fromCart {
        z-index: 100;

        position: fixed;

        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);

        background-color: white;

        padding: 2rem;

        flex-direction: column;

        gap: 1rem;

        box-shadow: rgba(0, 0, 0, 0.5) 0 0 5px;

        border-radius: 10px;

        & .action-btn-del {
          display: grid;
          grid-template-columns: 1fr 40%;

          gap: 1rem;

          & button,
          div {
            width: 100%;


            border-radius: 5px;

            cursor: pointer;
          }

          & button {
            background-color: rgb(49, 49, 255);
            color: white;

            border: 1px solid rgb(49, 49, 255);
          }

          & div {
            display: flex;
            justify-content: center;
            align-items: center;

            border: 1px solid black;
          }
        }

        .del-icon {
          display: flex;
          justify-content: center;

          & i {
            font-size: 5rem;
          }
        }
      }
    </style>

    <form action="../config/user/menu-config.php" method="post">
      <div class="removeProduct_fromCart" style="display: none;">
        <input type="hidden" name="cart_ID" value="null">
        <input type="hidden" name="user_ID" value="<?php echo $_SESSION['user_ID'] ?>">

        <div class="del-icon">
          <i class="bi bi-trash3"></i>
        </div>

        <h3 class="product_name">Confirm remove product: <span id="product_ID">null</span></h3>



        <div class="action-btn-del">
          <button name="removeProduct_fromCart">CONFIRM</button>
          <div class="cancel-remove-product" onclick="document.querySelector('.removeProduct_fromCart').style.display='none'">BACK</div>
        </div>
      </div>
    </form>
  </main>
  <!-- MAIN END -->



  <!-- =================================================================== -->
  <!-- ============================ FOOTER =============================== -->
  <!-- =================================================================== -->

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
      &copy; 2024 Av Café All rights reserved
    </div>
  </footer>

  <!-- SHOW CART AND USER POP UP  -->
  <!-- <script src="../script/user/showHide2.js"></script> -->

  <script src="../script/user/show.js"></script>
  <script src="../script/user/quantityConfig2.js"></script>
  <script src="../script/user/editProductCart.js"></script>
  <script src="../script/user/deleteProduct.js"></script>
  <script>
    function showLogin() {

      const login = document.querySelector('.userLogin')

      if (login) {

        login.style.display = 'block'

      }

    }

    const userReg = document.querySelector('.userRegistration')

    function showRegistration() {


      if (userReg) {
        userReg.style.display = 'block'
        document.querySelector('.userLogin').style.display = 'none'

      }
    }

    function showUserLogin() {
      document.querySelector('.userLogin').style.display = 'block'
      userReg.style.display = 'none'

      if (document.getElementById('error')) {
        document.getElementById('error').innerHTML = ''
      }

    }

    function hideReg() {
      if (document.querySelector('.userRegistration').style.display === 'block') {
        document.querySelector('.userRegistration').style.display = 'none'
      }
    }
  </script>
  </script>

</body>

</html>