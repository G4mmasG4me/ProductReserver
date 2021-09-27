<?php 

require 'config.php';

session_start();


if(isset($_SESSION["signedin"]) && $_SESSION["signedin"] === true) {
	header('Location: index.php');
}
else {
}


$emailerror = '';
$passworderror = '';
$loginerror = '';

if(isset($_POST['signinsubmit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = 'SELECT * FROM users WHERE email = ?';
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, 's', $email);
	mysqli_stmt_execute($stmt);
	$user = mysqli_stmt_get_result($stmt);

	if(mysqli_num_rows($user) != 0) {
		$user_data = mysqli_fetch_array($user);
		
		if(password_verify($password, $user_data['password'])) { //valid password
			$_SESSION['signedin'] = true;
			$_SESSION['id'] = $user_data['id'];
			// add browser cart to database

			// create a list of browser cart
			$cart = json_decode($_COOKIE['cart'], true);
			// loop through browser cart list
			foreach($cart as $prod) {
				$sql = 'SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?';
				$stmt = mysqli_prepare($conn, $sql);
				mysqli_stmt_bind_param($stmt, 'ii', $user_data['id'], $prod[0]);
				mysqli_execute($stmt);
				$db_cart_item = mysqli_stmt_get_result($stmt); // get cart items that match user id and product id, of cookie cart.
				if(mysqli_num_rows($db_cart_item) != 0) { // if item already in db cart
					// add cookie quantity to cart quantity
					$db_cart_item = mysqli_fetch_array($db_cart_item);
					$sql = 'UPDATE cart_items SET quantity = ? WHERE id = ?';
					$stmt = mysqli_prepare($conn, $sql);
					mysqli_stmt_bind_param($stmt, 'ii', ($db_cart_item['quantity']+$prod[1]), $db_cart_item['id']);
					mysqli_execute($stmt);
				}
				else { // if item not already in db
					// add product to db cart
					$sql = 'INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?,?,?)';
					$stmt = mysqli_prepare($conn, $sql);
					mysqli_stmt_bind_param($stmt, 'iii', $user_data['id'], $prod[0], $prod[1]);
					mysqli_execute($stmt);
				}
			// wipe cookie cart
			setcoookie('cart', '', time()-3600);
			}
			

			// way 1
			// check if user_id and product_id already in db
			// if already in db, then add to quantity
			// if not in db, then insert cart item in db

			// way2
			// check if user_id and product_id already in db
			// if already in db, then add sql command to add to quantity
			// if not in db, then add sql command to insert cart item into db
			// once looped through all in cart
			// execute final sql command

			header('Location: index.php');
		}
		else {
			$loginerror = 'Login Failed: Wrong Email or Password';
		}
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Website | Sign In</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="styles/signin.css">
		
		<script type="text/javascript" src="scripts/signin.js"></script>
	</head>

	<body>
		<div id="container">
			<form id="loginform" action="" method="post">
				<h1>Login</h1>
				<input type="text" name="email" placeholder="Email" required>
				<p id="emailerror"><?php echo $emailerror ?></p>
				<input type="password"  name="password" placeholder="Password" required>
				<p id="passworderror"><?php echo $passworderror ?></p>
				<p id="loginerror"><?php echo $loginerror ?></p>
				
				<input type="submit" name="signinsubmit">
				<a href="signup.php">Sign Up</a>
				<a>Forgot Password</a>
			</form>
		</div>
	</body>

</html>