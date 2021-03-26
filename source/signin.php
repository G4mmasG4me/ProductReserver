<?php 

require 'config.php';

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
            <input type="text" name="email" placeholder="Email">
            <input type="text"  name="password" placeholder="Password">
            
            <input type="submit">
            <a href="signup.php">Sign Up</a>
            <a>Forgot Password</a>
          </form>
        </div>
    </body>

</html>