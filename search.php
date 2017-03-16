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
		$user_role  = $row['user_role'];

		if($user_role === '1'){
			$home_link  = 'dashboard.php?user_id='.$user_id;
		}elseif($user_role === '2'){
			$home_link  = 'dashboard_dir.php?user_id='.$user_id;
		}
	}
?>
<div class="col-md-12" id="main_wrp">
	<div class="container">
		<div class="col-md-12">
		<img src="img/logo.png" id="logo">
	</div>
		<div class="col-md-12">

			<div class="page-header">
				<h1><i class="fa fa-search" aria-hidden="true"></i> გაფართოებული ძიება</h1>
				<p id="big_p">
			    	<h5>PLEASE CHOOSE SUITABLE MODUL</h5>
			    </p>
				<p id="small_p">
			    	<h5>გთხოვთ აირჩიოთ სასურველი მოდული</h5>
			    </p>
			</div>
					<div class="col-md-12" id="menu_wrapper">
			<p>
				<h4><a href="<?php echo $home_link;?>"><span class="glyphicon glyphicon-home"></span> BACK TO THE MAIN PAGE / მთავარ გვერდზე დაბრუნება</a></h4>
			</p>
		</div>

			<div class="col-md-12" id="search_btns_wrp">
				<a href="search_by_client.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-default btn-lg btn-block" id="tmppa"><i class="fa fa-search-plus" aria-hidden="true"></i> SEARCH BY CLIENT NAME / ძიება დამკვეთის მიხედვით</button></a>
				<a href="search_by_order_number.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-default btn-lg btn-block" id="tmppa"><i class="fa fa-search-plus" aria-hidden="true"></i> SEARCH BY ORDER NUMBER / ძიება ოქმის ნომრის მიხედვით</button></a>
				<a href="search_by_invoice.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-default btn-lg btn-block" id="tmppa"><i class="fa fa-search-plus" aria-hidden="true"></i> SEARCH BY INVOICE NUMBER / ძიება ინვოისის ნომრის მიხედვით</button></a>
				<a href="search_by_bill.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-default btn-lg btn-block" id="tmppa"><i class="fa fa-search-plus" aria-hidden="true"></i> SEARCH BY WAGON NUMBER OR BILL NUMBER / ვაგონის ნომრის ან ზედდებულის მიხედვით</button></a>
				<a href="search_by_code.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-default btn-lg btn-block" id="tmppa"><i class="fa fa-search-plus" aria-hidden="true"></i> SEARCH BY TRANSFER CODE / ძიება გადაზიდვის კოდის მიხედვით</button></a>
			</div>	
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
