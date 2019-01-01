<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
	$username = ($this->session->userdata['logged_in']['username']);
	$email = ($this->session->userdata['logged_in']['email']);
} else {
	// print_r($_SESSION);
	//header("location: ".base_url()."index.php");
}

?>
<head>
	<title>Admin Page</title>
	<!-- BASE CSS -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/menu.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/vendors.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
	<!-- YOUR CUSTOM CSS -->
	<!-- <link href="css/custom.css" rel="stylesheet"> -->
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'> 
</head>
<body>
	<div class="content-wrapper">
		<div class="container">
			<?php
			if (isset($message_display)) {

				echo "<div class='text-center alert alert-success alert-dismissible fade show my-3'>";
				echo $message_display;
				echo' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
				echo '<span aria-hidden="true">&times;</span>';
				echo "</div>";
			} ?>
			<div class="text-center mt-5">
				<h2>Users List</h2>
			</div>
			<div class="">

				<div class="row">
					<div class="col-sm-10" style="margin-bottom: 20px;">
						<a href="<?php echo base_url() ?>user_authentication/user_registration_show">
							<input  type="button" value="Create User" id="login-submit"  class="btn btn-primary" ></a>
						</div>
						<div class="col-sm-1" style="margin-bottom: 20px;">
							<a href="logout" class="btn btn-primary">Logout</a>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="tblrecord"   >
						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email Address</th>
								<th>User Name</th>
								<th>Department</th>
								<th>Designation</th>
								<th>Location</th>
								<th>Action</th>
							</tr>
						</thead>
						<?php	foreach($title as $row) { ?>
							<tbody>
								<tr>
									<td class="capitalize"><?php echo $row['firstname'] ?></td>
									<td class="capitalize"><?php echo $row['lastname'] ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['username']; ?></td>
									<td><?php echo $row['department']; ?></td>
									<td><?php echo $row['designation']; ?></td>
									<td><?php echo $row['location']; ?></td>
									<td class="text-center"> 
										<a href="<?php echo base_url() ?>user_authentication/editUser/<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a> <a href="<?php echo base_url() ?>user_authentication/deleteUser/<?php echo $row['id']; ?>" class="btn btn-primary">Delete</a>
									</td>
								</tr>
							</tbody>
						<?php } ?>
					</table>
				</div>

			</div>
		</div>	
	</body>
	</html>