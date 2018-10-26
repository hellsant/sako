<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>
<?php 
$success = "none";
$s_name =  "";
$parent_id = "";
$s_email =  "";
$p_name = "";
$s_contact =  "";
$s_address =  "";
$s_dob =  "";
$s_class_id =  "";
$s_roll_no =  "";
$s_gender =  "";
$s_religion =  "";
$s_image =  "";
$s_profile_name =  "";
$s_password =  "";
$title = 'Añadir Nuevo Estudiante';
$button_text="Guardar";
$successful_msg="Add Student Successfully";
$form_url = WEB_URL . "student/add_student.php";
$id="";
$hdnid="0";

$image = WEB_URL . 'img/no_image.jpg';
$img_track = '';

if(isset($_POST['txtStName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	
	$image_url = uploadImage();	
	
	$sql = mysqli_query($link,"INSERT INTO `tbl_add_student`(`s_name`,`parent_id`,`s_email`, `s_contact`, `s_address`, `s_dob`, `s_class_id`, `s_roll_no`, `s_gender`, `s_religion`, `s_image`, `s_profile_name`, `s_password`) VALUES ('$_POST[txtStName]','$_POST[hdnParentId]','$_POST[txtStEmail]','$_POST[txtStContact]','$_POST[txtStAddress]','$_POST[txtStDateOfBirth]','$_POST[txtStClassId]','$_POST[txtStRollNo]','$_POST[ddlStGender]','$_POST[txtStReligion]','$image_url','$_POST[txtStProfileName]','$_POST[StPassword]')");
	//echo $sql;
	//die();
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'student/student_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$image_url = uploadImage();	
		
		if($image_url == ''){
			$image_url = $_POST['img_exist'];
		}
	
	$sql =mysqli_query($link,"UPDATE `tbl_add_student` SET `s_name`='".$_POST['txtStName']."',`parent_id`='".$_POST['hdnParentId']."',`s_email`='".$_POST['txtStEmail']."',`s_contact`='".$_POST['txtStContact']."',`s_address`='".$_POST['txtStAddress']."',`s_dob`='".$_POST['txtStDateOfBirth']."',`s_class_id`='".$_POST['txtStClassId']."',`s_roll_no`='".$_POST['txtStRollNo']."',`s_gender`='".$_POST['ddlStGender']."',`s_religion`='".$_POST['txtStReligion']."',`s_image`='".$image_url."',`s_profile_name`='".$_POST['txtStProfileName']."',`s_password`='".$_POST['StPassword']."' WHERE s_id='".$_GET['id']."'");
	//$sql = "UPDATE tbl_add_student SET s_name='".$_POST['txtStName']."',parent_id='".$_POST['hdnParentId']."',s_email='".$_POST['txtStEmail']."',`s_contact`='".$_POST['txtStContact']."',`s_address`='".$_POST['txtStAddress']."',`s_dob`='".$_POST['txtStDateOfBirth']."',`s_class_id`='".$_POST['txtStClassId']."',`s_roll_no`='".$_POST['txtStRollNo']."',`s_gender`='".$_POST['ddlStGender']."',`s_religion`='".$_POST['txtStReligion']."',`s_image`='".$image_url."',`s_profile_name`='".$_POST['txtStProfileName']."',`s_password`='".$_POST['StPassword']."' WHERE s_id='".$_GET['id']."'";
	mysqli_query($link,$sql);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'student/student_list.php?m=u&cid='.$_POST['hdnCId'];
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT *,p.p_father_name FROM tbl_add_student s inner join tbl_add_parent p on p.p_id = s.parent_id where s.s_id = '" . $_GET['id'] . "'");
	//$result = mysql_query("SELECT * FROM tbl_add_student where s_id = '" . $_GET['id'] . "'",$link);
	while($row = mysqli_fetch_array($result)){
		if($row['s_image'] != ''){
			$image = WEB_URL . 'img/upload/' . $row['s_image'];
			$img_track = $row['s_image'];
		}
		$s_name = $row['s_name'];
		$p_name = $row['p_father_name'];
		$parent_id = $row['parent_id'];
		$s_email = $row['s_email'];
		$s_contact = $row['s_contact'];
		$s_address = $row['s_address'];
		$s_dob = $row['s_dob'];
		$s_class_id = $row['s_class_id'];
		$s_roll_no = $row['s_roll_no'];
		$s_gender = $row['s_gender'];
		$s_religion = $row['s_religion'];
		$s_image = $row['s_image'];
		$s_profile_name = $row['s_profile_name'];
		$s_password = $row['s_password'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Estudiante';
		$button_text="Actualizar";
		$successful_msg="Update Student Successfully";
		$form_url = WEB_URL . "student/add_student.php?id=".$_GET['id'];
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
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/student.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>dashboard.php">Ventana Principal</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>student/student_list.php">Volver Lista de Estudiantes</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" onSubmit="return validationForm();" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtParents"> Grado de Instruccion * </label>
          <div class="col-sm-6">
            <input type="text" name="txtParents" id="txtParents" value="<?php echo $p_name;?>" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtStName"> Nombre * </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $s_name;?>" name="txtStName" id="txtStName" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStEmail"> Email * </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $s_email;?>" name="txtStEmail" id="txtStEmail" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStContact"> Celular * </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $s_contact;?>" name="txtStContact" id="txtStContact" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStAddress"> Direccion </label>
          <div class="col-sm-6">
            <textarea name="txtStAddress" id="txtStAddress" class="form-control"><?php echo $s_address;?></textarea>
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStDateOfBirth"> Fecha Nacimiento </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $s_dob;?>" name="txtStDateOfBirth" id="txtStDateOfBirth" class="form-control datepicker">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStClassId"> Nombre Curso * </label>
          <div class="col-sm-6">
            <select class="form-control" id="txtStClassId" name="txtStClassId">
              <option value="">--Select--</option>
              <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_class order by c_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($s_class_id == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStRollNo"> No Lista * </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $s_roll_no;?>" name="txtStRollNo" id="txtStRollNo" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="ddlStGender"> Genero </label>
          <div class="col-sm-6">
            <select class="form-control" id="ddlStGender" name="ddlStGender">
              <option value="">--Select--</option>
              <option <?php if($s_gender =='Masculino'){echo 'selected';}?> value="Masculino">Masculino</option>
              <option <?php if($s_gender =='Femenino'){echo 'selected';}?> value="Femenino">Femenino</option>
            </select>
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStReligion"> Religion </label>
          <div class="col-sm-6">
            <select class="form-control" id="txtStReligion" name="txtStReligion">
              <option value="">--Select--</option>
              <option <?php if($s_religion =='Islam'){echo 'selected';}?> value="Islam">Islam</option>
              <option <?php if($s_religion =='Hindu'){echo 'selected';}?> value="Hindu">Hindu</option>
              <option <?php if($s_religion =='Buddish'){echo 'selected';}?> value="Buddish">Buddish</option>
              <option <?php if($s_religion =='Christian'){echo 'selected';}?> value="Christian">Christian</option>
              <option <?php if($s_religion =='Others'){echo 'selected';}?> value="Others">Others</option>
            </select>
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStImage">Imagen</label>
          <div class="col-sm-6" align="left"> <img src="<?php echo $image; ?>" style="height:100px;width:100px;" id="output"/>
            <input type="hidden" name="img_exist" value="<?php echo $img_track; ?>" />
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label col-xs-8 col-md-2" for="photo"> Subir </label>
          <!-- <div class="col-sm-4 col-xs-6 col-md-4">
              <input disabled="" placeholder="Choose File" id="uploadFile" class="form-control">
            </div>-->
          <div class="col-sm-2 col-xs-6 col-md-2">
            <div class="fileUpload btn btn-success form-control"> <span class="fa fa-repeat"></span> <span>Upload</span>
			
			<!--Macanas-->
			
			
			
			
              <input type="file" name="fStImage" class="upload" onchange="loadFile(event)" id="fStImage">
            </div>
          </div>
          <span class="col-sm-4 control-label col-xs-6 col-md-4"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStProfileName"> Nombre Perfil * </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $s_profile_name;?>" name="txtStProfileName" id="txtStProfileName" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="StPassword"> Password * </label>
          <div class="col-sm-6">
            <input type="password" value="<?php echo $s_password;?>" name="StPassword" id="StPassword" class="form-control">
          </div>
          <span class="col-sm-4 control-label"> </span> </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-8">
            <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
          </div>
        </div>
        <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
		<input type="hidden" value="<?php echo $s_class_id; ?>" name="hdnCId"/>
		<input type="hidden" value="<?php echo $parent_id; ?>" name="hdnParentId" id="hdnParentId"/>
      </form>
    </div>
  </div>
  <div class="bottom_area"></div>
</div>
<script type="text/javascript">
function validationForm(){
	if($("#txtParents").val() == ''){
			alert("Parent is Required !!!");
			$("#txtParents").focus();
			return false;
		}
	else if($("#txtStName").val() == ''){
		alert("Name is Required !!!");
		$("#txtStName").focus();
		return false;
	}
	else if($("#txtStEmail").val() == ''){
		alert("Email is Required !!!");
		$("#txtStEmail").focus();
		return false;
	}
	else if($("#txtStContact").val() == ''){
		alert("Contact Number is Required !!!");
		$("#txtStContact").focus();
		return false;
	}
	else if($("#txtStClassId").val() == ''){
		alert("Class Name is Required !!!");
		$("#txtStClassId").focus();
		return false;
	}
	else if($("#txtStRollNo").val() == ''){
		alert("Roll Number is Required !!!");
		$("#txtStRollNo").focus();
		return false;
	}
	else if($("#txtStProfileName").val() == ''){
		alert("Profile Name is Required !!!");
		$("#txtStProfileName").focus();
		return false;
	}
	else if($("#StPassword").val() == ''){
		alert("Password is Required !!!");
		$("#StPassword").focus();
		return false;
	}
	else{
		return true;
	}
}

$(document).ready(function(){
  $("#txtParents").autocomplete({
    source: "<?php echo WEB_URL; ?>ajax/getparentsinfo.php" // name of controller followed by function
  }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        var inner_html = '<a href="javascript:;" onclick="setParentsValue('+item.id+');"><div class="list_item_container"><div class="image"><img class="photo_img_round" style="width:60px;height:60px;" src="<?php echo WEB_URL; ?>img/upload/' + item.image + '"></div><div class="label">Name: ' + item.label + '</div><div class="description">National Card: ' + item.description + '</div></div></a>';
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append(inner_html)
            .appendTo( ul );
    };
});
function setParentsValue(id){
	$("#hdnParentId").val(id);
}
</script>
<style type="text/css">
.list_item_container {
    width:300px;
    height: 60px;
}
.list_item_container .label{
	color:#000 !important;
	font-weight:bold !important;
	padding:0 !important;
}
.list_item_container .image {
    width: 60px;
    height: 60px;
    margin-right: 10px;
    float: left;
}
.description {
    font-size: 0.8em;
    color: #000;
}
</style>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
