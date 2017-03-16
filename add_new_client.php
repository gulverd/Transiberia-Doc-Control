<?php
	ob_start();
	include 'db.php';
	$user_id = $_GET['user_id'];
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
			$home_link  = 'dashboard.php?user_id='.$user_id;
		}elseif($user_role === '2'){
			$home_link  = 'dashboard_dir.php?user_id='.$user_id;
		}
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
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CLIENT NAME / შემკვეთის დასახელება</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_name">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CONTACT PERSON / საკონტაქტო პირის სახელი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_contact_name">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CONTACT PHONE / საკონტაქტო პირის ტელეფონის ნომერი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_contact_phone">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CONTACT EMAIL / საკონტაქტო პირის ელ-ფოსტა</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_contact_email">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">WEB / შემკვეთის ვებ-საიტი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_contact_web">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">ADDRESS / შემკვეთის მისამართი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="client_contact_address">
			</div>		
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">AGREEMENT / ხელშეკრულება</label>
				<input type="file" class="form-control" id="exampleInputEmail1" name="image">
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
		$client_name 			= $_POST['client_name'];
		$client_contact_name 	= $_POST['client_contact_name'];
		$client_contact_phone 	= $_POST['client_contact_phone'];
		$client_contact_email 	= $_POST['client_contact_email'];
		$client_contact_web  	= $_POST['client_contact_web'];
		$client_contact_address = $_POST['client_contact_address'];

		if(isset($_FILES['image'])){
			
	
			$errors    	= array();
			$file_name 	= $_FILES['image']['name'];
			$file_size 	= $_FILES['image']['size'];
			$file_tmp  	= $_FILES['image']['tmp_name'];
			$file_type 	= $_FILES['image']['type'];   
			$file_ext  	= strtolower(end(explode('.',$_FILES['image']['name'])));

			$extensions = array("jpeg","jpg","png");      
			if($file_name == '' or is_null($file_name)){
				$fl_name = NULL;
			}else{
				$fl_name    = $dt.$file_name;
			}         

			
			if(empty($errors)==true){
			     move_uploaded_file($file_tmp,"agreement/".$fl_name);

			    $query = "INSERT INTO clients (client_name,client_contact_name,client_contact_phone,client_contact_email,client_contact_address,client_contact_web,client_file) 
			    	VALUES ('$client_name','$client_contact_name','$client_contact_phone','$client_contact_email','$client_contact_address','$client_contact_web','$fl_name')";
				$run   = mysqli_query($conn,$query);

				header('location:clients.php?user_id='.$user_id);

			}else{
			    print_r($errors);
			}

		}

	}

?>