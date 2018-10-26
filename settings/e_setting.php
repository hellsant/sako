<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text">Welcome To Configuration Dashboard</div>
  <div class="top_common_bar">
  <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>e_dashboard.php"><i class="fa"></i>Dashboard</a></div>
  </div>
  <div style="clear:both;"></div>
  <div align="center" style="margin:0 auto;width:88%;">
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>settings/e_add_designation.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/designation.png"></a></div>
      <div class="link_box_text">Add Designation</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>settings/e_schedule_setup.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/schedule.png"></a></div>
      <div class="link_box_text">Schedule Setup</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>settings/e_book_setup.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/books.png"></a></div>
      <div class="link_box_text">Book Setup</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>settings/e_branch_setup.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/branch.png"></a></div>
      <div class="link_box_text">Branch Setup</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>settings/e_school_setup_list.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/schl.png"></a></div>
      <div class="link_box_text">School Setup</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>settings/e_routine_setup.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/routine.png"></a></div>
      <div class="link_box_text">Routine Setup</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>settings/e_add_month.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/month.png"></a></div>
      <div class="link_box_text">Month Setup</div>
    </div>
  </div>
  <br/>
  <br/>
  <div style="clear:both"></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
