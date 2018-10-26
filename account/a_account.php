<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text">Welcome To Exam. Dashboard</div>
  <div class="top_common_bar">
    <div class="obj_right" style="padding-right:10px !important;"> <a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>a_dashboard.php"><i class="fa"></i>Dashboard</a></div>
  </div>
  <div style="clear:both;"></div>
  <div align="center" style="width:88%;margin:0 auto;padding:0;">
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>account/a_chargelist.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/charge.png"></a></div>
      <div class="link_box_text">Student Charge</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>account/a_feelist.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/fee.png"></a></div>
      <div class="link_box_text">Student Exam Fee</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>account/a_t_salarylist.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/t_salary.png"></a></div>
      <div class="link_box_text">Tearcher Salary</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>account/a_e_salarylist.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/e_salary.png"></a></div>
      <div class="link_box_text">Employee Salery</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>account/a_fee_type_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/ct.png"></a></div>
      <div class="link_box_text">Type Of Fee</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>account/a_fee_set_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/fee.png"></a></div>
      <div class="link_box_text">Fee Setup</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>account/a_expense_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/expense.png"></a></div>
      <div class="link_box_text">Expense Setup</div>
    </div>
	<div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>account/a_transport_fee_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/tpfee.png"></a></div>
      <div class="link_box_text">Transport Fee</div>
    </div>
	<div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>account/a_hostel_fee_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/hostel.png"></a></div>
      <div class="link_box_text">Hostel Fee</div>
    </div>
    <div style="clear:both"></div>
  </div>
  <br/>
  <br/>
</div>
<br/>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
