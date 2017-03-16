<?php
	ob_start();
	
	include 'db.php';
	
	$user_id   = $_GET['user_id'];
	$client_id = $_GET['client_id'];
	$now = date("Y-m-d H:m:s");

	$home_link  = 'clients.php?user_id='.$user_id;


	$query2 = "SELECT * FROM clients WHERE id = '$client_id'";
	$run2   = mysqli_query($conn,$query2);
	
	while($row2 = mysqli_fetch_array($run2)){	
		$client_name 		 	= $row2['client_name'];
		$client_contact_name  	= $row2['client_contact_name'];
		$client_contact_phone 	= $row2['client_contact_phone'];
		$client_contact_email 	= $row2['client_contact_email'];
		$client_contact_address = $row2['client_contact_address'];
		$client_contact_web 	= $row2['client_contact_web']; 
		$client_file 			= $row2['client_file'];
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
			<h1><i class="fa fa-plus-circle" aria-hidden="true"></i> დამკვეთის პროფილი: <small><?php echo $client_name;?></small></h1>
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
<div class="col-md-12">
	<div class="col-md-12" id="docs">
		<h4>ინფორმაცია დამკვეთის შესახებ:</h4>
	</div>
	<div class="col-md-12">
		<table class="table table-hovered" id="tbli">
			<tr class="tbl_hdr">
				<td>დამკვეთის დასახელება</td>
				<td>საკონტაქტო პირი</td>
				<td>ელ-ფოსტა</td>
				<td>მისამართი</td>
				<td>ვებ-საიტი</td>
				<td>ხელშეკრულება</td>
			</tr>
			<tr>
				<td><?php echo $client_name;?></td>
				<td><?php echo $client_contact_name;?></td>
				<td><?php echo $client_contact_email;?></td>
				<td><?php echo $client_contact_address;?></td>
				<td><?php echo $client_contact_web;?></td>
				<td><a href="agreement/<?php echo $client_file;?>" id="ok"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> ხელშეკრულების გადმოწერა</a></td>
			</tr>
		</table>
	</div>

	<div class="col-md-12" id="docs">
		<h4>შეკვეთების ცხრილი:</h4>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered" id="tbli">
			<tr class="tbl_hdr">
				<td id="cent_td"><i class="fa fa-eye" aria-hidden="true"></i></td>
				<td>შემკვეთი</td>
				<td>ოქმის ნომერი</td>
				<td>ოქმ. დოკ.</td>
				<td>გამგზავნი</td>
				<td>მიმღები</td>
				<td>გამ. სადგური</td>
				<td>მიმ. სადგური</td>
				<td>ტვირთი (ГНГ)</td>
				<td>საექსპედიტორო მონაკვეთი</td>
				<td>შექმნის თარიღი</td>
				<td>დასრულების თარიღი</td>
				<td id="cent_td">სტატუსი</td>
				<td id="cent_td"><i class="fa fa-trash-o" aria-hidden="true"></i></td>
			</tr>
			<?php
				$query = "SELECT *,a.id as id, b.client_name as order_owner_name FROM orders a JOIN clients b on a.order_owner = b.id WHERE a.order_owner = '$client_id'";
				$run   = mysqli_query($conn,$query);

				while($row = mysqli_fetch_array($run)){
					$id 				= $row['id'];
					$order_owner  	  	= $row['order_owner'];
					$order_number 	  	= $row['order_number'];
					$cargo_sender     	= $row['cargo_sender'];
					$cargo_reciever   	= $row['cargo_reciever'];
					$sender_station   	= $row['sender_station'];
					$reciever_station 	= $row['reciever_station'];
					$cargo_type       	= $row['cargo_type'];
					$forwarding_section = $row['forwarding_section'];
					$order_owner_name   = $row['order_owner_name'];
					$order_document     = $row['order_document'];


					if($order_document == '' or is_null($order_document)){
						$order_document = '<span class="glyphicon glyphicon-remove" id="del"></span>';
					}else{
						$order_document = '<span class="glyphicon glyphicon-ok" id="ok"></span>';
					}
					
					$order_creator    	= $row['order_creator'];
					$order_create_date 	= $row['order_create_date'];


					$order_finisher    	= $row['order_finisher'];
					$order_finish_date  = $row['order_finish_date'];

					$status    			= $row['order_status'];

					if($status === '0'){
						$status = '<span class="st_active">აქტიური</span>';
					}else{
						$status = '<span class="st_finished">დასრულებული</span>';
					}

					echo 
					'<tr class="tbl_trs">
						<td id="cent_td"><a href="order_in.php?user_id='.$user_id.'&order_id='.$id.'"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
						<td>'.$order_owner_name.'</td>
						<td>'.$order_number.'</td>
						<td id="cent_td">'.$order_document.'</td>
						<td>'.$cargo_sender.'</td>
						<td>'.$cargo_reciever.'</td>
						<td>'.$sender_station.'</td>
						<td>'.$reciever_station.'</td>
						<td>'.$cargo_type.'</td>
						<td>'.$forwarding_section.'</td>
						<td>'.$order_create_date.'</td>
						<td>'.$order_finish_date.'</td>
						<td id="cent_td">'.$status.'</td>
						<td id="cent_td">
							<button type="button" data-toggle="modal" data-target="#myModal'.$id.'">
							  <span class="glyphicon glyphicon-trash" id="dl"></span>
							</button>
							<div class="modal fade" id="myModal'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">შეკვეთის წაშლა</h4>
							      </div>
							      <div class="modal-body">
									<p>
										დარწმუნებული ხართ რომ გინდათ წაშალოთ შეკვეთა ნომრით: <span id="del">'.$id.'</span> ?
										შეგახსენებთ რომ გატარებასთან ერთად წაიშლება ყველა მასთან დაგავშირებული ინფორმაცია.
									</p>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal" id="butia">ოპერაციის გაუქმება</button>
							        <button type="button" class="btn btn-danger" id="butia"><a href="del_order.php?user_id='.$user_id.'&order_id='.$id.'"><span class="glyphicon glyphicon-trash"></span> წაშლა</a></button>
							      </div>
							    </div>
							  </div>
							</div>
						</td>
					</tr>';
					
					$queryCodes = "SELECT a.id as idz,a.code_id as cid,a.code as code,b.code_name as codname,b.country_name as cntryname FROM order_codes a 
								JOIN codes b on a.code_id = b.id
								WHERE a.order_id = '$id'";
					$runCodes   = mysqli_query($conn,$queryCodes);

					if(mysqli_num_rows($runCodes)>= 1){
						echo '<tr>
							<td colspan="3"><span id="del">გადაზიდვის კოდები:</span></td>';
						while($rowCodes = mysqli_fetch_array($runCodes)){
							$code_name = $rowCodes['codname'];
							$code = $rowCodes['code'];
							
							echo '<td id="cent_td">'.$code_name. ' -  <span id="del">' .$code.'</span></td>';
							
						}
						echo '</tr>';
					}else{
						echo '<tr>
							<td colspan="15"><span id="del">გადაზიდვის კოდები არ არის მითითებული</td></td>
						</tr>';
					}
				}

			?>
		</table>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
