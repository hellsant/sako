<?php include('header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>

<div class="content">
  <div style="position:absolute;right:0px;margin-right:10px;margin-top:5px;">
    <div><a href="javascript:;" data-target=".modal" data-toggle="modal"><img src="<?php echo WEB_URL; ?>img/profile-icon.png" /></a></div>
    <div style="text-align:center;font-size:10px;color:#000;font-weight:bold;"><a href="javascript:;" data-target=".modal" data-toggle="modal"><?php echo $name_x; ?></a></div>
  </div>
  <div class="header_text">
    <div align="center"><img id="window_size_img" src="<?php echo WEB_URL; ?>img/dashboard_image.png"><img id="mobile_size_img" style="display:none;" src="<?php echo WEB_URL; ?>img/mobile_dashboard.png"></div>
  </div>
  <div align="center" style="width:88%;margin:0 auto;padding:0;">
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>transport/a_transport.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/transport.png"></a></div>
      <div class="link_box_text">Transport</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image2"><a href="<?php echo WEB_URL; ?>hostel/a_hostel.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/hostel.png"></a></div>
      <div class="link_box_text">Hostel</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>account/a_account.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/account.png"></a></div>
      <div class="link_box_text">Account</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>notice/a_notice_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/notice.png"></a></div>
      <div class="link_box_text">Notice</div>
    </div>
    <div style="clear:both"></div>
  </div>
  <br/>
  <br/>
</div>
<?php include('copyright.php');?>
<?php include('footer.php');?>
