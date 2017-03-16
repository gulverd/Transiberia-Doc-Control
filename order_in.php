<?php
	ob_start();
	
	include 'db.php';
	
	$user_id  = $_GET['user_id'];
	$order_id = $_GET['order_id'];

	$now = date("Y-m-d H:m:s");
	
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


	$query2 = "SELECT * FROM orders WHERE id='$order_id'";
	$run2   = mysqli_query($conn,$query2);

	while($row2 = mysqli_fetch_array($run2)){
		$id 				= $row2['id'];
		$order_owner  		= $row2['order_owner'];
		$order_number  		= $row2['order_number'];
		$cargo_sender 		= $row2['cargo_sender'];
		$cargo_reciever 	= $row2['cargo_reciever'];
		$sender_station 	= $row2['sender_station'];
		$reciever_station 	= $row2['reciever_station'];
		$cargo_type 	  	= $row2['cargo_type'];
		$order_statusa 		= $row2['order_status'];
		$forwarding_section = $row2['forwarding_section'];
		$order_doc 			= $row2['order_document'];

	if($order_statusa == '0'){
			$order_status = '<span class="st_active">აქტიური</span>';
		}else{
			$order_status = '<span class="st_finished">დასრულებული</span>';
		}

	}
	if($order_doc == '' or is_null($order_doc)){
		$down_order_doc = '<a href="upload_order_doc.php?user_id='.$user_id.'&order_id='.$order_id.'" id="link"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> დოკუმენტის ატვირთვა</a>';
		$doc_del_link   = '';
	}else{
		$down_order_doc = '<a href="order_docs/'.$order_doc.'" id="ok" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> ფაილის ჩამოტვირთვა</a>';
		$doc_del_link   = '<a href="del_order_doc.php?user_id='.$user_id.'&order_id='.$order_id.'"><i class="fa fa-trash-o" aria-hidden="true"></i> წაშლა</a>';
	}


	$queryClients = "SELECT * FROM clients WHERE id = '$order_owner'";
	$runClients   = mysqli_query($conn,$queryClients);

	while($rowClients = mysqli_fetch_array($runClients)){
		$client_namea = $rowClients['client_name'];					
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
		<div class="col-md-6" id="docs">
			<h3>შეკვეთის სტატუსი: <?php echo $order_status;?></h3>
		</div>
		<div class="col-md-6" id="docs">
			<h3>უნიკალური კოდი: <span id="del"> <?php echo $id;?> </span></h3>
		</div>
	</div>
</div>
	<div class="col-md-12">
		<div class="col-md-12" id="docs">
			<h4>დოკუმენტები:</h4>
		</div>
		<div class="col-md-3" id="docs">
			<table class="table table bordered">
				<tr class="tra">
					<td>ოქმის დოკუმენტი:</td>
					<td><?php echo $down_order_doc;?></td>
					<td class="tda" id="nobs"><?php echo $doc_del_link;?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-3" id="docs">
			<table class="table table bordered">
				<tr class="tra">
					<td><a href="invoices.php?user_id=<?php echo $user_id;?>&order_id=<?php echo $order_id;?>"  id="link"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> ინვოისები - დათვალიერება / დამატება</a>
					(
					<?php
							$queryInvoicesCount = "SELECT COUNT(*) as countInvoice FROM invoices WHERE order_id = '$order_id'";
							$runInvoicesCount   = mysqli_query($conn,$queryInvoicesCount);

							while($rowInvoicesCount = mysqli_fetch_array($runInvoicesCount)){
								$countInvoice = $rowInvoicesCount['countInvoice'];
								echo $countInvoice;
							}
						?>
						)
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-3" id="docs">
			<table class="table table bordered">
				<tr class="tra">
					<td><a href="bills.php?user_id=<?php echo $user_id;?>&order_id=<?php echo $order_id;?>"  id="link"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> ზედდებულები - დათვალიერება / დამატება</a>
					(
					<?php
							$queryBillsCount = "SELECT COUNT(*) as countBills FROM bills WHERE order_id = '$order_id'";
							$runBillssCount   = mysqli_query($conn,$queryBillsCount);

							while($rowBillsCount = mysqli_fetch_array($runBillssCount)){
								$countBills = $rowBillsCount['countBills'];
								echo $countBills;
							}
						?>
						)
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-3" id="docs">
			<table class="table table bordered">
				<tr class="tra">
					<td>
						<a href="order_codes.php?user_id=<?php echo $user_id;?>&order_id=<?php echo $order_id;?>"  id="link">გადაზიდვის კოდები / დათვალიერება / დამატება</a>
						(
						<?php
							$queryCodesCount = "SELECT COUNT(*) as countCodes FROM order_codes WHERE order_id = '$order_id'";
							$runCodesCount   = mysqli_query($conn,$queryCodesCount);

							while($rowCodesCount = mysqli_fetch_array($runCodesCount)){
								$countCodes = $rowCodesCount['countCodes'];
								echo $countCodes;
							}
						?>
						)
					</td>
				</tr>
			</table>
		</div>
	</div>

<div class="container">
	<div class="col-md-12">
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">ORDER OWNER NAME / შემკვეთის სახელი</label>
				<input type="text" class="form-control" name="order_owner" value="<?php echo $client_namea;?>" readonly>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">ORDER NUMBER / ოქმის ნომერი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="order_number" value="<?php echo $order_number;?>" readonly>
			</div>		
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CARGO SENDER NAME / ტვირთის გამგზავნის სახელი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="cargo_sender" value="<?php echo $cargo_sender;?>">
			</div>		
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CARGO RECIEVER NAME / ტვირთის მიმღების სახელი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="cargo_reciever" value="<?php echo $cargo_reciever;?>">
			</div>		
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">SENDER STATION / გამგზავნი სადგური</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="sender_station" value="<?php echo $sender_station;?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">RECIEVER STATION / მიმღები სადგური</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="reciever_station" value="<?php echo $reciever_station;?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">CARGO TYPE / ტვირთის სახეობა (ГНГ)</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="cargo_type" value="<?php echo $cargo_type;?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1" id="label">FORWARDING SECTION / საექსპედიტორო მონაკვეთი</label>
				<input type="text" class="form-control" id="exampleInputEmail1" name="forwarding_section" value="<?php echo $forwarding_section;?>">
			</div>										 
			<div class="form-group" id="buttonsa">
				<div class="col-md-6">
					<button type="submit" name="submit" class="btn btn-primary" id="but"> CHANGE VALUES / მონაცემების ცვლილება</button>
				</div>
				<div class="col-md-6">
					<button type="submit" name="complete" class="btn btn-success" id="but"> COMPLETE ORDER / შეკვეთის დასრულება</button>
				</div> 
			</div>
			<div class="form-group" id="deleta">
				<button type="submit" name="delete" class="btn btn-danger" id="but"> DELETE ORDER / შეკვეთის გაუქმება</button>
			</div>
		</form>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

<script type="text/javascript">
	var a = '<?php echo $order_statusa;?>';
	if(a === '1'){
		$('.form-control').prop('readonly', true);
		$('#buttonsa').css('display','none');
		$('.tda').css('display','none');
	}else{
		$('#deleta').css('display','none');
	}
</script>

<?php 

	if(isset($_POST['submit'])){
		$order_owner1  		 = $_POST['order_owner'];
		$order_number1  	 = $_POST['order_number'];
		$cargo_sender1 		 = $_POST['cargo_sender'];
		$cargo_reciever1 	 = $_POST['cargo_reciever'];
		$sender_station1 	 = $_POST['sender_station'];
		$reciever_station1 	 = $_POST['reciever_station'];
		$cargo_type1 	  	 = $_POST['cargo_type'];
		$forwarding_section1 = $_POST['forwarding_section'];

		$query3 = "UPDATE orders SET order_owner = '$order_owner1', order_number = '$order_number1', cargo_sender = '$cargo_sender1', cargo_reciever = '$cargo_reciever1', sender_station = '$sender_station1', reciever_station = '$reciever_station1', cargo_type = '$cargo_type1',forwarding_section = '$forwarding_section1' WHERE id = '$order_id'";
		$run3   = mysqli_query($conn,$query3);

		header( "refresh:0;" );

	}

	if(isset($_POST['complete'])){
		$query4 = "UPDATE orders SET order_finisher = '$username',  order_finish_date = '$now', order_status = '1' WHERE id = '$order_id'";
		$run4   = mysqli_query($conn,$query4);

		header('location: orders.php?user_id='.$user_id);
	}

	if(isset($_POST['delete'])){
		$query5 = "DELETE FROM orders WHERE id = '$order_id'";
		$run5   = mysqli_query($conn,$query5);

		header('location: orders.php?user_id='.$user_id);
	}

?>