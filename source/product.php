<?php 

session_start();

require 'config.php';

if(!isset($_GET['id'])) {
    header('Location: products.php');
}
if(isset($_GET['id'])) {
	$sql = 'SELECT * FROM products WHERE id = ' . $_GET['id'];
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	
	if (mysqli_num_rows($result) != 0) { // if id in database
		$row = mysqli_fetch_array($query);
		$id = $row['id'];
		$name = $row['name'];
		$price = $row['price'];
		$description = $row['description'];
		$targetdir = dirname(dirname(__FILE__)) . '/images/' . $id . '/*';
		$images = glob($targetdir);
		// get all information and print
		$mainimageoutput = "";
		$thumbnailoutput = "";
		$i = 1;
		foreach($images as $image) {
			$imagename = basename($image);
			$imagepath = '../images/'.$id.'/'.$imagename;
			$mainimageoutput .=  '<img class="slide" src="'.$imagepath.'">';
			$thumbnailoutput .= '<button class="thumbnailbutton" onclick="currentSlide('.$i.')"><img class="thumbnail" src="'.$imagepath.'"></button>';
			$i++;
		}
	}
	else { // if id not in database
		// show sorry screen, then redirect to products.php
		header('Location: products.php');
	}
}

if(isset($_POST['addtocart'])) { // if add to cart button pressed
	$product_id = $_GET['id'];
	$quantity = 1;
	if(isset($_SESSION['signedin']) && $_SESSION['signedin']) { // if logged in
		$user_id = $_SESSION['id'];

		$sql = 'SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?';
		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, 'ii', $user_id, $product_id);
		mysqli_stmt_execute($stmt);
		$db_cart_item = mysqli_stmt_get_result($stmt); // get cart items that match user id and product id, of cookie cart.

		if(mysqli_num_rows($db_cart_item) != 0) { // if item already in db cart
				// add cookie quantity to cart quantity
				$db_cart_item = mysqli_fetch_array($db_cart_item);
				$sql = 'UPDATE cart_items SET quantity = ? WHERE id = ?';
				$stmt = mysqli_prepare($conn, $sql);
				mysqli_stmt_bind_param($stmt, 'ii', ($db_cart_item['quantity']+$quantity), $db_cart_item['id']);
				mysqli_stmt_execute($stmt);
		}
		else { // if item not already in db
			// add product to db cart
			$sql = 'INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?,?,?)';
			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_bind_param($stmt, 'iii', $user_id, $product_id, $quantity);
			mysqli_stmt_execute($stmt);
		}
		
	}
	else { // not logged in
		if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])) { // if cookie exists and is not empty
			$current_cart = json_decode($_COOKIE['cart'], true);
			if(array_key_exists($product_id, $current_cart)) { // if item already in cart
					$current_cart[$product_id] = $current_cart[$product_id] + $quantity;
			}
			else { // if item not in cart
					$current_cart[$product_id] = $quantity;
			}
			setcookie("cart", json_encode($current_cart), time()+60*60*24*14); // 14 day expire time
		}
		else { // cookie is empty
			$new_cart = array($product_id => $quantity);
			setcookie("cart", json_encode($new_cart), time()+60*60*24*14);
		}
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
			<title>Website | <?php echo $name ?></title>
			
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" href="styles/navbar.css">
			<link rel="stylesheet" type="text/css" href="styles/product.css">
			
			<script type="text/javascript" src="scripts/product.js"></script>
	</head>

	<body>
		<div id="container">
			<!-- Top Navbar -->
			<?php include "shoptopnav.php"; ?>
			<div id="main">
				<div id="imagesection">
					<div id="mainimagesection">
						<button onclick="plusSlide(-1)">Left</button>
						<div id="slideshow">
							<?php echo $mainimageoutput ?>
						</div>
							
						<button onclick="plusSlide(1)">Right</button>
					</div>
					<div id="thumbnails">
						<?php echo $thumbnailoutput ?>
					</div>

				</div>
				<div id="productsection">
					<h1><?php echo $name ?></h1>
					<p>£<?php echo $price ?></p>
					<p><?php echo $description ?></p>

				</div>
				<div id="buysection">
					<form method="post" action="product.php?id=<?php echo $id; ?>">
						<input type="submit" name="buy" value="Buy">
						<input type="submit" name="addtocart" value="Add To Cart">
					</form>
				</div>

			</div>
			<?php include 'bottomnav.php' ?>
		</div>
	</body>

</html>