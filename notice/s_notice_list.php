<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location:logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Lista de Noticias</div>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>s_dashboard.php"><i class="fa"></i>Ventana Principal</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div>
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Titulo</th>
          <th>Fecha</th>
          <th>Noticia </th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
         <?php
		 $permission = '';
		 $result = mysqli_query($link,"Select * from tbl_add_notice where permission='student' order by n_id ASC");
		 while($row = mysqli_fetch_array($result)){ ?>
        <tr>
          <td><?php echo $row['n_title']; ?></td>
          <td><?php echo $row['date']; ?></td>
          <td><?php echo $row['notice']; ?></td>
          <td></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
