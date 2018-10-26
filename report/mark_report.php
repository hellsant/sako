<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>
<?php 
$es_term_id =  "";
$es_class_id = "";
$es_subject_id = "";
$title = 'Planilla de Notas por Curso';
$button_text="Enviar";

if(isset($_GET['cid'])){
	$class_id = $_GET['cid'];
}
if(isset($_GET['eid'])){
	$exam_id = $_GET['eid'];
}

if(isset($_GET['sbid'])){
	$subject_id = $_GET['sbid'];
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text_inside">
    <div class="header_text_left"><?php echo $title; ?></div>
  </div>
  <div class="main_content">
    <div class="main_content_left">
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/mark.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>report/report.php">Volver a Reportes</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>dashboard.php">Ventana Principal</a></div>
    </div>
    <div class="frmstyle">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-3">
            <select class="form-control" id="txtESId" name="txtESId">
              <option value="">--Seleccionar Prueba--</option>
              <?php 
				  	$result_term = mysqli_query($link,"SELECT * FROM tbl_schedule_setup order by schedule_id ASC");
					while($row_term = mysqli_fetch_array($result_term)){
				  ?>
              <option <?php if($es_term_id == $row_term['schedule_id']){echo 'selected';}?> value="<?php echo $row_term['schedule_id'];?>"><?php echo $row_term['schedule_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
          <div class="col-sm-4">
            <select class="form-control" id="dllESClassId" onChange="getSubject(this.value);" name="dllESClassId">
              <option value="">--Seleccionar Curso--</option>
              <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_class order by c_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($es_class_id == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
          <div class="col-sm-3">
            <select class="form-control" id="dllESSubjectId" name="dllESSubjectId">
              <option value="">--Seleccionar Material--</option>
              <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_subject order by sb_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($es_subject_id == $row_class['sb_id']){echo 'selected';}?> value="<?php echo $row_class['sb_id'];?>"><?php echo $row_class['sb_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
          <div class="col-sm-2">
            <input type="button" onclick="getMarkInfo()" value="<?php echo $button_text;?>" class="btn btn-success">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bottom_area"></div>
</div>
<script type="text/javascript">
	function getMarkInfo(){
		var class_id = $("#dllESClassId").val();
		var exam_id = $("#txtESId").val();
		var subject_id = $("#dllESSubjectId").val();
		
		if(class_id != '' && exam_id != '' && subject_id != ''){
			//window.location = "<?php //echo WEB_URL;?>report/mark_info.php?cid=" + class_id + '&eid=' + exam_id + '&sbid=' + subject_id;
			window.open('<?php echo WEB_URL;?>report/mark_info.php?cid=' + class_id + '&eid=' + exam_id + '&sbid=' + subject_id,'_blank');
		}
		else{
			alert('Please select all 3 fields');
		}
	}
</script>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
