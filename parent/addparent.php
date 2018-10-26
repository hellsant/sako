<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$p_student_name_id =  "";
$p_student_class_id = "";
$p_student_roll ="";
$p_guardian =  "";
$p_father_name =  "";
$p_father_profession =  "";
$p_mother_name =  "";
$p_mother_profession =  "";
$p_email =  "";
$p_contact =  "";
$p_address =  "";
$p_religion =  "";
$p_image =  "";
$p_profile_name =  "";
$p_password =  "";
$title = 'Add New Parent';
$button_text="Save Information";
$successful_msg="Add Parent Successfully";
$form_url = WEB_URL . "parent/parentlist.php";
$id="";
$hdnid="0";

$image = WEB_URL . 'img/no_image.jpg';
$img_track = '';

if(isset($_POST['txtStGuardianName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$image_url = uploadImage();	
	$sql =mysqli_query($link,"INSERT INTO `tbl_add_parent`(`p_guardian`, `p_father_name`, `p_father_profession`, `p_mother_name`, `p_mother_profession`, `p_email`, `p_contact`, `p_address`, `p_religion`, `p_image`, `p_profile_name`, `p_password`) VALUES ('$_POST[txtStGuardianName]','$_POST[txtStFatherName]','$_POST[txtStFatherProfession]','$_POST[txtStMotherName]','$_POST[txtStMotherProfession]','$_POST[txtPtEmail]','$_POST[txtPtContact]','$_POST[txtPtAddress]','$_POST[txtPtReligion]','$image_url','$_POST[txtPtProfileName]','$_POST[PtPassword]')");
	mysqli_query($sql,$link);
	//here we make relation student to parent many
	/*$p_id = mysql_insert_id();
	foreach($_POST['dllStNameId'] as $sid){
		$sqlx = "INSERT INTO `tbl_parents_student_relation`(`parent_id`,`student_id`) VALUES ('$p_id','$sid')";
		mysql_query($sqlx,$link);
	}*/
	/**************************************/
	mysqli_close($link);
	$redirect_url = WEB_URL . 'parent/parentlist.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$image_url = uploadImage();	
		
		if($image_url == ''){
			$image_url = $_POST['img_exist'];
		}
	
	$sql =mysqli_query($link,"UPDATE `tbl_add_parent` SET `p_guardian`='".$_POST['txtStGuardianName']."',`p_father_name`='".$_POST['txtStFatherName']."',`p_father_profession`='".$_POST['txtStFatherProfession']."',`p_mother_name`='".$_POST['txtStMotherName']."',`p_mother_profession`='".$_POST['txtStMotherProfession']."',`p_email`='".$_POST['txtPtEmail']."',`p_contact`='".$_POST['txtPtContact']."',`p_address`='".$_POST['txtPtAddress']."',`p_religion`='".$_POST['txtPtReligion']."',`p_image`='".$image_url."',`p_profile_name`='".$_POST['txtPtProfileName']."',`p_password`='".$_POST['PtPassword']."' WHERE p_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'parent/parentlist.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"Select * from tbl_add_parent where p_id='".$_GET['id']."'");
	while($row = mysqli_fetch_array($result)){
		if($row['p_image'] != ''){
			$image = WEB_URL . 'img/upload/' . $row['p_image'];
			$img_track = $row['p_image'];
		}
		$p_guardian = $row['p_guardian'];
		$p_father_name = $row['p_father_name'];
		$p_father_profession = $row['p_father_profession'];
		$p_mother_name = $row['p_mother_name'];
		$p_mother_profession = $row['p_mother_profession'];
		$p_email = $row['p_email'];
		$p_contact = $row['p_contact'];
		$p_address = $row['p_address'];
		$p_religion = $row['p_religion'];
		$p_image = $row['p_image'];
		$p_profile_name = $row['p_profile_name'];
		$p_password = $row['p_password'];
		$hdnid = $_GET['id'];
		$title = 'Update Parent';
		$button_text="Update Information";
		$successful_msg="Update Parent Successfully";
		$form_url = WEB_URL . "parent/parentlist.php?id=".$_GET['id'];
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
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/parent.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>dashboard.php">Dashboard</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>parent/parentlist.php">Back To Parent List</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" onSubmit="return validationForm();" method="post" role="form" class="form-horizontal">
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtStGuardianName"></label>
		  <div class="col-sm-6">
            <div id="add_student"></div>
			<div style="clear:both;"></div>
          </div>
          <span class="col-sm-4 control-label"> </span>
		</div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStGuardianName"> Gardiun Name * </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $p_guardian;?>" name="txtStGuardianName" id="txtStGuardianName" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStFatherName"> Father's Name * </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $p_father_name;?>" name="txtStFatherName" id="txtStFatherName" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStFatherProfession"> Profession </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $p_father_profession;?>" name="txtStFatherProfession" id="txtStFatherProfession" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStMotherName"> Mother's Name </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $p_mother_name;?>" name="txtStMotherName" id="txtStMotherName" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStMotherProfession"> Profession </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $p_mother_profession;?>" name="txtStMotherProfession" id="txtStMotherProfession" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtPtEmail"> Email * </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $p_email;?>" name="txtPtEmail" id="txtPtEmail" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtPtContact"> Telephone * </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $p_contact;?>" name="txtPtContact" id="txtPtContact" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtPtAddress"> Address * </label>
          <div class="col-sm-6">
            <textarea name="txtPtAddress" id="txtPtAddress" class="form-control"><?php echo $p_address;?></textarea>
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtPtReligion"> Religion </label>
          <div class="col-sm-6">
            <select class="form-control" id="txtPtReligion" name="txtPtReligion">
              <option value="">--Select--</option>
              <option <?php if($p_religion =='Islam'){echo 'selected';}?> value="Islam">Islam</option>
              <option <?php if($p_religion =='Hindu'){echo 'selected';}?> value="Hindu">Hindu</option>
              <option <?php if($p_religion =='Buddish'){echo 'selected';}?> value="Buddish">Buddish</option>
              <option <?php if($p_religion =='Christian'){echo 'selected';}?> value="Christian">Christian</option>
              <option <?php if($p_religion =='Others'){echo 'selected';}?> value="Others">Others</option>
            </select>
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtPtImage">Image</label>
          <div class="col-sm-6" align="left"> <img src="<?php echo $image; ?>" style="height:100px;width:100px;" id="output"/>
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
              <input type="file" name="fStImage" class="upload" onchange="loadFile(event)" id="fStImage">
            </div>
          </div>
          <span class="col-sm-4 control-label col-xs-6 col-md-4"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtPtProfileName"> Profile Name * </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $p_profile_name;?>" name="txtPtProfileName" id="txtPtProfileName" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="PtPassword"> Password * </label>
          <div class="col-sm-6">
            <input type="password" value="<?php echo $p_password;?>" name="PtPassword" id="PtPassword" class="form-control">
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
	if($("#txtStGuardianName").val() == ''){
		alert("Guardian Name is Required !!!");
		$("#txtStGuardianName").focus();
		return false;
	}
	else if($("#txtStFatherName").val() == ''){
		alert("Father Name is Required !!!");
		$("#txtStFatherName").focus();
		return false;
	}
	else if($("#txtPtEmail").val() == ''){
		alert("Email is Required !!!");
		$("#txtPtEmail").focus();
		return false;
	}
	else if($("#txtPtContact").val() == ''){
		alert("Contact Number is Required !!!");
		$("#txtPtContact").focus();
		return false;
	}
	else if($("#txtPtAddress").val() == ''){
		alert("Address is Required !!!");
		$("#txtPtAddress").focus();
		return false;
	}
	else if($("#txtPtProfileName").val() == ''){
		alert("Profile Name is Required !!!");
		$("#txtPtProfileName").focus();
		return false;
	}
	else if($("#PtPassword").val() == ''){
		alert("Password is Required !!!");
		$("#PtPassword").focus();
		return false;
	}
	else{
		return true;
	}
}
</script>

<?php include('../copyright.php');?>
<?php include('../footer.php');?>
