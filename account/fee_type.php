<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$fee_type =  "";
$fee_note = "";
$title = 'Añadir Tipo de Pago';
$button_text="Guardar Informacion";
$successful_msg="Add Fee Type Successfully";
$form_url = WEB_URL . "account/fee_type.php";
$id="";
$hdnid="0";

if(isset($_POST['txtFeeType'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql = mysqli_query($link,"INSERT INTO `tbl_add_fee_type`(`fee_type`,`fee_note`) VALUES ('$_POST[txtFeeType]','$_POST[txtFeeNote]')");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/fee_type_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql =mysqli_query($link,"UPDATE `tbl_add_fee_type` SET `fee_type`='".$_POST['txtFeeType']."',`fee_note`='".$_POST['txtFeeNote']."' WHERE ft_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/fee_type_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_fee_type where ft_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){
		$fee_type = $row['fee_type'];
		$fee_note = $row['fee_note'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Tipo de Pago';
		$button_text="Actualizar Informacion";
		$successful_msg="Update Fee Type Successfully";
		$form_url = WEB_URL . "account/fee_type.php?id=".$_GET['id'];
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
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/e_salary.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/account.php">Ventana de Pagos</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/fee_type_list.php">Lista de Tipos de Pagos</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" action="<?php echo $form_url; ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtFeeType"> Tipo de Pago </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $fee_type;?>" name="txtFeeType" id="txtFeeType" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtFeeNote"> Nota </label>
          <div class="col-sm-6">
            <textarea name="txtFeeNote" id="txtFeeNote" class="form-control"><?php echo $fee_note;?></textarea>
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
