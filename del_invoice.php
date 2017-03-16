<?php
	ob_start();
	include 'db.php';
	$user_id  	= $_GET['user_id'];
	$order_id 	= $_GET['order_id'];
	$invoice_id = $_GET['invoice_id'];

 	$query = "DELETE FROM invoices WHERE id = '$invoice_id'";
	$run   = mysqli_query($conn,$query);

	header('location: invoices.php?user_id='.$user_id.'&order_id='.$order_id); 