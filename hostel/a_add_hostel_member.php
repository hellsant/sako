<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>


<?php 
$success = "none";
$hostel_name =  "";
$hostel_category =  "";
$title = 'Add New Hostel Member';
$button_text="Add Information";
$id="";
$hdnid="0";
$sid = 0;
$cid = 0;

if(isset($_GET['sid']) && $_GET['sid'] != ''){
	$sid = $_GET['sid'];
}
if(isset($_GET['cid']) && $_GET['cid'] != ''){
	$cid = $_GET['cid'];
}


if(isset($_POST['ddlHostelName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	  $sql = "INSERT INTO `tbl_add_hostel_member`(`sid`,`cid`,`hostel_name`,`hostel_category`) VALUES ('$_POST[hdnsid]','$_POST[hdncid]','$_POST[ddlHostelName]','$_POST[txtCategoryType]')";
	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'hostel/a_hostel_member_list.php?m=i&cid='.$_POST[hdncid];
	  header('Location: ' . $redirect_url);
	  die();
	
}
else{
	
	$sql = "UPDATE `tbl_add_hostel_member` SET `hostel_name`='".$_POST['ddlHostelName']."',`hostel_category`='".$_POST['txtCategoryType']."' WHERE hmid='".$_GET['id']."'";
	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'hostel/a_hostel_member_list.php?m=u&cid='.$_POST[hdncid];
	  header('Location: ' . $redirect_url);
	  die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_hostel_member where hmid = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$hostel_name = $row['hostel_name'];
		$hostel_category = $row['hostel_category'];
		$hdnid = $_GET['id'];
		$title = 'Update Hostel Member';
		$button_text="Update Information";
	}
	
	//mysql_close($link);

}
	
?>
  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content">
    <div class="header_text_inside">
      <!--<div id="me" style="width:100%;text-align:center;background:#666;color:#fff;margin-bottom:20px; display:none;">
        <?php //echo $successful_msg; ?>
      </div>-->
      <div class="header_text_left"><?php echo $title; ?></div>
    </div>
    <div class="main_content">
      <div class="main_content_left">
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/member.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>hostel/a_hostel.php">Hostel</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>hostel/a_hostel_member_list.php">Back To Hostel Member List</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlHostelName"> Hostel Name </label>
            <div class="col-sm-6">
             <select onChange="getCategoryType(this.value);" class="form-control" id="ddlHostelName" name="ddlHostelName">
            <option value="-1">--Select Hostel--</option>
				 <?php 
				  	$result_hostel = mysql_query("SELECT * FROM tbl_add_hostel order by h_id ASC",$link);
					while($row_hostel = mysql_fetch_array($result_hostel)){
				  ?>
              <option <?php if($hostel_name == $row_hostel['h_id']){echo 'selected';}?> value="<?php echo $row_hostel['h_id'];?>"><?php echo $row_hostel['h_name'];?></option>
              <?php } //mysql_close($link);?>
			 </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtCategoryType"> Category Type </label>
            <div class="col-sm-6">
			<input type="text" readonly value="<?php echo $hostel_category;?>" name="txtCategoryType" id="txtCategoryType" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
            </div>
          </div>
          <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
		  <input type="hidden" value="<?php echo $sid; ?>" name="hdnsid"/>
          <input type="hidden" value="<?php echo $cid; ?>" name="hdncid"/>
        </form>
      </div>
    </div>
    <div class="bottom_area"></div>
  </div>
  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
