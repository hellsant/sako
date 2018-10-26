<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$n_title =  "";
$date =  "";
$permission = "";
$notice =  "";
$title = 'Add New Notice';
$button_text="Add Notice";
$successful_msg="Add Notice Successfully";
$form_url = WEB_URL . "notice/a_add_notice.php";
$id="";
$hdnid="0";


if(isset($_POST['txtTitle'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	  $sql = "INSERT INTO `tbl_add_notice`(`n_title`,`date`,`permission`,`notice`) VALUES ('$_POST[txtTitle]','$_POST[txtDate]','$_POST[txtPermission]','$_POST[txtNotice]')";
	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'notice/a_notice_list.php?m=i';
	  header('Location: ' . $redirect_url);
	  die();
	
}
else{
	
	$sql = "UPDATE `tbl_add_notice` SET `n_title`='".$_POST['txtTitle']."',`date`='".$_POST['txtDate']."',`permission`='".$_POST['txtPermission']."',`notice`='".$_POST['txtNotice']."' WHERE n_id='".$_GET['id']."'";

	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'notice/a_notice_list.php?m=u';
	  header('Location: ' . $redirect_url);
	  die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_notice where n_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$n_title = $row['n_title'];
		$date = $row['date'];
		$permission = $row['permission'];
		$notice = $row['notice'];
		$hdnid = $_GET['id'];
		$title = 'Update Class';
		$button_text="Update";
		$successful_msg="Update Class Successfully";
		$form_url = WEB_URL . "notice/a_add_notice.php?id=".$_GET['id'];
	}
	
	//mysql_close($link);

}
	
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text_inside">
    <div class="header_text_left"><?php echo $title; ?></div>
  </div>
  <div class="main_content">
    <div class="main_content_left">
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/class.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>a_dashboard.php">Dashboard</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>notice/a_notice_list.php">Notice List</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtTitle"> Title </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $n_title;?>" name="txtTitle" id="txtTitle" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtDate"> Date </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $date;?>" name="txtDate" id="txtDate" class="form-control datepicker">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="txtPermission"> Permission </label>
            <div class="col-sm-6">
              <select class="form-control" id="txtPermission" name="txtPermission">
                <option value="-1">--Select--</option>
				<option <?php if($permission == 'teacher'){echo 'selected';}?> value="teacher">Teacher</option>
				<option <?php if($permission == 'student'){echo 'selected';}?> value="student">Student</option>
				<option <?php if($permission == 'parent'){echo 'selected';}?> value="parent">Parent</option>
				<option <?php if($permission == 'employee'){echo 'selected';}?> value="employee">Employee</option>
				<option <?php if($permission == 'librarian'){echo 'selected';}?> value="librarian">Librarian</option>
				<option <?php if($permission == 'accountant'){echo 'selected';}?> value="accountant">Accountant</option>
				<option <?php if($permission == 'everyone'){echo 'selected';}?> value="everyone">Every One</option>
              </select>
            </div>
          </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtNotice"> Notice </label>
          <div class="col-sm-6">
            <textarea name="txtNotice" id="txtNotice" style="resize:none;" class="form-control"><?php echo $notice;?></textarea>
          </div>
          <span class="col-sm-4 control-label"></span></div>
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
