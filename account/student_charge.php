<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$sc_class =  "";
$sc_student = "";
$sc_roll = "";
$sc_type_id = "";
$sc_month = "";
$sc_date = "";
$sc_amount = "";
$title = 'Añadir Pago de Estudiante';
$button_text="Guardar Informacion";
$successful_msg="Add Student Charge Successfully";
$form_url = WEB_URL . "account/student_charge.php";
$id="";
$hdnid="0";

if(isset($_POST['dllStMonth'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql = mysqli_query($link,"INSERT INTO `tbl_add_student_charge`(`sc_class`, `sc_student`, `sc_roll`, `sc_month`,`sc_type_id`, `sc_amount`,`sc_date`) VALUES ('$_POST[dllStClassId]','$_POST[dllStNameId]','$_POST[txtStRollNo]','$_POST[dllStMonth]','$_POST[dllFeeType]','$_POST[txtStAmount]','$_POST[txtStDate]')");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/chargelist.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = mysqli_query($link,"UPDATE `tbl_add_student_charge` SET `sc_class`='".$_POST['dllStClassId']."',`sc_student`='".$_POST['dllStNameId']."',`sc_roll`='".$_POST['txtStRollNo']."',`sc_month`='".$_POST['dllStMonth']."',`sc_type_id`='".$_POST['dllFeeType']."',`sc_amount`='".$_POST['txtStAmount']."',`sc_date`='".$_POST['txtStDate']."' WHERE charge_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/chargelist.php?m=u&cval='.$_POST['hdnCId'];
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_student_charge where charge_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){
		$sc_class = $row['sc_class'];
		$sc_student = $row['sc_student'];
		$sc_roll = $row['sc_roll'];
		$sc_month = $row['sc_month'];
		$sc_type_id = $row['sc_type_id'];
		$sc_amount = $row['sc_amount'];
		$sc_date = $row['sc_date'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Pago Estudiante';
		$button_text="Guardar Informacion";
		$successful_msg="Update Student Charge Successfully";
		$form_url = WEB_URL . "account/student_charge.php?id=".$_GET['id'];
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
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/chargelist.php">Volver a Lista de Pagos</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" action="<?php echo $form_url; ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStClass"> Curso </label>
          <div class="col-sm-6">
            <select class="form-control" onchange="getStudentWithRoll(this.value);" id="dllStClassId" name="dllStClassId">
              <option value="">--Seleccionar--</option>
              <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_class order by c_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($sc_class == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStNameId"> Estudiante </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllStNameId" name="dllStNameId">
			  <option value="">--Seleccionar--</option>
			   <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_student order by s_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($sc_student == $row_class['s_id']){echo 'selected';}?> value="<?php echo $row_class['s_id'];?>"><?php echo $row_class['s_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtStRollNo"> No. Lista </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $sc_roll;?>" name="txtStRollNo" id="txtStRollNo" class="form-control">
          </div>
        </div>
		 <div class="form-group">
          <label class="col-sm-2 control-label" for="dllStMonth"> Seleccionar Mes </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllStMonth" name="dllStMonth">
              <option value="">--Seleccionar--</option>
              <option <?php if($sc_month =='January'){echo 'selected';}?> value="January">January</option>
              <option <?php if($sc_month =='February'){echo 'selected';}?> value="February">February</option>
              <option <?php if($sc_month =='March'){echo 'selected';}?> value="March">March</option>
              <option <?php if($sc_month =='April'){echo 'selected';}?> value="April">April</option>
              <option <?php if($sc_month =='May'){echo 'selected';}?> value="May">May</option>
			  <option <?php if($sc_month =='June'){echo 'selected';}?> value="June">June</option>
			  <option <?php if($sc_month =='July'){echo 'selected';}?> value="July">July</option>
			  <option <?php if($sc_month =='August'){echo 'selected';}?> value="August">August</option>
			  <option <?php if($sc_month =='September'){echo 'selected';}?> value="September">September</option>
			  <option <?php if($sc_month =='October'){echo 'selected';}?> value="October">October</option>
			  <option <?php if($sc_month =='November'){echo 'selected';}?> value="November">November</option>
			  <option <?php if($sc_month =='December'){echo 'selected';}?> value="December">December</option>
            </select>
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="dllFeeType"> Tipo de Pago </label>
          <div class="col-sm-6">
            <select onChange="getTypeFee(this.value);" class="form-control" id="dllFeeType" name="dllFeeType">
              <option value="">--Seleccionar--</option>
               <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_fee_type order by ft_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($sc_type_id == $row_class['ft_id']){echo 'selected';}?> value="<?php echo $row_class['ft_id'];?>"><?php echo $row_class['fee_type'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStAmount"> Cantidad </label>
          <div class="col-sm-6">
		  <div class="input-group">
            <input type="text" readonly="" value="<?php echo $sc_amount;?>" name="txtStAmount" id="txtStAmount" class="form-control">
			<div class="input-group-addon"> <?php echo 'Bs';//CURRENCY;?> </div>
            </div>
          </div>
          </div>
		   <div class="form-group">
          <label class="col-sm-2 control-label" for="txtStDate"> Fecha </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $sc_date;?>" name="txtStDate" id="txtStDate" class="form-control datepicker">
          </div>
         </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-8">
            <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
          </div>
        </div>
        <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
		<input type="hidden" value="<?php echo $sc_class; ?>" name="hdnCId"/>
      </form>
    </div>
  </div>
  <div class="bottom_area"></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
