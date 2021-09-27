<?php 
session_start();


?>

<!DOCTYPE html>
<html>
    
	<head>
		<title>Website | Home</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="styles/recommend.css">
		<link rel="stylesheet" type="text/css" href="styles/navbar.css">
		
		<script type="text/javascript" src="scripts/index.js"></script>
	</head>

	<body>
		<div id="container">
				<!-- Top Navbar -->
				<?php include "topnav.php"; ?>
				<div id="main">
					<div id="content">
						<h1>Recommend A Product</h1>
						<form id="productform">
							<input id="nameinput" type="text" placeholder="">
							<textarea id="descriptioninput"></textarea>
							<input id="submit" type="submit">
						</form>
					</div>
				</div>
				<!-- Bottom Navbar -->
				<?php include "bottomnav.php" ?>
		</div>
	</body>
</html>