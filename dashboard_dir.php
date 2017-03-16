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
	$user_id = $_GET['user_id'];
	
	$query = "SELECT * FROM user WHERE id = '$user_id'";
	$run   = mysqli_query($conn,$query);

	while($row = mysqli_fetch_array($run)){
		$full_name = $row['full_name'];
	}

?>
<div class="col-md-12" id="main_wrp">

	<div class="container">
		<div class="col-md-12">
		<img src="img/logo.png" id="logo">
	</div>
		<div class="col-md-12">

			<div class="page-header">
				<h1><span class="glyphicon glyphicon-user"></span>მოგესალმები,  <small><?php echo $full_name;?></small></h1>
				<p id="big_p">
			    	<h5>PLEASE CHOOSE SUITABLE MODUL</h5>
			    </p>
				<p id="small_p">
			    	<h5>გთხოვთ აირჩიოთ სასურველი მოდული</h5>
			    </p>
			</div>
			<div class="col-md-12">
			<a href="add_order.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-primary btn-lg btn-block" id="exact"><i class="fa fa-plus-square" aria-hidden="true"></i> CREATE ORDER / შეკვეთის დამატება </button></a>
			<a href="orders.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-primary btn-lg btn-block" id="whs"><i class="fa fa-list" aria-hidden="true"></i> ORDERS LIST / შეკვეთების სია </button></a>
			<a href="search.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-danger btn-lg btn-block" id="deps"><i class="fa fa-search" aria-hidden="true"></i> ADVANCED SEARCH / გაფართოებული ძიება</button></a>
			<a href="clients.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-primary btn-lg btn-block" id="admins"><i class="fa fa-list" aria-hidden="true"></i> CLIENTS LIST / დამკვეთების სია </button></a>
			<a href="codes.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-primary btn-lg btn-block" id="cancel"><i class="fa fa-list" aria-hidden="true"></i> TRANSFER CODES LIST / გადაზიდვის კოდების სია </button></a>
			<a href="users.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-danger btn-lg btn-block" id="tmpp"><i class="fa fa-users" aria-hidden="true"></i> USERS / მომხარებლები </button></a>
			<a href="personal.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-default btn-lg btn-block" id="prsnl"><span class="glyphicon glyphicon-user"></span> PERSONAL INFORMATION / პირადი ინფორმაცია</button></a>
		</div>	
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
