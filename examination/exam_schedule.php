<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$es_term_id =  "";
$es_class_id =  "";
$es_subject_id =  "";
$es_date =  "";
$es_start_time = "";
$es_end_time = "";
$es_room_no = "";
$title = 'Añadir Nueva Fecha de Examen';
$button_text="Guardar Informacion";
$id="";
$hdnid="0";

if(isset($_POST['txtESId'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	
	$sql = mysqli_query($link,"INSERT INTO `tbl_add_exam_schedule`(`es_term_id`,`es_class_id`,`es_subject_id`,`es_date`,`es_start_time`,`es_end_time`, `es_room_no`) VALUES ('$_POST[txtESId]','$_POST[dllESClassId]','$_POST[dllESSubjectId]','$_POST[txtESDate]','$_POST[txtESStart]','$_POST[txtESEnd]','$_POST[txtESRoomNo]')");
	//echo $sql;
	//die();
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'examination/exam_schedule_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql =mysqli_query($link,"UPDATE `tbl_add_exam_schedule` SET `es_term_id`='".$_POST['txtESId']."',`es_class_id`='".$_POST['dllESClassId']."',`es_subject_id`='".$_POST['dllESSubjectId']."',`es_date`='".$_POST['txtESDate']."',`es_start_time`='".$_POST['txtESStart']."',`es_end_time`='".$_POST['txtESEnd']."',`es_room_no`='".$_POST['txtESRoomNo']."' WHERE es_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'examination/exam_schedule_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_exam_schedule where es_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){

		$es_term_id = $row['es_term_id'];
		$es_class_id = $row['es_class_id'];
		$es_subject_id = $row['es_subject_id'];
		$es_date = $row['es_date'];
		$es_start_time = $row['es_start_time'];
		$es_end_time = $row['es_end_time'];
		$es_room_no = $row['es_room_no'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Fecha Examen';
		$button_text="Actualizar Informacion";
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
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>examination/exam_schedule_list.php">Lista Exa. Programads</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>examination/exm.php">Ventana de Examenes</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtESId"> Nombre Examen </label>
            <div class="col-sm-6">
              <select class="form-control" id="txtESId" name="txtESId">
                <option value="">--Seleccionar--</option>
                <?php 
				  	$result_term = mysqli_query($link,"SELECT * FROM tbl_schedule_setup order by schedule_id ASC");
					while($row_term = mysqli_fetch_array($result_term)){
				  ?>
                <option <?php if($es_term_id == $row_term['schedule_id']){echo 'selected';}?> value="<?php echo $row_term['schedule_id'];?>"><?php echo $row_term['schedule_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="dllESClassId"> Nombre Curso </label>
            <div class="col-sm-6">
              <select class="form-control" id="dllESClassId" onChange="getSubject(this.value);" name="dllESClassId">
                <option value="">--Seleccionar--</option>
                <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_class order by c_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
                <option <?php if($es_class_id == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="dllESSubjectId"> Nombre Materia </label>
            <div class="col-sm-6">
              <select class="form-control" id="dllESSubjectId" name="dllESSubjectId">
                <option value="">--Seleccionar--</option>
				 <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_subject order by sb_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
                <option <?php if($es_subject_id == $row_class['sb_id']){echo 'selected';}?> value="<?php echo $row_class['sb_id'];?>"><?php echo $row_class['sb_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtESDate"> Fecha Examen </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $es_date;?>" name="txtESDate" id="txtESDate" class="form-control datepicker ">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtESStart">  Inicio Examen </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $es_start_time;?>" name="txtESStart" id="txtESStart" class="form-control time">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtESEnd"> Fin Examen </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $es_end_time;?>" name="txtESEnd" id="txtESEnd" class="form-control time">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtESRoomNo"> No Lista </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $es_room_no;?>" name="txtESRoomNo" id="txtESRoomNo" class="form-control">
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
  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
