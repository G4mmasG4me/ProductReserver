<?php 

session_start();

require 'config.php';

if(!isset($_GET['id'])) {
    header('Location: products.php');
}
if(isset($_GET['id'])) {
    $sql = 'SELECT * FROM products WHERE id = ' . $_GET['id'];
    $query = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($query) != 0) { // if id in database
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
  if(isset($_SESSION['signedin']) && $_SESSION['signedin']) { // if logged in
		$user_id = $_SESSION['id'];
		$product_id = $_GET['id'];
		$quantity = 1;
		$sql = 'INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?,?,?)';
		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, 'iii', $user_id, $product_id, $quantity);
		mysqli_stmt_execute($stmt);
	}
	else { // not logged in
		if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])) { // if cookie is not empty
			$current_cart = json_decode($_COOKIE['cart'], true);
			array_push($current_cart, array($id, 1));
			setcookie("cart", json_encode($current_cart));
		}
		else { // cookie is empty
			$new_cart = array(array($id, 1));
			setcookie("cart", json_encode($new_cart));
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