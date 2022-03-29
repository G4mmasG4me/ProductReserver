<?php

require 'config.php';


# add user to database function
if(!empty($_POST['add_user_submit'])) {
  $first_name = $_POST['user_f_name'];
  $last_name = $_POST['user_l_name'];
  $email = $_POST['user_email'];
  $password = 'Hello123';
  $password = password_hash($password, PASSWORD_ARGON2ID);
  $sql = 'INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?);';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'ssss', $first_name, $last_name, $email, $password);
  mysqli_stmt_execute($stmt);
}

# add product to database function
if(!empty($_POST['add_product_submit'])) {
  $name = $_POST['product_name'];
  $desc = $_POST['product_desc'];
  $colour = $_POST['product_colour'];
  $size = $_POST['product_size'];
  $size_id = $_POST['product_size_id'];
  $category_id = $_POST['product_category_id'];
  $company_id = $_POST['product_company_id'];
  $price = $_POST['product_price'];

  $sql = 'INSERT INTO product (product_name, description, colour, size, size_id, category_id, company_id, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?);';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'ssssssss', $name, $desc, $colour, $size, $size_id, $category_id, $company_id, $price);
  mysqli_stmt_execute($stmt);
}

# add unfilled order to database
if(!empty($_POST['add_unfilled_order_submit'])) {
  $user_id = $_POST['user_id'];
  $product_id = $_POST['product_id'];

  $sql = 'INSERT INTO order_detail (user_id) VALUES (?);';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'i', $user_id);
  mysqli_stmt_execute($stmt);

  $order_detail_id = mysqli_insert_id($conn);

  $sql = 'INSERT INTO order_item (order_detail_id, product_id) VALUES (?, ?);';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'ii', $order_detail_id, $product_id);
  mysqli_stmt_execute($stmt);

  $order_item_id = mysqli_insert_id($conn);

  $sql = 'INSERT INTO unfilled_order_item (order_item_id) VALUES (?);';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'i', $order_item_id);
  mysqli_stmt_execute($stmt);
}

# add address to database
if(!empty($_POST['add_address'])) {
  $user_id = $_POST['user_id'];
  $line_1 = $_POST['line_1'];
  $line_2 = $_POST['line_2'];
  $postcode = $_POST['postcode'];
  $city = $_POST['city'];
  $county = $_POST['county'];
  $country = $_POST['country'];

  $sql = 'INSERT INTO address (user_id, line_1, line_2, postcode, city, county, country) VALUES (?, ?, ?, ?, ?, ?, ?);';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'issssss', $user_id, $line_1, $line_2, $postcode, $city, $county, $country);
  mysqli_stmt_execute($stmt);
}

# add product link to database function
if(!empty($_POST['add_product_link_submit'])) {
  $product_id = $_POST['product_id'];
  $link = $_POST['link'];

  $sql = 'INSERT INTO product_link (product_id, link) VALUES (?, ?);';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'is', $product_id, $link);
  mysqli_stmt_execute($stmt);
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Website | ControlPanel</title>

    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='styles/controlpanel.css'>

  </head>
  
  <body>
    <div class='main_container'>
      <div class='row'>

        <form id='add_user_form' name='add_user_form' action='' method='post' enctype='multipart/form-data'>
          <h2>Add User To DB</h2>
          <div class='input_section'>
            <label for='user_f_name'>First Name</label>
            <input id='user_f_name' name='user_f_name' type='text'>
          </div>
          <div class='input_section'>
            <label for='user_l_name'>Last Name</label>
            <input id='user_l_name' name='user_l_name' type='text'>
          </div>
          <div class='input_section'>
            <label for='user_email'>Email</label>
            <input id='user_email' name='user_email' type='text'>
          </div>
          <input id='add_user_submit' name='add_user_submit' type='submit'>
          <p1 id='add_user_error_message'></p1>
        </form>

        <form id='add_product_form' action='' method='post' enctype='multipart/form-data'>
          <h1>Add Product To DB</h1>
          <div class='input_section'>
            <label for='product_name'>Name</label>
            <input id='product_name' name='product_name' type='text'>
          </div>
          <div class='input_section'>
            <label for='product_desc'>Description</label>
            <input id='product_desc' name='product_desc' type='text'>
          </div>
          <div class='input_section'>
            <label for='product_colour'>Colour</label>
            <input id='product_colour' name='product_colour' type='text'>
          </div>
          <div class='input_section'>
            <label for='product_size'>Size</label>
            <input id='product_size' name='product_size' type='text'>
          </div>
          <div class='input_section'>
            <label for='product_size_id'>Size ID</label>
            <input id='product_size_id' name='product_size_id' type='text'>
          </div>
          <div class='input_section'>
            <label for='product_category_id'>Category ID</label>
            <input id='product_category_id' name='product_category_id' type='text'>
          </div>
          <div class='input_section'>
            <label for='product_company_id'>Company ID</label>
            <input id='product_company_id' name='product_company_id' type='text'>
          </div>
          <div class='input_section'>
            <label for='product_price'>Price</label>
            <input id='product_price' name='product_price' type='text'>
          </div>
          <input id='add_product_submit' name='add_product_submit' type='submit'>
          <p1 id='add_product_error_message'></p1>
        </form>

        <form id='add_unfilled_order' action='' method='post' enctype='multipart/form-data'>
          <h2>Add Unfilled Product To DB</h2>
          <div class='input_section'>
            <label for='user_id'>User ID</label>
            <input id='user_id' name='user_id' type='text'>
          </div>
          <div class='input_section'>
            <label for='product_id'>Product ID</label>
            <input id='product_id' name='product_id' type='text'>
          </div>

          <input id='add_unfilled_order_submit' name='add_unfilled_order_submit' type='submit'>
          <p1 id='add_unfilled_order_error_message'></p1>
        </form>

        <form id='add_address' action='' method='post' enctype='multipart/form-data'>
          <h2>Add Address To DB</h2>
          <div class='input_section'>
            <label for='user_id'>User ID</label>
            <input id='user_id' name='user_id' type='text'>
          </div>
          <div class='input_section'>
            <label for='line_1'>Line 1</label>
            <input id='line_1' name='line_1' type='text'>
          </div>
          <div class='input_section'>
            <label for='line_2'>Line 2</label>
            <input id='line_2' name='line_2' type='text'>
          </div>
          <div class='input_section'>
            <label for='postcode'>Postcode</label>
            <input id='postcode' name='postcode' type='text'>
          </div>
          <div class='input_section'>
            <label for='city'>City</label>
            <input id='city' name='city' type='text'>
          </div>
          <div class='input_section'>
            <label for='County'>County</label>
            <input id='County' name='County' type='text'>
          </div>
          <div class='input_section'>
            <label for='Country'>Country</label>
            <input id='Country' name='Country' type='text'>
          </div>
          <input id='add_address_submit' name='add_address_submit' type='submit'>
          <p1 id='add_address_error_message'></p1>
        </form>

        <form id='add_product_link' action='' method='post' enctype='multipart/form-data'>
          <h2>Add Product Link To DB</h2>
          <div class='input_section'>
            <label for='product_id'>Product ID</label>
            <input id='product_id' name='product_id' type='text'>
          </div>
          <div class='input_section'>
            <label for='link'>Link</label>
            <input id='link' name='link' type='text'>
          </div>
          <input id='add_product_link_submit' name='add_product_link_submit' type='submit'>
          <p1 id='add_product_link_error_message'></p1>
        </form>

      </div>
      
    </div>
  </body>

</html>