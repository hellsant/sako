<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
<div id="print_area">
  <div class="bio-graph-heading">
    <?php
 
$id = '';
$result = mysql_query("Select * from tbl_add_user where u_id='".$_GET['id']."'",$link);
while($row = mysql_fetch_array($result)){
$u_image = WEB_URL . 'img/no_image.jpg';	
if(file_exists(ROOT_PATH . '/img/upload/' . $row['u_image']) && $row['u_image'] != ''){
$u_image = WEB_URL . 'img/upload/' . $row['u_image'];
}
  
?>
    <div align="center" style="width:100%;"><img class="img_ratio img-circle" src="<?php echo $u_image;  ?>"></div>
    <div class="details_top_text"><?php echo $row['u_name']; ?></div>
    <p><?php echo $row['u_designation']; ?></p>
    <?php } ?>
  </div>
  <div style="padding:10px;">
    <?php
    $result = mysql_query("Select * from tbl_add_user where u_id='".$_GET['id']."'",$link);
	while($row = mysql_fetch_array($result)){?>
    <div style="font-size:13px;text-align:left;" class="row">
      <div class="col-md-6">
        <table class="table">
          <tr>
            <td><strong>Email:</strong></td>
            <td><?php echo $row['u_email'];?></td>
          </tr>
          <tr>
            <td><strong>Contact:</strong></td>
            <td><?php echo $row['u_contact'];?></td>
          </tr>
          <tr>
            <td><strong>Address:</strong></td>
            <td><?php echo $row['u_address'];?></td>
          </tr>
          <tr>
            <td><strong>Date of Birth:</strong></td>
            <td><?php echo $row['u_dob'];?></td>
          </tr>
        </table>
      </div>
      <div class="col-md-6">
        <table class="table">
          <tr>
            <td><strong>Gender:</strong></td>
            <td><?php echo $row['u_gender'];?></td>
          </tr>
          <tr>
            <td><strong>Religion:</strong></td>
            <td><?php echo $row['u_religion'];?></td>
          </tr>
          <tr>
            <td><strong>Profile Name:</strong></td>
            <td><?php echo $row['u_profile_name'];?></td>
          </tr>
        </table>
      </div>
    </div>
    <?php }  //mysql_query($link);?>
  </div>
  <div style="padding:10px;" align="center"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>user/add_user.php"><i class="fa fa-plus"></i>&nbsp;Add User</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>user/user_list.php"><i class="fa fa-list"></i>&nbsp;User List</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>dashboard.php"><i class="fa fa-home"></i>&nbsp;Dashboard</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" onclick="printContent('print_area','Employee Information')" href="javascript:;"><i class="fa fa-print"></i>&nbsp;Print</a></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
