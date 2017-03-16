<?php
	ob_start();

	include 'db.php';

	$user_id  	= $_GET['user_id'];
	$client_id  = $_GET['client_id'];


	$queryOrderID = "SELECT * FROM orders WHERE order_owner = '$client_id'";
	$runOrderId   = mysqli_query($conn,$queryOrderID);
	
	if(mysqli_num_rows($runOrderId) >= 1){
		while($rowOrderId = mysqli_fetch_array($runOrderId)){

			$order_id = $rowOrderId['id'];

			$query 	  = "DELETE FROM clients WHERE id = '$client_id'";
			$run 	  = mysqli_query($conn,$query);

			$query4	  = "DELETE FROM orders WHERE id = '$order_id'";
			$run4 	  = mysqli_query($conn,$query4); 

			$query1   = "DELETE FROM invoices WHERE order_id = '$order_id'";
			$run1     = mysqli_query($conn,$query1);

			$query2   = "DELETE FROM bills WHERE order_id = '$order_id'";
			$run2     = mysqli_query($conn,$query2);

			$query3   = "DELETE FROM order_codes WHERE order_id = '$order_id'";
			$run3     = mysqli_query($conn,$query3);

			header('location: clients.php?user_id='.$user_id);

		}
	}else{

		$query5	  = "DELETE FROM clients WHERE id = '$client_id'";
		$run5 	  = mysqli_query($conn,$query);
		
		header('location: clients.php?user_id='.$user_id);
	
	}
	

?>