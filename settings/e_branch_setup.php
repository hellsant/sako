<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<?php 
	$b_name = '';
	$b_email = '';
	$b_contact_no = '';
	$b_address = '';
	$b_status = '';
	$button_text = "Save";
	$hval = 0;
	
	if(isset($_POST['txtBrName'])){
		if($_POST['hdnSpid'] == '0'){
			$sql_branch = "INSERT INTO `tbl_add_branch`(`b_name`, `b_email`, `b_contact_no`, `b_address`,`b_status`) VALUES ('$_POST[txtBrName]','$_POST[txtBrEmail]','$_POST[txtBrConNo]','$_POST[txtareaAddress]','$_POST[radioStatus]')";
	mysql_query($sql_branch,$link);

		}
		else{
			$sql_branch = "UPDATE `tbl_add_branch` SET `b_name`='".$_POST['txtBrName']."',`b_email`='".$_POST['txtBrEmail']."',`b_contact_no`='".$_POST['txtBrConNo']."',`b_address`='".$_POST['txtareaAddress']."',`b_status` ='".$_POST['radioStatus']."' WHERE bid = '".$_GET['spid']."'";
		mysql_query($sql_branch,$link);
			echo "<script>alert('Update Successfully');</script>";
		}
	}
	
	if(isset($_GET['spid']) && $_GET['spid'] != ''){
		$result = mysql_query("SELECT * FROM tbl_add_branch where bid= '" . (int)$_GET['spid'] . "'",$link);
		if($row = mysql_fetch_array($result)){
		 	$b_name = $row['b_name'];
			$b_email = $row['b_email'];
			$b_contact_no = $row['b_contact_no'];
			$b_address = $row['b_address'];
			$b_status = $row['b_status'];
			$button_text = "Update";
			$hval = $row['bid'];
		}
			
	}
	
	if(isset($_GET['delid']) && $_GET['delid'] != ''){
		mysql_query("DELETE from tbl_add_branch where bid= '" . (int)$_GET['delid'] . "'",$link);
		echo "<script>alert('Delete Successfully');</script>";
	}
	
  ?>
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Branch Setup</div>
    <div class="top_common_bar">
      <div class="obj_right"><a class="btn_save" href="<?php echo WEB_URL; ?>settings/e_setting.php">Setting</a></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        <div class="box-body">
        <div class="form-group">
          <label for="txtBrName">Name :</label>
          <input type="text" name="txtBrName" value="<?php echo $b_name; ?>" id="txtBrName" class="form-control"/>
        </div>
        <div class="form-group">
          <label for="txtBrEmail">Email :</label>
          <input type="text" name="txtBrEmail" value="<?php echo $b_email; ?>" id="txtBrEmail" class="form-control"/>
        </div>
        <div class="form-group">
          <label for="txtBrConNo">Contact No :</label>
          <input type="text" name="txtBrConNo" value="<?php echo $b_email; ?>" id="txtBrConNo" class="form-control"/>
        </div>
        <div class="form-group">
          <label for="txtareaAddress">Address :</label>
          <textarea name="txtareaAddress" id="txtareaAddress" rows="4" class="form-control"><?php echo $b_address; ?></textarea>
        </div>
        <div class="form-group">
          <label for="">Status :</label>
          <div class="row">
            <div class="col-xs-1" style="vertical-align:middle !important ;">
              <input style="width:30%;" type="radio" name="radioStatus" <?php if($b_status == 'enable'){echo 'checked=checked';}?> value="enable" id="radioStatus" class="form-control"/></div>
              <div class="col-xs-1" style="vertical-align:middle !important ;"><label for="radioStatus">Enable</label></div>
              <div class="col-xs-1" style="vertical-align:middle !important ;"><input style="width:30%;" type="radio" name="radioStatus" <?php if($b_status == 'disable'){echo 'checked=checked';}?> value="disable" id="radioStatus" class="form-control"/></div>
              <div class="col-xs-1" style="vertical-align:middle !important ;"><label for="radioStatus">Disable</label>
            </div>
          </div>
        </div>
        <div class="form-group pull-right">
          <input type="submit" name="submit" class="btn btn-primary" value="<?php echo $button_text; ?>"/>
          &nbsp;
          <input type="reset" onClick="javascript:window.location.href='<?php echo WEB_URL; ?>settings/e_branch_setup.php';" name="btnReset" id="btnReset" value="Reset" class="btn btn-primary"/>
        </div>
        <input type="hidden" name="hdnSpid" value="<?php echo $hval; ?>"/>
      </form>
    </div>
  </div>
</div>
<!-- end insert dept. name -->
<!--show department name-->
<!--show department name-->
<div class="row">
  <div class="col-xs-12">
    <div class="box-body">
      <table class="table common_sakotable table-bordered table-striped dt-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
				$result = mysql_query("SELECT * FROM tbl_add_branch order by bid ASC",$link);
				while($row = mysql_fetch_array($result)){ ?>
          <tr>
            <td><?php echo $row['bid']; ?></td>
            <td><?php echo $row['b_name']; ?></td>
            <td><?php echo $row['b_email']; ?></td>
            <td><?php echo $row['b_contact_no']; ?></td>
            <td><?php echo $row['b_address']; ?></td>
            <td><?php echo $row['b_status']; ?></td>
            <td><a class="btn btn-primary btn-xs mrg" data-toggle="tooltip" title="Edit Me" href="<?php echo WEB_URL;?>settings/e_branch_setup.php?spid=<?php echo $row['bid']; ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-danger btn-xs mrg" data-toggle="tooltip" title="Delete Me" onclick=deleteMe("<?php echo WEB_URL;?>settings/e_branch_setup.php?delid=<?php echo $row['bid'];?>"); href="javascript:void(0);" data-original-title="Delete"><i class="fa fa-trash-o"></i></a></td>
          </tr>
          <?php } mysql_close($link); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div style="clear:both"></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
