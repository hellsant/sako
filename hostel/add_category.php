<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$hostel_id =  "";
$hostel_category =  "";
$hostel_fee =  "";
$hostel_note =  "";
$title = 'Add New Category';
$button_text="Add Category";
$id="";
$hdnid="0";


if(isset($_POST['ddlCategoryName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	  $sql = "INSERT INTO `tbl_hostel_category`(`hostel_id`,`hostel_category`,`hostel_fee`,`hostel_note`) VALUES ('$_POST[ddlCategoryName]','$_POST[ddlCategory]','$_POST[txtFee]','$_POST[txtCNote]')";
	  mysql_query($sql,$link);
	  echo $sql;
	  die();
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'hostel/category_list.php?m=i';
	  header('Location: ' . $redirect_url);
	  die();
	
}
else{
	
	$sql = "UPDATE `tbl_hostel_category` SET `hostel_id`='".$_POST['ddlCategoryName']."',`hostel_category`='".$_POST['ddlCategory']."',`hostel_fee`='".$_POST['txtFee']."',`hostel_note`='".$_POST['txtCNote']."' WHERE category_id='".$_GET['id']."'";
	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'hostel/category_list.php?m=u';
	  header('Location: ' . $redirect_url);
	  die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_hostel_category where category_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$hostel_id = $row['hostel_id'];
		$hostel_category = $row['hostel_category'];
		$hostel_fee = $row['hostel_fee'];
		$hostel_note = $row['hostel_note'];
		$hdnid = $_GET['id'];
		$title = 'Update Category';
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
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>hostel/hostel.php">Hostel Dashboard</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>hostel/category_list.php">Category List</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
         <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlCategoryName"> Hostel Name </label>
            <div class="col-sm-6">
              <select class="form-control" id="ddlCategoryName" name="ddlCategoryName">
               <option value="">--Select--</option>
                <?php 
				  	$result_hostel = mysql_query("SELECT * FROM tbl_add_hostel order by h_id ASC",$link);
					while($row_hostel = mysql_fetch_array($result_hostel)){
				  ?>
                <option <?php if($hostel_id == $row_hostel['h_id']){echo 'selected';}?> value="<?php echo $row_hostel['h_id'];?>"><?php echo $row_hostel['h_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlCategory"> Category </label>
            <div class="col-sm-6">
              <select class="form-control" id="ddlCategory" name="ddlCategory">
              	<option value="">--Select--</option>
                <option <?php if($hostel_category =='First Class'){echo 'selected';}?> value="First Class">First Class</option>
                <option <?php if($hostel_category =='Second Class'){echo 'selected';}?> value="Second Class">Second Class</option>
                <option <?php if($hostel_category =='Third Class'){echo 'selected';}?> value="Third Class">Third Class</option>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtFee"> Hostel Fee </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $hostel_fee; ?>" name="txtFee" id="txtFee" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtCNote"> Note </label>
            <div class="col-sm-6">
              <textarea name="txtCNote" id="txtCNote" class="form-control"><?php echo $hostel_note;?></textarea>
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
