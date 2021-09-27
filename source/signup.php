<?php 

require 'config.php';

session_start();

if(isset($_SESSION["signedin"]) && $_SESSION["signedin"] === true) {
	header('Location: index.php');
}

$emailerror = '';
$emailerr = '';
$nameerror = '';
$namerr = '';
$passworderror = '';
$passworderr = '';
$confirmerror = '';
$confirmerr = '';

$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charlength = strlen($characters);

if(isset($_POST['signupsubmit'])) {
	//on submit get post parameters
	$email = $_POST['email']; // need to do validation on email
	$name = $_POST['name']; // need to do validation on name
	$password = $_POST['password']; // need to do validation on password 
	$confirm = $_POST['confirm']; // need to do validation on confirm
	// Email Validation
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailerror = 'Invalid email format';
		$emailerr = True;
	}
	else {
		$emailerror = '';
		$emailerr = False;
	}
	// Name Validation
	if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
		$nameerror = 'Only letters and white space allowed';
		$nameerr = True;
	}
	else {
		$nameerror = '';
		$nameerror = False;
	}
	// Password Validation
	if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}$/", $password)) {
		$passworderror = 'Invalid Password';
		$passworderr = True;
	}
	else {
		$passworderror = '';
		$passworderr = False;
	}
	if ($password != $confirm) {
		$confirmerror = 'Password and Confirm Not The Same';
		$confirmerr = True;
	}
	else {
		$confirmerror = '';
		$confirmerr = False;
	}


	// search for email is db
	$sql = 'SELECT email FROM users WHERE email = ?';
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, 's', $email);
	mysqli_stmt_execute($stmt);
	$users_result = mysqli_stmt_get_result($stmt);
	
	$sql = 'SELECT email FROM unverified_users WHERE email = ?';
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, 's', $email);
	mysqli_stmt_execute($stmt);
	$unverified_users_result = mysqli_stmt_get_result($stmt);

	if(mysqli_num_rows($users_result) == 0 && mysqli_num_rows($unverified_users_result) == 0 ) { // if email not in database
		// hash and salt password
		$password = password_hash($password, PASSWORD_ARGON2ID);

		$code = rand(0000,9999);
		echo $code;

		//temporarily saves parameters and ID to a unverified user database
		$sql = 'INSERT INTO unverified_users (code, name, email, password) VALUES (?, ?, ?, ?)';
		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, 'ssss', $code, $name, $email, $password);
		mysqli_stmt_execute($stmt);
		$id = mysqli_insert_id($conn);

		$subject = 'Product Resever Account Code';
		$txt = 'Welcome to Product Reserver your account code is ' . $code;
		$headers = 'From: productresever@hotmail.com\r\n';
		mail($email,$subject,$txt,$headers);

		//direct them to verify page with key
		header('Location: verify.php?id=' . $id);
	}
	else {
		$emailerror = 'Email already in use';
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Website | Sign Up</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="styles/signup.css">
		
		<script type="text/javascript" src="scripts/signup.js"></script>
	</head>

	<body>
		<div id="container">
			<form id="loginform" action="" method="post">
				<h1>Sign Up</h1>
				<input id="nameinput" type="text" name="name" onchange="namecheck()" placeholder="First and Last Name" required>
				<p id="nameerror"></p>
				<input id="emailinput" type="text" name="email" onchange="emailcheck()" placeholder="Email" required>
				<p id="emailerror"><?php echo $emailerror ?></p>
				<input id="passwordinput" type="password" name="password" onchange="passwordcheck()" placeholder="Password" required>
				<p id="passworderror"></p>
				<input id="confirminput" type="password" name="confirm" onchange="confirmcheck()"placeholder="Confirm Password" required>
				<p id="confirmerror"></p>
				<input id="submit" type="submit" name="signupsubmit" disabled>
				<a href="signin.php">Sign In</a>
			</form>
		</div>
	</body>
</html>