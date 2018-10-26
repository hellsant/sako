<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php
$token = 'none';
$msg = '';

if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx=mysqli_query($link,"DELETE FROM `tbl_add_exam_schedule` WHERE es_id = ".$_GET['id']);
	mysqli_query($sqlx,$link); 
	$msg = 'Delete Schedule Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Schedule Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Schedule Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Lista de Examenes Programados</div>
    <div class="top_common_bar">
      <div class="obj_left">
        <select id="ddlClass" onChange="getClassData2(this.value,'exam_schedule_list');" class="form-control" name="ddlClass">
          <option value="-1">--Seleccionar Curso--</option>
          <?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_class order by c_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cval']) && $_GET['cval'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_left">
        <select onChange="getTerminalData(this.value,'exam_schedule_list');" class="form-control" name="ddlTeminal" id="ddlTeminal">
          <option value="-1">--Seleccionar Prueba--</option>
          <?php
            	$result_class = mysqli_query($link,"Select * from tbl_schedule_setup order by schedule_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['schedule_id']){echo 'selected';}?> value="<?php echo $row_class['schedule_id'];?>"><?php echo $row_class['schedule_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_right"> <a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>examination/exam_schedule.php"><i class="fa fa-plus"></i>&nbsp;Añadir Exa Progra</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>examination/exm.php"><i class="fa"></i>Ventana de Examenes</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div>
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Nombre Materia</th>
          <th>Fecha Examen</th>
		  <th>Inicio Examen</th>
		  <th>Fin Examen</th>
		  <th>No Lista</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <?php
				$result = '';
		  		if(isset($_GET['cval']) && $_GET['cval'] != '' && isset($_GET['tval']) && $_GET['tval'] != ''){
					$result = mysqli_query($link,"SELECT * , c.c_name, s.sb_name FROM tbl_add_exam_schedule es INNER JOIN tbl_add_class c ON c_id = es_class_id INNER JOIN tbl_add_subject s ON sb_id = es_subject_id WHERE es.es_class_id = '" . $_GET['cval'] . "' and es.es_term_id = '" . $_GET['tval'] . "' order by es.es_id ASC");
				}
				else if(isset($_GET['cval']) && $_GET['cval'] != ''){
					$result = mysqli_query($link,"SELECT * , c.c_name, s.sb_name FROM tbl_add_exam_schedule es INNER JOIN tbl_add_class c ON c_id = es_class_id INNER JOIN tbl_add_subject s ON sb_id = es_subject_id WHERE es.es_class_id = '" . $_GET['cval'] . "' order by es.es_id ASC");
				}
				else if(isset($_GET['tval']) && $_GET['tval'] != ''){
					$result = mysqli_query($link,"SELECT * , c.c_name, s.sb_name FROM tbl_add_exam_schedule es INNER JOIN tbl_add_class c ON c_id = es_class_id INNER JOIN tbl_add_subject s ON sb_id = es_subject_id WHERE es.es_term_id = '" . $_GET['tval'] . "' order by es.es_id ASC");
				}
				else{
					$result = mysqli_query($link,"Select * from tbl_add_exam_schedule where es_class_id = '-1' order by es_id desc");
				}
				while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['sb_name']; ?></td>
          <td><?php echo $row['es_date']; ?></td>
		  <td><?php echo $row['es_start_time']; ?></td>
		  <td><?php echo $row['es_end_time']; ?></td>
		  <td><?php echo $row['es_room_no']; ?></td>
          <td><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>examination/exam_schedule.php?id=<?php echo $row['es_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteExam(<?php echo $row['es_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteExam(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Exam. Date ?");
	if(iAnswer){
		window.location = 'exam_date_list.php?id=' + Id;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
