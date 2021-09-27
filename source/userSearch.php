<?php 

require 'config.php';

$id = $_GET['id'];

$sql = 'SELECT * FROM users WHERE id = ?';
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if(mysqli_num_rows($result) == 1) {
	$user = mysqli_fetch_array($result);
	$first_name = $user['first_name'];
	$last_name = $user['last_name'];
	$email = $user['email'];
	$address = $user['address'];
	$dateadded = $user['dateadded'];

	$output = '
	<form id="edituserform" action="" method="post" enctype="multipart/form-data">
		<input id="userid" type="number" name="id" onchange="userSearchEdit(this.value)" value="'. $id .'">
		<table>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Address</th>
				<th>Date Added</th>
			</tr>
			<tr>
				<td><input type="text" name="id" value="'. $id . '" readonly></td>
				<td><input type="text" name="first_name" value="'. $first_name . '" required></td>
				<td><input type="text" name="last_name" value="'. $last_name . '" required></td>
				<td><input type="text" name="email" value="'. $email . '" required></td>
				<td><input type="text" name="address" value="'. $address . '" required></td>
				<td><input type="text" name="dateadded" value="'. $dateadded . '" readonly></td>
			</tr>
		</table>
		<input id="editusersubmit" type="submit" name="editusersubmit">
	</form>';
}
elseif(mysqli_num_rows($result) > 1) {
	$output = '
	<input id="userid" type="number" name="id" onchange="userSearchEdit(this.value)" value="'. $id . '">
	<p>More than one user by that ID</p>';
}
elseif(mysqli_num_rows($result) < 1) {
	$output = '
	<input id="userid" type="number" name="id" onchange="userSearchEdit(this.value)" value="'. $id . '">
	No users by that ID';
}


echo $output;