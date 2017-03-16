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
			<h1><i class="fa fa-plus-circle" aria-hidden="true"></i> TRANSFER CODES <small>გადაზიდვის კოდები</small></h1>
			<p id="big_p">
			    <h5>PLEASE FILL IN ALL FIELD CORECTLY</h5>
			   </p>
			<p id="small_p">
			    <h5>გთხოვთ სწორად შეავსოთ ყველა ველი</h5>
			</p>
		</div>	
		<div class="col-md-12" id="menu_wrapper">
			<p>
				<h4><a href="<?php echo $home_link;?>"><span class="glyphicon glyphicon-home"></span> BACK TO THE PREVIOUS PAGE / წინა გვერდზე დაბრუნება</a></a></h4>
			</p>
		</div>
	</div>
</div>



<div class="container">
	<div class="col-md-12 ">
		<div class="col-md-12" id="docs">
			<h4><i class="fa fa-list" aria-hidden="true"></i> გადაზიდვის კოდები</h4>
		</div>
		<div class="col-md-12">
			<table class="table table-bordered" id="tbli">
				<tr id="tbl_hdr">
					<td id="cent_td">გადაზივის კოდის დასახელება</td>
					<td id="cent_td">ქვეყანა</td>
					<td id="cent_td">გადაზიდვის კოდი</td>
					<td id="cent_td" class="delika">წაშლა</td>
				</tr>

				<?php
					$query2 = "SELECT a.id as idz,a.code_id as cid,a.code as code,b.code_name as codname,b.country_name as cntryname FROM order_codes a 
								JOIN codes b on a.code_id = b.id
								WHERE a.order_id = '$order_id'";
					$run2   = mysqli_query($conn,$query2);

					if(mysqli_num_rows($run2) >= 1){
						while($row2 = mysqli_fetch_array($run2)){
							$id 		  		 = $row2['idz'];
							$code           	 = $row2['code'];
							$c_id                = $row2['cid'];
							$codname 			 = $row2['codname'];
							$cntryname 			 = $row2['cntryname'];
							$del_button 		 = '<a href="del_order_code.php?user_id='.$user_id.'&order_id='.$order_id.'&code_id='.$id.'"><i class="fa fa-trash-o" aria-hidden="true" id="del"></i></a>';
 
							echo 
							'
							<tr>
							   <td id="cent_td">'.$codname.'</td>
							   <td id="cent_td">'.$cntryname.'</td>
							   <td id="cent_td">'.$code.'</td>
							   <td id="cent_td" class="delika">'.$del_button.'</td>
							</tr>
							';
						}
					}else{
						echo '<tr>
								<td colspan="4" id="colsp">ამ დროისათვის არ არის მითითებული გადაზიდვის კოდი</td>
							</tr>';
					}

					

				?>
			</table>
		</div>
	</div>
	<div class="col-md-12 delika">
		<div class="col-md-12" id="docs">
			<h4><i class="fa fa-plus-circle" aria-hidden="true"></i> შეკვეთაზე გადაზიდვის კოდის დამატება</h4>
		</div>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="col-md-12">
				<div class="form-group">
					<label id="label">TRANSFER CODE AND COUNTRY NAME / გადაზიდვის კოდის და ქვეყნის დასახელება</label>
					<select class="form-control" name="code_name">
						<?php 	
							$queryCodes = "SELECT * FROM codes";
							$runCodes   = mysqli_query($conn,$queryCodes);

							while($rowCodes = mysqli_fetch_array($runCodes)){
								$code_ida     = $rowCodes['id'];
								$code_name    = $rowCodes['code_name'];
								$country_name = $rowCodes['country_name']; 
								echo '<option value="'.$code_ida.'">'.$code_name .' - '. $country_name .'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1" id="label">CODE NUMBER / კოდის ნომერი</label>
					<input type="text" name="code_number" class="form-control">
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
		$c_name   = $_POST['code_name'];
		$c_number = $_POST['code_number']; 

	
		$query3 = "INSERT INTO order_codes (code_id,order_id,code) VALUES ('$c_name','$order_id','$c_number')";
		$run3   = mysqli_query($conn,$query3);

		header( "refresh:0;" );
	}

?>