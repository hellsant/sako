<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>
<?php 
$success = "none";
$h_member_id = "";
$hostel_id = "";
$h_month = date('m');
$h_date = date('d/m/Y');
$h_amount = "";
$title = 'Add Hostel Monthly Fee';
$button_text="Save Information";
$successful_msg="Added Hostel Monthly Fee Successfully";
$form_url = WEB_URL . "account/a_add_hostel_fee.php";
$id="";
$hdnid="0";

if(isset($_POST['txtHAmount'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql = "INSERT INTO `tbl_hostel_monthly_fee`(`h_member_id`,`hostel_id`, `h_month`, `h_date`, `h_amount`) VALUES ('$_POST[txtMemberId]','$_POST[dllHostelId]','$_POST[dllMonth]','$_POST[txtHDate]','$_POST[txtHAmount]')";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'account/a_hostel_fee_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = "UPDATE `tbl_hostel_monthly_fee` SET `h_member_id`='".$_POST['txtMemberId']."',`hostel_id`='".$_POST['dllHostelId']."',`h_month`='".$_POST['dllMonth']."',`h_date`='".$_POST['txtHDate']."',`h_amount`='".$_POST['txtHAmount']."' WHERE htl_id='".$_GET['id']."'";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'account/a_hostel_fee_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_hostel_monthly_fee where htl_id = '" . $_GET['id'] . "'",$link);
	if($row = mysql_fetch_array($result)){
		$h_member_id = $row['h_member_id'];
		$hostel_id = $row['hostel_id'];
		$h_month = $row['h_month'];
		$h_date = $row['h_date'];
		$h_amount = $row['h_amount'];
		$hdnid = $_GET['id'];
		$title = 'Update Hostel Monthly Fee';
		$button_text="Update Information";
		$successful_msg="Update Hostel Monthly Fee Successfully";
		$form_url = WEB_URL . "account/a_add_hostel_fee.php?id=".$_GET['id'];
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
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/a_account.php">Account</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/a_hostel_fee_list.php">Back To Hostel Fee List</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" action="<?php echo $form_url; ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllHostelMemberId"> Member Id </label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="txtMemberId" id="txtMemberId" onblur="loadMemberInfo(this.value);" placeholder="Enter Member Id then focus Mouse point blank Place" value="<?php echo $h_member_id;?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllHostelId"> Hostel Name </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllHostelId" name="dllHostelId">
              <option value="">--Select Hostel--</option>
              <?php 
				  	$result_hostel = mysql_query("SELECT * FROM tbl_add_hostel order by h_id ASC",$link);
					while($row_hostel = mysql_fetch_array($result_hostel)){
				  ?>
              <option <?php if($hostel_id == $row_hostel['h_id']){echo 'selected';}?> value="<?php echo $row_hostel['h_id'];?>"><?php echo $row_hostel['h_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="dllHostelMemberId"> Student Name </label>
          <div class="col-sm-6">
            <input type="text" disabled="disabled" class="form-control" name="txtStudentName" id="txtStudentName" value="" />
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="dllHostelMemberId"> Class Name </label>
          <div class="col-sm-6">
            <input type="text" disabled="disabled" class="form-control" name="txtClassName" id="txtClassName" value="" />
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="dllHostelMemberId"> Hostel Type </label>
          <div class="col-sm-6">
            <input type="text" disabled="disabled" class="form-control" name="txtHostelType" id="txtHostelType" value="" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllMonth"> Select Month </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllMonth" name="dllMonth">
              <option value="-1">--Select Month--</option>
              <?php 
				  	$result_hostel = mysql_query("Select * from tbl_add_month order by mid asc",$link);
					while($row_hostel = mysql_fetch_array($result_hostel)){
				  ?>
              <option <?php if($h_month == $row_hostel['mid']){echo 'selected';}?> value="<?php echo $row_hostel['mid'];?>"><?php echo $row_hostel['m_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtHDate"> Date </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $h_date;?>" name="txtHDate" id="txtHDate" class="form-control datepicker">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtHAmount"> Amount </label>
          <div class="col-sm-6">
            <div class="input-group">
              <input type="text" value="<?php echo $h_amount;?>" name="txtHAmount" id="txtHAmount" class="form-control">
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
  if($("#txtMemberId").val() != ''){
  	loadMemberInfo($("#txtMemberId").val());
  }
});
</script>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
