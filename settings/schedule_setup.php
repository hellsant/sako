<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<?php 
  	$schedule_name ='';
	$button_text = "Save";
	$hval = 0;
	
	if(isset($_POST['txtScheduleName'])){
		if($_POST['hdnSpid'] == '0'){
			$sql="INSERT INTO `tbl_schedule_setup`(`schedule_name`) VALUES ('$_POST[txtScheduleName]')";	
			mysql_query($sql, $link);
		}
		else{
			$sql_update="UPDATE `tbl_schedule_setup` set schedule_name = '$_POST[txtScheduleName]' where schedule_id= '" . (int)$_POST['hdnSpid'] . "'";	
			mysql_query($sql_update, $link);
			echo "<script>alert('Update Successfully');</script>";
		}
	}
	
	if(isset($_GET['spid']) && $_GET['spid'] != ''){
		$result = mysql_query("SELECT * FROM tbl_schedule_setup where schedule_id= '" . (int)$_GET['spid'] . "'",$link);
		if($row = mysql_fetch_array($result)){
		 	$schedule_name = $row['schedule_name'];
			$button_text = "Update";
			$hval = $row['schedule_id'];
		}
			
	}
	
	if(isset($_GET['delid']) && $_GET['delid'] != ''){
		mysql_query("DELETE from tbl_schedule_setup where schedule_id= '" . (int)$_GET['delid'] . "'",$link);
		echo "<script>alert('Delete Successfully');</script>";
	}
	
  ?>
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Schedule Setup</div>
    <div class="top_common_bar">
      <div class="obj_right"><a class="btn btn-success" href="<?php echo WEB_URL; ?>settings/setting.php">Setting</a></div>
    </div>
  </div>
  <!-- start insert department name-->
  <div class="row">
    <div class="col-md-12">
      <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        <div class="box-body">
          <div class="form-group">
            <label for="txtPurchaseItemCharge">Schedule Name :</label>
            <input type="text" name="txtScheduleName" value="<?php echo $schedule_name; ?>" id="txtScheduleName" class="form-control"/>
          </div>
          <div class="form-group pull-right">
            <input type="submit" name="submit" class="btn btn-success" value="<?php echo $button_text; ?>"/>
            &nbsp;
            <input type="reset" onClick="javascript:window.location.href='<?php echo WEB_URL; ?>settings/schedule_setup.php';" name="btnReset" id="btnReset" value="Reset" class="btn btn-success"/>
          </div>
          <input type="hidden" name="hdnSpid" value="<?php echo $hval; ?>"/>
        </div>
      </form>
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
              <th>ID#</th>
              <th>Schedule</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
				$result = mysql_query("SELECT * FROM tbl_schedule_setup order by schedule_name ASC ",$link);
				while($row = mysql_fetch_array($result)){ ?>
            <tr>
              <td><?php echo $row['schedule_id']; ?></td>
              <td><?php echo $row['schedule_name']; ?></td>
			  <td><a class="btn btn-primary btn-xs mrg" data-toggle="tooltip" title="Edit Me" href="<?php echo WEB_URL;?>settings/schedule_setup.php?spid=<?php echo $row['schedule_id']; ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-danger btn-xs mrg" data-toggle="tooltip" title="Delete Me" onclick=deleteMe("<?php echo WEB_URL;?>settings/schedule_setup.php?delid=<?php echo $row['schedule_id'];?>"); href="javascript:void(0);" data-original-title="Delete"><i class="fa fa-trash-o"></i></a></td>
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
