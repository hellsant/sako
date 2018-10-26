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
	$sqlx= mysqli_query($link,"DELETE FROM `tbl_add_teacher` WHERE teacher_id = ".$_GET['id']);
	mysqli_query($sqlx,$link); 
	$msg = 'Delete Teacher Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Teacher Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Teacher Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Lista de Docentes</div>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>teacher/add_teacher.php"><i class="fa fa-plus"></i>&nbsp;Añadir Docente</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>dashboard.php"><i class="fa"></i>Ventana Principal</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div>
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Celular</th>
          <th>Cargo</th>
          <th>Direccion</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <?php
				$result = mysqli_query($link,"Select * from tbl_add_teacher order by teacher_id desc");
				while($row = mysqli_fetch_array($result)){
					
				$t_photo = WEB_URL . 'img/no_image.jpg';	
		if(file_exists(ROOT_PATH . '/img/upload/' . $row['t_photo']) && $row['t_photo'] != ''){
			$t_photo = WEB_URL . 'img/upload/' . $row['t_photo'];
		}
					
					 ?>
        <tr>
          <td><img class="photo_img_round" style="width:50px;height:50px;" src="<?php echo $t_photo;  ?>" /></td>
          <td><?php echo $row['t_name']; ?></td>
          <td><?php echo $row['t_email']; ?></td>
          <td><?php echo $row['t_phone']; ?></td>
          <td><?php echo $row['t_designation']; ?></td>
          <td><?php echo $row['t_address']; ?></td>
          <td><a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>teacher/teacher_details.php?id=<?php echo $row['teacher_id']; ?>"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;<a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>teacher/add_teacher.php?id=<?php echo $row['teacher_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteTeacher(<?php echo $row['teacher_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteTeacher(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Teacher ?");
	if(iAnswer){
		window.location = 'teacher_list.php?id=' + Id;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
