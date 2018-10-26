<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Hostel List</div>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>hostel/s_hostel.php"><i class="fa"></i>Hostel Dashboard</a></div>
    </div>
    </div>
    <div style="clear:both;"></div>
  <div>
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Hostel Name</th>
          <th>Address</th>
          <th>Hostel Type</th>
		  <th>Note</th>
        </tr>
      </thead>
      <tbody>
        <?php
				$result = mysql_query("Select * from tbl_add_hostel order by h_id desc",$link);
				while($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['h_name']; ?></td>
          <td><?php echo $row['h_address']; ?></td>
          <td><?php echo $row['h_type']; ?></td>
          <td><?php echo $row['h_note']; ?></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteHostel(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Hostel ?");
	if(iAnswer){
		window.location = 'hostel_list.php?id=' + Id;
	}
  }
  </script>

<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
