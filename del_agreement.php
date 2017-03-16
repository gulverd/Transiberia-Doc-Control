<?php
	ob_start();
	include 'db.php';
	$user_id   = $_GET['user_id'];
	$client_id = $_GET['client_id'];

	$query = "UPDATE clients SET client_file = '' WHERE id = '$client_id'";
	$run   = mysqli_query($conn,$query);

	header('location: edit_client.php?user_id='.$user_id.'&client_id='.$client_id); 