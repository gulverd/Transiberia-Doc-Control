<?php
	ob_start();
	include 'db.php';
	$user_id  	= $_GET['user_id'];
	$order_id 	= $_GET['order_id'];
	$code_id 	= $_GET['code_id'];

 	$query = "DELETE FROM order_codes WHERE id = '$code_id'";
	$run   = mysqli_query($conn,$query);

	header('location: order_codes.php?user_id='.$user_id.'&order_id='.$order_id); 