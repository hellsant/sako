<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>
<?php 
$success = "none";
$t_member_id = "";
$t_destination

 = "";
$t_month = date('m');
$t_date = date('d/m/Y');
$t_amount = "";
$title = 'Add Transport Monthly Fee';
$button_text="Save Information";
$successful_msg="Added Transport Monthly Fee Successfully";
$form_url = WEB_URL . "account/add_transport_fee.php";
$id="";
$hdnid="0";

if(isset($_POST['txtTransportId'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql = "INSERT INTO `tbl_transport_monthly_fee`(`t_member_id`,`t_destination`, `t_month`, `t_date`, `t_amount`) VALUES ('$_POST[txtTransportId]','$_POST[txtDestination]','$_POST[dllTMonth]','$_POST[txtTransportDate]','$_POST[txtTransportAmount]')";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'account/transport_fee_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = "UPDATE `tbl_transport_monthly_fee` SET `t_member_id`='".$_POST['txtTransportId']."',`t_destination`='".$_POST['txtDestination']."',`t_month`='".$_POST['dllTMonth']."',`t_date`='".$_POST['txtTransportDate']."',`t_amount`='".$_POST['txtTransportAmount']."' WHERE t_id='".$_GET['id']."'";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'account/transport_fee_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_transport_monthly_fee where t_id = '" . $_GET['id'] . "'",$link);
	if($row = mysql_fetch_array($result)){
		$t_member_id = $row['t_member_id'];
		$t_destination = $row['t_destination'];
		$t_month = $row['t_month'];
		$t_date = $row['t_date'];
		$t_amount = $row['t_amount'];
		$hdnid = $_GET['id'];
		$title = 'Update Transport Monthly Fee';
		$button_text="Update Information";
		$successful_msg="Update Transport Monthly Fee Successfully";
		$form_url = WEB_URL . "account/add_transport_fee.php?id=".$_GET['id'];
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
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/fee.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/account.php">Account</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/transport_fee_list.php">Back To Transport Fee List</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" action="<?php echo $form_url; ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtTransportId"> Member Id </label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="txtTransportId" id="txtTransportId" onblur="loadTransportInfo(this.value);" placeholder="Enter Member Id then focus Mouse point blank Place" value="<?php echo $t_member_id;?>" />
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtStudentName"> Student Name </label>
          <div class="col-sm-6">
            <input type="text" disabled="disabled" class="form-control" name="txtStudentName" id="txtStudentName" value="" />
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtClassName"> Class Name </label>
          <div class="col-sm-6">
            <input type="text" disabled="disabled" class="form-control" name="txtClassName" id="txtClassName" value="" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllTMonth"> Select Month </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllTMonth" name="dllTMonth">
              <option value="-1">--Select Month--</option>
              <?php 
				  	$result_hostel = mysql_query("Select * from tbl_add_month order by mid asc",$link);
					while($row_hostel = mysql_fetch_array($result_hostel)){
				  ?>
              <option <?php if($t_month == $row_hostel['mid']){echo 'selected';}?> value="<?php echo $row_hostel['mid'];?>"><?php echo $row_hostel['m_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtTransportDate"> Date </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $t_date;?>" name="txtTransportDate" id="txtTransportDate" class="form-control datepicker">
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtDestination"> Destination </label>
          <div class="col-sm-6">
            <input type="text" name="txtDestination" readonly="" id="txtDestination" value="<?php echo $t_destination;?>" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtTransportAmount"> Amount </label>
          <div class="col-sm-6">
            <div class="input-group">
              <input type="text" value="<?php echo $t_amount;?>" readonly="" name="txtTransportAmount" id="txtTransportAmount" class="form-control">
              <div class="input-group-addon"> <?php echo CURRENCY;?> </div>
            </div>
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

<script type="text/javascript">
$(document).ready(function() {
  if($("#txtTransportId").val() != ''){
  	loadTransportInfo($("#txtTransportId").val());
  }
});
</script>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
