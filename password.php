<?php
	ob_start();
	include 'db.php';
	$user_id = $_GET['user_id'];
	
	$query = "SELECT * FROM user WHERE id = '$user_id'";
	$run   = mysqli_query($conn,$query);

	while($row = mysqli_fetch_array($run)){
		$user_role 	  = $row['user_role'];
		$old_pass     = $row['password1'];

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
			<h1><span class="glyphicon glyphicon-user"></span> CHANGE PASSWORD <small>პაროლის შეცვლა</small></h1>
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
				<label for="exampleInputEmail1" id="login_label">PLEASE FILL IN CURRENT PASSWORD / შეიყვანეთ ახლანდელი პაროლი</label>
				<input type="password" class="form-control" id="exampleInputEmail1" name="old_pass" placeholder="Old Password">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="login_label">PLEASE FILL IN NEW PASSWORD / შეიყვანეთ ახალი პაროლი</label>
				<input type="password" class="form-control" id="exampleInputEmail1" name="password1" placeholder="New Password">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="login_label">PLEASE RE-TYPE NEW PASSWORD / გაიმეორეთ ახალი პაროლი</label>
				<input type="password" class="form-control" id="exampleInputEmail1" name="password2" placeholder="Repeat Password">
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
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$oldd_pass = $_POST['old_pass'];

		if($oldd_pass == $old_pass AND $password1 == $password2){
			
			$query2 = "UPDATE user SET password1 = '$password1', password2 = '$password2' WHERE id = '$user_id'";
			$run2   = mysqli_query($conn,$query2);

			echo "<script> 
				window.alert('პაროლი შეცვლილია!');
		 	  </script>"; 

		 	header('location:'.$home_link);

		}else{
			echo '<div class="col-md-12">
				<div class="alert alert-danger" role="alert">არასწორად იქნა შეყვანილი ძველი პაროლი ან ახალი პაროლები არ ემთხვევა ერთმანეთს!</div>
			</div>';
		}
	}

?>