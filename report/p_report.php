<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'parents'){
	header("Location:logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content">
    <div class="header_text">Welcome To Report Dashboard</div>
    <div class="top_common_bar">
        <div class="obj_right" style="padding-right:10px !important;">
        	<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>p_dashboard.php"><i class="fa"></i>Dashboard</a></div>
        </div>
    <div style="clear:both;"></div>
    <div align="center" style="width:88%;margin:0 auto;padding:0;">
    <div class="link_box">
        <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>report/p_student_report.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/student.png"></a></div>
        <div class="link_box_text">Student Report</div>
      </div>
      <div class="link_box">
        <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>report/p_mark_report.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/mark.png"></a></div>
        <div class="link_box_text">Mark Report</div>
      </div>
	  <div class="link_box">
        <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>report/p_transport_fee_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/tpfee.png"></a></div>
        <div class="link_box_text">Transport Report</div>
      </div>
	  <div class="link_box">
        <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>report/p_hostel_fee_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/hostel.png"></a></div>
        <div class="link_box_text">Hostel Report</div>
      </div>
      <div style="clear:both"></div>
    </div>
    <br/><br/>
  </div>
  <br/>
  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
