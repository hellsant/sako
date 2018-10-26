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
	$sqlx=mysqli_query($link,"DELETE FROM `tbl_add_student` WHERE s_id = ".$_GET['id']);
	mysqli_query($link,$sqlx);
	$msg = 'Delete Student Successfully';
	$token = 'block';
	/*mysql_close($link);
	$redirect_url = WEB_URL . 'student/student_list.php?m=u&cid='.$_GET['cid'];
	header('Location: ' . $redirect_url);
	die();*/
}
?>
  <?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Student Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Student Information Successfully';
	$token = 'block';
}

?>
  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content content_inside">
    <div class="header_text">
      <div class="header_text_left">Lista de Estudiantes</div>
      <!--<div class="header_text_right"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>student/add_student.php"><i class="fa fa-plus"></i>&nbsp;Add Student</a></div>-->
      
      <div class="top_common_bar">
      	<div class="obj_left">
        	<select onChange="getClassData(this.value,'student_list');" class="form-control" name="ddlClass">
            <option value="-1">--Seleccionar Curso--</option>
			<?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_class order by c_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
                	<option <?php if(isset($_GET['cid']) && $_GET['cid'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
                <?php } ?>
            </select>	
        </div>
        <div class="obj_right">
        	<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>student/add_student.php"><i class="fa fa-plus"></i>&nbsp;Añadir Estudiante</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>dashboard.php"><i class="fa"></i>Ventana Principal</a></div>
        </div>
      </div>
    <div style="clear:both;"></div>
    <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
    <div class="list" style="width:100%; height:480px; overflow:auto;">
      <table class="table sakotable table-bordered table-striped dt-responsive">
	  <thead>
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Celular</th>
          <th>Nombre de Curso</th>
          <th>Direccion</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <?php
				$result = '';
				if(isset($_GET['cid']) && $_GET['cid'] != ''){
					$result = mysqli_query($link,"Select *,c.c_name from tbl_add_student s INNER JOIN tbl_add_class c on c_id=s_class_id where s_class_id = '" . $_GET['cid'] . "' order by s_id desc");
				}
				else if(isset($_GET['m']) && $_GET['m'] == 'i'){
					$result = mysqli_query($link,"Select *,c.c_name from tbl_add_student s INNER JOIN tbl_add_class c on c_id=s_class_id WHERE s.s_id=(SELECT max(s_id) FROM tbl_add_student)");
				}
				else{
					$result = mysqli_query($link,"Select * from tbl_add_student where s_class_id = '-1' order by s_id desc");
				}
				while($row = mysqli_fetch_array($result)){
					
				$s_image = WEB_URL . 'img/no_image.jpg';	
		if(file_exists(ROOT_PATH . '/img/upload/' . $row['s_image']) && $row['s_image'] != ''){
			$s_image = WEB_URL . 'img/upload/' . $row['s_image'];
		}
					
					 ?>
        <tr>
          <td><img class="photo_img_round" style="width:50px;height:50px;" src="<?php echo $s_image;  ?>" /></td>
          <td><?php echo $row['s_name']; ?></td>
          <td><?php echo $row['s_email']; ?></td>
          <td><?php echo $row['s_contact']; ?></td>
          <td><?php echo $row['c_name']; ?></td>
          <td><?php echo $row['s_address']; ?></td>
          <td><a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>student/student_details.php?id=<?php echo $row['s_id']; ?>&cid=<?php echo $row['c_id']; ?>"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;<a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>student/add_student.php?id=<?php echo $row['s_id']; ?>&cid=<?php echo $row['c_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteStudent(<?php echo $row['s_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysqli_close($link); ?>
		</tbody>
      </table>
    </div>
  </div>
  <script type="text/javascript">
  function deleteStudent(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Student ?");
	if(iAnswer){
		window.location = 'student_list.php?id=' + Id;
	}
  }
  </script>
  <?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
