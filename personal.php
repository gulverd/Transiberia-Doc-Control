<?php
	ob_start();
	include 'db.php';
	$user_id = $_GET['user_id'];
	
	$query = "SELECT * FROM user WHERE id = '$user_id'";
	$run   = mysqli_query($conn,$query);

	while($row = mysqli_fetch_array($run)){
		$id 	  	= $row['id'];
		$username 	= $row['username'];
		$full_name 	= $row['full_name'];
		$user_role  = $row['user_role'];

		if($user_role === '1'){
			$role 		= 'ოპერატორი';
			$home_link  = 'dashboard.php?user_id='.$user_id;
		}elseif($user_role === '2'){
			$role = 'მენეჯერი';
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
			<h1><span class="glyphicon glyphicon-user"></span> PERSONAL INFORMATION <small>პერსონალური ინფორმაცია</small></h1>
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
	
		<form action="" method="POST">
				<div class="form-group">
				    <label for="exampleInputEmail1" id="label">USERNAME / მომხარებლის სახელი</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" name="username" value="<?php echo $username?>" readonly>
				</div>				 
				<div class="form-group">
				    <label for="exampleInputEmail1" id="label">FULL NAME / სრული სახელი</label>
				    <input type="text" class="form-control" id="exampleInputEmail1"  name="full_name" value="<?php echo $full_name?>" placeholder="მაგ: გიორგი მაისურაძე">
				</div>

				<div class="form-group">
				    <label for="exampleInputEmail1" id="label">USER STATUS / მომხმარებლის სტატუსი</label>
				    <input type="text" class="form-control" id="exampleInputEmail1"  name="user_role" value="<?php echo $role?>" readonly>
				</div>

				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary" id="but"> SUBMIT / დადასტურება</button> 
				</div>
		</form>
	</div>
	<div class="col-md-12" id="passs">
		<a href="password.php?user_id=<?php echo $user_id;?>"><span class="glyphicon glyphicon-lock"></span> CHANGE PASSWORD / პაროლის შეცვლა</a>
	</div>	
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


<?php 

	if(isset($_POST['submit'])){
		$fl_name = $_POST['full_name'];

		$query2 = "UPDATE user SET full_name = '$fl_name' WHERE id = '$user_id'";
		$run2   = mysqli_query($conn,$query2);
			
			echo "<script> 
				window.alert('მონაცემები შეცვლილია!');
		 	  </script>"; 

		 	header( "refresh:0;" );
	}

?>