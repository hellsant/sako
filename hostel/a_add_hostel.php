<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>


<?php 
$success = "none";
$h_name =  "";
$h_address =  "";
$h_type =  "";
$h_note =  "";
$title = 'Add New Hostel';
$button_text="Add Hostel";
$id="";
$hdnid="0";


if(isset($_POST['txtHostelName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	  $sql = "INSERT INTO `tbl_add_hostel`(`h_name`,`h_address`,`h_type`,`h_note`) VALUES ('$_POST[txtHostelName]','$_POST[txtHostelAddress]','$_POST[ddlHostelType]','$_POST[txtHostelNote]')";
	  mysql_query($sql,$link);
	  //echo $sql;
	  //die();
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'hostel/a_hostel_list.php?m=i';
	  header('Location: ' . $redirect_url);
	  die();
	
}
else{
	
	$sql = "UPDATE `tbl_add_hostel` SET `h_name`='".$_POST['txtHostelName']."',`h_address`='".$_POST['txtHostelAddress']."',`h_type`='".$_POST['ddlHostelType']."',`h_note`='".$_POST['txtHostelNote']."' WHERE h_id='".$_GET['id']."'";
	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'hostel/a_hostel_list.php?m=u';
	  header('Location: ' . $redirect_url);
	  die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_hostel where h_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$h_name = $row['h_name'];
		$h_address = $row['h_address'];
		$h_type = $row['h_type'];
		$h_note = $row['h_note'];
		$hdnid = $_GET['id'];
		$title = 'Update Hostel';
		$button_text="Update";
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
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/member.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>hostel/a_hostel.php">Hostel Dashboard</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>hostel/a_hostel_list.php">Hostel List</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtHostelName"> Hostel Name </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $h_name; ?>" name="txtHostelName" id="txtHostelName" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            <div class="form-group">
            <label class="col-sm-2 control-label" for="txtHostelAddress"> Address </label>
            <div class="col-sm-6">
              <textarea name="txtHostelAddress" id="txtHostelAddress" class="form-control"><?php echo $h_address;?></textarea>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlHostelType"> Hostel Type </label>
            <div class="col-sm-6">
              <select class="form-control" id="ddlHostelType" name="ddlHostelType">
              	<option value="">--Select--</option>
                <option <?php if($h_type =='Boys'){echo 'selected';}?> value="Boys">Boys</option>
                <option <?php if($h_type =='Girls'){echo 'selected';}?> value="Girls">Girls</option>
                <option <?php if($h_type =='Combine'){echo 'selected';}?> value="Combine">Combine</option>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtHostelNote"> Note </label>
            <div class="col-sm-6">
              <textarea name="txtHostelNote" id="txtHostelNote" class="form-control"><?php echo $h_note;?></textarea>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
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
