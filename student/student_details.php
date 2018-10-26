<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div id="print_area">
    <div class="bio-graph-heading">
      <?php
 
$id = '';
$result = mysqli_query($link,"Select *,c.c_name from tbl_add_student s inner join tbl_add_class c on s.s_class_id = c.c_id where s_id='".$_GET['id']."'");
while($row = mysqli_fetch_array($result)){
$s_image = WEB_URL . 'img/no_image.jpg';	
if(file_exists(ROOT_PATH . '/img/upload/' . $row['s_image']) && $row['s_image'] != ''){
$s_image = WEB_URL . 'img/upload/' . $row['s_image'];
}
  
?>
      <div align="center" style="width:100%;"><img class="img_ratio img-circle" src="<?php echo $s_image;  ?>"></div>
      <div class="details_top_text"><?php echo $row['s_name']; ?></div>
      <p><?php echo $row['c_name']; ?></p>
      <?php } ?>
    </div>
    <div style="padding:10px;">
      <?php
    $result = mysqli_query($link,"Select *,c.c_name,p.p_father_name from tbl_add_student s inner join tbl_add_class c on s.s_class_id = c.c_id inner join tbl_add_parent p on p.p_id = s.parent_id where s_id='".$_GET['id']."'");
	while($row = mysqli_fetch_array($result)){?>
      <div style="font-size:13px;text-align:left;" class="row">
        <div class="col-md-6">
          <table class="table">
            <tr>
              <td><strong>Grado de Instruccion:</strong></td>
              <td><?php echo $row['p_father_name'];?></td>
            </tr>
            <tr>
              <td><strong>Email:</strong></td>
              <td><?php echo $row['s_email'];?></td>
            </tr>
            <tr>
              <td><strong>Celular:</strong></td>
              <td><?php echo $row['s_contact'];?></td>
            </tr>
            <tr>
              <td><strong>Direccion:</strong></td>
              <td><?php echo $row['s_address'];?></td>
            </tr>
            <tr>
              <td><strong>Fecha de Nacimiento:</strong></td>
              <td><?php echo $row['s_dob'];?></td>
            </tr>
          </table>
        </div>
        <div class="col-md-6">
          <table class="table">
            <tr>
              <td><strong>Nombre Curso:</strong></td>
              <td><?php echo $row['c_name'];?></td>
            </tr>
            <tr>
              <td><strong>No Lista:</strong></td>
              <td><?php echo $row['s_roll_no'];?></td>
            </tr>
            <tr>
              <td><strong>Genero:</strong></td>
              <td><?php echo $row['s_gender'];?></td>
            </tr>
            <tr>
              <td><strong>Religion:</strong></td>
              <td><?php echo $row['s_religion'];?></td>
            </tr>
            <tr>
              <td><strong>Nombre Perfil:</strong></td>
              <td><?php echo $row['s_profile_name'];?></td>
            </tr>
          </table>
        </div>
      </div>
      <?php }  //mysql_query($link);?>
    </div>
  </div>
  <div style="padding:10px;" align="center"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>student/add_student.php"><i class="fa fa-plus"></i>&nbsp;Añadir Estudiante</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>student/student_list.php?cid=<?php echo $_GET['cid']; ?>"><i class="fa fa-list"></i>&nbsp;Lista Estudiantes</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>dashboard.php"><i class="fa fa-home"></i>&nbsp;Ventana Principal</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" onclick="printContent('print_area','Student Information');" href="javascript:;"><i class="fa fa-print"></i>&nbsp;Print</a></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
