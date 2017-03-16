<?php
	ob_start();
	include 'db.php';
	$user_id   = $_GET['user_id'];
	$order_id  = $_GET['order_id'];

	$query = "UPDATE orders SET order_number = '', order_document = '' WHERE id = '$order_id'";
	$run   = mysqli_query($conn,$query);

	header('location: order_in.php?user_id='.$user_id.'&order_id='.$order_id); 