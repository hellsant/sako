<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'teacher'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$r_class_id =  "";
$r_subject_id = "";
$routine_day =  "";
$routine_time_start =  "";
$start_am_pm = "";
$routine_time_end=  "";
$end_am_pm = "";
$routine_room=  "";
$title = 'Add New Routine';
$button_text="Add Routine";
$successful_msg="Add Routine Successfully";
$form_url = WEB_URL . "routine/addroutine.php";
$id="";
$hdnid="0";


if(isset($_POST['dllStClassId'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	  $sql = "INSERT INTO `tbl_add_routine`(`r_class_id`,`r_subject_id`, `routine_day`, `routine_time_start`,`start_am_pm`,`routine_time_end`,`end_am_pm`,`routine_room`) VALUES ('$_POST[dllStClassId]','$_POST[dllESSubjectId]','$_POST[ddlDays]','$_POST[txtRStartTime]','$_POST[ddlStartAMPM]','$_POST[txtREndTime]','$_POST[ddlEndAMPM]','$_POST[txtRoomNo]')";
	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'routine/routinelist.php?m=i&cid='.$_GET['cid'];
	  header('Location: ' . $redirect_url);
	  die();
	}
	else{
		$sql = "UPDATE `tbl_add_routine` SET `r_class_id`='".$_POST['dllStClassId']."',`r_subject_id`='".$_POST['dllESSubjectId']."',`routine_day`='".$_POST['ddlDays']."',`routine_time_start`='".$_POST['txtRStartTime']."',`start_am_pm`='".$_POST['ddlStartAMPM']."',`routine_time_end`='".$_POST['txtREndTime']."',`end_am_pm`='".$_POST['ddlEndAMPM']."',`routine_room`='".$_POST['txtRoomNo']."' WHERE routine_id='".$_GET['id']."'";
	
		  mysql_query($sql,$link);
		  mysql_close($link);
		  $redirect_url = WEB_URL . 'routine/routinelist.php?m=u&cid='.$_GET['cid'];
		  header('Location: ' . $redirect_url);
		  die();
	}
	$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_routine where routine_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$r_class_id = $row['r_class_id'];
		$r_subject_id = $row['r_subject_id'];
		$routine_day = $row['routine_day'];
		$routine_time_start = $row['routine_time_start'];
		$start_am_pm = $row['start_am_pm'];
		$routine_time_end = $row['routine_time_end'];
		$end_am_pm = $row['end_am_pm'];
		$routine_room = $row['routine_room'];
		$hdnid = $_GET['id'];
		$title = 'Update Routine';
		$button_text="Update";
		$successful_msg="Update Routine Successfully";
		$form_url = WEB_URL . "routine/addroutine.php?id=".$_GET['id'];
	}
	
	//mysql_close($link);

}
if(isset($_GET['mode']) && $_GET['mode'] == 'view'){
	$title = 'View Nurse Details';
}
	
?>
  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content">
    <div class="header_text_inside">
      <div id="me" style="width:100%;text-align:center;background:#666;color:#fff;margin-bottom:20px; display:none;">
        <?php //echo $successful_msg; ?>
      </div>
      <div class="header_text_left"><?php echo $title; ?></div>
    </div>
    <div class="main_content">
      <div class="main_content_left">
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/class.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>t_dashboard.php">Dashboard</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>routine/t_routinelist.php">Back To Routine List</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="dllStClassId"> Class </label>
            <div class="col-sm-6">
              <select class="form-control" onchange="getSubject(this.value);" id="dllStClassId" name="dllStClassId">
                <option value="">--Select--</option>
                <?php 
				  	$result_class = mysql_query("SELECT * FROM tbl_add_class order by c_id ASC",$link);
					while($row_class = mysql_fetch_array($result_class)){
				  ?>
                <option <?php if($r_class_id == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="dllESSubjectId"> Subject </label>
            <div class="col-sm-6">
              <select class="form-control" id="dllESSubjectId" name="dllESSubjectId">
                <option value="">--Select--</option>
                <?php 
				  	if($r_subject_id != 0){
					$result_class = mysql_query("SELECT * from tbl_add_subject where sb_class_id = '" . (int)$r_class_id . "' order by sb_name asc",$link);
					while($row_class = mysql_fetch_array($result_class)){
				 ?>
                <option <?php if($r_subject_id == $row_class['sb_id']){echo 'selected';}?> value="<?php echo $row_class['sb_id'];?>"><?php echo $row_class['sb_name'];?></option>
                <?php } } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlDays"> Days </label>
            <div class="col-sm-6">
              <select class="form-control" id="ddlDays" name="ddlDays">
                <option value="">--Select--</option>
                <option <?php if($routine_day == 'saturday'){echo 'selected';}?> value="saturday">Saturday</option>
				<option <?php if($routine_day == 'sunday'){echo 'selected';}?> value="sunday">Sunday</option>
				<option <?php if($routine_day == 'monday'){echo 'selected';}?> value="monday">Monday</option>
				<option <?php if($routine_day == 'tuesday'){echo 'selected';}?> value="tuesday">Tuesday</option>
				<option <?php if($routine_day == 'wednesday'){echo 'selected';}?> value="wednesday">Wednesday</option>
				<option <?php if($routine_day == 'thursday'){echo 'selected';}?> value="thursday">Thursday</option>
				<option <?php if($routine_day == 'friday'){echo 'selected';}?> value="friday">Friday</option>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtRStartTime"> Start Time </label>
            <div class="col-sm-3">
              <input type="text" value="<?php echo $routine_time_start; ?>" name="txtRStartTime" id="txtRStartTime" class="form-control">
            </div>
			<div class="col-sm-3">
              <select class="form-control" id="ddlStartAMPM" name="ddlStartAMPM">
                <option <?php if($start_am_pm == 'AM'){echo 'selected';}?> value="AM">AM</option>
				<option <?php if($start_am_pm == 'PM'){echo 'selected';}?> value="PM">PM</option>
              </select>
            </div>
			</div>
			<div class="form-group">
            <label class="col-sm-2 control-label" for="txtREndTime"> End Time </label>
            <div class="col-sm-3">
              <input type="text" value="<?php echo $routine_time_end; ?>" name="txtREndTime" id="txtREndTime" class="form-control">
            </div>
			<div class="col-sm-3">
              <select class="form-control" id="ddlEndAMPM" name="ddlEndAMPM">
                <option <?php if($end_am_pm == 'AM'){echo 'selected';}?> value="AM">AM</option>
				<option <?php if($end_am_pm == 'PM'){echo 'selected';}?> value="PM">PM</option>
              </select>
            </div>
			</div>
			<div class="form-group">
            <label class="col-sm-2 control-label" for="txtRoomNo"> Room No. </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $routine_room; ?>" name="txtRoomNo" id="txtRoomNo" class="form-control">
            </div>
			</div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
            </div>
          </div>
          <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
        </form>
      </div>
    </div>
    <div class="bottom_area"></div>
  </div>
  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>

<!---->