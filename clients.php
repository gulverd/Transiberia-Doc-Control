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
			<h1><i class="fa fa-plus-circle" aria-hidden="true"></i> LIST OF CLIENTS <small>შემკვეთების სია</small></h1>
		</div>	
		<div class="col-md-12" id="menu_wrapper">
			<p>
				<h4><a href="<?php echo $home_link;?>"><span class="glyphicon glyphicon-home"></span> BACK TO THE MAIN PAGE / მთავარ გვერდზე დაბრუნება</a></h4>
			</p>
		</div>
	</div>
</div>
	<div class="col-md-12" id="menu_wrapper">
		<h4><a href="add_new_client.php?user_id=<?php echo $user_id;?>"><span class="glyphicon glyphicon-plus"></span> ADD NEW CLIENT / ახალი შემკვეთის დამატება </a></h4>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered" id="tbli">
			<tr class="tbl_hdr">
				<td id="cent_td"><i class="fa fa-eye" aria-hidden="true"></i></td>
				<td>შემკვეთის დასახელება</td>
				<td>საკონტაქტო პირი</td>
				<td>საკონტაქტო ნომერი</td>
				<td>E-MAIL</td>
				<td>მისამართი</td>
				<td id="cent_td">WEB</td>
				<td id="cent_td">ხელშეშეკრულება</td>
				<td id="cent_td">რედაქტირება</td>
				<td id="cent_td">წაშლა</td>
			</tr>
			<?php
				$query2 = "SELECT * FROM clients ORDER BY client_name ASC";
				$run2   = mysqli_query($conn,$query2);

				while($row = mysqli_fetch_array($run2)){
					$id 				 	= $row['id'];
					$client_name 	     	= $row['client_name'];
					$client_contact_name 	= $row['client_contact_name'];
					$client_contact_phone	= $row['client_contact_phone'];
					$client_contact_email	= $row['client_contact_email'];
					$client_contact_address = $row['client_contact_address'];
					$client_contact_web 	= $row['client_contact_web'];
					$client_file			= $row['client_file'];

					if($client_file == '' or is_null($client_file)){
						$client_file = '<span class="glyphicon glyphicon-remove" id="del"></span>';
					}else{
						$client_file = '<span class="glyphicon glyphicon-ok" id="ok"></span>';
					}

					echo 
						'<tr class="tbl_trs">
							<td id="cent_td"><a href="client_in.php?user_id='.$user_id.'&client_id='.$id.'"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
							<td>'.$client_name.'</td>
							<td>'.$client_contact_name.'</td>
							<td>'.$client_contact_phone.'</td>
							<td>'.$client_contact_email.'</td>
							<td>'.$client_contact_address.'</td>
							<td id="cent_td">'.$client_contact_web.'</td>
							<td id="cent_td">'.$client_file.'</td>
							<td id="cent_td"><a href="edit_client.php?user_id='.$user_id.'&client_id='.$id.'" id="edit"><i class="fa fa-pencil aria-hidden="true"></i></a></td>
							<td id="cent_td">
							<button type="button" data-toggle="modal" data-target="#myModal'.$id.'">
							  <span class="glyphicon glyphicon-trash" id="dl"></span>
							</button>
							<div class="modal fade" id="myModal'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">დამკვეთის წაშლა</h4>
							      </div>
							      <div class="modal-body">
									<p>
										დარწმუნებული ხართ რომ გინდათ დამკვეთის წაშლა სახელით:  </br><span id="del">'.$client_name.'</span> ?
										</br> შეგახსენებთ რომ დამკვეთთან ერთად წაიშლება ყველა მასთან დაგავშირებული ინფორმაცია.
									</p>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal" id="butia">ოპერაციის გაუქმება</button>
							        <button type="button" class="btn btn-danger" id="butia"><a href="del_client.php?user_id='.$user_id.'&client_id='.$id.'" id="del"><span class="glyphicon glyphicon-trash"></span> წაშლა</a></button>
							      </div>
							    </div>
							  </div>
							</div>
						</td>
						</tr>';
				}

			?>
		</table>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>