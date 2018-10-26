<?php 
/**************************sako engine*************************************************************************/
ob_start();
session_start();
define('DIR_APPLICATION', str_replace('\'', '/', realpath(dirname(__FILE__))) . '/');
include(DIR_APPLICATION."config.php");
$school_image = '';
$result_s_arr = mysqli_query($link,"Select * from tbl_add_school");
if($row_arr = mysqli_fetch_array($result_s_arr)){$school_image = WEB_URL . 'img/upload/' . $row_arr['s_image'];}
if(!isset($_SESSION['objLogin'])){header('Location: index.php');die();}
/***********************end engine******************************************************************************/
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVA Entornos Virtuales de Aprendizaje</title> <!--<title>School Management System</title>  -->
<link type="text/css" href="<?php echo WEB_URL; ?>css/style.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo WEB_URL; ?>js/jquery-ui.css">
<script src="<?php echo WEB_URL; ?>js/jquery-1.10.2.js"></script>
<script src="<?php echo WEB_URL; ?>js/jquery-ui.js"></script>
<script src="<?php echo WEB_URL; ?>js/jquery.colorbox-min.js"></script>
<script src="<?php echo WEB_URL; ?>js/jquery.mask.min.js"></script>
<link href="<?php echo WEB_URL; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_URL; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo WEB_URL; ?>js/common.js"></script>
<link href="<?php echo WEB_URL; ?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<!-- Font Awesome Icons -->
<link href="<?php echo WEB_URL; ?>dist/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="<?php echo WEB_URL; ?>dist/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo WEB_URL; ?>plugins/datatable/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo WEB_URL; ?>plugins/datatable/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo WEB_URL; ?>plugins/datatable/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_URL; ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo WEB_URL; ?>js/common.js"></script>
<script src="<?php echo WEB_URL; ?>js/printThis.js"></script>
</head>
<body>
<?php
$login_type = $_SESSION['objLogin']; 
$img_x = '';
$name_x = '';
$email_x = '';
$password_x = '';
$update_id = 0;
if($_SESSION['login_type'] == 'admin'){
	$img_x = WEB_URL . 'img/admin.png';
	$name_x = $login_type['d_name'];
	$email_x = $login_type['a_email'];
	$password_x = $login_type['password'];
	$update_id = $login_type['aid'];
}
else if($_SESSION['login_type'] == 'teacher'){
	$img_x = WEB_URL . 'img/upload/'.$login_type['t_photo'];
	$name_x = $login_type['t_username'];
	$email_x = $login_type['t_email'];
	$password_x = $login_type['t_password'];
	$update_id = $login_type['teacher_id'];
}
else if($_SESSION['login_type'] == 'student'){
	$img_x = WEB_URL . 'img/upload/'.$login_type['s_image'];
	$name_x = $login_type['s_profile_name'];
	$email_x = $login_type['s_email'];
	$password_x = $login_type['s_password'];
	$update_id = $login_type['s_id'];
}
else if($_SESSION['login_type'] == 'parents'){
	$img_x = WEB_URL . 'img/upload/'.$login_type['p_image'];
	$name_x = $login_type['p_profile_name'];
	$email_x = $login_type['p_email'];
	$password_x = $login_type['p_password'];
	$update_id = $login_type['p_id'];
}
else if($_SESSION['login_type'] == 'accountant' || $_SESSION['login_type'] == 'librarian'){
	$img_x = WEB_URL . 'img/upload/'.$login_type['u_image'];
	$name_x = $login_type['u_profile_name'];
	$email_x = $login_type['u_email'];
	$password_x = $login_type['u_password'];
	$update_id = $login_type['u_id'];
}
?>
<input type="hidden" id="web_url" value="<?php echo WEB_URL; ?>" />
<div class="main">
<?php if($school_image != '') {?>
<div class="mobile_school_logo" align="center" style="display:none;"><img style="width:100px;height:100px;" src="<?php echo $school_image; ?>" /></div>
<?php }?>
<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Update Profile Information</h4>
      </div>
      <div class="modal-body">
		<div align="center"><img class="img-circle" style="width:150px; height:150px;border:solid 5px #000;" src="<?php echo $img_x; ?>" /></div>
        <br>
		<div style="font-size:11px;color:red;text-align:center;font-weight:bold;">After change anything current user will be logout automatically.</div>
        <div>
          <form id="updateprofile" action="<?php echo WEB_URL; ?>ajax/updateProfile.php" method="post">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Name:</label>
              <input type="text" class="form-control" id="txtProfileName" name="txtProfileName" value="<?php echo $name_x; ?>">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">Email:</label>
              <input type="text" class="form-control" id="txtProfileEmail" name="txtProfileEmail" value="<?php echo $email_x; ?>">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">Password:</label>
              <input type="text" class="form-control" id="txtProfilePassword" name="txtProfilePassword" value="<?php echo $password_x; ?>">
            </div>
			<input type="hidden" name="user_id" value="<?php echo $update_id; ?>" >
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="javascript:$('#updateprofile').submit();">Update</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<h1 align="center" class="school_top_text"><img src="<?php echo WEB_URL; ?>img/logo.png"></h1>
