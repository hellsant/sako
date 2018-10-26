<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>
<?php 
$success = "none";
$t_name =  "";
$t_month = "";
$t_pay_date = "";
$t_amount = "";
$title = 'Añadir Salario Docente';
$button_text="Guardar Informacion";
$successful_msg="Add Teacher Salary Successfully";
$form_url = WEB_URL . "account/teacher_salary.php";
$id="";
$hdnid="0";

if(isset($_POST['dllTrNameId'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$sql = mysqli_query($link,"INSERT INTO `tbl_add_teacher_salary`(`t_name`, `t_month`, `t_pay_date`, `t_amount`) VALUES ('$_POST[dllTrNameId]','$_POST[dllTrMonth]','$_POST[txtTrDate]','$_POST[txtTrAmount]')");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/t_salarylist.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = mysqli_query($link,"UPDATE `tbl_add_teacher_salary` SET `t_name`='".$_POST['dllTrNameId']."',`t_month`='".$_POST['dllTrMonth']."',`t_pay_date`='".$_POST['txtTrDate']."',`t_amount`='".$_POST['txtTrAmount']."' WHERE t_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'account/t_salarylist.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_teacher_salary where t_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){
		$t_name = $row['t_name'];
		$t_month = $row['t_month'];
		$t_pay_date = $row['t_pay_date'];
		$t_amount = $row['t_amount'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Salario de Docente';
		$button_text="Guardar Informacion";
		$successful_msg="Update Teacher Salary Successfully";
		$form_url = WEB_URL . "account/teacher_salary.php?id=".$_GET['id'];
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
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>account/t_salarylist.php">Lista Salario Docentes</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" action="<?php echo $form_url; ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllTrNameId"> Seleccionar Docente </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllTrNameId" name="dllTrNameId">
			  <option value="">--Seleccionar--</option>
			   <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_teacher order by teacher_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($t_name == $row_class['teacher_id']){echo 'selected';}?> value="<?php echo $row_class['teacher_id'];?>"><?php echo $row_class['t_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllTrMonth"> Seleccionar Mes </label>
          <div class="col-sm-6">
            <select class="form-control" id="dllTrMonth" name="dllTrMonth">
			  <option value="">--Seleccionar Mes--</option>
			  <?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_month order by mid asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if($t_month == $row_class['mid']){echo 'selected';}?> value="<?php echo $row_class['mid'];?>"><?php echo $row_class['m_name'];?></option>
          <?php }?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtTrDate"> Fecha Pago </label>
          <div class="col-sm-6">
            <input type="text" value="<?php echo $t_pay_date;?>" name="txtTrDate" id="txtTrDate" class="form-control datepicker">
          </div>
         </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="txtTrAmount"> Cantidad </label>
          <div class="col-sm-6">
		  <div class="input-group">
            <input type="text" value="<?php echo $t_amount;?>" name="txtTrAmount" id="txtTrAmount" class="form-control">
			<div class="input-group-addon"> <?php echo 'Bs';?> </div>
            </div>
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
