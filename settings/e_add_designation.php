<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<?php 
  	$designation_name ='';
	$button_text = "Save";
	$hval = 0;
	
	if(isset($_POST['txtDesignation'])){
		if($_POST['hdnSpid'] == '0'){
			$sql="INSERT INTO `tbl_add_designation`(`designation_name`) VALUES ('$_POST[txtDesignation]')";	
			mysql_query($sql, $link);
		}
		else{
			$sql_update="UPDATE `tbl_add_designation` set designation_name = '$_POST[txtDesignation]' where designation_id= '" . (int)$_POST['hdnSpid'] . "'";	
			mysql_query($sql_update, $link);
			echo "<script>alert('Update Successfully');</script>";
		}
	}
	
	if(isset($_GET['spid']) && $_GET['spid'] != ''){
		$result = mysql_query("SELECT * FROM tbl_add_designation where designation_id= '" . (int)$_GET['spid'] . "'",$link);
		if($row = mysql_fetch_array($result)){
		 	$designation_name = $row['designation_name'];
			$button_text = "Update";
			$hval = $row['designation_id'];
		}
			
	}
	
	if(isset($_GET['delid']) && $_GET['delid'] != ''){
		mysql_query("DELETE from tbl_add_designation where designation_id= '" . (int)$_GET['delid'] . "'",$link);
		echo "<script>alert('Delete Successfully');</script>";
	}
	
  ?>
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Department Setup</div>
    <div class="top_common_bar">
      <div class="obj_right"><a class="btn_save" href="<?php echo WEB_URL; ?>settings/e_setting.php">Setting</a></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
	<form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
      <div class="box-body">
        <div class="form-group">
          <label for="txtDesignation">Designation :</label>
          <input type="text" name="txtDesignation" value="<?php echo $designation_name; ?>" id="txtDesignation" class="form-control"/>
        </div>
        <div class="form-group pull-right">
          <input type="submit" name="submit" class="btn btn-primary" value="<?php echo $button_text; ?>"/>
          &nbsp;
          <input type="reset" onClick="javascript:window.location.href='<?php echo WEB_URL; ?>settings/e_add_designation.php';" name="btnReset" id="btnReset" value="Reset" class="btn btn-primary"/>
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
              <th>Designation</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
				$result = mysql_query("SELECT * FROM tbl_add_designation order by designation_name ASC ",$link);
				while($row = mysql_fetch_array($result)){ ?>
            <tr>
              <td><?php echo $row['designation_name']; ?></td>
			  <td><a class="btn btn-primary btn-xs mrg" data-toggle="tooltip" title="Edit Me" href="<?php echo WEB_URL;?>settings/e_add_designation.php?spid=<?php echo $row['designation_id']; ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-danger btn-xs mrg" data-toggle="tooltip" title="Delete Me" onclick=deleteMe("<?php echo WEB_URL;?>settings/e_add_designation.php?delid=<?php echo $row['designation_id'];?>"); href="javascript:void(0);" data-original-title="Delete"><i class="fa fa-trash-o"></i></a></td>
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
