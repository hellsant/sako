<?php 
include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'teacher'){
	header("Location: logout.php");
	die();
}
?>
<?php 
$c_teacher =  "";
$title = 'Informacion Docente';
$button_text="Enviar";

if(isset($_GET['tid'])){
	$teacher_id = $_GET['tid'];
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text_inside">
    <div class="header_text_left"><?php echo $title; ?></div>
  </div>
  <div class="main_content">
    <div class="main_content_left">
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/teacher.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>report/t_report.php">Volver a Reportes</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>t_dashboard.php">Ventana Principal</a></div>
    </div>
    <div class="frmstyle">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <select class="form-control" id="ddlClTeacher" name="ddlClTeacher">
              <option value="">--Seleccionar Docente--</option>
              <?php 
				  	$result_teacher = mysqli_query($link,"SELECT * FROM tbl_add_teacher order by t_name ASC");
					while($row_teacher = mysqli_fetch_array($result_teacher)){
				  ?>
              <option <?php if($c_teacher == $row_teacher['teacher_id']){echo 'selected';}?> value="<?php echo $row_teacher['teacher_id'];?>"><?php echo $row_teacher['t_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
          <div class="col-sm-6">
            <input type="button" onclick="getTeacherInfo()" value="<?php echo $button_text;?>" class="btn btn-success">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bottom_area"></div>
</div>
<script type="text/javascript">
	function getTeacherInfo(){
		var teacher_id = $("#ddlClTeacher").val();
		
		if(teacher_id != ''){
			//window.location = "<?php //echo WEB_URL;?>report/teacher_info.php?tid=" + teacher_id ;
			window.open('<?php echo WEB_URL;?>report/t_teacher_info.php?tid=' + teacher_id , '_blank');
		}
		else{
			alert('Please select field');
		}
	}
</script>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
