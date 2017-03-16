<?php
	ob_start();
	include 'db.php';
	$user_id = $_GET['user_id'];
	
	$query = "SELECT * FROM user WHERE id = '$user_id'";
	$run   = mysqli_query($conn,$query);

	while($row = mysqli_fetch_array($run)){
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
<body>
<div class="col-md-12" id="main_wrp">
	<div class="container">
		<div class="col-md-12">
		<img src="img/logo.png" id="logo">
	</div>
		<div class="col-md-12">
			<div class="page-header">
				<h1><i class="fa fa-users" aria-hidden="true"></i></span>USERS PAGE <small>მომმარებლების გვერდი</small></h1>
				<p id="big_p">
			    	<h5>YOU CAN REMOVE OR ADD NEW USER</h5>
			    </p>
				<p id="small_p">
			    	<h5>თქვენ შეგიძლიათ წაშალოთ ან დაამატოთ მომხმარებელი</h5>
			    </p>
			</div>
			<div class="col-md-12" id="menu_wrapper">
				<p>
					<h4><a href="<?php echo $home_link;?>"><span class="glyphicon glyphicon-home"></span> BACK TO THE MAIN PAGE / მთავარ გვერდზე დაბრუნება</a></a></h4>
				</p>
			</div>
			
			<div class="col-md-12" id="nwdpa">
				<i class="fa fa-users" aria-hidden="true"></i></span>  LIST OF USERS / მომხმარებლების სია
			</div>
			<div class="col-md-12">
				<table class="table table-bordered">
					<tr>
						<td>მომხარებლის სახელი</td>
						<td>სრული სახელი</td>
						<td>მომხმარებლის სტატუსი</td>
						<td id="cent_td">წაშლა</td>
					</tr>
					<?php

						$query = "SELECT * FROM user WHERE id != '$user_id' ORDER BY id DESC";
						$run   = mysqli_query($conn,$query);

						while($row = mysqli_fetch_array($run)){
							$id 	   = $row['id'];
							$username  = $row['username'];
							$full_name = $row['full_name'];
							$user_role = $row['user_role'];

							if($user_role === '1'){
								$role = 'ოპერატორი';
							}else{
								$role = 'მენეჯერი';
							}

							echo 
							'<tr>
								<td>'.$username.'</td>
								<td>'.$full_name.'</td>
								<td>'.$role.'</td>
								<td id="cent_td"><a href="del_user.php?user_id='.$user_id.'&user='.$id.'"><span class="glyphicon glyphicon-trash" id="dl"></span></a></td>
							</tr>';
						}
					?>
				</table>
			</div>	

			<div class="col-md-12" id="nwdpa">
				<i class="fa fa-user-plus" aria-hidden="true"></i>  CREATE NEW USER / ახალი მომხარებლის დამატება
			</div>

			<div class="col-md-12">
				<form action="" method="POST">
					<div class="form-group">
						<label>USERNAME / მომხმარებლის სახელი</label>
						<input type="text" name="username" class="form-control" placeholder="g.maisuradze" autocomplete="off" autosave="off">
					</div>
					<div class="form-group">
						<label>Password / პაროლი</label>
						<input type="password" name="password" class="form-control" placeholder="1324" autocomplete="off" autosave="off">
					</div>
					<div class="form-group">
						<label>FULL NAME / სრული სახელი</label>
						<input type="text" name="full_name" class="form-control" placeholder="გიორგი მაისურაძე" autocomplete="off" autosave="off">
					</div>
					<div class="form-group">
						<label>USER STATUS / მომხმარებლის სტატუსი</label>
						<select class="form-control" name="user_role">
							<option value="1">ოპერატორი</option>
							<option value="2">მენეჯერი</option>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-success" value="დადასტურება">
					</div>
				</form>
			</div>
		</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


<?php
	
	if(isset($_POST['submit'])){
		$username   = $_POST['username'];
		$password   = $_POST['password'];
		$full_name  = $_POST['full_name'];
		$user_role1 = $_POST['user_role'];

		$query1    = "INSERT INTO user (username,password1,password2,full_name,user_role) VALUES ('$username','$password','$password','$full_name','$user_role1')";
		$run1 	   = mysqli_query($conn,$query1);

		header( "refresh:0;" );
	}