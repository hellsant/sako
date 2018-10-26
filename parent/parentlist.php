<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php
$token = 'none';
$msg = '';

if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx= mysqli_query($link,"DELETE FROM `tbl_add_parent` WHERE p_id = ".$_GET['id']);
	mysqli_query($sqlx,$link); 
	$msg = 'Delete Parent Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Parent Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Parent Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Parent List</div>
    <!--<div class="header_text_right"><a class="btn btn_add_new btn-success" href="<?php //echo WEB_URL; ?>teacher/add_teacher.php"><i class="fa fa-plus"></i>&nbsp;Add Teacher</a></div>
    </div>-->
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>parent/addparent.php"><i class="fa fa-plus"></i>&nbsp;Add Parent</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>dashboard.php"><i class="fa"></i>Dashboard</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div class="list" style="width:100%; height:480px; overflow:auto;">
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Image</th>
          <th>Guardiun Name</th>
		  <th>Father's Name</th>
		  <th>Mother's Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
				$result = mysqli_query($link,"Select * from tbl_add_parent order by p_id desc");
				while($row = mysqli_fetch_array($result)){
					
				$p_image = WEB_URL . 'img/no_image.jpg';	
		if(file_exists(ROOT_PATH . '/img/upload/' . $row['p_image']) && $row['p_image'] != ''){
			$p_image = WEB_URL . 'img/upload/' . $row['p_image'];
		}
					
					 ?>
        <tr>
          <td><img class="photo_img_round" style="width:50px;height:50px;" src="<?php echo $p_image;  ?>" /></td>
          <td><?php echo $row['p_guardian']; ?></td>
		  <td><?php echo $row['p_father_name']; ?></td>
          <td><?php echo $row['p_mother_name']; ?></td>
          <td><?php echo $row['p_email']; ?></td>
          <td><?php echo $row['p_contact']; ?></td>
          <td><?php echo $row['p_address']; ?></td>
          <td><a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>parent/parent_details.php?id=<?php echo $row['p_id']; ?>"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;<a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>parent/addparent.php?id=<?php echo $row['p_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteParent(<?php echo $row['p_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteParent(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Parent ?");
	if(iAnswer){
		window.location = 'parentlist.php?id=' + Id;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
