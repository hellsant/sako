<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$c_name =  "";
$c_numeric =  "";
$c_teacher =  "";
$c_note=  "";
$title = 'Añadir Nuevo Curso';
$button_text="Añadir Curso";
$successful_msg="Add Class Successfully";
$form_url = WEB_URL . "class/add_class.php";
$id="";
$hdnid="0";


if(isset($_POST['txtClName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	  $sql = mysqli_query($link,"INSERT INTO `tbl_add_class`(`c_name`, `c_numeric`, `c_teacher`, `c_note`) VALUES ('$_POST[txtClName]','$_POST[txtClNumeric]','$_POST[ddlClTeacher]','$_POST[txtClNote]')");
	  //echo $sql;
	  //die();
	  mysqli_query($sql,$link);
	  mysqli_close($link);
	  $redirect_url = WEB_URL . 'class/class_list.php?m=i';
	  header('Location: ' . $redirect_url);
	  die();
	
}
else{
	
	$sql = mysqli_query($link,"UPDATE `tbl_add_class` SET `c_name`='".$_POST['txtClName']."',`c_numeric`='".$_POST['txtClNumeric']."',`c_teacher`='".$_POST['ddlClTeacher']."',`c_note`='".$_POST['txtClNote']."' WHERE c_id='".$_GET['id']."'");

	  mysqli_query($sql,$link);
	  mysqli_close($link);
	  $redirect_url = WEB_URL . 'class/class_list.php?m=u';
	  header('Location: ' . $redirect_url);
	  die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_class where c_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){
		$c_name = $row['c_name'];
		$c_numeric = $row['c_numeric'];
		$c_teacher = $row['c_teacher'];
		$c_note = $row['c_note'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Curso';
		$button_text="Actualizar";
		$successful_msg="Update Class Successfully";
		$form_url = WEB_URL . "class/add_class.php?id=".$_GET['id'];
	}
	
	//mysql_close($link);

}
if(isset($_GET['mode']) && $_GET['mode'] == 'view'){
	$title = 'View Nurse Details';
}
	
?>
  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content">
    <div class="header_text_inside">
      <div id="me" style="width:100%;text-align:center;background:#666;color:#fff;margin-bottom:20px; display:none;">
        <?php //echo $successful_msg; ?>
      </div>
      <div class="header_text_left"><?php echo $title; ?></div>
    </div>
    <div class="main_content">
      <div class="main_content_left">
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/class.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>dashboard.php">Ventana Principal</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>class/class_list.php">Volver Lista de Cursos</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" onSubmit="return validationForm();" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtClName"> Nombre Curso * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $c_name;?>" name="txtClName" id="txtClName" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtClNumeric"> Nro Modulo * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $c_numeric;?>" name="txtClNumeric" id="txtClNumeric" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlClTeacher"> Docente de Curso * </label>
            <div class="col-sm-6">
              <select class="form-control" id="ddlClTeacher" name="ddlClTeacher">
                <option value="">--Select--</option>
                <?php 
				  	$result_teacher = mysqli_query($link,"SELECT * FROM tbl_add_teacher order by t_name ASC");
					while($row_teacher = mysqli_fetch_array($result_teacher)){
				  ?>
                <option <?php if($c_teacher == $row_teacher['t_name']){echo 'selected';}?> value="<?php echo $row_teacher['t_name'];?>"><?php echo $row_teacher['t_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtClNote"> Nota de Curso </label>
            <div class="col-sm-6">
              <textarea name="txtClNote" id="txtClNote" style="resize:none;" class="form-control"><?php echo $c_note;?></textarea>
            </div>
            <span class="col-sm-4 control-label"></span></div>
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
	if($("#txtClName").val() == ''){
		alert("Class Name is Required !!!");
		$("#txtClName").focus();
		return false;
	}
	else if($("#txtClNumeric").val() == ''){
		alert("Class Numeric is Required !!!");
		$("#txtClNumeric").focus();
		return false;
	}
	else if($("#ddlClTeacher").val() == ''){
		alert("Class Teacher is Required !!!");
		$("#ddlClTeacher").focus();
		return false;
	}
	else{
		return true;
	}
}
</script>

  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
