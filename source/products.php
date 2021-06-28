<?php 

session_start();

$output = '';
$order = '';
$filter = '';
$num_results = '';

require 'config.php';

if(isset($_GET['filter'])) {
  switch($_GET['filter']) {
    case 'default':
      $filter = '';
      break;
    case 'popular':
      $filter = '';
      break;
    case 'newest':
      $filter = '';
      break;
    case 'priceH-L':
      $filter = 'ORDER BY price DESC';
      break;
    case 'priceL-H':
      $filter = 'ORDER BY price ASC';
      break;
  }
}

if(isset($_GET['num_results'])) {
  switch($_GET['num_results']) {
    case '25':
      $num_results = 'LIMIT 0, 25';
      break;
    case '50':
      $num_results = 'LIMIT 0, 50';
      break;
    case '100':
      $num_results = 'LIMIT 0, 100';
      break;
  }
}

if(isset($_GET['search'])) {
  $searchq = $_GET['search'];
  $sql = 'SELECT * FROM products WHERE name LIKE ' . '"%' . $searchq . '%" ' . $filter;
  $query = mysqli_query($conn, $sql);
  
  if(mysqli_num_rows($query) == 0) {
    $output = 'There were no search results!';
    $_SESSION['output'] = $output;
  }
  else {
    while($row = mysqli_fetch_array($query)) {
      $name = $row['name'];
      $price = $row['price'];
      $description = $row['description'];
      #$manufacturer = $row['manufacturer'];
      $id = $row['id'];
      #$image = 'images/' . $id . '.png';
      $output .= '<a href="product.php?id='.$id.'" id="product"><div id="imgcontainer"><img src="https://via.placeholder.com/160x160?text=Product+Image"></div><div id="productinfo"><h1 id="productname">'.$name.'</h1><p id="productprice">£'.$price.'</p><p id="productdescription">'.$description.'</p></div></a>';
      $_SESSION['output'] = $output;
    }
  }
}
else {
  $sql = "SELECT * FROM products " . $filter;
  $query = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($query)) {
    $name = $row['name'];
    $price = $row['price'];
    $description = $row['description'];
    #$manufacturer = $row['manufacturer'];
    $id = $row['id'];
    #$image = 'image/' . $id . '.png';
    $output .= '<a href="product.php?id='.$id.'" id="product"><div id="imgcontainer"><img src="https://via.placeholder.com/160x160?text=Product+Image"></div><div id="productinfo"><h1 id="productname">'.$name.'</h1><p id="productprice">£'.$price.'</p><p id="productdescription">'.$description.'</p></div></a>';
    $_SESSION['output'] = $output;
  }
}

$searchhiddeninputs = "";
$sorthiddeninputs = "";


foreach($_GET as $key => $value) {
    if($key != "search" && $key != "category") {
        $searchhiddeninputs .= "<input type='hidden' name='".$key."' value='".$value."'>";
    }
    if($key != "sortby") {
        $sorthiddeninputs .= "<input type='hidden' name='".$key."' value='".$value."'>";
    }
}


?>


<!DOCTYPE html>
<html>
    <head>
        <title>Website | Products</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles/navbar.css">
        <link rel="stylesheet" type="text/css" href="styles/products.css">
        <link rel="stylesheet" type="text/css" href="styles/slider.css">
        
        <script type="text/javascript" src="scripts/products.js"></script>
        <script type="text/javascript" src="scripts/slider.js"></script>
    </head>

    <body>
        <div id="container">
            <!-- Top Navbar -->
            <?php include "shoptopnav.php"; ?>
            <div id="bodycontent">
                <div id="filterpanel">
                    <h1>Filter Panel</h1>
                    <div id="price-range">
                        <p>£</p>
                        <input id="leftinput" type="number" oninput="set_left_thumb()">
                        <div id="range-slider">
                            <div id="track"></div>
                            <input id="leftthumb" type="range" min=0 max=100 value=25 step=1 oninput="set_left_input()">
                            <input id="rightthumb" type="range" min=0 max=100 value=75 step=1 oninput="set_right_input()">
                        </div>
                        <p>£</p>
                        <input id="rightinput" type="number" oninput="set_right_thumb()">
                    </div>

                </div>
                <div id="maincontent">
                    <div id="sortbarform" action="" method="get">
                        <form id="leftsortbarform" action="" method="get" class="justify-content-start w-100">
                            <?php echo $sorthiddeninputs ?>
                            <select id="sortbar" name="sortby" onchange="sortchange()">
                                <option value='popular' <?php if(isset($_GET['sortby']) and $_GET['sortby'] == 'popular') { echo "selected = 'selected'"; } ?>>Popular</option>
                                <option value='newest' <?php if(isset($_GET['sortby']) and $_GET['sortby'] == 'newest') { echo "selected = 'selected'"; } ?>>Newest</option>
                                <option value='pricehtl' <?php if(isset($_GET['sortby']) and $_GET['sortby'] == 'pricehtl') { echo "selected = 'selected'"; } ?>>Price: High to Low</option>
                                <option value='pricelth' <?php if(isset($_GET['sortby']) and $_GET['sortby'] == 'pricelth') { echo "selected = 'selected'"; } ?>>Price: Low to High</option>
                            </select>
                        </form>
                        <form  id="rightsortbarform" action="" method="get" class="justify-content-end">
                            <div id="sortdiv">
                                <button id="rows"><img src="https://via.placeholder.com/32?text=Layout+2"></button>
                                <button id="grid"><img src="https://via.placeholder.com/32?text=Layout+1"></button>
                            </div>
                        </form>
                    </div>
                    <div id="products">
                        <?php echo $output ?>
                    </div>
                </div>
            </div>
            <!-- Bottom Navbar -->
            <?php include "bottomnav.php"; ?>
        </div>

        
    </body>

</html>