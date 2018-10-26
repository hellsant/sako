<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$sc_class =  "";
$sc_student = "";
$sc_roll = "";
$sc_type_id = '';
$sc_month = "";
$sc_date = "";
$sc_amount = "";
$title = 'Add Student Charge';
$button_text="Save Information";
$successful_msg="Add Student Charge Successfully";
$form_url = WEB_URL . "account/a_student_charge.php";
$id="";
$hdnid="0";

if(isset($_GET['cval']) && $_GET['cval'] != ''){
	$sc_class = $_GET['cval'];
}
if(isset($_GET['tval']) && $_GET['tval'] != ''){
	$sc_roll = $_GET['tval'];
}


if(isset($_POST['dllStMonth'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql = "INSERT INTO `tbl_add_student_charge`(`sc_class`, `sc_student`, `sc_roll`, `sc_month`,`sc_type_id`, `sc_amount`,`sc_date`) VALUES ('$_POST[dllStClassId]','$_POST[dllStNameId]','$_POST[txtStRollNo]','$_POST[dllStMonth]','$_POST[dllFeeType]','$_POST[txtStAmount]','$_POST[txtStDate]')";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'account/a_chargelist.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = "UPDATE `tbl_add_student_charge` SET `sc_class`='".$_POST['dllStClassId']."',`sc_student`='".$_POST['dllStNameId']."',`sc_roll`='".$_POST['txtStRollNo']."',`sc_month`='".$_POST['dllStMonth']."',`sc_type_id`='".$_POST['dllFeeType']."',`sc_amount`='".$_POST['txtStAmount']."',`sc_date`='".$_POST['txtStDate']."' WHERE charge_id='".$_GET['id']."'";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'account/a_chargelist.php?m=u&tval='.$_POST['hdnsid'].'&cval='.$_POST['hdncid'];
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_student_charge where charge_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$sc_class = $row['sc_class'];
		$sc_student = $row['sc_student'];
		$sc_roll = $row['sc_roll'];
		$sc_month = $row['sc_month'];
		$sc_type_id = $row['sc_type_id'];
		$sc_amount = $row['sc_amount'];
		$sc_date = $row['sc_date'];
		$hdnid = $_GET['id'];
		$title = 'Update Student Charge';
		$button_text="Update Information";
		$successful_msg="Update Student Charge Successfully";
		$form_url = WEB_URL . "account/a_student_charge.php?id=".$_GET['id'];
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
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/charge.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/a_account.php">Account</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/a_chargelist.php">Back To Charge List</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" action="<?php echo $form_url; ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStClass"> Class </label>
          <div class="col-sm-6">
            <select class="form-control" onchange="getStudentWithRoll(this.value);" id="dllStClassId" name="dllStClassId">
              <option value="">--Select--</option>
              <?php 
				  	$result_class = mysql_query("SELECT * FROM tbl_add_class order by c_id ASC",$link);
					while($row_class = mysql_fetch_array($result_class)){
				  ?>
              <option <?php if($sc_class == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStNameId"> Student </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllStNameId" name="dllStNameId">
			  <option value="">--Select--</option>
			   <?php 
				  	$result_class = mysql_query("SELECT * FROM tbl_add_student order by s_id ASC",$link);
					while($row_class = mysql_fetch_array($result_class)){
				  ?>
              <option <?php if($sc_student == $row_class['s_id']){echo 'selected';}?> value="<?php echo $row_class['s_id'];?>"><?php echo $row_class['s_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtStRollNo"> Roll No. </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $sc_roll;?>" name="txtStRollNo" id="txtStRollNo" class="form-control">
          </div>
        </div>
		 <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStMonth"> Select Month </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllStMonth" name="dllStMonth">
              <option value="">--Select--</option>
              <option <?php if($sc_month =='January'){echo 'selected';}?> value="January">January</option>
              <option <?php if($sc_month =='February'){echo 'selected';}?> value="February">February</option>
              <option <?php if($sc_month =='March'){echo 'selected';}?> value="March">March</option>
              <option <?php if($sc_month =='April'){echo 'selected';}?> value="April">April</option>
              <option <?php if($sc_month =='May'){echo 'selected';}?> value="May">May</option>
			  <option <?php if($sc_month =='June'){echo 'selected';}?> value="June">June</option>
			  <option <?php if($sc_month =='July'){echo 'selected';}?> value="July">July</option>
			  <option <?php if($sc_month =='August'){echo 'selected';}?> value="August">August</option>
			  <option <?php if($sc_month =='September'){echo 'selected';}?> value="September">September</option>
			  <option <?php if($sc_month =='October'){echo 'selected';}?> value="October">October</option>
			  <option <?php if($sc_month =='November'){echo 'selected';}?> value="November">November</option>
			  <option <?php if($sc_month =='December'){echo 'selected';}?> value="December">December</option>
            </select>
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="dllFeeType"> Fee Type </label>
          <div class="col-sm-6">
            <select onChange="getTypeFee(this.value);" class="form-control" id="dllFeeType" name="dllFeeType">
              <option value="">--Select--</option>
               <?php 
				  	$result_class = mysql_query("SELECT * FROM tbl_add_fee_type order by ft_id ASC",$link);
					while($row_class = mysql_fetch_array($result_class)){
				  ?>
              <option <?php if($sc_type_id == $row_class['ft_id']){echo 'selected';}?> value="<?php echo $row_class['ft_id'];?>"><?php echo $row_class['fee_type'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStAmount"> Amount </label>
          <div class="col-sm-6">
		  <div class="input-group">
            <input type="text" value="<?php echo $sc_amount;?>" name="txtStAmount" id="txtStAmount" class="form-control">
			<div class="input-group-addon"> <?php echo CURRENCY;?> </div>
            </div>
          </div>
          </div>
		   <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStDate"> Date </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $sc_date;?>" name="txtStDate" id="txtStDate" class="form-control datepicker">
          </div>
         </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-8">
            <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
          </div>
        </div>
        <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
		<input type="hidden" value="<?php echo $sc_roll; ?>" name="hdnsid"/>
        <input type="hidden" value="<?php echo $sc_class; ?>" name="hdncid"/>
      </form>
    </div>
  </div>
  <div class="bottom_area"></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
