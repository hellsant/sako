<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>


<div class="content">
  <div style="clear:both"></div>
</div>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
