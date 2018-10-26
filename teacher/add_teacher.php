<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$t_name =  "";
$t_designation =  "";
$t_dob =  "";
$t_gender =  "";
$t_religion =  "";
$t_email =  "";
$t_phone =  "";
$t_address =  "";
$t_joining_date =  "";
$t_photo =  "";
$t_username =  "";
$t_password =  "";
$title = 'Añadir Nuevo Docente';//avida fuler  $title = 'Add New Teacher';
$button_text="Guardar";   //$button_text="Save";
$successful_msg="Add Teacher Successfully";
$form_url = WEB_URL . "teacher/add_teacher.php";
$id="";
$hdnid="0";

$image = WEB_URL . 'img/no_image.jpg';
$img_track = '';

if(isset($_POST['txtTrName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	
	$image_url = uploadImage();	
	
	$sql = mysqli_query($link,"INSERT INTO `tbl_add_teacher`(`t_name`, `t_designation`, `t_dob`, `t_gender`, `t_religion`, `t_email`, `t_phone`, `t_address`, `t_joining_date`,`t_photo`,`t_username`, `t_password`) VALUES ('$_POST[txtTrName]','$_POST[txtTrDesignation]','$_POST[txtTrDateOfBirth]','$_POST[ddlTrSex]','$_POST[txtTrReligion]','$_POST[txtTrEmail]','$_POST[txtTrPhone]','$_POST[txtTrAddress]','$_POST[txtTrJoiningDate]','$image_url','$_POST[txtTrProfile]','$_POST[password]')");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'teacher/teacher_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$image_url = uploadImage();	
		
		if($image_url == ''){
			$image_url = $_POST['img_exist'];
		}
	
	$sql = mysqli_query($link,"UPDATE `tbl_add_teacher` SET `t_name`='".$_POST['txtTrName']."',`t_designation`='".$_POST['txtTrDesignation']."',`t_dob`='".$_POST['txtTrDateOfBirth']."',`t_gender`='".$_POST['ddlTrSex']."',`t_religion`='".$_POST['txtTrReligion']."',`t_email`='".$_POST['txtTrEmail']."',`t_phone`='".$_POST['txtTrPhone']."',`t_address`='".$_POST['txtTrAddress']."',`t_joining_date`='".$_POST['txtTrJoiningDate']."',`t_photo`='".$image_url."',`t_username`='".$_POST['txtTrProfile']."',`t_password`='".$_POST['password']."' WHERE teacher_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'teacher/teacher_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_teacher where teacher_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){
		if($row['t_photo'] != ''){
			$image = WEB_URL . 'img/upload/' . $row['t_photo'];
			$img_track = $row['t_photo'];
		}
		$t_name = $row['t_name'];
		$t_designation = $row['t_designation'];
		$t_dob = $row['t_dob'];
		$t_gender = $row['t_gender'];
		$t_religion = $row['t_religion'];
		$t_email = $row['t_email'];
		$t_phone = $row['t_phone'];
		$t_address = $row['t_address'];
		$t_joining_date = $row['t_joining_date'];
		$t_username = $row['t_username'];
		$t_password = $row['t_password'];
		$t_photo = $row['t_photo'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Docente';  //$title = 'Update Teacher';
		$button_text="Actualizar";
		$successful_msg="Update Teacher Successfully";
		$form_url = WEB_URL . "teacher/add_teacher.php?id=".$_GET['id'];
	}
	
	//mysql_close($link);

}

function uploadImage(){
	if((!empty($_FILES["fTrImage"])) && ($_FILES['fTrImage']['error'] == 0)) {
	  $filename = basename($_FILES['fTrImage']['name']);
	  $ext = substr($filename, strrpos($filename, '.') + 1);
	  if(($ext == "jpg" && $_FILES["fTrImage"]["type"] == 'image/jpeg') || ($ext == "png" && $_FILES["fTrImage"]["type"] == 'image/png') || ($ext == "gif" && $_FILES["fTrImage"]["type"] == 'image/gif')){   
	  	$temp = explode(".",$_FILES["fTrImage"]["name"]);
	  	$newfilename = rand(1,99999) . uniqid() . '.' .end($temp);
	  	move_uploaded_file($_FILES["fTrImage"]["tmp_name"], ROOT_PATH . '/img/upload/' . $newfilename);
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
      <div id="PreviewImage" class="header_text_left"><?php echo $title; ?></div>
    </div>
    <div class="main_content">
      <div class="main_content_left">
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/tr.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>dashboard.php">Ventana Principal</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>teacher/teacher_list.php">Volver a Lista de Docentes</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" onSubmit="return validationForm();" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrName"> Nombre * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $t_name;?>" name="txtTrName" id="txtTrName" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrEmail"> Email * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $t_email;?>" name="txtTrEmail" id="txtTrEmail" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrPhone"> Celular * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $t_phone;?>" name="txtTrPhone" id="txtTrPhone" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrAddress"> Direccion * </label>
            <div class="col-sm-6">
              <textarea name="txtTrAddress" id="txtTrAddress" class="form-control"><?php echo $t_address;?></textarea>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrDesignation"> Cargo * </label>
            <div class="col-sm-6">
              <select class="form-control" id="txtTrDesignation" name="txtTrDesignation">
               <option value="">--Seleccionar--</option>
                <?php 
				  	$result_designation = mysqli_query($link,"SELECT * FROM tbl_add_designation order by designation_name ASC");
					while($row_designation = mysqli_fetch_array($result_designation)){
				  ?>
                <option <?php if($t_designation == $row_designation['designation_name']){echo 'selected';}?> value="<?php echo $row_designation['designation_name'];?>"><?php echo $row_designation['designation_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrDateOfBirth"> Fecha Nacimiento </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $t_dob;?>" name="txtTrDateOfBirth" id="txtTrDateOfBirth" class="form-control datepicker">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlTrSex"> Genero </label>
            <div class="col-sm-6">
              <select class="form-control" id="ddlTrSex" name="ddlTrSex">
              	<option value="">--Seleccionar--</option>
                <option <?php if($t_gender =='Maculino'){echo 'selected';}?> value="Masculino">Masculino</option>
                <option <?php if($t_gender =='Femenino'){echo 'selected';}?> value="Femenenino">Femenino</option>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrReligion"> Religion </label>
            <div class="col-sm-6">
               <select class="form-control" id="txtTrReligion" name="txtTrReligion">
               	<option value="">--Seleccionar--</option>
                <option <?php if($t_religion =='Islam'){echo 'selected';}?> value="Islam">Islam</option>
                <option <?php if($t_religion =='Hindu'){echo 'selected';}?> value="Hindu">Hindu</option>
                <option <?php if($t_religion =='Buddish'){echo 'selected';}?> value="Buddish">Buddish</option>
                <option <?php if($t_religion =='Christian'){echo 'selected';}?> value="Christian">Christian</option>
                <option <?php if($t_religion =='Others'){echo 'selected';}?> value="Others">Others</option>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrJoiningDate"> Dia de Ingreso </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $t_joining_date;?>" name="txtTrJoiningDate" id="txtTrJoiningDate" class="form-control datepicker">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrImage">Imagen</label>
            <div class="col-sm-6" align="left">
             <img src="<?php echo $image; ?>" style="height:100px;width:100px;" id="output"/>
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
                <input type="file" name="fTrImage" class="upload" onchange="loadFile(event)" id="fTrImage">
              </div>
            </div>
            <span class="col-sm-4 control-label col-xs-6 col-md-4"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrProfile"> Nombre Perfil * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $t_username;?>" name="txtTrProfile" id="txtTrProfile" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="password"> Password * </label>
            <div class="col-sm-6">
              <input type="password" value="<?php echo $t_password;?>" name="password" id="password" class="form-control">
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
	if($("#txtTrName").val() == ''){
		alert("Name is Required !!!");
		$("#txtTrName").focus();
		return false;
	}
	else if($("#txtTrEmail").val() == ''){
		alert("Email is Required !!!");
		$("#txtTrEmail").focus();
		return false;
	}
	else if($("#txtTrPhone").val() == ''){
		alert("Phone Number is Required !!!");
		$("#txtTrPhone").focus();
		return false;
	}
	else if($("#txtTrAddress").val() == ''){
		alert("Address is Required !!!");
		$("#txtTrAddress").focus();
		return false;
	}
	else if($("#txtTrDesignation").val() == ''){
		alert("Designation is Required !!!");
		$("#txtTrDesignation").focus();
		return false;
	}
	else if($("#txtTrProfile").val() == ''){
		alert("Profile Name is Required !!!");
		$("#txtTrProfile").focus();
		return false;
	}
	else if($("#password").val() == ''){
		alert("Password is Required !!!");
		$("#password").focus();
		return false;
	}
	else{
		return true;
	}
}
</script>

  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
