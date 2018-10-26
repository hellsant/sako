<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">School Grade List</div>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>s_dashboard.php"><i class="fa"></i>Dashboard</a></div>
    </div>
  </div>
  <div>
    <table class="table common_sakotable_att table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Grade Name</th>
          <th>Grade Point</th>
          <th>Mark From</th>
          <th>Mark Upto</th>
          <th>Note</th>
        </tr>
      </thead>
      <tbody>
        <?php
		$result = mysqli_query($link,"Select * from tbl_add_grade order by g_id desc");
		while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['g_name']; ?></td>
          <td><?php echo $row['g_point']; ?></td>
          <td><?php echo $row['g_from']; ?></td>
          <td><?php echo $row['g_upto']; ?></td>
          <td><?php echo $row['g_note']; ?></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
