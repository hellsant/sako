<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text">Bienvenido a la Ventana de Tareas</div>
  <div class="top_common_bar">
    <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>s_dashboard.php"><i class="fa"></i>Ventana Principal</a></div>
  </div>
  <div style="clear:both;"></div>
  <div align="center" style="width:88%; height:450px;margin:0 auto;padding:0;">
    <!--<div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>library/memberlist.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/member.png"></a></div>
      <div class="link_box_text">Add Member</div>
    </div>  
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>library/issuelist.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/issue.png"></a></div>
      <div class="link_box_text">Issue</div>
    </div>  --> 
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>library/student_book_list.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/books.png"></a></div>
      <div class="link_box_text">Lista de Tareas</div>
    </div>   
  <!--  <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>library/finelist.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/fine.png"></a></div>
      <div class="link_box_text">Fine</div>
    </div>   -->
  </div>
  <br/>
  <br/>
  <div style="clear:both"></div>
</div>
<br/>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
