<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$class_name_id =  "";
$f_type_id = "";
$f_fee = "0.00";
$f_date = "";
$f_fine = "0.00";
$fine_date = "";
$title = 'Añadir Tarifa';
$button_text="Guardar Informacion";
$successful_msg="Add Fee Successfully";
$form_url = WEB_URL . "account/fee_set.php";
$id="";
$hdnid="0";

if(isset($_POST['dllFClass'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql = mysqli_query($link,"INSERT INTO `tbl_add_fee_set`(`class_name_id`, `f_type_id`, `f_fee`, `f_date`,`f_fine`,`fine_date`) VALUES ('$_POST[dllFClass]','$_POST[dllFeeType]','$_POST[txtFee]','$_POST[txtFeeDate]','$_POST[txtFine]','$_POST[txtFineDate]')");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/fee_set_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = mysqli_query($link,"UPDATE `tbl_add_fee_set` SET `class_name_id`='".$_POST['dllFClass']."',`f_type_id`='".$_POST['dllFeeType']."',`f_fee`='".$_POST['txtFee']."',`f_date`='".$_POST['txtFeeDate']."',`f_fine`='".$_POST['txtFine']."',`fine_date`='".$_POST['txtFineDate']."' WHERE fs_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/fee_set_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_fee_set where fs_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){
		$class_name_id = $row['class_name_id'];
		$f_type_id = $row['f_type_id'];
		$f_fee = $row['f_fee'];
		$f_date = $row['f_date'];
		$f_fine = $row['f_fine'];
		$fine_date = $row['fine_date'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Tarifa';
		$button_text="Guardar Informacion";
		$successful_msg="Update Fee Successfully";
		$form_url = WEB_URL . "account/fee_set.php?id=".$_GET['id'];
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
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/fee_set_list.php">Lista de Tarifas</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" action="<?php echo $form_url; ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllFClass"> Curso </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllFClass" name="dllFClass">
			  <option value="">--Seleccionar--</option>
			    <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_class order by c_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($class_name_id == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllFeeType"> Tipo de Pago </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllFeeType" name="dllFeeType">
              <option value="">--Seleccionar--</option>
               <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_fee_type order by ft_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($f_type_id == $row_class['ft_id']){echo 'selected';}?> value="<?php echo $row_class['ft_id'];?>"><?php echo $row_class['fee_type'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="txtFee"> Cantidad Bs. </label>
          <div class="col-sm-6">
		  <div class="input-group">
            <input type="text" value="<?php echo $f_fee;?>" name="txtFee" id="txtFee" class="form-control">
			<div class="input-group-addon"> <?php echo 'Bs';?> </div>
            </div>
          </div>
         </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtFeeDate"> Fecha </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $f_date;?>" name="txtFeeDate" id="txtFeeDate" class="form-control datepicker">
          </div>
         </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtFine"> Multa Bs. </label>
          <div class="col-sm-6">
		  <div class="input-group">
            <input type="text" value="<?php echo $f_fine;?>" name="txtFine" id="txtFine" class="form-control">
			<div class="input-group-addon"> <?php echo 'Bs';?> </div>
            </div>
          </div>
          </div>
		  <div class="form-group">
          <label class="col-sm-2 control-label" for="txtFineDate"> Fecha con Multa </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $fine_date;?>" name="txtFineDate" id="txtFineDate" class="form-control datepicker">
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
