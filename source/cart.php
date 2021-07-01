<?php 

/* cart item
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


<div id="emptycart">
  <p1 id="emptycartext">Your Cart Is Empty!</p1>
  <button id="productsbutton">Check Out More Products Here</button>
</div>
*/



require 'config.php';

session_start();

if(isset($_SESSION['signedin']) && $_SESSION['signedin']) { // if signed in get cart from database
  // get all cart items where the user id equals current user id
  /*
  $sql = 'SELECT product_id FROM cart_items WHERE user_id = ?';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 's', $_SESSION['id']);
  mysqli_stmt_execute($stmt);
  $cart = mysqli_stmt_get_result($stmt);
  */
  $sql = 'SELECT * FROM cart_items WHERE user_id = ' . $_SESSION['id'];
  $query = mysqli_query($conn, $sql);
  if(mysqli_num_rows($query) != 0) { // if cart not empty
    $cart_output = '';
    while($cart_item = mysqli_fetch_array($query)) {
      $product_id = $cart_item['product_id'];
      $sql = 'SELECT * FROM products WHERE id = ?';
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, 's', $product_id);
      mysqli_stmt_execute($stmt);
      $product = mysqli_stmt_get_result($stmt);
      $product = mysqli_fetch_array($product);
      $name = $product['name'];
      $price = $product['price'];
      $description = $product['description'];
      $cart_output .= '<div class="item"><div class="image"><img class="productimg" src="https://via.placeholder.com/160x160"></div><div class="proddetails"><div class="leftside"><p>'.$name.'</p><p></p></div><div class="rightside"><p>£'.$price.'</p></div></div></div>';
    }
  }
  else {
    $cart_output = "Cart Empty";
  }
}
else { // if not signed in get cart from browser
  // if browser cart not empty
  if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
    $cart_output = '';
    foreach($cart as $product_id => $product_quantity) {
      $sql = 'SELECT * FROM products WHERE id = ?';
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, 's', $product_id);
      mysqli_stmt_execute($stmt);
      $product = mysqli_stmt_get_result($stmt);
      $product = mysqli_fetch_array($product);
      $name = $product['name'];
      $price = $product['price'];
      $description = $product['description'];
      $cart_output .= '<div class="item"><div class="image"><img class="productimg" src="https://via.placeholder.com/160x160"></div><div class="proddetails"><div class="leftside"><p>'.$name.'</p><p>'.$product_quantity.'</p></div><div class="rightside"><p>£'.$price.'</p></div></div></div>';
    }
  }
  // if browser cart empty
  else {
    $cart_output = '<div id="emptycart"><p1 id="emptycartext">Your Cart Is Empty!</p1><form id="emptycartform" action="products.php"><input type="submit" id="productsbutton" value="Check Out More Products Here!"></form></div>';
  }
  
}


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
          <?php echo $cart_output ?>
          <div class="item">
            <div class="image">
              <img class="productimg" src="https://via.placeholder.com/160x160">
            </div>
            <div class="proddetails">
              <div class="leftside">
                <p>Product Name</p>
              </div>
              <div class="rightside">
                <p>£10</p>
                <div id="quantitySelector">
                  <select id="quantitySelect" name="quantity" onchange="quantityChange(this)">
                    <option value="1">Quantity: 1</option>
                    <option value="2">Quantity: 2</option>
                    <option value="3">Quantity: 3</option>
                    <option value="4">Quantity: 4</option>
                    <option value="5">Quantity: 5</option>
                    <option value="6">Quantity: 6</option>
                    <option value="7">Quantity: 7</option>
                    <option value="8">Quantity: 8</option>
                    <option value="9">Quantity: 9</option>
                    <option value="10+">Quantity: 10+</option>
                  </select>
                </div>
                <form id="removeitemform" action="" method="post">
                  <input type="submit">Remove</input>
                </form>
              </div>
            </div>
          </div>
        </div>
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