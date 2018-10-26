<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$library_id =  "";
$library_fee =  "";
$title = 'Add New Library Member';
$button_text="Add Member";
$id="";
$hdnid="0";


if(isset($_POST['txtLibraryID'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	  $sql = mysqli_query($link,"INSERT INTO `tbl_library_member`(`library_id`,`library_fee`) VALUES ('$_POST[txtLibraryID]','$_POST[txtLibraryFee]')");
	  mysqli_query($sql,$link);
	  mysqli_close($link);
	  $redirect_url = WEB_URL . 'library/memberlist.php?m=i';
	  header('Location: ' . $redirect_url);
	  die();
	
}
else{
	
	$sql = mysqli_query($link,"UPDATE `tbl_library_member` SET `library_id`='".$_POST['txtLibraryID']."',`library_fee`='".$_POST['txtLibraryFee']."' WHERE lmid='".$_GET['id']."'");
	  mysqli_query($sql,$link);
	  mysqli_close($link);
	  $redirect_url = WEB_URL . 'library/memberlist.php?m=u';
	  header('Location: ' . $redirect_url);
	  die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_library_member where lmid = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){
		$library_id = $row['library_id'];
		$library_fee = $row['library_fee'];
		$hdnid = $_GET['id'];
		$title = 'Update Library Member';
		$button_text="Update Information";
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
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>library/library.php">Library</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>library/memberlist.php">Library Member List</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtLibraryID"> Library ID </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $library_id;?>" name="txtLibraryID" id="txtLibraryID" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtLibraryFee"> Library Fee </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $library_fee;?>" name="txtLibraryFee" id="txtLibraryFee" class="form-control">
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
