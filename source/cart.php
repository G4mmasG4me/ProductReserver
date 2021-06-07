<?php 

require 'config.php';

session_start();

if(isset($_SESSION['signedin']) && $_SESSION['signedin']) { // if signed in get cart from database
  $sql = 'SELECT * FROM cart_items WHERE user_id = ?';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
  mysqli_stmt_execute($stmt);
  $db_cart = mysqli_stmt_get_result($stmt);

  if(mysqli_num_rows($db_cart) != 0) { // if cart not empty
    while($row = $db_cart) {
      $sql = 'SELECT * FROM products WHERE id = ?';
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, 's', $row['product_id']);
      mysqli_stmt_execute($stmt);
      $product = mysqli_stmt_get_result($stmt);
      $name = $product['name'];
      $price = $product['price'];
      $description = $product['description'];
      #$manufacturer = $product['manufacturer'];
      #$image = 'images/' . $row['product_id'] . '.png';
    }

  }
}
else { // if not signed in get cart from browser
  // if browser cart not empty
  if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])) {
    foreach($_COOKIE['cart'] as $product) {
      $product_id = $product[0];
      $product_quantity = $product[1];
      $sql = 'SELECT * FROM products WHERE id = ?';
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, 's', $product_id);
      mysqli_stmt_execute($stmt);
      $product = mysqli_stmt_get_result($stmt);
      $name = $product['name'];
      $price = $product['price'];
      $description = $product['description'];

      $cart .= '<div class="item"><div class="image"><img class="productimg" src="https://via.placeholder.com/160x160"></div><div class="proddetails"><div class="leftside"><p>'.$name.'</p><p>'.$product_quantity.'</p></div><div class="rightside"><p>'.$price.'</p></div></div></div>';
    }
  }
  // if browser cart empty
  else {
    $cart = "Cart Empty";
  }
  
}


// if not signed in get cart from browser


?>


<!DOCTYPE html>
<html>
  <head>
    <title>Website | Shopping Cart</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/navbar.css">
    <link rel="stylesheet" type="text/css" href="styles/cart.css">
    
    <script type="text/javascript" src="scripts/cart.js"></script>
  </head>

  <body>
    <div id="container">
      <!-- Top Navbar -->
      <?php include "shoptopnav.php"; ?>
      <div id="bodycontent">
        <div id="cartmenu">
          <div class="item">
            <div class="image">
              <img class="productimg" src="https://via.placeholder.com/160x160">
            </div>
            <div class="proddetails">
              <div class="leftside">
                <p>Product Name</p>
                <p>Quantity</p>
              </div>
              <div class="rightside">
                <p>Price</p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="image">
              <img class="productimg" src="https://via.placeholder.com/160x160">
            </div>
            <div class="proddetails">
              <div class="leftside">
                <p>Product Name</p>
                <p>Quantity</p>
              </div>
              <div class="rightside">
                <p>Price</p>
              </div>
            </div>
          </div>
        </div>
        <?php echo $cart ?>
        <div id="buymenu">
          <p>Summary</p>
          <p>Total: </p>
          <button class="buybutton">Checkout</button>
        </div>
      </div>
      <!-- Bottom Navbar -->
      <?php include "bottomnav.php"; ?>
    </div>
  </body>

</html>