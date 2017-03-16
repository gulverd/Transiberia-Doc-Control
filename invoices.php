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

		$home_link  = 'order_in.php?user_id='.$user_id.'&order_id='.$order_id;

	}

	$queryStatus = "SELECT * FROM orders WHERE id = '$order_id'";
	$runStatus   = mysqli_query($conn,$queryStatus);

	while($rowStatus = mysqli_fetch_array($runStatus)){
		$ord_status = $rowStatus['order_status'];
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
			<h1><i class="fa fa-plus-circle" aria-hidden="true"></i> INVOICES <small>ინვოისები</small></h1>
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
</div>



<div class="container">
	<div class="col-md-12 ">
		<div class="col-md-12" id="docs">
			<h4><i class="fa fa-list" aria-hidden="true"></i> ინვოისები</h4>
		</div>
		<div class="col-md-12">
			<table class="table table-bordered" id="tbli">
				<tr id="tbl_hdr">
					<td id="cent_td">ინვოისის ნომერი</td>
					<td id="cent_td">ინვოისის დოკუმენტი</td>
					<td id="cent_td" class="delika">წაშლა</td>
				</tr>

				<?php
					$query2 = "SELECT * FROM invoices WHERE order_id = '$order_id'";
					$run2   = mysqli_query($conn,$query2);

					if(mysqli_num_rows($run2) >= 1){
						while($row2 = mysqli_fetch_array($run2)){
							$id 		  		 = $row2['id'];
							$invoice_number 	 = $row2['invoice_code'];
							$invoice_file   	 = $row2['invoice_file'];
							$invoice_down_button = '<a href="invoices/'.$invoice_file.'" id="ok" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> ფაილის ჩამოტვირთვა</a>'; 
							$del_button 		 = '<a href="del_invoice.php?user_id='.$user_id.'&order_id='.$order_id.'&invoice_id='.$id.'"><i class="fa fa-trash-o" aria-hidden="true" id="del"></i></a>';
 
							echo 
							'
							<tr>
							   <td id="cent_td">'.$invoice_number.'</td>
							   <td id="cent_td">'.$invoice_down_button.'</td>
							   <td id="cent_td" class="delika">'.$del_button.'</td>
							</tr>
							';
						}
					}else{
						echo '<tr>
								<td colspan="3" id="colsp">ამ დროისათვის არ არის ინვოისები ატვირთული</td>
							</tr>';
					}

					

				?>
			</table>
		</div>
	</div>
	<div class="col-md-12 delika">
		<div class="col-md-12" id="docs">
			<h4><i class="fa fa-plus-circle" aria-hidden="true"></i> ინვოისის დამატება</h4>
		</div>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="col-md-12">
				<div class="form-group">
					<label id="label">INVOICE NUMBER / ინვოისის ნომერი</label>
					<input type="text" name="invoice_code" class="form-control">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1" id="label">INVOICE DOCUMENT / ინვოისის დოკუმენტი</label>
					<input type="file" class="form-control" id="exampleInputEmail1" name="image">
				</div>
				<div class="form-group" id="buttonsa">
					<button type="submit" name="submit" class="btn btn-primary" id="but"> SUBMIT / დადასტურება</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

<script type="text/javascript">
	var a = '<?php echo $ord_status;?>';
	if(a === '1'){
		$('.delika').css('display','none');
	}
</script>


<?php 

	if(isset($_POST['submit'])){
		$invoice_code = $_POST['invoice_code'];

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
			    move_uploaded_file($file_tmp,"invoices/".$fl_name);

				$query3 = "INSERT INTO invoices (invoice_code,invoice_file,order_id) VALUES ('$invoice_code', '$fl_name', '$order_id')";
				$run3   = mysqli_query($conn,$query3);

				header( "refresh:0;" );

			}else{
			    print_r($errors);
			}

		}

	}

?>