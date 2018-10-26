<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>


<?php 
$success = "none";
$fday =  "";
$fmonth = "";
$fyear ="";
$title = 'Add New Fine';
$button_text="Save Information";
$successful_msg="Add Fine Successfully";
$form_url = WEB_URL . "library/fine.php";
$id="";
$hdnid="0";

if(isset($_POST['ddlFDay'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	
	$sql = "INSERT INTO `tbl_add_fine`(`fday`,`fmonth`,`fyear`) VALUES ('$_POST[ddlFDay]','$_POST[ddlFMonth]','$_POST[ddlFYear]')";
	//echo $sql;
	//die();
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'library/fine.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = "UPDATE `tbl_add_fine` SET `fday`='".$_POST['ddlFDay']."',`fmonth`='".$_POST['ddlFMonth']."',`fyear`='".$_POST['ddlFYear']."' WHERE fid='".$_GET['id']."'";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'library/fine.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){

	$result = mysql_query("SELECT * FROM tbl_add_fine where fid = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$fday = $row['fday'];
		$fmonth = $row['fmonth'];
		$fyear = $row['fyear'];
		$hdnid = $_GET['id'];
		$title = 'Update Fine';
		$button_text="Update Information";
		$successful_msg="Update Fine Successfully";
		$form_url = WEB_URL . "library/fine.php?id=".$_GET['id'];
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
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/student.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>library/library.php">Library</a></div>
		<div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL;?>library/finelist.php">Back To Fine List</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlFDay"> Day </label>
            <div class="col-sm-6">
             <select class="form-control" id="ddlFDay" name="ddlFDay">
			  						<option>--Select--</option>
			  <?php
						for ($x = 1; $x <= 31; $x++) {?>
              	<option value="<?php echo "$x";?>"><?php echo "$x".'</br>';?></option>
				
					  <?php } ?> 
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlFMonth"> Month </label>
            <div class="col-sm-6">
              <select class="form-control" id="ddlFMonth" name="ddlFMonth">
			  	<option>--Select--</option>
              	<option <?php if($fmonth == 'January'){echo 'selected';}?> value="January">January</option>
				<option <?php if($fmonth == 'February'){echo 'selected';}?> value="February">February</option>
				<option <?php if($fmonth == 'March'){echo 'selected';}?> value="March">March</option>
				<option <?php if($fmonth == 'April'){echo 'selected';}?> value="April">April</option>
				<option <?php if($fmonth == 'May'){echo 'selected';}?> value="May">May</option>
				<option <?php if($fmonth == 'June'){echo 'selected';}?> value="June">June</option>
				<option <?php if($fmonth == 'July'){echo 'selected';}?> value="July">July</option>
				<option <?php if($fmonth == 'August'){echo 'selected';}?> value="August">August</option>
				<option <?php if($fmonth == 'September'){echo 'selected';}?> value="September">September</option>
				<option <?php if($fmonth == 'October'){echo 'selected';}?> value="October">October</option>
				<option <?php if($fmonth == 'November'){echo 'selected';}?> value="November">November</option>
				<option <?php if($fmonth == 'December'){echo 'selected';}?> value="December">December</option> 
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlFYear"> Year </label>
            <div class="col-sm-6">
               <select class="form-control" id="ddlFYear" name="ddlFYear">
			  						<option>--Select--</option>
			  <?php
						for ($x = 2015; $x >= 1980; $x--) {?>
              	<option <?php if($fyear == '$x'){echo 'selected';}?> value="<?php echo "$x";?>"><?php echo "$x".'</br>';?></option>
				
					  <?php } ?> 
              </select>
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
