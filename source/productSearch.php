<?php 

require 'config.php';

$id = $_GET['id'];

$sql = 'SELECT * FROM products WHERE id = ?';
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if(mysqli_num_rows($result) == 1) {
    $product = mysqli_fetch_array($result);
    $name = $product['name'];
    $description = $product['description'];
    $colour = $product['colour'];
    $size = $product['size'];
    $category = $product['category'];
    $company = $product['company_id'];
    $price = $product['price'];
    $link = $product['link'];

    $output = '
    <form id="editproductform" action="" method="post" enctype="multipart/form-data">
        <input id="productid" type="number" name="id" onchange="productSearchEdit(this.value)" value="'. $id .'">
        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Colour</th>
                <th>Size</th>
                <th>Image</th>
                <th>Category</th>
                <th>Company</th>
                <th>Price (£)</th>
                <th>Link</th>
            </tr>
            <tr>
                <td><input type="text" name="name" value="'. $name . '" required></td>
                <td><input type="text" name="description" value="'. $description . '" required></td>
                <td><input type="text" name="colour" value="'. $colour . '" required></td>
                <td><input type="text" name="size" value="'. $size . '" required></td>
                <td><input type="file" name="image[]" accept="image/*" multiple></td>
                <td><input type="text" name="category" value="'. $category . '" required></td>
                <td><input type="text" name="brand" value="'. $company . '" required></td>
                <td><input type="number" name="price" step="0.01" value="'. $price . '" required></td>
                <td><input type="text" name="link" value="'. $link . '" required></td>
            </tr>
        </table>
        <input id="editproductsubmit" type="submit" name="editproductsubmit">
    </form>';
}
elseif(mysqli_num_rows($result) > 1) {
    $output = '
    <input id="productid" type="number" name="id" onchange="productSearchEdit(this.value)" value="'. $id . '">
    <p>More than one products by that ID</p>';
}
elseif(mysqli_num_rows($result) < 1) {
    $output = '
    <input id="productid" type="number" name="id" onchange="productSearchEdit(this.value)" value="'. $id . '">
    No products by that ID';
}


echo $output;