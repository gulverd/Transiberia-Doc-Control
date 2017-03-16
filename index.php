<?php ob_start();?>
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
<body>
<?php
	include 'db.php';
?>
<div class="col-md-12" id="main_wrp">
	<div class="container">
		<div class="col-md-12">
		<img src="img/logo.png" id="logo">
	</div>
		<div class="col-md-12">

			<div class="page-header">
				<h1><span class="glyphicon glyphicon-user"></span> AUTHORIZATION <small>ავტორიზაცია</small></h1>
				<p id="big_p">
			    	<h5>PLEASE FILL IN WITH YOUR USERNAME, PASSWORD AND CLICK THE LOGIN BUTTON.</h5>
			    </p>
				<p id="small_p">
			    	<h5>გთხოვთ შეიყვანოთ მომხმარებლის სახელი, პაროლი და დააჭირეთ ღილაკს "შესვლა".</h5>
			    </p>
			</div>

		</div>

		<div class="col-md-12">
			<div class="panel panel-default" id="login_form">
				<div class="panel-heading" id="login_panel_head">AUTHORIZATION / ავტორიზაცია </div>
					<div class="panel-body">
					   	<form action="" method="POST" class="form-horizontal">
					   		<div class="input-group">
					   			<label for="exampleInputEmail1" id="login_label">USERNAME / მომხარებლის სახელი</label>
					   		</div>
							<div class="input-group" id="space_login">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="text" class="form-control" id="exampleInputEmail1"  name="username" placeholder="Ex: G.Maisuradze">
							</div>
							<div class="input-group">
								<label for="exampleInputEmail1" id="login_label">PASSWORD / პაროლი</label>
							</div>
							<div class="input-group" id="space_login">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="password" class="form-control" id="exampleInputEmail1"  name="password" placeholder="Ex: 1324">
							</div>
							<div class="input-group">
								<button type="submit" name="submit" class="btn btn-primary pull-right" id="but"><i class="glyphicon glyphicon-log-in"></i> LOG IN / შესვლა</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


<?php
	if(isset($_POST['submit'])){

		$username = $_POST['username'];
		$password = $_POST['password'];

		$query    = "SELECT * FROM user WHERE username = '$username' and password1 = '$password'";
		$run	  = mysqli_query($conn,$query);

		while($row = mysqli_fetch_array($run)){
			$id 	   = $row['id'];
			$user_role = $row['user_role'];
		}
		
		if(mysqli_num_rows($run)>=1){
			if($user_role === '1'){
				header("Location:dashboard.php?user_id=".$id);
			}elseif($user_role === '2'){
				header("Location:dashboard_dir.php?user_id=".$id);
			}
		}else{
			echo '<div class="col-md-12">
					<div class="alert alert-danger" role="alert">არასწორი მოხმარებლის სახელი ან პაროლი</div>
				 </div>';
		}
	}

?>
