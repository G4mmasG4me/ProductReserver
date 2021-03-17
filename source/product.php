<?php 

require 'config.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Website | Products</title>
        
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
                        <form id="searchform" action="" method="get">
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
                    <img src="https://via.placeholder.com/480">

                </div>
                <div id="productsection">
                    <h1>Product</h1>
                    <p>Price</p>
                    <p>Description</p>

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