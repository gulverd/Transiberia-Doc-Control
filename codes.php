<?php
	ob_start();
	include 'db.php';
	$user_id = $_GET['user_id'];
	$now = date("Y-m-d H:m:s");
	
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
<div class="container">
	<div class="col-md-12">
		<img src="img/logo.png" id="logo">
	</div>
	<div class="col-md-12">
		<div class="page-header">
			<h1><i class="fa fa-plus-circle" aria-hidden="true"></i> LIST OF TRANSFER CODES <small>გადაზიდვის კოდების სია</small></h1>
		</div>	
		<div class="col-md-12" id="menu_wrapper">
			<p>
				<h4><a href="<?php echo $home_link;?>"><span class="glyphicon glyphicon-home"></span> BACK TO THE MAIN PAGE / მთავარ გვერდზე დაბრუნება</a></h4>
			</p>
		</div>
	</div>

	<div class="col-md-12" id="menu_wrapper">
		<div class="col-md-12" id="docs">
			<h4>გადაზიდვის კოდების ცხრილი</h4>
		</div>
		<div class="col-md-12">
			<table class="table table-bordered">
				<tr class="tbl_hdr">
					<td id="cent_td">კოდის დასახელება</td>
					<td id="cent_td">დასახელება</td>
					<td id="cent_td">წაშლა</td>
				</tr>
				<?php
					$query2 = "SELECT * FROM codes";
					$run2   = mysqli_query($conn,$query2);

					while($row2 = mysqli_fetch_array($run2)){
						$code_id   		= $row2['id'];
						$code_name 		= $row2['code_name'];
						$country_namea 	= $row2['country_name'];

						echo '<tr>
								<td id="cent_td">'.$code_name.'</td>
								<td id="cent_td">'.$country_namea.'</td>
								<td id="cent_td"><a href="del_codes.php?user_id='.$user_id.'&code_id='.$code_id.'"><span class="glyphicon glyphicon-trash" id="dl"></span></a></td>
							</tr>';
					}

				?>
			</table>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12" id="docs">
			<h4>ახალი კოდის დამატება</h4>
		</div>
		<div class="col-md-12">
			<form action="" method="post">
				<div class="form-group">
					<label id="label">TRANSFER CODE NAME / გადაზიდვის კოდის დასახელება</label>
					<input type="text" name="transfer_code" class="form-control">
				</div>
				<div class="form-group">
					<label id="label">NAME / დასახელება</label>
					<input type="text" name="country_name" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" name="submit" class="btn btn-primary" id="but" value="SUBMIT / დადასტურება">
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
		$transfer_code = $_POST['transfer_code'];
		$country_name  = $_POST['country_name'];

		$query3 = "INSERT INTO codes (code_name,country_name) VALUES ('$transfer_code','$country_name')";
		$run3   = mysqli_query($conn,$query3);

		header( "refresh:0;" );
	}
?>