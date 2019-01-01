<html>
<?php
if (isset($this->session->userdata['logged_in'])) {

	header("location: ".base_url()."user_authentication/user_login_process");
}
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Find easily a doctor and book online an appointment">
	<meta name="author" content="Ansonika">
	<title>Login Form</title>
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
	<div id="preloader" class="Fixed">
		<div data-loader="circle-side"></div>
	</div>
	<!-- /Preload-->
	<div id="page">
		<main>
			<div class="bg_color_2">
				<div class="container" style="padding-bottom: 144px; padding-top: 100px;">
					<div id="login">
						<h1>Please login to your dashboard!</h1>
						<div class="box_form">
							<?php
							if (isset($logout_message)) {
								echo "<div class='text-center alert alert-success alert-dismissible fade show my-3'>";
								echo $logout_message;
								echo' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
								echo '<span aria-hidden="true">&times;</span>';
								echo "</div>";
							}
							?>
							<?php
							if (isset($message_display)) {
								echo "<div class='text-center alert alert-success alert-dismissible fade show my-3'>";
								echo $message_display;
								echo' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
								echo '<span aria-hidden="true">&times;</span>';
								echo "</div>";
							}
							?>
							<?php echo form_open('user_authentication/user_login_process'); ?>
							<?php
							echo "<div class='error_msg'>";
							if (isset($error_message)) {
								echo $error_message;
							}
							echo validation_errors();
							echo "</div>";
							?>
							<div class="form-group">
								<input type="text" name="username" id="name" class="form-control" placeholder="Username" />
							</div>
							<div class="form-group">
								<input type="password" name="password" id="password"	value=""  class="form-control" placeholder="Password"/>
							</div>
							<div class="form-group text-center add_top_20">
								<button type="submit" name="submit" id="submit" class="btn_1 medium">Login</button>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
					<!-- /login -->
				</div>
			</div>
		</main>
	</div>
	<div id="toTop"></div>
	<!-- Back to top button -->

	<!-- COMMON SCRIPTS -->
	<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/common_scripts.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/functions.js"></script>
</body>
