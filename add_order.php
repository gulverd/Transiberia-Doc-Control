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
			<h1><i class="fa fa-plus-circle" aria-hidden="true"></i> CREATE NEW ORDER <small>ახალი შეკვეთის დამატება</small></h1>
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
				<label for="exampleInputEmail1" id="label">ORDER OWNER NAME / შემკვეთის დასახელება</label>
				<select class="form-control" name="order_owner">
					<?php
						$queryClients = "SELECT * FROM clients ORDER BY client_name ASC";
						$runClients   = mysqli_query($conn,$queryClients);

						while($rowClients = mysqli_fetch_array($runClients)){
							$client_ida   = $rowClients['id'];
							$client_namea = $rowClients['client_name'];
							echo '<option value="'.$client_ida.'">'.$client_namea.'</option>';
						}

					?>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">ORDER NUMBER / ოქმის ნომერი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="order_number">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">ORDER DOCUMENT / ოქმის დოკუმენტი</label>
				<input type="file" class="form-control" id="exampleInputEmail1" name="image">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CARGO SENDER NAME / ტვირთის გამგზავნის დასახელება</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="cargo_sender">
			</div>		
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CARGO RECIEVER NAME / ტვირთის მიმღების დასახელება</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="cargo_reciever">
			</div>		
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">SENDER STATION / გამგზავნი სადგური</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="sender_station">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">RECIEVER STATION / მიმღები სადგური</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="reciever_station">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CARGO TYPE / ტვირთის სახეობა (ГНГ)</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="cargo_type">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">WAGON`S NUMBER / ვაგონების რაოდენობა</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="wagons_number">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CARGO WEIGHT / ტვირთის წონა</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="cargo_weight">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">FORWARDING SECTION / საექსპედიტორო მონაკვეთი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="forwarding_section">
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
		$order_owner  		= $_POST['order_owner'];
		$order_number  		= $_POST['order_number'];
		$cargo_sender 		= $_POST['cargo_sender'];
		$cargo_reciever 	= $_POST['cargo_reciever'];
		$sender_station 	= $_POST['sender_station'];
		$reciever_station 	= $_POST['reciever_station'];
		$cargo_type 	  	= $_POST['cargo_type'];
		$forwarding_section = $_POST['forwarding_section'];
		$cargo_weight       = $_POST['cargo_weight'];
		$wagons_number  	= $_POST['wagons_number'];

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
			    move_uploaded_file($file_tmp,"order_docs/".$fl_name);

			    $query = "INSERT INTO orders (order_owner,order_number,order_document,cargo_sender,cargo_reciever,sender_station,reciever_station,cargo_type,wagons_number,cargo_weight,forwarding_section,order_creator,order_create_date,order_status) 
			    	VALUES ('$order_owner','$order_number','$fl_name','$cargo_sender','$cargo_reciever','$sender_station','$reciever_station','$cargo_type','$wagons_number','$cargo_weight','$forwarding_section','$username','$now','0')";
				$run   = mysqli_query($conn,$query);

				header('location:'.$home_link);

			}else{
			    print_r($errors);
			}

		}

	}

?>