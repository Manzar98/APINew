<html>
<?php
//print_r($this->session->userdata['logged_in']);
if (!isset($this->session->userdata['logged_in'])) {

 header("location: ".base_url()."index.php");
}
?>
<head>
  <title>Registration Form</title>
  <!-- BASE CSS -->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/menu.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/vendors.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
  <!-- YOUR CUSTOM CSS -->
  <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
  <!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'> -->
</head>
<body>
  <div id="page">
    <main>
      <div class="bg_color_2">
        <div class="container margin_60_35">
          <div id="signup">
            <h1 class="text-capitalize">Edit <?php echo $record->firstname ?></h1>     
            <div class="box_form">
              <div class='error_msg'>
               <?php echo validation_errors(); ?>
             </div> 
             <?php  echo form_open("user_authentication/updateUser/{$record->id}");
             ?>
             <a href="<?php echo base_url(); ?>user_authentication/user_login_process">Go Back</a>
             <div class="row mt-5">
               <div class="col-sm-6">
                 <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" name="firstname" value="<?php echo $record->firstname ?>">
                </div>
              </div>
              <div class="col-sm-6">
               <div class="form-group">
                 <label>Last Name</label>
                 <input type="text" class="form-control" name="lastname"  value="<?php echo $record->lastname ?>">
               </div>
             </div>
           </div>
           <div class="row">
             <div class="col-sm-6">
               <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" value="<?php echo $record->lastname ?>">
                <?php if (isset($message_display)) {?>
                 <div class='error_msg text-danger'>
                  <?php echo $message_display; ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="col-sm-6">
           <div class="form-group">
             <label>Password</label>
             <input type="password" class="form-control" name="password" disabled="">
           </div>
         </div>
       </div>
       <div class="form-group">
         <label>Email Address</label>
         <input type="email" name="email" class="form-control" value="<?php echo $record->email ?>"/>
       </div>
       <div class="row">
         <div class="col-sm-6">
           <div class="form-group">
            <label>Department</label>
            <input type="text" class="form-control" name="department" value="<?php echo $record->department ?>">
          </div>
        </div>
        <div class="col-sm-6">
         <div class="form-group">
           <label>Designation</label>
           <input type="text" class="form-control" name="designation" value="<?php echo $record->designation ?>">
         </div>
       </div>
     </div>
     <div class="row">
       <div class="col-sm-6">
         <div class="form-group">
          <label>User Role</label>
          <input type="text" class="form-control" name="user_role" value="<?php echo $record->user_role ?>">
        </div>
      </div>
      <div class="col-sm-6">
       <div class="form-group">
         <label>Location</label>
         <input type="text" class="form-control" name="location" value="<?php echo $record->location ?>">
       </div>
     </div>
   </div>
   <div class="form-group text-center add_top_20">
    <button type="submit" name="submit" class="btn_1 medium">Update</button>
  </div>
  <?php echo form_close(); ?>
  
</div>
</div>
</div>
</div>
</main>
</div>
</body>
<!-- COMMON SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/common_scripts.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/functions.js"></script>
</html>