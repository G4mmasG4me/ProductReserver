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
			if($product_quantity > 9) {

			}
			else {

			}
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
					<table>
						<tr>
							<th>Item</th>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
						<tr>
							<td><img class="productimg" src="https://via.placeholder.com/160x160">Test1</td>
							<td>
								<form id="quantitySelector" name="quantitySelector">
									<button id="quantityButton" type="button" onclick="quantityButtonChange(this, -1)">-</button>
									<input id="quantityInput" type="number" value=1 onchange="quantityChange()">
									<button id="quantityButton" type="button" onclick="quantityButtonChange(this, 1)">+</button>
									<form id="removeitemform" action="" method="post">
											<input type="submit" value="Remove">
										</form>
								</form></td>
							<td>£10</td>
						</tr>
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
									<div class="top">
										<form id="removeitemform" action="" method="post">
											<input type="submit" value="Remove">
										</form>
									</div>
									<div class="bottom">
										<form id="quantitySelector" name="quantitySelector">
											<p>Quantity</p>
											<button id="quantityButton" type="button" onclick="quantityButtonChange(this, -1)">-</button>
											<input id="quantityInput" type="number" value=1 onchange="quantityChange()">
											<button id="quantityButton" type="button" onclick="quantityButtonChange(this, 1)">+</button>
										</form>
										<p id="price">£10</p>
									</div>
								</div>
							</div>
						</div>
					</table>
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