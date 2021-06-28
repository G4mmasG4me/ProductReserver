<?php 

require 'config.php';

if(!isset($_GET['id'])) {
  header('Location: index.php');
}
$error = '';


if(isset($_GET['id'])) {
  $sql = "SELECT * FROM unverified_users WHERE id = '" . $_GET["id"] . "'";
  $query = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($query) != 0) { // if id in database
    $row = mysqli_fetch_array($query);
    $id = $row['id'];
    $email = $row['email'];
    $code = $row['code'];
    // get all information and print
  }
  else { // if id not in database
      // show sorry screen, then redirect to products.php
      header('Location: products.php');
  }
}

if(isset($_POST['codesubmit'])) {
  $code1 = $_POST['code1'];
  $code2 = $_POST['code2'];
  $code3 = $_POST['code3'];
  $code4 = $_POST['code4'];
  $inputed_code = $code1 . $code2 . $code3 . $code4;
  if($inputed_code == $code) {
    #Transfer Unverified User to Permanent Database
    $name = $row['name'];
    $name = explode(' ', $name);
    $first_name = array_shift($name);
    $last_name = implode(' ', $name);
    $email = $row['email'];
    $password = $row['password'];
    $sql = 'INSERT INTO users (first_name, last_name, email, password) VALUES (?,?,?,?)';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssss', $first_name, $last_name, $email, $password);
    mysqli_stmt_execute($stmt);
    $sql = 'DELETE FROM unverified_users WHERE id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $_GET['id']);
    mysqli_stmt_execute($stmt);
    // add user to basket programming database
    header('Location: signin.php');
  }
  else {
    $error = "This is an incorrect code!";
  }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Website | Verify</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles/verify.css">
        
        <script type="text/javascript" src="scripts/verify.js"></script>
    </head>

    <body>
        <div id="container">
          <form id="codeform" action="" method="post">
          <p>We have sent an email to email, containing the 4 digit verification code. Please input it below.</p>
            <div id="codes">
              <input id="codeinp1" type="text" name="code1" maxlength=1 oninput="nextfocus1()" autofocus required>
              <input id="codeinp2" type="text" name="code2" maxlength=1 oninput="nextfocus2()" required>
              <input id="codeinp3" type="text" name="code3" maxlength=1 oninput="nextfocus3()" required>
              <input id="codeinp4" type="text" name="code4" maxlength=1 oninput="nextfocus4()" required>
            </div>
            <p><?php echo $error; ?></p>
            <input id="codesubmit" name="codesubmit" type="submit">
            <a href="">Resend</a>
          </form>
        </div>
    </body>
</html>