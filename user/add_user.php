<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$u_name =  "";
$u_email =  "";
$u_contact =  "";
$u_address =  "";
$u_dob =  "";
$u_gender =  "";
$u_religion =  "";
$u_designation = "";
$u_image =  "";
$u_profile_name =  "";
$u_password =  "";
$title = 'Add New User';
$button_text="Save";
$form_url = WEB_URL . "user/add_user.php";
$id="";
$hdnid="0";

$image = WEB_URL . 'img/no_image.jpg';
$img_track = '';

if(isset($_POST['txtUrName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	
	$image_url = uploadImage();	
	
	$sql = "INSERT INTO `tbl_add_user`(`u_name`,`u_email`, `u_contact`, `u_address`, `u_dob`,`u_gender`, `u_religion`,`u_designation`, `u_image`, `u_profile_name`, `u_password`) VALUES ('$_POST[txtUrName]','$_POST[txtUrEmail]','$_POST[txtUrContact]','$_POST[txtUrAddress]','$_POST[txtUrDateOfBirth]','$_POST[ddlUrGender]','$_POST[txtUrReligion]','$_POST[txtUrDesignation]','$image_url','$_POST[txtUrProfileName]','$_POST[UrPassword]')";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'user/user_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$image_url = uploadImage();	
		
		if($image_url == ''){
			$image_url = $_POST['img_exist'];
		}
	
	$sql = "UPDATE `tbl_add_user` SET `u_name`='".$_POST['txtUrName']."',`u_email`='".$_POST['txtUrEmail']."',`u_contact`='".$_POST['txtUrContact']."',`u_address`='".$_POST['txtUrAddress']."',`u_dob`='".$_POST['txtUrDateOfBirth']."',`u_gender`='".$_POST['ddlUrGender']."',`u_religion`='".$_POST['txtUrReligion']."',`u_designation`='".$_POST['txtUrDesignation']."',`u_image`='".$image_url."',`u_profile_name`='".$_POST['txtUrProfileName']."',`u_password`='".$_POST['UrPassword']."' WHERE u_id='".$_GET['id']."'";
	mysql_query($sql,$link);
	mysql_close($link);
	$redirect_url = WEB_URL . 'user/user_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_user where u_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		if($row['u_image'] != ''){
			$image = WEB_URL . 'img/upload/' . $row['u_image'];
			$img_track = $row['u_image'];
		}
		$u_name = $row['u_name'];
		$u_email = $row['u_email'];
		$u_contact = $row['u_contact'];
		$u_address = $row['u_address'];
		$u_dob = $row['u_dob'];
		$u_gender = $row['u_gender'];
		$u_religion = $row['u_religion'];
		$u_designation = $row['u_designation'];
		$u_image = $row['u_image'];
		$u_profile_name = $row['u_profile_name'];
		$u_password = $row['u_password'];
		$hdnid = $_GET['id'];
		$title = 'Update User';
		$button_text="Update";
		$form_url = WEB_URL . "user/add_user.php?id=".$_GET['id'];
	}
	
	//mysql_close($link);

}

function uploadImage(){
	if((!empty($_FILES["fUrImage"])) && ($_FILES['fUrImage']['error'] == 0)) {
	  $filename = basename($_FILES['fUrImage']['name']);
	  $ext = substr($filename, strrpos($filename, '.') + 1);
	  if(($ext == "jpg" && $_FILES["fUrImage"]["type"] == 'image/jpeg') || ($ext == "png" && $_FILES["fUrImage"]["type"] == 'image/png') || ($ext == "gif" && $_FILES["fUrImage"]["type"] == 'image/gif')){   
	  	$temp = explode(".",$_FILES["fUrImage"]["name"]);
	  	$newfilename = rand(1,99999) . uniqid() . '.' .end($temp);
	  	move_uploaded_file($_FILES["fUrImage"]["tmp_name"], ROOT_PATH . '/img/upload/' . $newfilename);
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
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/user.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>dashboard.php">Dashboard</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>user/user_list.php">Back To User List</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" onSubmit="return validationForm();" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtUrName"> Name * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $u_name;?>" name="txtUrName" id="txtUrName" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            <div class="form-group">
            <label class="col-sm-2 control-label" for="txtUrEmail"> Email * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $u_email;?>" name="txtUrEmail" id="txtUrEmail" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtUrContact"> Contact * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $u_contact;?>" name="txtUrContact" id="txtUrContact" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            <div class="form-group">
            <label class="col-sm-2 control-label" for="txtUrAddress"> Address * </label>
            <div class="col-sm-6">
              <textarea name="txtUrAddress" id="txtUrAddress" class="form-control"><?php echo $u_address;?></textarea>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            <div class="form-group">
            <label class="col-sm-2 control-label" for="txtUrDateOfBirth"> Date of Birth </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $u_dob;?>" name="txtUrDateOfBirth" id="txtUrDateOfBirth" class="form-control datepicker">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlUrGender"> Gender </label>
            <div class="col-sm-6">
              <select class="form-control" id="ddlUrGender" name="ddlUrGender">
              	<option value="">--Select--</option>
                <option <?php if($u_gender =='Male'){echo 'selected';}?> value="Male">Male</option>
                <option <?php if($u_gender =='Female'){echo 'selected';}?> value="Female">Female</option>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtUrReligion"> Religion </label>
            <div class="col-sm-6">
               <select class="form-control" id="txtUrReligion" name="txtUrReligion">
               	<option value="">--Select--</option>
                <option <?php if($u_religion =='Islam'){echo 'selected';}?> value="Islam">Islam</option>
                <option <?php if($u_religion =='Hindu'){echo 'selected';}?> value="Hindu">Hindu</option>
                <option <?php if($u_religion =='Buddish'){echo 'selected';}?> value="Buddish">Buddish</option>
                <option <?php if($u_religion =='Christian'){echo 'selected';}?> value="Christian">Christian</option>
                <option <?php if($u_religion =='Others'){echo 'selected';}?> value="Others">Others</option>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div> 
            <div class="form-group">
            <label class="col-sm-2 control-label" for="txtUrDesignation"> Designation * </label>
            <div class="col-sm-6">
              <select class="form-control" id="txtUrDesignation" name="txtUrDesignation">
               <option value="">--Select--</option>
                <?php 
				  	$result_designation = mysql_query("SELECT * FROM tbl_add_designation order by designation_name ASC",$link);
					while($row_designation = mysql_fetch_array($result_designation)){
				  ?>
                <option <?php if($u_designation == $row_designation['designation_name']){echo 'selected';}?> value="<?php echo $row_designation['designation_name'];?>"><?php echo $row_designation['designation_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>         
             <div class="form-group">
            <label class="col-sm-2 control-label" for="fUrImage">Image</label>
            <div class="col-sm-6" align="left">
             <img src="<?php echo $image; ?>" style="height:100px;width:100px;" id="output"/>
                  <input type="hidden" name="img_exist" value="<?php echo $img_track; ?>" />
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            
          <div class="form-group">
            <label class="col-sm-2 control-label col-xs-8 col-md-2" for="photo"> Upload </label>
           <!-- <div class="col-sm-4 col-xs-6 col-md-4">
              <input disabled="" placeholder="Choose File" id="uploadFile" class="form-control">
            </div>-->
            <div class="col-sm-2 col-xs-6 col-md-2">
              <div class="fileUpload btn btn-success form-control"> <span class="fa fa-repeat"></span> <span>Upload</span>
                <input type="file" name="fUrImage" class="upload" onchange="loadFile(event)" id="fUrImage">
              </div>
            </div>
            <span class="col-sm-4 control-label col-xs-6 col-md-4"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtUrProfileName"> Profile Name * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $u_profile_name;?>" name="txtUrProfileName" id="txtUrProfileName" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="UrPassword"> Password * </label>
            <div class="col-sm-6">
              <input type="password" value="<?php echo $u_password;?>" name="UrPassword" id="UrPassword" class="form-control">
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
  
   <script type="text/javascript">
function validationForm(){
	if($("#txtUrName").val() == ''){
		alert("Name is Required !!!");
		$("#txtUrName").focus();
		return false;
	}
	else if($("#txtUrEmail").val() == ''){
		alert("Email is Required !!!");
		$("#txtUrEmail").focus();
		return false;
	}
	else if($("#txtUrContact").val() == ''){
		alert("Contact Number is Required !!!");
		$("#txtUrContact").focus();
		return false;
	}
	else if($("#txtUrAddress").val() == ''){
		alert("Address is Required !!!");
		$("#txtUrAddress").focus();
		return false;
	}
	else if($("#txtUrDesignation").val() == ''){
		alert("Designation is Required !!!");
		$("#txtUrDesignation").focus();
		return false;
	}
	else if($("#txtUrProfileName").val() == ''){
		alert("Profile Name is Required !!!");
		$("#txtUrProfileName").focus();
		return false;
	}
	else if($("#UrPassword").val() == ''){
		alert("Password is Required !!!");
		$("#UrPassword").focus();
		return false;
	}
	else{
		return true;
	}
}
</script>

  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
