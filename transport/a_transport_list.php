<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>

<?php
$token = 'none';
$msg = '';

if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx= "DELETE FROM `tbl_add_transport` WHERE transport_id = ".$_GET['id'];
	mysql_query($sqlx,$link); 
	$msg = 'Delete Transport Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Transport Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Transport Information Successfully';
	$token = 'block';
}

?>    
  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content content_inside">
    <div class="header_text">
      <div class="header_text_left">Transport List</div>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>transport/a_add_transport.php"><i class="fa fa-plus"></i>&nbsp;Add Transport</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>transport/a_transport.php"><i class="fa"></i>Transport</a></div>
    </div>
    </div>
    <div style="clear:both;"></div>
    <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
    <div class="list" style="width:100%;">
      <table width="100%" align="center" class="table sakotable table-bordered table-striped dt-responsive">
	  <thead>
        <tr>
          <th>Destination</th>
          <th>Vehicle Number</th>
          <th>Fare</th>
          <th>Note</th>
          <th>Action</th>
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
          <td align="center"><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-xs mrg" href="<?php echo WEB_URL;?>transport/a_add_transport.php?id=<?php echo $row['transport_id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteTransport(<?php echo $row['transport_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysql_close($link); ?>
		</tbody>
      </table>
    </div>
  </div>
  <script type="text/javascript">
  function deleteTransport(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Transport ?");
	if(iAnswer){
		window.location = 'a_transport_list.php?id=' + Id;
	}
  }
  </script>
  <?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
