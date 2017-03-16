<?php
	ob_start();
	include 'db.php';
	$user_id  	= $_GET['user_id'];
	$code_id 	= $_GET['code_id'];

 	$query = "DELETE FROM codes WHERE id = '$code_id'";
	$run   = mysqli_query($conn,$query);

	header('location: codes.php?user_id='.$user_id); 