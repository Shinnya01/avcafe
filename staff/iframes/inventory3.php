<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../../style/staff/iframes/product_list1.css" />

  <link rel="stylesheet" href="../../style/staff/edit-product1.css">

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

  <!-- for insert -->
  <link
    rel="stylesheet"
    href="../../style/staff/iframes/insertProduct.css" />

  <link rel="stylesheet" href="../../style/staff/removeProduct.css">
  <link rel="stylesheet" href="../../style/staff/iframes/search.css">
</head>

<body>
  <section class="data-container">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>IMAGE</th>
          <th>ID</th>
          <th>NAME</th>
          <th style="text-align: center;">PRICE</th>
          <th>CATEGORY</th>
          <th>STATUS</th>
          <th>ORDERS</th>

          <th>
            <button class="new">NEW</butt>
          </th>

          <th>
            <i class="bi bi-search" id="showSearchBtn" onclick="showSearch()"></i>
            <i class="bi bi-x" id="removeSearchBtn" onclick="removeSearch()" style="display: none; cursor:pointer"></i>

            <form action="inventory3.php" method="post">
              <div id="search-box" style="display: none;">
                <input type="text" name="findProduct" id="searchField">

                <input type="submit" id="submitSearch" style="display:none">
                <label for="submitSearch"> <i class="bi bi-search"></i></label>
              </div>
            </form>

          </th>
        </tr>
      </thead>
      <?php

      require_once "../../config/connect.php";


      if (isset($_POST['findProduct'])) {
        $findProduct = $_POST['findProduct'] . '%';

        $sql = "SELECT * FROM product WHERE product_name LIKE :findProduct";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':findProduct', $findProduct);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (COUNT($result) > 0) {


      ?>
          <tbody>

            <?php
            $product_count = 1;
            foreach ($result as $product): ?>
              <tr style="text-transform: capitalize;">
                <td><?php echo $product_count ?></td>

                <td class="product-img"><img src="../../img/products/<?php echo $product['product_img'] ?>"></td>

                <td>
                  <?php echo $product['product_ID'] ?>
                  <input type="hidden" name="product_ID" value="<?php echo $product['product_ID'] ?>">
                </td>

                <td>
                  <?php echo $product['product_name'] ?>
                  <input type="hidden" name="product_name" value="<?php echo $product['product_name'] ?>">
                </td>

                <td style="text-align: center;">
                  <?php echo $product['product_price'] ?>
                  <input type="hidden" name="product_price" value="<?php echo $product['product_price'] ?>">
                </td>

                <td><?php echo $product['product_category'] ?></td>

                <td>
                  <?php echo $product['product_status'] ?>
                  <input type="hidden" name="product_status" value="<?php echo $product['product_status'] ?>">
                </td>

                <td><?php echo $product['product_orders'] ?></td>

                <td style="position: relative">
                  <i class="bi bi-three-dots-vertical pop-menu"></i>

                  <div class="action-menu" style="position: absolute">
                    <button name="editProduct">EDIT</button>
                    <button name="removeProduct">REMOVE</button>
                  </div>
                </td>
                <td></td>
              </tr>

            <?php
              $product_count++;
            endforeach;
          } else {
            ?>
            <tr>
              <td colspan="10" style="text-align: center;">No product found</td>
            </tr>
          <?php
          } ?>

          </tbody>


        <?php
      } else {

        $sql = "SELECT * FROM product";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
          <tbody>

            <?php
            $product_count = 1;
            foreach ($result as $product): ?>
              <tr style="text-transform: capitalize;">
                <td><?php echo $product_count ?></td>

                <td class="product-img"><img src="../../img/products/<?php echo $product['product_img'] ?>"></td>

                <td>
                  <?php echo $product['product_ID'] ?>
                  <input type="hidden" name="product_ID" value="<?php echo $product['product_ID'] ?>">
                </td>

                <td>
                  <?php echo $product['product_name'] ?>
                  <input type="hidden" name="product_name" value="<?php echo $product['product_name'] ?>">
                </td>

                <td style="text-align: center;">
                  <?php echo $product['product_price'] ?>
                  <input type="hidden" name="product_price" value="<?php echo $product['product_price'] ?>">
                </td>

                <td><?php echo $product['product_category'] ?></td>

                <td>
                  <?php echo $product['product_status'] ?>
                  <input type="hidden" name="product_status" value="<?php echo $product['product_status'] ?>">
                </td>

                <td><?php echo $product['product_orders'] ?></td>

                <td style="position: relative">
                  <i class="bi bi-three-dots-vertical pop-menu"></i>

                  <div class="action-menu" style="position: absolute">
                    <button name="editProduct">EDIT</button>
                    <button name="removeProduct">REMOVE</button>
                  </div>
                </td>
                <td></td>
              </tr>

            <?php
              $product_count++;
            endforeach; ?>
          </tbody>
        <?php } ?>
    </table>
  </section>
  <style>
    .fill-everything {
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
  <?php if (isset($_GET['fillEverything'])) { ?>
    <div class="fill-everything">
      <i class="bi bi-x"></i>
      <p>Please fill up everything</p>
    </div>
    <script>
      const fillUp = document.querySelector('.fill-everything');

      setTimeout(function() {
        fillUp.style.top = '.5rem';
      }, 500);

      setTimeout(function() {
        fillUp.style.display = 'none';
      }, 3000);
    </script>
  <?php } ?>
  <section class="add-container" style="z-index: 10">
    <form
      action="../../config/insert.php"
      method="post">
      <div class="input-container input-product-inventory">
        <h3 class="title">ADD PRODUCT</h3>
        <section class="input-field">
          <!-- INPUT IMAGE SECTION -->
          <div class="item-image">
            <h3>Add Image</h3>
            <div class="preview-image">
              <img src="" id="displayImage" />
            </div>
            <!-- INPUT IMAGE -->
            <input
              type="file"
              name="product_img"
              id="choose-image"
              accept="image/*"
              required />
            <label for="choose-image">Choose a photo</label>
          </div>

          <!-- INPUT ITEM INFORMATION SECTION -->
          <div class="item-info" style="justify-content: space-between">
            <!-- PRODUCT NAME -->
            <div class="info-input-field">
              <label for="product_name">Product Name</label>

              <input
                type="text"
                name="product_name"
                id="product_name"
                placeholder="Enter Product Name" />

            </div>

            <!-- PRODUCT CATEGORY -->
            <div class="info-input-field">
              <label for="product_category">Product Category</label>

              <select name="product_category" id="product_category" required>
                <option disabled selected>
                  ESPRESSO / NON-COFFEE / REFRESHERS
                </option>
                <option value="espresso">ESPRESSO</option>
                <option value="non-coffee">NON-COFFEE</option>
                <option value="refreshers">REFRESHERS</option>
              </select>
            </div>

            <!-- PRODUCT PRICE -->
            <div class="info-input-field">
              <label for="product_price">Price</label>

              <input
                type="number"
                name="product_price"
                id="product_price"
                placeholder="Enter Product Price" />
            </div>


            <!-- PRODUCT STATUS -->
            <div class="info-input-field">
              <label for="product_status">Status</label>

              <select name="product_status" id="equipment_status" required>
                <option selected disabled>AVAILABLE / UNAVAILABLE</option>
                <option value="available">AVAILABLE</option>
                <option value="unavailable">UNAVAILABLE</option>
              </select>
            </div>
          </div>
          <!-- ITEM INFO END -->
        </section>

        <!-- ADD ITEM BUTTON -->
        <section class="add-btn">
          <button name="addProduct">ADD PRODUCT</button>
          <div id="cancel">CANCEL</div>
        </section>
      </div>
    </form>
  </section>

  <form action="../../config/staff/staff-config.php" method="post">
    <section class="edit" style="display:none;">

      <h3>EDIT PRODUCT</h3>
      <div class="input-field-edit">
        <input type="hidden" name="product_ID" value="" style="padding-inline: 10px;">

        <label for="">Name:</label>
        <input type="text" name="product_name" id="staff_name" value="" style="padding-inline: 10px;" />

        <label for="">Price:</label>
        <input type="number" name="product_price" id="" value="" style="padding-inline: 10px;">

        <label for="">Status:</label>
        <select name="product_status" id="">
          <option value="available">AVAILABLE</option>
          <option value="unavailable">UNAVAILABLE</option>
        </select>

      </div>

      <div class="add-btn">
        <button name="editProduct">SUBMIT</button>
        <div id="cancel">CANCEL</div>
      </div>

    </section>
  </form>


  <form action="../../config/staff/staff-config.php" method="post">
    <section class="removeProduct" style="display: none;">
      <div class="remove-icon">
        <i class="bi bi-trash3"></i>
      </div>

      <input type="hidden" name="delete_product_ID" value="">
      <div class="delete-info">
        <h1>Confirm delete equipment: <span id="user_name"></span> ?</h1>
      </div>

      <div class="del-action-btn">
        <button name="deleteProduct">DELETE</button>
        <div id="cancel">CANCEL</div>
      </div>

    </section>
  </form>

  <style>
    .update-success,
    .delete-success,
    .add-success {
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

  <?php if (isset($_GET['updateSuccess'])) { ?>
    <div class="update-success">
      <i class="bi bi-check"></i>
      <p>Update success</p>
    </div>
    <script>
      const updateSuccess = document.querySelector('.update-success');

      setTimeout(function() {
        updateSuccess.style.top = '1rem';
      }, 500);

      setTimeout(function() {
        updateSuccess.style.display = 'none';
      }, 3000);
    </script>
  <?php } else if (isset($_GET['deleteSuccess'])) { ?>
    <div class="delete-success">
      <i class="bi bi-check"></i>
      <p>Delete success</p>
    </div>
    <script>
      const delSuccess = document.querySelector('.delete-success');

      setTimeout(function() {
        delSuccess.style.top = '1rem';
      }, 500);

      setTimeout(function() {
        delSuccess.style.display = 'none';
      }, 3000);
    </script>
  <?php } else if (isset($_GET['addSuccess'])) { ?>
    <div class="add-success">
      <i class="bi bi-check"></i>
      <p>Item Added</p>
    </div>
    <script>
      const addSuccess = document.querySelector('.add-success');

      setTimeout(function() {
        addSuccess.style.top = '1rem';
      }, 500);

      setTimeout(function() {
        addSuccess.style.display = 'none';
      }, 3000);
    </script>
  <?php } ?>

  <script src="../../script/pop-menu.js"></script>
  <!-- <script src="../../script/addNew_2.js"></script> -->

  <script src="../../script/staff/preview-img.js"></script>

  <script src="../../script/staff/show-hide-add-inventory2.js"></script>
  <script src="../../script/staff/search.js"></script>
</body>

</html>