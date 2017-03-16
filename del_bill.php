
<?php
	ob_start();
	include 'db.php';
	$user_id  	= $_GET['user_id'];
	$order_id 	= $_GET['order_id'];
	$bill_id    = $_GET['bill_id'];

 	$query = "DELETE FROM bills WHERE id = '$bill_id'";
	$run   = mysqli_query($conn,$query);

	header('location: bills.php?user_id='.$user_id.'&order_id='.$order_id); 