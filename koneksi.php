<?php
// mengkoneksikan ke database
	$kon = new mysqli('localhost','root','','kuliah');
	if (!$kon) {
		die('Could not connect: ' . mysqli_error($con));
	}
?>
