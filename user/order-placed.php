<?php
session_start();
require_once "../config/connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style/user/pop/order-placed.css" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>
  <div class="order-placed">
    <i class="bi bi-check2-circle"></i>
    <h1>Order placed successfully.</h1>
    <?php
    $user_ID = $_SESSION['user_ID'];

    $sql = "SELECT user_name FROM user WHERE user_ID = :user_ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_ID', $user_ID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    $user_name = $result['user_name'];
    ?>
    <ul class="details">
      <li>Customer Name</li>
      <li><?php echo $user_name ?></li>
      <li>Product:</li>
      <li><?php echo $_SESSION['product_count'] ?></li>
      <li>Order Total:</li>
      <li>₱ <?php echo number_format((float)$_SESSION['order_total'], 2, '.', ','); ?></li>

      <li>Payment:</li>
      <li><?php echo $_SESSION['payment'] ?></li>
    </ul>

    <ul class="redirect-links">
      <a href="userHomepage1.php">
        <li>Return to homepage</li>
      </a>
      <a href="menu5.php">
        <li>Order again</li>
      </a>
    </ul>
  </div>
</body>

</html>