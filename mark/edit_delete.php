<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$token = 'none';
$msg = '';
$e_name =  0;
$e_month = "";
$e_pay_date = "";
$e_amount = "";
$title = 'Editar/Eliminar Calificacion por Estudiante';
$button_text="Editar/Eliminar Calificacion";
$successful_msg="Add Employee Salary Successfully";
$form_url = WEB_URL . "account/employee_salary.php";
$id="";
$sf_class_id = 0;
$student_id = 0;
$form_show = 'none';

if(isset($_GET['eid'])){
	$e_name = $_GET['eid'];
	$form_show = 'block';
}
if(isset($_GET['cid'])){
	$sf_class_id = $_GET['cid'];
}
if(isset($_GET['sid'])){
	$student_id = $_GET['sid'];
}

if(isset($_GET['mid']) && $_GET['mid'] != '' && $_GET['mid'] > 0){
	$sqlx= mysqli_query($link,"DELETE FROM `tbl_student_marks` WHERE smid = ".$_GET['mid']);
	mysqli_query($sqlx,$link); 
	$msg = 'Delete Student Mark Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text_inside">
    <div class="header_text_left"><?php echo $title; ?></div>
  </div>
  <div class="main_content">
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
    <div class="main_content_left">
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/charge.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>mark/mark.php">Ventana de Calificaciones</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>mark/viewmark.php">Lista de Calificaciones</a></div>
    </div>
    <form id="frmAddMark" action="../ajax/updateStudentMark.php" method="post">
      <div class="frmstyle">
        <div  class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="dllEmNameId"> Examen </label>
            <div class="col-sm-6">
              <select class="form-control" id="ddlExam" name="ddlExam">
                <option value="">--Seleccionar--</option>
                <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_schedule_setup order by schedule_name ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
                <option <?php if($e_name == $row_class['schedule_id']){echo 'selected';}?> value="<?php echo $row_class['schedule_id'];?>"><?php echo $row_class['schedule_name'];?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="dllStClassId"> Curso </label>
            <div class="col-sm-6">
              <select class="form-control" onchange="getStudentWithRoll(this.value);" id="dllStClassId" name="dllStClassId">
              <option value="">--Seleccionar Curso--</option>
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
            <label class="col-sm-2 control-label" for="dllStNameId"> Estudiante </label>
            <div class="col-sm-6">
              <select class="form-control" id="dllStNameId" name="dllStNameId">
                <option value="">--Seleccionar Estudiante--</option>
                <?php 
				  	if($student_id != 0){
					$result_class = mysqli_query($link,"SELECT * from tbl_add_student order by s_name asc");
					while($row_class = mysqli_fetch_array($result_class)){
				 ?>
                <option <?php if($student_id == $row_class['s_id']){echo 'selected';}?> value="<?php echo $row_class['s_id'];?>"><?php echo $row_class['s_name'];?></option>
                <?php } } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <input type="button" onclick="getStudentInfoByMark();" value="<?php echo $button_text;?>" class="btn btn-success">
            </div>
          </div>
        </div>
        <div style="display:<?php echo $form_show; ?>;">
          <table class="table common_sakotable table-bordered table-striped dt-responsive">
            <thead>
              <tr>
                <th>Asignatura</th>
                <th>Calificacion</th>
                <th>Editar</th>
                <th>Accion</th>
              </tr>
            </thead>
            <tbody>
              <?php
				$result = '';
				if(isset($_GET['cid']) && $_GET['cid'] != ''){
					$result = mysqli_query($link,"Select *,c.c_name,s.s_name,s.s_email,s.s_contact,sb.sb_name from tbl_student_marks m inner join tbl_add_student s on m.student_id = s.s_id INNER JOIN tbl_add_class c on m.class_id=c.c_id inner join tbl_add_subject sb on m.subject_id = sb.sb_id where m.class_id = '" . $_GET['cid'] . "' and m.student_id = '" . $_GET['sid'] . "' and m.exam_id = '" . $_GET['eid'] . "' order by m.smid desc");
				}
				else{
					$result = mysqli_query($link,"Select * from tbl_student_marks where class_id = '-1' order by smid desc");
				}
				while($row = mysqli_fetch_array($result)){
					$s_image = WEB_URL . 'img/no_image.jpg';	
					if(file_exists(ROOT_PATH . '/img/upload/' . $row['s_image']) && $row['s_image'] != ''){
						$s_image = WEB_URL . 'img/upload/' . $row['s_image'];
					}
			 ?>
              <tr>
                <!--<td><img class="photo_img_round" style="width:50px;height:50px;" src="<?php //echo $s_image;  ?>" /></td>-->
                <td><?php echo $row['sb_name']; ?></td>
                <td><?php echo $row['marks']; ?></td>
                <td><input type="text" size="10" id="txt_<?php echo $row['smid']; ?>" value="<?php echo $row['marks']; ?>" style="text-align:center" name="mark[<?php echo $row['smid']; ?>][number]" /><input type="hidden" name="mark[<?php echo $row['smid']; ?>][id]" value="<?php echo $row['smid']; ?>" id="mid_<?php echo $row['smid']; ?>"></td>
				<td><a title="Delete Mark" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteMark(<?php echo $row['smid']; ?>,<?php echo $row['exam_id']; ?>,<?php echo $row['c_id']; ?>,<?php echo $row['s_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
              </tr>
              <?php } mysqli_close($link); ?>
            </tbody>
          </table>
        </div>
        <br/>
        <div class="row" style="display:<?php echo $form_show; ?>;">
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <input type="button" class="btn btn-success" style="width:400px;" value="Update Mark" onclick="submitStudentMark();">
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="bottom_area"></div>
</div>
<script type="text/javascript">
	function getStudentInfoByMark(){
		var exam_id = $("#ddlExam").val();
		var class_id = $("#dllStClassId").val();
		var student_id = $("#dllStNameId").val();
		
		if(exam_id != '' && class_id != '' && student_id != ''){
			window.location = "<?php echo WEB_URL;?>mark/edit_delete.php?eid=" + exam_id + '&cid=' + class_id + '&sid=' + student_id;
		}
		else{
			alert('Please select all 3 fields');
		}
	}
	function submitStudentMark(){
		$("#frmAddMark").submit();
	}
	
	$("#frmAddMark").submit(function(e)
	{
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR) 
			{
				alert(data);
				//data: return data from server
			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
				//if fails      
			}
		});
		e.preventDefault(); //STOP default action
	});
	
  function deleteMark(mid,eid,cid,sid){
  	var iAnswer = confirm("Are you sure you want to delete this Mark ?");
	if(iAnswer){
		window.location = 'edit_delete.php?mid=' + mid + '&eid=' + eid + '&cid=' + cid + '&sid=' + sid;
	}
  }

	
</script>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
