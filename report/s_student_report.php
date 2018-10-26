<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location:logout.php");
	die();
}
?>
<?php 
$p_student_class_id =  "";
$title = 'Informacion de Estudiante';
$button_text="Enviar";

if(isset($_GET['cid'])){
	$class_id = $_GET['cid'];
}
if(isset($_GET['sid'])){
	$student_id = $_GET['sid'];
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text_inside">
    <div class="header_text_left"><?php echo $title; ?></div>
  </div>
  <div class="main_content">
    <div class="main_content_left">
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/student.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>s_dashboard.php">Ventana Principal</a></div>
    </div>
    <div class="frmstyle">
      <div class="form-group">
        <div class="col-sm-12">
          <select class="form-control" id="dllStClassId" name="dllStClassId">
            <option value="">--Seleccionar Curso--</option>
            <?php 
					if(isset($_SESSION['objLogin']['s_class_id'])){
				  	$result_class = mysqli_query($link,"SELECT *,c.c_name FROM tbl_add_student s inner join tbl_add_class c on c.c_id = s.s_class_id where s.s_id = '" . (int)$_SESSION['objLogin']['s_id'] . "' order by s.s_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){?>
            <option <?php if($p_student_class_id == $row_class['s_class_id']){echo 'selected';}?> value="<?php echo $row_class['s_class_id'];?>"><?php echo $row_class['c_name'];?></option>
            <?php }}else{echo "Enter Current Class";}//mysql_close($link);?>
          </select>
        </div>
      </div>
	  <div class="form-group">&nbsp;</div>
      <div class="form-group">
        <div class="col-sm-12">
          <input type="button" onclick="getStudentInfo()" value="<?php echo $button_text;?>" class="btn btn-success">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="bottom_area"></div>
</div>
<script type="text/javascript">
	function getStudentInfo(){
		var class_id = '<?php echo $_SESSION['objLogin']['s_class_id']; ?>';
		var student_id = '<?php echo $_SESSION['objLogin']['s_id']; ?>';
		
		if(class_id != '' && student_id != ''){
			window.open('<?php echo WEB_URL;?>report/s_student_info.php?cid=' + class_id + '&sid=' + student_id , '_blank');
		}
		else{
			alert('Please select all 2 fields');
		}
	}
</script>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
