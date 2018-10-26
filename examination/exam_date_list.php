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
	$sqlx= mysqli_query($link,"DELETE FROM `tbl_add_exam_date` WHERE ex_id = ".$_GET['id']);
	mysqli_query($sqlx,$link); 
	$msg = 'Delete Exam. Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Exam. Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Exam. Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Lista de Fechas de Examenes</div>
    <div class="top_common_bar">
      <div class="obj_left">
        <select onChange="getClassData(this.value,'exam_date_list');" class="form-control" name="ddlClass">
          <option value="-1">--Seleccionar Curso--</option>
          <?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_class order by c_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cid']) && $_GET['cid'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_right"> <a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>examination/exam_date.php"><i class="fa fa-plus"></i>&nbsp;Añadir Fecha Examen</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>examination/exm.php"><i class="fa"></i>Ventana de Examenes</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div>
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Nombre Examen</th>
          <th>Fecha Examen</th>
          <th>Nota</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <?php
				$result = '';
		  		if(isset($_GET['cid']) && $_GET['cid'] != ''){
				$result = mysqli_query($link,"Select *, c.c_name,ss.schedule_name from tbl_add_exam_date ed INNER JOIN tbl_add_class c on c_id=ex_class_id inner join tbl_schedule_setup ss on ss.schedule_id = ed.ex_name where ex_class_id = '" . $_GET['cid'] . "' order by ex_id ASC");
				}
				else{
					$result = mysqli_query($link,"Select * from tbl_add_exam_date where ex_class_id = '-1' order by ex_id desc");
				}
				while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['schedule_name']; ?></td>
          <td><?php echo $row['ex_date']; ?></td>
          <td><?php echo $row['ex_note']; ?></td>
          <td><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>examination/exam_date.php?id=<?php echo $row['ex_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteExam(<?php echo $row['ex_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
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
