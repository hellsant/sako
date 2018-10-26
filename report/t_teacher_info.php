<?php 
include('../header.php');
include('../sako/common.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'teacher'){
	header("Location: logout.php");
	die();
}
$school_image = '';
$school_name = '';
$result_s_arr = mysqli_query($link,"Select * from tbl_add_school");
if($row_arr = mysqli_fetch_array($result_s_arr)){
	$school_image = WEB_URL . 'img/upload/' . $row_arr['s_image'];
	$school_name = $row_arr['st_title'];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Teacher Information</title>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<style type="text/css">
.btn_save {
	background: #3498db;
	background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
	background-image: -moz-linear-gradient(top, #3498db, #2980b9);
	background-image: -ms-linear-gradient(top, #3498db, #2980b9);
	background-image: -o-linear-gradient(top, #3498db, #2980b9);
	background-image: linear-gradient(to bottom, #3498db, #2980b9);
	-webkit-border-radius: 28;
	-moz-border-radius: 28;
	border-radius: 28px;
	font-family: Georgia;
	color: white;
	font-weight:bold;
	font-size: 15px;
	padding: 5px 20px 5px 20px;
	text-decoration: none;
}
.btn_save :hover {
	background: #3cb0fd;
	background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
	background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
	background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
	background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
	background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
	text-decoration: none;
}
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:14px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	/*background-color: #dedede;*/
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>
</head>
<body>
<div align="center" style="margin:50px;">
  <div align="right"> <a class="btn btn-success" onClick="javascript:window.print();">Print</a> </div>
  <div>
    <input type="hidden" id="web_url" value="<?php echo WEB_URL; ?>" />
    <?php if($school_image != '') {?>
    <!--<img style="width:200px;height:200px; margin:0 auto" src="img/logo.png"/>-->
    <img style="width:200px;height:200px;" src="<?php echo $school_image; ?>" />
    <p style="color:black;font-size:24px; font-weight:bold;text-transform:uppercase;"><?php echo $school_name; ?></p>
    <?php }?>
  </div>
  <div style="margin:20px;"></div>
  <div align="left">
    <?php
 
$id = '';
   $result = mysqli_query($link,"Select * from tbl_add_teacher where teacher_id='".$_GET['tid']."'");
if($row = mysqli_fetch_array($result)){
$t_photo = WEB_URL . 'img/no_image.jpg';	
if(file_exists(ROOT_PATH . '/img/upload/' . $row['t_photo']) && $row['t_photo'] != ''){
$t_photo = WEB_URL . 'img/upload/' . $row['t_photo'];
}
  
?>
    <img style="width:150px;height:150px; margin:0 auto" src="<?php echo $t_photo;  ?>" /></div>
  <?php } ?>
  <div>
    <div style="font-size:20px; font-weight:bold; color:black; text-align:left; margin-top:20px; margin-bottom:20px; text-decoration:underline;">Personal Information:</div>
    <div align="left" style="width:100%; margin-bottom:30px;">
      <?php
    $result = mysqli_query($link,"Select * from tbl_add_teacher where teacher_id='".$_GET['tid']."'");

	if($row = mysqli_fetch_array($result)){?>
      <table class="gridtable" align="left"  style="width:100%">
        <tr>
          <td style="font-weight:bold;">Name :</td>
          <td><?php echo $row['t_name']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Designation :</td>
          <td><?php echo $row['t_designation']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Email :</td>
          <td><?php echo $row['t_email']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Contact :</td>
          <td><?php echo $row['t_phone']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Address :</td>
          <td><?php echo $row['t_address']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Date Of Birth :</td>
          <td><?php echo $row['t_dob']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Joining Date :</td>
          <td><?php echo $row['t_joining_date']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Religion :</td>
          <td><?php echo $row['t_religion']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Profile Name :</td>
          <td><?php echo $row['t_username']; ?></td>
        </tr>
        <?php }  //mysql_query($link);?>
      </table>
    </div>
  </div>
  <div style="clear:both"></div>
</div>
</body>
</html>
