<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$e_name =  "";
$e_month = "";
$e_pay_date = "";
$e_amount = "";
$title = 'Add Employee Salary';
$button_text="Save Information";
$successful_msg="Add Employee Salary Successfully";
$form_url = WEB_URL . "account/employee_salary.php";
$id="";
$hdnid="0";

if(isset($_POST['dllEmNameId'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql = mysqli_query($link,"INSERT INTO `tbl_add_employee_salary`(`e_name`, `e_month`, `e_pay_date`, `e_amount`) VALUES ('$_POST[dllEmNameId]','$_POST[dllEmMonth]','$_POST[txtEmDate]','$_POST[txtEmAmount]')");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/e_salarylist.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = mysqli_query($link,"UPDATE `tbl_add_employee_salary` SET `e_name`='".$_POST['dllEmNameId']."',`e_month`='".$_POST['dllEmMonth']."',`e_pay_date`='".$_POST['txtEmDate']."',`e_amount`='".$_POST['txtEmAmount']."' WHERE e_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/e_salarylist.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_employee_salary where e_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){
		$e_name = $row['e_name'];
		$e_month = $row['e_month'];
		$e_pay_date = $row['e_pay_date'];
		$e_amount = $row['e_amount'];
		$hdnid = $_GET['id'];
		$title = 'Update Employee Salary';
		$button_text="Update Information";
		$successful_msg="Update Employee Salary Successfully";
		$form_url = WEB_URL . "account/employee_salary.php?id=".$_GET['id'];
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
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/account.php">Account</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/e_salarylist.php">Teacher Salary List</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" action="<?php echo $form_url; ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllEmNameId"> Employee </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllEmNameId" name="dllEmNameId">
			  <option value="">--Select--</option>
			   <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_user order by u_name ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($e_name == $row_class['u_id']){echo 'selected';}?> value="<?php echo $row_class['u_id'];?>"><?php echo $row_class['u_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllEmMonth"> Select Month </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllEmMonth" name="dllEmMonth">
              <option value="">--Select Month--</option>
			  <?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_month order by mid asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if($e_month == $row_class['mid']){echo 'selected';}?> value="<?php echo $row_class['mid'];?>"><?php echo $row_class['m_name'];?></option>
          <?php }?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtEmDate"> Pay Date </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $e_pay_date;?>" name="txtEmDate" id="txtEmDate" class="form-control datepicker">
          </div>
         </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtEmAmount"> Amount </label>
          <div class="col-sm-6">
		  <div class="input-group">
            <input type="text" value="<?php echo $e_amount;?>" name="txtEmAmount" id="txtEmAmount" class="form-control">
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
