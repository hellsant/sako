<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left"><?php echo $_SESSION['objLogin']['s_name']?>&nbsp;Lista de Materias-Documentos</div>
    <div class="top_common_bar">
      <div class="obj_right"> <a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>s_dashboard.php"><i class="fa"></i>Ventana Principal</a></div>
    </div>
  </div>
  <div>
    <table class="table common_sakotable_att table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Nombre de Materia</th>
          <th>Autor Documento</th>
          <th>Documento</th>
          <th>Docente de Curso</th>
        </tr>
      </thead>
      <tbody>
        <?php
		  $result = '';
		  if(isset($_SESSION['objLogin']['s_class_id'])){
		  $result = mysqli_query($link,"Select *, c.c_name, t.t_name from tbl_add_subject s INNER JOIN tbl_add_class c on c_id=sb_class_id inner join tbl_add_teacher t on 	teacher_id=sb_teacher_id where sb_class_id = '" . (int)$_SESSION['objLogin']['s_class_id'] . "' order by sb_id desc");
		  }
		  else{
			  $result = mysqli_query($link,"Select * from tbl_add_subject where sb_class_id = '-1' order by sb_id desc");
		  }
		  while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['sb_name']; ?></td>
          <td><?php echo $row['sb_author']; ?></td>
 <!--               <td><?php //echo $row['sb_code']; ?></td>      -->

          <td><a href="archivoest.php?id=<?php echo $row['sb_id']?>"><?php echo $row['sb_code']; ?></a> </td>    
          
         

          <td><?php echo $row['t_name']; ?></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
