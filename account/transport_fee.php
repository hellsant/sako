<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$tpf_class =  "";
$tpf_student = "";
$tpf_roll = "";
$tpf_month = "";
$tpf_date = "";
$tpf_destination = "";
$tpf_amount = "";
$title = 'Add Student Transport Fee';
$button_text="Save Information";
$successful_msg="Add Student Transport Fee Successfully";
$form_url = WEB_URL . "account/transport_fee.php";
$id="";
$hdnid="0";

if(isset($_POST['dllStMonth'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql = "INSERT INTO `tbl_transport_fee`(`tpf_class`, `tpf_student`, `tpf_roll`, `tpf_month`, `tpf_date`,`tpf_destination`,`tpf_amount`) VALUES ('$_POST[dllStClassId]','$_POST[dllStNameId]','$_POST[txtStRollNo]','$_POST[dllStMonth]','$_POST[txtStDate]','$_POST[ddlTrMbDestination]','$_POST[txtTrMbFee]')";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'account/transport_fee_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = "UPDATE `tbl_transport_fee` SET `tpf_class`='".$_POST['dllStClassId']."',`tpf_student`='".$_POST['dllStNameId']."',`tpf_roll`='".$_POST['txtStRollNo']."',`tpf_month`='".$_POST['dllStMonth']."',`tpf_date`='".$_POST['txtStDate']."',`tpf_destination`='".$_POST['ddlTrMbDestination']."',`tpf_amount`='".$_POST['txtTrMbFee']."' WHERE tpf_id='".$_GET['id']."'";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'account/transport_fee_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_transport_fee where tpf_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$tpf_class = $row['tpf_class'];
		$tpf_student = $row['tpf_student'];
		$tpf_roll = $row['tpf_roll'];
		$tpf_month = $row['tpf_month'];
		$tpf_date = $row['tpf_date'];
		$tpf_destination = $row['tpf_destination'];
		$tpf_amount = $row['tpf_amount'];
		$hdnid = $_GET['id'];
		$title = 'Update Student Transport Fee';
		$button_text="Update Information";
		$successful_msg="Update Student Transport Fee Successfully";
		$form_url = WEB_URL . "account/transport_fee.php?id=".$_GET['id'];
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
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/transport_fee_list.php">Back To Tp Fee List</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" action="<?php echo $form_url; ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStClass"> Select Class </label>
          <div class="col-sm-6">
            <select class="form-control" onchange="getStudentWithRoll(this.value);" id="dllStClassId" name="dllStClassId">
              <option value="">--Select--</option>
              <?php 
				  	$result_class = mysql_query("SELECT * FROM tbl_add_class order by c_id ASC",$link);
					while($row_class = mysql_fetch_array($result_class)){
				  ?>
              <option <?php if($tpf_class == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStNameId"> Select Student </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllStNameId" name="dllStNameId">
			  <option value="">--Select--</option>
			   <?php 
				  	$result_tpf = mysql_query("SELECT * FROM tbl_add_student order by s_id ASC",$link);
					while($row_tpf = mysql_fetch_array($result_tpf)){
				  ?>
              <option <?php if($tpf_student == $row_tpf['s_id']){echo 'selected';}?> value="<?php echo $row_tpf['s_id'];?>"><?php echo $row_tpf['s_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtStRollNo"> Roll No. </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $tpf_roll;?>" name="txtStRollNo" id="txtStRollNo" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStMonth"> Select Month </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllStMonth" name="dllStMonth">
              <option value="">--Select--</option>
              <option <?php if($tpf_month =='January'){echo 'selected';}?> value="January">January</option>
              <option <?php if($tpf_month =='February'){echo 'selected';}?> value="February">February</option>
              <option <?php if($tpf_month =='March'){echo 'selected';}?> value="March">March</option>
              <option <?php if($tpf_month =='Appril'){echo 'selected';}?> value="Appril">Appril</option>
              <option <?php if($tpf_month =='May'){echo 'selected';}?> value="May">May</option>
			  <option <?php if($tpf_month =='June'){echo 'selected';}?> value="June">June</option>
			  <option <?php if($tpf_month =='July'){echo 'selected';}?> value="July">July</option>
			  <option <?php if($tpf_month =='August'){echo 'selected';}?> value="August">August</option>
			  <option <?php if($tpf_month =='September'){echo 'selected';}?> value="September">September</option>
			  <option <?php if($tpf_month =='October'){echo 'selected';}?> value="October">October</option>
			  <option <?php if($tpf_month =='November'){echo 'selected';}?> value="November">November</option>
			  <option <?php if($tpf_month =='December'){echo 'selected';}?> value="December">December</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStDate"> Date </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $tpf_date;?>" name="txtStDate" id="txtStDate" class="form-control datepicker">
          </div>
         </div>
		 <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlTrMbDestination"> Destination </label>
            <div class="col-sm-6">
			  <select onChange="getTransportPay(this.value);" class="form-control" name="ddlTrMbDestination" id="ddlTrMbDestination">
            <option value="-1">--Select Destination--</option>
			<?php
            	$result_pay = mysql_query("Select * from tbl_add_transport order by transport_id asc",$link);
				while($row_pay = mysql_fetch_array($result_pay)){?>
                	<option <?php if($tpf_destination == $row_pay['transport_id']){echo 'selected';}?> value="<?php echo $row_pay['transport_id'];?>"><?php echo $row_pay['destination'];?></option>
                <?php } ?>
            </select>	
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStAmount"> Amount </label>
          <div class="col-sm-6">
		  <div class="input-group">
            <input type="text" readonly value="<?php echo $tpf_amount;?>" name="txtTrMbFee" id="txtTrMbFee" class="form-control">
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
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
