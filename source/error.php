<?php 

if (isset($_SERVER['REDIRECT_STATUS']) && !empty($_SERVER['REDIRECT_STATUS'])) {
	$status = $_SERVER['REDIRECT_STATUS'];
}
elseif (isset($_GET['error'])) {
	$status = $_GET['error'];
}
else {
	$status = 000;
}

$codes = array(
       403 => array('403 Forbidden', 'The server has refused to fulfill your request.'),
       404 => array('404 Not Found', 'The document/file requested was not found on this server.'),
       405 => array('405 Method Not Allowed', 'The method specified in the Request-Line is not allowed for the specified resource.'),
       408 => array('408 Request Timeout', 'Your browser failed to send a request in the time allowed by the server.'),
       500 => array('500 Internal Server Error', 'The request was unsuccessful due to an unexpected condition encountered by the server.'),
       502 => array('502 Bad Gateway', 'The server received an invalid response from the upstream server while trying to fulfill the request.'),
       504 => array('504 Gateway Timeout', 'The upstream server failed to send a request in the time allowed by the server.'),
			 000 => array('Unknown Error' , 'An Unknown Eroror Has Occured')
);

if (array_key_exists($status, $codes)) {
	$title = $codes[$status][0];
	$message = $codes[$status][1];
}
else {
	$title = $codes[000][0];
	$message = $codes[000][1];
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Website | 404 Not Found</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="styles/error.css">
		<link rel="stylesheet" type="text/css" href="styles/navbar.css">
	</head>

	<body>
		<div id="container">
			<!-- Top Navbar -->
			<?php include "topnav.php"; ?>
			<div id="content">
				<h1><?php echo $title; ?></h1>
				<p><?php echo $message; ?></p>
				<a href="index.php"><button id="homebutton">Home</button></a>
			</div>
			<!-- Bottom Navbar -->
			<?php include "bottomnav.php"; ?>
		</div>
	</body>

</html>