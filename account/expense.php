<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$ex_issue =  "";
$ex_date = "";
$ex_amount = "";
$ex_note = "";
$title = 'Add New Expense';
$button_text="Save Information";
$successful_msg="Add Expense Information Successfully";
$form_url = WEB_URL . "account/expense.php";
$id="";
$hdnid="0";

if(isset($_POST['txtExIssue'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql = "INSERT INTO `tbl_add_expense`(`ex_issue`,`ex_date`,`ex_amount`,`ex_note`) VALUES ('$_POST[txtExIssue]','$_POST[txtExDate]','$_POST[txtExAmount]','$_POST[txtExNote]')";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'account/expense_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = "UPDATE `tbl_add_expense` SET `ex_issue`='".$_POST['txtExIssue']."',`ex_date`='".$_POST['txtExDate']."',`ex_amount`='".$_POST['txtExAmount']."',`ex_note`='".$_POST['txtExNote']."' WHERE ex_id='".$_GET['id']."'";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'account/expense_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_expense where ex_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$ex_issue = $row['ex_issue'];
		$ex_date = $row['ex_date'];
		$ex_amount = $row['ex_amount'];
		$ex_note = $row['ex_note'];
		$hdnid = $_GET['id'];
		$title = 'Update Fee Type';
		$button_text="Update Information";
		$successful_msg="Update Expense Information Successfully";
		$form_url = WEB_URL . "account/expense.php?id=".$_GET['id'];
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
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/e_salary.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/account.php">Account</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/expense_list.php">Expense List</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" action="<?php echo $form_url; ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtExIssue"> Issue </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $ex_issue;?>" name="txtExIssue" id="txtExIssue" class="form-control">
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtExDate"> Date </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $ex_date;?>" name="txtExDate" id="txtExDate" class="form-control datepicker">
          </div>
         </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtExAmount"> Amount </label>
          <div class="col-sm-6">
		  <div class="input-group">
            <input type="text" value="<?php echo $ex_amount;?>" name="txtExAmount" id="txtExAmount" class="form-control">
			<div class="input-group-addon"> <?php echo CURRENCY;?> </div>
            </div>
          </div>
          </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtExNote"> Note </label>
          <div class="col-sm-6">
            <textarea name="txtExNote" id="txtExNote" class="form-control"><?php echo $ex_note;?></textarea>
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
