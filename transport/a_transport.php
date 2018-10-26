<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content">
    <div class="header_text">Welcome To Transport Dashboard</div>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>a_dashboard.php"><i class="fa"></i>Dashboard</a></div>
    </div>
    <div style="clear:both;"></div>
    <div align="center" style="width:88%;margin:0 auto;padding:0;">
      <div class="link_box">
        <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>transport/a_transport_list.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/transport.png"></a></div>
        <div class="link_box_text">Add Transport</div>
      </div>
      <div class="link_box">
        <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>transport/a_t_member_list.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/member.png"></a></div>
        <div class="link_box_text">Add Member</div>
      </div>
      <div style="clear:both"></div>
    </div>
    <br/>
    <br/>
  </div>
  <br/>
  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
