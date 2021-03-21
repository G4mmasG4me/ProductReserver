<?php 

require 'config.php';


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Website | Sign Up</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles/signin.css">
        
        <script type="text/javascript" src="scripts/signup.js"></script>
    </head>

    <body>
        <div id="container">
          <form id="loginform" action="" method="post">
            <h1>Login</h1>
            <input id="nameinput" type="text" name="name" onchange="namecheck()" placeholder="First and Last Name">
            <p id="nameerror"></p>
            <input id="emailinput" type="text" name="email" onchange="emailcheck()" placeholder="Email">
            <p id="emailerror"></p>
            <input id="addressinput" type="text" name="address" onchange="addresscheck()" placeholder="Address">
            <p id="addresserror"></p>
            <input id="passwordinput" type="text" name="password" onchange="passwordcheck()" placeholder="Password">
            <p id="passworderror"></p>
            <input id="confirminput" type="text" name="confirm" onchange="confirmcheck()"placeholder="Confirm Password">
            <p id="confirmerror"></p>
            <input id="submit" type="submit" disabled>
            <a href="">Register</a>
            <a href="">Forgot Password</a>
          </form>
        </div>
    </body>

</html>