<?php 

require 'config.php';

if(!isset($_GET['id'])) {
    header('Location: products.php');
}
if(isset($_GET['id'])) {
    $sql = 'SELECT * FROM products WHERE id = ' . $_GET['id'];
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $id = $row['id'];
    $name = $row['name'];
    $price = $row['price'];
    $description = $row['description'];
    $targetdir = dirname(dirname(__FILE__)) . '/images/' . $id . '/*';
    $images = glob($targetdir);
    if (mysqli_num_rows($query) != 0) { // if id in database
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
            <header class="w-100 top" id="header">
                <nav class="navbar justify-content-center w-100">
                    <ul class="navbar-nav w-100 justify-content-start align-items-center">
                        <li class="nav-item"><a class="nav-link" href="index.php"><img src="https://via.placeholder.com/160x40?text=Company+Name+Logo"></a></li>
                    </ul>
                    <div class="navbar-nav w-100 justify-content-center align-items-center">
                        <form id="searchform" action="products.php" method="get">
                            <input id="searchbar" type="text" name="search" placeholder="Search.." value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                            <select id="selectbar" name="category">
                                <option <?php if(isset($_GET['category']) and $_GET['category'] == 'All') { echo "selected = 'selected'"; } ?>>All</option>
                                <option <?php if(isset($_GET['category']) and $_GET['category'] == 'Tech') { echo "selected = 'selected'"; } ?>>Tech</option>
                                <option <?php if(isset($_GET['category']) and $_GET['category'] == 'Makeup') { echo "selected = 'selected'"; } ?>>Makeup</option>
                            </select>
                            <input id="searchbutton" type="submit">
                        </form>
                    </div>
                    <ul class="navbar-nav w-100 justify-content-end align-items-center">
                        <li class="nav-item"><a class="nav-link" href="#">Sign In</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Sign Up</a></li>
                    </ul>
                </nav>
            </header>
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
                    <button>Buy</button>
                    <button>Add to Basket</button>
                </div>

            </div>
            <?php include 'bottomnav.php' ?>
        </div>
    </body>

</html>