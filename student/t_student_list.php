<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'teacher'){
	header("Location: logout.php");
	die();
}
?>
  
  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content content_inside">
    <div class="header_text">
      <div class="header_text_left">Lista de Estudiantes</div>
      <!--<div class="header_text_right"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>student/add_student.php"><i class="fa fa-plus"></i>&nbsp;Add Student</a></div>-->
      
      <div class="top_common_bar">
      	<div class="obj_left">
        	<select onChange="getClassData(this.value,'t_student_list');" class="form-control" name="ddlClass">
            <option value="-1">--Seleccionar Curso--</option>
			<?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_class order by c_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
                	<option <?php if(isset($_GET['cid']) && $_GET['cid'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
                <?php } ?>
            </select>	
        </div>
        <div class="obj_right">
        	<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>t_dashboard.php"><i class="fa"></i>Ventana Principal</a></div>
        </div>
      </div>
    <div style="clear:both;"></div>
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
          <td><a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>student/t_student_details.php?id=<?php echo $row['s_id']; ?>&cid=<?php echo $_GET['cid']; ?>"><i class="fa fa-eye"></i></a></td>
        </tr>
        <?php } mysqli_close($link); ?>
		</tbody>
      </table>
    </div>
  </div>
  
  <?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
