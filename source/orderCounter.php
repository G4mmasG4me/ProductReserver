<?php 

require 'config.php';

$sql = 'SELECT * FROM order_item';
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$rows = mysqli_num_rows($result);
echo $rows;
?>