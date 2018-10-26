<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Category List</div>
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
          <th>Hostel Category</th>
		  <th>Hostel Fee</th>
		  <th>Note</th>
        </tr>
      </thead>
      <tbody>
        <?php
				$result = mysql_query("Select *,h.h_name from tbl_hostel_category hc INNER JOIN tbl_add_hostel h on hostel_id=h_id  order by hc.category_id desc",$link);
				while($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['h_name']; ?></td>
          <td><?php echo $row['hostel_category']; ?></td>
          <td><?php echo CURRENCY.' '.$row['hostel_fee']; ?></td>
          <td><?php echo $row['hostel_note']; ?></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteCategory(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Category ?");
	if(iAnswer){
		window.location = 'category_list.php?id=' + Id;
	}
  }
  </script>

<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
