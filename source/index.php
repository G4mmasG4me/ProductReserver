<?php 
session_start();

require 'config.php';

$sql = 'SELECT * FROM products ORDER BY dateadded DESC LIMIT 5';
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// get a list of recent products
$recent_products = '';

while($row = mysqli_fetch_array($result)) {
	$id = $row['id'];
	$name = $row['name'];
	$price = $row['price'];
	$targetdir = dirname(dirname(__FILE__)) . '/images/' . $id . '/*';
	$images = glob($targetdir);
	if (!empty($images)) {
		$imagename = basename($images[0]);
		$imagepath = '../images/'.$id.'/'.$imagename;
		$recent_products .= '<a href="#" id="product"><img id="productimg" src="' . $imagepath . '"><div id="productinfo"><p>'. $name . ' - £' . $price .'</p></div></a>';
	}
	else {
		// header('Location: error.php?error=404');
	}
}

// get a list of popular products

$sql = 'SELECT product_id FROM orders GROUP BY product_id ORDER BY COUNT(product_id) DESC LIMIT 5';

?>

<!DOCTYPE html>
<!--
⢀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⣠⣤⣶⣶
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⢰⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⣀⣀⣾⣿⣿⣿⣿
⣿⣿⣿⣿⣿⡏⠉⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⣿
⣿⣿⣿⣿⣿⣿⠀⠀⠀⠈⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⠛⠉⠁⠀⣿
⣿⣿⣿⣿⣿⣿⣧⡀⠀⠀⠀⠀⠙⠿⠿⠿⠻⠿⠿⠟⠿⠛⠉⠀⠀⠀⠀⠀⣸⣿
⣿⣿⣿⣿⣿⣿⣿⣷⣄⠀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⠏⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠠⣴⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⡟⠀⠀⢰⣹⡆⠀⠀⠀⠀⠀⠀⣭⣷⠀⠀⠀⠸⣿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠈⠉⠀⠀⠤⠄⠀⠀⠀⠉⠁⠀⠀⠀⠀⢿⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⢾⣿⣷⠀⠀⠀⠀⡠⠤⢄⠀⠀⠀⠠⣿⣿⣷⠀⢸⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⡀⠉⠀⠀⠀⠀⠀⢄⠀⢀⠀⠀⠀⠀⠉⠉⠁⠀⠀⣿⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀⠀⠀⠀⠀⠀⠈⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢹⣿⣿
⣿⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿
-->
<html>
		
	<head>
		<title>Website | Home</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="styles/index.css">
		<link rel="stylesheet" type="text/css" href="styles/navbar.css">
		<link rel="icon" href="http://via.placeholder.com/64x64">
		
		<script type="text/javascript" src="scripts/index.js"></script>
		<script type="text/javascript" src="scripts/navbar.js"></script>
	</head>

	<body>
		<div id="container">
			<section id="section1">
				<!-- Top Navbar -->
				<?php include "topnav.php"; ?>
				<div id="sec1div">
					<h1>Business Name</h1>
					<p>Description : Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
				</div>
			</section>

			<section id="section2">
				<div id="sec2div">
					<h1>Products Reserved and Filled</h1>
					<p id="orderCounter">00000000</p> <!-- Use Ajax to update number -->
				</div>
			</section>

			<section id="section3">
				<div id="sec3div">
					<h1>Popular Products</h1>
					<div id="productrow">
						<?php echo $popular_products; ?>
					</div>
				</div>
			</section>

			<section id="section4">
				<div id="sec4div">
					<h1>Recent Products</h1>
					<div id="productrow">
						<?php echo $recent_products; ?>
					</div>
				</div>
				<!-- Bottom Navbar -->
				<?php include "bottomnav.php"; ?>
			</section>
		</div>
	</body>

</html>