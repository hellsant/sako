<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$ex_name =  "";
$ex_class_id =  "";
$ex_date =  "";
$ex_note =  "";
$title = 'Añadir Nueva Fecha de Examen';
$button_text="Guardar Informacion";
$id="";
$hdnid="0";

if(isset($_POST['dllExName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	
	$sql = mysqli_query($link,"INSERT INTO `tbl_add_exam_date`(`ex_name`,`ex_class_id`,`ex_date`, `ex_note`) VALUES ('$_POST[dllExName]','$_POST[dllClassId]','$_POST[txtExDate]','$_POST[txtExNote]')");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'examination/exam_date_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = mysqli_query($link,"UPDATE `tbl_add_exam_date` SET `ex_name`='".$_POST['dllExName']."',`ex_class_id`='".$_POST['dllClassId']."',`ex_date`='".$_POST['txtExDate']."',`ex_note`='".$_POST['txtExNote']."' WHERE ex_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'examination/exam_date_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_exam_date where ex_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){

		$ex_name = $row['ex_name'];
		$ex_class_id = $row['ex_class_id'];
		$ex_date = $row['ex_date'];
		$ex_note = $row['ex_note'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Fecha de Examen';
		$button_text="Guardar Informacion";
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
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/exm.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>examination/exam_date_list.php">Lista de Fechas de Examenes</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>examination/exm.php">Ventana de Examenes</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
           <div class="form-group">
            <label class="col-sm-2 control-label" for="dllExName"> Nombre Examen </label>
            <div class="col-sm-6">
              <select class="form-control" id="dllExName" onChange="getSubject(this.value);" name="dllExName">
                <option value="-1">--Select Tipo--</option>
            <?php
            	$result_class = mysqli_query($link,"Select * from tbl_schedule_setup order by schedule_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
            <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['schedule_id']){echo 'selected';}?> value="<?php echo $row_class['schedule_id'];?>"><?php echo $row_class['schedule_name'];?></option>
            <?php } ?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            <div class="form-group">
            <label class="col-sm-2 control-label" for="dllClassId"> Nombre Curso </label>
            <div class="col-sm-6">
              <select class="form-control" id="dllClassId" name="dllClassId">
               <option value="">--Select--</option>
                <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_class order by c_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
                <option <?php if($ex_class_id == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            <div class="form-group">
            <label class="col-sm-2 control-label" for="txtExDate"> Fecha Examen </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $ex_date;?>" name="txtExDate" id="txtExDate" class="form-control datepicker ">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
              <div class="form-group">
            <label class="col-sm-2 control-label" for="txtExNote"> Notas </label>
            <div class="col-sm-6">
              <textarea name="txtExNote" id="txtExNote" style="resize:none;" class="form-control"><?php echo $ex_note;?></textarea>
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
  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
