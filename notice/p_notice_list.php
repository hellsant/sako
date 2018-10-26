<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'parents'){
	header("Location:logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Notice List</div>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>p_dashboard.php"><i class="fa"></i>Dashboard</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div>
    <table class="table common_sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Title</th>
          <th>Date</th>
          <th>Notice </th>
        </tr>
      </thead>
      <tbody>
         <?php
				$result = mysql_query("Select * from tbl_add_notice where permission='parent' order by n_id ASC",$link);
				while($row = mysql_fetch_array($result)){ ?>
        <tr>
          <td><?php echo $row['n_title']; ?></td>
          <td><?php echo $row['date']; ?></td>
          <td><?php echo $row['notice']; ?></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>

<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
