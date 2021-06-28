<?php

require 'config.php';

if (isset($_POST['addproductsubmit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $colour = $_POST['colour'];
    $size = $_POST['size'];
    $category = $_POST['category'];
    $company = $_POST['brand'];
    $price = $_POST['price'];
    $link = $_POST['link'];

    $sql = 'INSERT INTO products (name, description, colour, size, category, company_id, price, link) VALUES (?, ?, ?, ?, ?, ?, ?, ?)'; 
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssiis', $name, $description, $colour, $size, $category, $company, $price, $link);
    mysqli_stmt_execute($stmt);
    $id = mysqli_insert_id($conn);
    $targetdir = dirname(dirname(__FILE__)) . '/images/' . $id . '/';
    mkdir($targetdir);
    for($i=0 ; $i < count($_FILES['image']['name']) ; $i++) {
        $tempfile = $_FILES['image']['tmp_name'][$i];
        $extension  = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
        $newfile = $targetdir . $i . '.' . $extension;
        move_uploaded_file($tempfile, $newfile);
    }
}
if (isset($_POST['editproductsubmit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $colour = $_POST['colour'];
    $size = $_POST['size'];
    $category = $_POST['category'];
    $company = $_POST['brand'];
    $price = $_POST['price'];
    $link = $_POST['link'];

    $sql = 'UPDATE products SET name=?, description=?, colour=?, size=?, category=?, company_id=?, price=?, link=? WHERE id=?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssiisi', $name, $description, $colour, $size, $category, $company, $price, $link, $id);
    mysqli_stmt_execute($stmt);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Website | Admin</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles/admin.css">

        <script type="text/javascript" src="scripts/admin.js"></script>
        
    </head>

    <body>
        <div id="container">
            <div id="sidepanel">
                <div id="topside">
                    <div id="lefttop">
                        <button id="sidepanelbutton" onclick="sidepanel_open_close()">&#8801;</button>
                    </div>
                    <div id="righttop">
                        <button id="profilebutton"><img id="profileimg" src="https://via.placeholder.com/50x50"></button>
                    </div>
                </div>
                <div id="sidepanellinks">
                    <button id="page1button" onclick="page(this)">Dashboard</button>
                    <button id="page2button" onclick="page(this)">Product</button>
                    <button id="page3button" onclick="page(this)">Customers</button>
                    <button id="page4button" onclick="page(this)">Orders</button>
                </div>
            </div>
            <div id="maincontent">
                <div id="page1">

                </div>
                <div id="page2">
                    <div id="innerpage">
                        <div id="topbar">
                            <button id="add" onclick="p2AddProductShow(this)">Add Product</button>
                            <button id="edit" onclick="p2EditProductShow(this)">Edit Product</button>
                            <button id="edit" onclick="p2SearchProductShow(this)">Search Product</button>
                        </div>
                        <div id="contentbar">
                            <div id="p2add-content">
                                <h1>Add Product</h1>
                                <form id="addproductform" action="" method="post" enctype="multipart/form-data">
                                    <table>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Colour</th>
                                            <th>Size</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Price (£)</th>
                                            <th>Link</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="name" required></td>
                                            <td><input type="text" name="description" required></td>
                                            <td><input type="text" name="colour" required></td>
                                            <td><input type="text" name="size" required></td>
                                            <td><input type="file" name="image[]" accept="image/*" multiple required></td>
                                            <td><input type="text" name="category" required></td>
                                            <td><input type="text" name="brand" required></td>
                                            <td><input type="number" name="price" step="0.01" required></td>
                                            <td><input type="text" name="link" required></td>
                                        </tr>
                                    </table>
                                    <input id="addproductsubmit" type="submit" name="addproductsubmit">
                                </form>

                            </div>
                            <div id="p2edit-content">
                                <h1>Edit Content</h1>
                                <p>Search For The Product Using It's ID</p>
                                
                                <form id="editproductform" action="" method="post" enctype="multipart/form-data">
                                    <input id="productid" type="number" name="id" onchange="productSearchEdit(this.value)">
                                </form>

                            </div>
                            <div id="p2search-content">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="page3">
                    <div id="innerpage">
                        <div id="topbar">
                            <button id="edit" onclick="p3EditProductShow(this)">Edit Product</button>
                            <button id="edit" onclick="p3SearchProductShow(this)">Search Product</button>
                        </div>
                        <div id="contentbar">
                            <div id="p3edit-content">
                                <h1>Edit Content</h1>
                                <p>Search For The Product Using It's ID</p>
                                
                                <form id="editcustomerform" action="" method="post" enctype="multipart/form-data">
                                    <input id="customerid" type="number" name="id" onchange="userSearchEdit(this.value)">
                                </form>

                            </div>
                            <div id="p3search-content">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="page4">

                </div>
            </div>
        </div>
    </body>

</html>