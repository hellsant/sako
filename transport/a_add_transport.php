<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$destination =  "";
$vehicle =  "";
$fare =  "";
$note=  "";
$title = 'Add New Transport';
$button_text="Add Transport";
//$successful_msg="Add Transport Successfully";
//$form_url = WEB_URL . "class/add_class.php";
$id="";
$hdnid="0";


if(isset($_POST['txtTrpDestination'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	  $sql = "INSERT INTO `tbl_add_transport`(`destination`, `vehicle`, `fare`, `note`) VALUES ('$_POST[txtTrpDestination]','$_POST[txtTrpVehicle]','$_POST[txtTrpFare]','$_POST[txtTrpNote]')";
	  //echo $sql;
	  //die();
	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'transport/a_transport_list.php?m=i';
	  header('Location: ' . $redirect_url);
	  die();
	
}
else{
	
	$sql = "UPDATE `tbl_add_transport` SET `destination`='".$_POST['txtTrpDestination']."',`vehicle`='".$_POST['txtTrpVehicle']."',`fare`='".$_POST['txtTrpFare']."',`note`='".$_POST['txtTrpNote']."' WHERE transport_id='".$_GET['id']."'";

	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'transport/a_transport_list.php?m=u';
	  header('Location: ' . $redirect_url);
	  die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_transport where transport_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$destination = $row['destination'];
		$vehicle = $row['vehicle'];
		$fare = $row['fare'];
		$note = $row['note'];
		$hdnid = $_GET['id'];
		$title = 'Update Transport';
		$button_text="Update";
	}
	
	//mysql_close($link);

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
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>transport/a_transport.php">Transport</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>transport/a_transport_list.php">Back To Transport List</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrpDestination"> Destination </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $destination;?>" name="txtTrpDestination" id="txtTrpDestination" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrpVehicle"> Vehicle Number </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $vehicle;?>" name="txtTrpVehicle" id="txtTrpVehicle" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrpFare"> Fare </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $fare;?>" name="txtTrpFare" id="txtTrpFare" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrpNote"> Class Note </label>
            <div class="col-sm-6">
              <textarea name="txtTrpNote" id="txtTrpNote" style="resize:none;" class="form-control"><?php echo $note;?></textarea>
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
