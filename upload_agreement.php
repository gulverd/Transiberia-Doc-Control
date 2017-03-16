<?php
	ob_start();
	
	include 'db.php';
	
	$user_id   = $_GET['user_id'];
	$client_id = $_GET['client_id'];

	$now = date("Y-m-d H:m:s");
	$dt = date("YmdHms");
	
	$query = "SELECT * FROM user WHERE id = '$user_id'";
	$run   = mysqli_query($conn,$query);

	while($row = mysqli_fetch_array($run)){
		$id 	  	= $row['id'];
		$username 	= $row['username'];
		$full_name 	= $row['full_name'];
		$user_role  = $row['user_role'];

		$home_link  = 'edit_client.php?user_id='.$user_id.'&client_id='.$client_id;
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
			<h1><i class="fa fa-plus-circle" aria-hidden="true"></i> UPLOAD AGREEMENT <small>ხელშეკრულების ატვირთვა</small></h1>
		</div>	
		<div class="col-md-12" id="menu_wrapper">
			<p>
				<h4><a href="<?php echo $home_link;?>"><span class="glyphicon glyphicon-home"></span> BACK TO THE ORDER PAGE / უკან დაბრუნება</a></a></h4>
			</p>
		</div>
	</div>
	<div class="col-md-12">
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">AGREEMENT / ხელშეკრულება</label>
				<input type="file" class="form-control" id="exampleInputEmail1" name="image">
			</div>											 
			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-primary" id="but"> UPLOAD AGREEMENT / ხელშეკრულების ატვირთვა</button>
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

		if(isset($_FILES['image'])){
			
			$errors    	= array();
			$file_name 	= $_FILES['image']['name'];
			$file_size 	= $_FILES['image']['size'];
			$file_tmp  	= $_FILES['image']['tmp_name'];
			$file_type 	= $_FILES['image']['type'];   
			$file_ext  	= strtolower(end(explode('.',$_FILES['image']['name'])));
			$extensions = array("jpeg","jpg","png");      
			$fl_name    = $dt.$file_name;         
			
			if(empty($errors)==true){
			    move_uploaded_file($file_tmp,"agreement/".$fl_name);

				$query3 = "UPDATE clients SET client_file = '$fl_name' WHERE id = '$client_id'";
				$run3   = mysqli_query($conn,$query3);

				header("location: edit_client.php?user_id=".$user_id.'&client_id='.$client_id);

			}else{
			    print_r($errors);
			}

		}
		

	}

?>