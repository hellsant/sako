<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>
<?php 
$success = "none";
$st_title =  "";
$email =  "";
$contact =  "";
$address =  "";
$s_image =  "";
$title = 'Add School Info';
$button_text="Save Info";
$successful_msg="Add School Information Successfully";
$form_url = WEB_URL . "settings/school_setup.php";
$id="";
$hdnid="0";

$image = WEB_URL . 'img/no_image.jpg';
$img_track = '';

if(isset($_POST['txtTitle'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	
	$image_url = uploadImage();	
	
	$sql = "INSERT INTO `tbl_add_school`(`st_title`,`email`,`contact`,`address`, `s_image`) VALUES ('$_POST[txtTitle]','$_POST[txtEmail]','$_POST[txtContact]','$_POST[txtAddress]','$image_url')";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'settings/school_setup_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$image_url = uploadImage();	
		
		if($image_url == ''){
			$image_url = $_POST['img_exist'];
		}
	
	$sql = "UPDATE `tbl_add_school` SET `st_title`='".$_POST['txtTitle']."',`email`='".$_POST['txtEmail']."',`contact`='".$_POST['txtContact']."',`address`='".$_POST['txtAddress']."',`s_image`='".$image_url."' WHERE school_id='".$_GET['id']."'";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'settings/school_setup_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_school where school_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		if($row['s_image'] != ''){
			$image = WEB_URL . 'img/upload/' . $row['s_image'];
			$img_track = $row['s_image'];
		}
		$st_title = $row['st_title'];
		$email = $row['email'];
		$contact = $row['contact'];
		$address = $row['address'];
		$s_image = $row['s_image'];
		$hdnid = $_GET['id'];
		$title = 'Update School Information';
		$button_text="Update Info";
		$successful_msg="Update Student Successfully";
		$form_url = WEB_URL . "settings/school_setup.php?id=".$_GET['id'];
	}
	
	//mysql_close($link);

}

function uploadImage(){
	if((!empty($_FILES["fStImage"])) && ($_FILES['fStImage']['error'] == 0)) {
	  $filename = basename($_FILES['fStImage']['name']);
	  $ext = substr($filename, strrpos($filename, '.') + 1);
	  if(($ext == "jpg" && $_FILES["fStImage"]["type"] == 'image/jpeg') || ($ext == "png" && $_FILES["fStImage"]["type"] == 'image/png') || ($ext == "gif" && $_FILES["fStImage"]["type"] == 'image/gif')){   
	  	$temp = explode(".",$_FILES["fStImage"]["name"]);
	  	$newfilename = rand(1,99999) . uniqid() . '.' .end($temp);
	  	move_uploaded_file($_FILES["fStImage"]["tmp_name"], ROOT_PATH . '/img/upload/' . $newfilename);
		return $newfilename;
	  }
	  else{
	  	return '';
	  }
	}
	return '';
}
	
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text_inside">
    <div class="header_text_left"><?php echo $title; ?></div>
  </div>
  <div class="main_content">
    <div class="main_content_left">
      <div></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>dashboard.php">Dashboard</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>settings/school_setup_list.php">Back To School</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtTitle"> Name </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $st_title;?>" name="txtTitle" id="txtTitle" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtEmail"> Email </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $email;?>" name="txtEmail" id="txtEmail" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtContact"> Contact </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $contact;?>" name="txtContact" id="txtContact" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtAddress"> Address </label>
          <div class="col-sm-6">
            <textarea name="txtAddress" id="txtAddress" class="form-control"><?php echo $address;?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtImage">Logo</label>
          <div class="col-sm-6" align="left"> <img src="<?php echo $image; ?>" style="height:100px;width:100px;" id="output"/>
            <input type="hidden" name="img_exist" value="<?php echo $img_track; ?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label col-xs-8 col-md-2" for="photo"> Upload </label>
          <!-- <div class="col-sm-4 col-xs-6 col-md-4">
              <input disabled="" placeholder="Choose File" id="uploadFile" class="form-control">
            </div>-->
          <div class="col-sm-2 col-xs-6 col-md-2">
            <div class="fileUpload btn btn-success form-control"> <span class="fa fa-repeat"></span> <span>Upload</span>
              <input type="file" name="fStImage" class="upload" onchange="loadFile(event)" id="fStImage">
            </div>
          </div>
          <span class="col-sm-4 control-label col-xs-6 col-md-4"> </span> </div>
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
