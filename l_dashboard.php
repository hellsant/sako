<?php include('header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'librarian'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div style="position:absolute;right:0px;margin-right:10px;margin-top:5px;">
    <div><a href="javascript:;" data-target=".modal" data-toggle="modal"><img src="<?php echo WEB_URL; ?>img/profile-icon.png" /></a></div>
    <div style="text-align:center;font-size:10px;color:#000;font-weight:bold;"><a href="javascript:;" data-target=".modal" data-toggle="modal"><?php echo $name_x; ?></a></div>
  </div>
  <div class="header_text">Welcome To Library Dashboard</div>
  <div style="clear:both;"></div>
  <div align="center" style="width:88%; height:400px;margin:0 auto;padding:0;">
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>library/l_memberlist.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/member.png"></a></div>
      <div class="link_box_text">Add Member</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>library/l_issuelist.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/issue.png"></a></div>
      <div class="link_box_text">Issue</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>library/l_book_list.php"><img height="75" width="75" src="<?php echo WEB_URL; ?>img/books.png"></a></div>
      <div class="link_box_text">Book List</div>
    </div>
  </div>
  <br/>
  <br/>
  <div style="clear:both"></div>
</div>
<br/>
<?php include('copyright.php');?>
<?php include('footer.php');?>
