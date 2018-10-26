<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'parents'){
	header("Location:logout.php");
	die();
}
?>

  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content content_inside">
    <div class="header_text">
      <div class="header_text_left">Transport List</div>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>transport/p_transport.php"><i class="fa"></i>Back</a></div>
    </div>
    </div>
    <div style="clear:both;"></div>
    <div class="list" style="width:100%; height:480px; overflow:auto;">
      <table width="100%" align="center" class="table sakotable table-bordered table-striped dt-responsive">
	  <thead>
        <tr>
          <th>Destination</th>
          <th>Vehicle Number</th>
          <th>Fare</th>
          <th>Note</th>
        </tr>
		</thead>
		<tbody>
        <?php
				$result = mysql_query("Select * from tbl_add_transport order by transport_id desc",$link);
				while($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['destination']; ?></td>
          <td><?php echo $row['vehicle']; ?></td>
          <td><?php echo $row['fare']; ?></td>
          <td ><?php echo $row['note']; ?></td>
        </tr>
        <?php } mysql_close($link); ?>
		</tbody>
      </table>
    </div>
  </div>
 
  <?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
