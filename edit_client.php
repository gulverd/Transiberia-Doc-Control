<?php
	ob_start();
	include 'db.php';
	$user_id 	= $_GET['user_id'];
	$client_id  = $_GET['client_id'];

	$now = date("Y-m-d H:m:s");

	$dt = date("YmdHms");
	
	$query = "SELECT * FROM user WHERE id = '$user_id'";
	$run   = mysqli_query($conn,$query);

	while($row = mysqli_fetch_array($run)){
		$id 	  	= $row['id'];
		$username 	= $row['username'];
		$full_name 	= $row['full_name'];
		$user_role  = $row['user_role'];

		if($user_role === '1'){
			$home_link  = 'clients.php?user_id='.$user_id;
		}elseif($user_role === '2'){
			$home_link  = 'clients.php?user_id='.$user_id;
		}
	}

	$query2 = "SELECT * FROM clients WHERE id = '$client_id'";
	$run2   = mysqli_query($conn,$query2);

	while($row2 = mysqli_fetch_array($run2)){
		$client_name 			= $row2['client_name'];
		$client_contact_name 	= $row2['client_contact_name'];
		$client_contact_phone 	= $row2['client_contact_phone'];
		$client_contact_email 	= $row2['client_contact_email'];
		$client_contact_web  	= $row2['client_contact_web'];
		$client_contact_address = $row2['client_contact_address'];
		$client_file 			= $row2['client_file'];
	}

	if($client_file == '' or is_null($client_file)){
		$client_file 	 = '<a href="upload_agreement.php?user_id='.$user_id.'&client_id='.$client_id.'" id="link"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> ხელშეკრულების ატვირთვა</a>';
		$client_del_link = '';
	}else{
		$client_file 	 = '<a href="agreement/'.$client_file.'" id="ok"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> ფაილის ჩამოტვირთვა</a>';
		$client_del_link = '<a href="del_agreement.php?user_id='.$user_id.'&client_id='.$client_id.'"><i class="fa fa-trash-o" aria-hidden="true"></i> წაშლა</a>';
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=0, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
	<title>Transiberia Document Control</title>
</head>
<div class="container">
	<div class="col-md-12">
		<img src="img/logo.png" id="logo">
	</div>
	<div class="col-md-12">
		<div class="page-header">
			<h1><i class="fa fa-plus-circle" aria-hidden="true"></i> ADD NEW CLIENT <small>ახალი შემკვეთის დამატება</small></h1>
			<p id="big_p">
			    <h5>PLEASE FILL IN ALL FIELD CORECTLY</h5>
			   </p>
			<p id="small_p">
			    <h5>გთხოვთ სწორად შეავსოთ ყველა ველი</h5>
			</p>
		</div>	
		<div class="col-md-12" id="menu_wrapper">
			<p>
				<h4><a href="<?php echo $home_link;?>"><span class="glyphicon glyphicon-home"></span> BACK TO THE MAIN PAGE / მთავარ გვერდზე დაბრუნება</a></a></h4>
			</p>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-12" id="docs">
			<h4>დოკუმენტები:</h4>
		</div>
		<div class="col-md-6" id="docs">
			<table class="table table bordered">
				<tr class="tra">
					<td>ხელშეკრულება:</td>
					<td><?php echo $client_file;?></td>
					<td class="tda" id="nobs"><?php echo $client_del_link;?></td>
				</tr>
			</table>
	</div>
	<div class="col-md-12">
		<form action="" method="POST">
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CLIENT NAME / შემკვეთის დასახელება</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_name" value="<?php echo $client_name?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CONTACT PERSON / საკონტაქტო პირის სახელი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_contact_name" value="<?php echo $client_contact_name?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CONTACT PHONE / საკონტაქტო პირის ტელეფონის ნომერი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_contact_phone" value="<?php echo $client_contact_phone?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CONTACT EMAIL / საკონტაქტო პირის ელ-ფოსტა</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_contact_email" value="<?php echo $client_contact_email?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">WEB / შემკვეთის ვებ-საიტი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_contact_web" value="<?php echo $client_contact_web?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">ADDRESS / შემკვეთის მისამართი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_contact_address" value="<?php echo $client_contact_address?>">
			</div>								 
			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-primary" id="but"> SUBMIT / დადასტურება</button> 
			</div>
		</form>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php 

	if(isset($_POST['submit'])){
		$client_name1 			 = $_POST['client_name'];
		$client_contact_name1 	 = $_POST['client_contact_name'];
		$client_contact_phone1 	 = $_POST['client_contact_phone'];
		$client_contact_email1 	 = $_POST['client_contact_email'];
		$client_contact_web1  	 = $_POST['client_contact_web'];
		$client_contact_address1 = $_POST['client_contact_address'];
       

		$query3 = "UPDATE clients SET client_name = '$client_name1', client_contact_name = '$client_contact_name1',client_contact_phone = '$client_contact_phone1', client_contact_email = '$client_contact_email1', client_contact_web = '$client_contact_web1',client_contact_address = '$client_contact_address1' WHERE id = '$client_id'";
		$run3   = mysqli_query($conn,$query3);

		header('location:clients.php?user_id='.$user_id);

	}

?>