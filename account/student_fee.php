<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$sf_class_id =  "";
$sf_name_id = "";
$sf_roll = "";
$sf_exam_type = "";
$sf_date = "";
$sf_amount = "";
$title = 'Añadir Pago de Estudiante';
$button_text="Guardar Informacion";
$successful_msg="Add Student Fee Successfully";
$form_url = WEB_URL . "account/student_fee.php";
$id="";
$hdnid="0";

if(isset($_POST['dllStExmType'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql = mysqli_query($link,"INSERT INTO `tbl_student_fee`(`sf_class_id`, `sf_name_id`, `sf_roll`, `sf_exam_type`, `sf_date`, `sf_amount`) VALUES ('$_POST[dllStClassId]','$_POST[dllStNameId]','$_POST[txtStRollNo]','$_POST[dllStExmType]','$_POST[txtStDate]','$_POST[txtStAmount]')");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/feelist.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = mysqli_query($link,"UPDATE `tbl_student_fee` SET `sf_class_id`='".$_POST['dllStClassId']."',`sf_name_id`='".$_POST['dllStNameId']."',`sf_roll`='".$_POST['txtStRollNo']."',`sf_exam_type`='".$_POST['dllStExmType']."',`sf_date`='".$_POST['txtStDate']."',`sf_amount`='".$_POST['txtStAmount']."' WHERE sf_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/feelist.php?m=u&cval='.$_POST['hdnCId'];
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_student_fee where sf_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){
		$sf_class_id = $row['sf_class_id'];
		$sf_name_id = $row['sf_name_id'];
		$sf_roll = $row['sf_roll'];
		$sf_exam_type = $row['sf_exam_type'];
		$sf_date = $row['sf_date'];
		$sf_amount = $row['sf_amount'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Pago Estudiante';
		$button_text="Actualizar Informacion";
		$successful_msg="Update Student Fee Successfully";
		$form_url = WEB_URL . "account/student_fee.php?id=".$_GET['id'];
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
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/charge.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/account.php">Ventana de Pagos</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/feelist.php">Volver a Lista Ex.Extraord</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" action="<?php echo $form_url; ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStClassId"> Seleccionar Curso </label>
          <div class="col-sm-6">
            <select class="form-control" onchange="getStudentWithRoll(this.value);" id="dllStClassId" name="dllStClassId">
              <option value="">--Seleccionar--</option>
              <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_class order by c_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($sf_class_id == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStNameId"> Seleccionar Estudiante </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllStNameId" name="dllStNameId">
			  <option value="">--Seleccionar--</option>
			   <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_student order by s_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($sf_name_id == $row_class['s_id']){echo 'selected';}?> value="<?php echo $row_class['s_id'];?>"><?php echo $row_class['s_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtStRollNo"> No Lista </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $sf_roll;?>" name="txtStRollNo" id="txtStRollNo" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStExmType"> Tipo Examen </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllStExmType" name="dllStExmType">
			  <option value="">--Seleccionar--</option>
			   <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_schedule_setup order by schedule_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($sf_exam_type == $row_class['schedule_id']){echo 'selected';}?> value="<?php echo $row_class['schedule_id'];?>"><?php echo $row_class['schedule_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStDate"> Fecha </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $sf_date;?>" name="txtStDate" id="txtStDate" class="form-control datepicker">
          </div>
         </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStAmount"> Cantidad </label>
          <div class="col-sm-6">
		  <div class="input-group">
            <input type="text" value="<?php echo $sf_amount;?>" name="txtStAmount" id="txtStAmount" class="form-control">
			<div class="input-group-addon"><?php echo 'Bs'//CURRENCY;?> </div>
            </div>
          </div>
          </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-8">
            <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
          </div>
        </div>
        <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
		<input type="hidden" value="<?php echo $sf_class_id; ?>" name="hdnCId"/>
      </form>
    </div>
  </div>
  <div class="bottom_area"></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
