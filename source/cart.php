<?php 



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