<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text">Bienvenido a la Ventana de Calificaciones</div>
  <div class="top_common_bar">
    <div class="obj_right" style="padding-right:10px !important;"> <a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>dashboard.php"><i class="fa"></i>Ventana Principal</a></div>
  </div>
  <div style="clear:both;"></div>
  <div align="center" style="width:88%;margin:0 auto;padding:0;">
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>mark/viewmark.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/viewmark.png"></a></div>
      <div class="link_box_text">Ver Calificaciones</div>
    </div>
	<div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>mark/addmark.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/marks.png"></a></div>
      <div class="link_box_text">Añadir Calificacion</div>
    </div>
	<div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>mark/edit_delete.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/marks.png"></a></div>
      <div class="link_box_text">Editar/Elimin Calif.</div>
    </div>
    <div style="clear:both"></div>
  </div>
  <br/>
  <br/>
</div>
<br/>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
