<?php 

require 'config.php';

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
}
else {
  header('Location: index.php');
}


$emailerror = '';
$passworderror = '';
$loginerror = '';

if(isset($_POST['signinsubmit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = 'SELECT * FROM users WHERE email = ?';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 's', $email);
  mysqli_stmt_execute($stmt);
  $user = mysqli_stmt_get_result($stmt);

  if(mysqli_num_rows($user) != 0) {
    $user_data = mysqli_fetch_array($user);
    
    if(password_verify($password, $user_data['password'])) { //valid password
      $_SESSION['loggedin'] = true;
      $_SESSION['id'] = $user_data['id'];
      header('Location: index.php');
    }
    else {
      $loginerror = 'Login Failed: Wrong Email or Password';
    }
  }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Website | Sign In</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles/signin.css">
        
        <script type="text/javascript" src="scripts/signin.js"></script>
    </head>

    <body>
        <div id="container">
          <form id="loginform" action="" method="post">
            <h1>Login</h1>
            <input type="text" name="email" placeholder="Email" required>
            <p id="emailerror"><?php echo $emailerror ?></p>
            <input type="text"  name="password" placeholder="Password" required>
            <p id="passworderror"><?php echo $passworderror ?></p>
            <p id="loginerror"><?php echo $loginerror ?></p>
            
            <input type="submit" name="signinsubmit">
            <a href="signup.php">Sign Up</a>
            <a>Forgot Password</a>
          </form>
        </div>
    </body>

</html>