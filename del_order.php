<?php
	ob_start();

	include 'db.php';

	$user_id  = $_GET['user_id'];
	$order_id = $_GET['order_id'];

	$query 	  = "DELETE FROM orders WHERE id = '$order_id'";
	$run 	  = mysqli_query($conn,$query); 

	$query1   = "DELETE FROM invoices WHERE order_id = '$order_id'";
	$run1     = mysqli_query($conn,$query1);

	$query2   = "DELETE FROM bills WHERE order_id = '$order_id'";
	$run2     = mysqli_query($conn,$query2);

	$query3   = "DELETE FROM order_codes WHERE order_id = '$order_id'";
	$run3     = mysqli_query($conn,$query3);

	header('location: orders.php?user_id='.$user_id);

?>