<?php
	ob_start();
	include 'db.php';

	$user_id = $_GET['user_id'];
	$user 	 = $_GET['user'];

	$query   = "DELETE FROM user WHERE id = '$user'";
	$run     = mysqli_query($conn,$query);

	header('location:users.php?user_id='.$user_id);
?>