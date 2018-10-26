<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'teacher'){
	header("Location: logout.php");
	die();
}
?>

<?php
$token = 'none';
$msg = '';

if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx= mysqli_query($link,"DELETE FROM `tbl_add_grade` WHERE g_id = ".$_GET['id']);
	mysqli_query($sqlx,$link); 
	$msg = 'Delete Grade Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Grade Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Grade Information Successfully';
	$token = 'block';
}

?>    


<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Grados de Calificacion</div>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>t_dashboard.php"><i class="fa"></i>Ventana Principal</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div>
    <table class="table common_sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Nombre Grado</th>
          <th>Puntaje Ponderado</th>
          <th>Marcar Desde</th>
		  <th>Marcar Hasta</th>
		  <th>Nota</th>
        </tr>
      </thead>
      <tbody>
        <?php
				$result = mysqli_query($link,"Select * from tbl_add_grade order by g_id desc");
				while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['g_name']; ?></td>
          <td><?php echo $row['g_point']; ?></td>
          <td><?php echo $row['g_from']; ?></td>
          <td><?php echo $row['g_upto']; ?></td>
		  <td><?php echo $row['g_note']; ?></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteGrade(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Grade ?");
	if(iAnswer){
		window.location = 'grade_list.php?id=' + Id;
	}
  }
  </script>

<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
