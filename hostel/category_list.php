<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php
$token = 'none';
$msg = '';

if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx= "DELETE FROM `tbl_add_hostel` WHERE h_id = ".$_GET['id'];
	mysql_query($sqlx,$link); 
	$msg = 'Delete Category Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Category Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Category Information Successfully';
	$token = 'block';
}

?> 


<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Category List</div>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>hostel/add_category.php"><i class="fa fa-plus"></i>&nbsp;Add Category</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>hostel/hostel.php"><i class="fa"></i>Hostel Dashboard</a></div>
    </div>
    </div>
    <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div>
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Hostel Name</th>
          <th>Hostel Category</th>
		  <th>Hostel Fee</th>
		  <th>Note</th>
          <th>Action</th>
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
          <td><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>hostel/add_category.php?id=<?php echo $row['category_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteCategory(<?php echo $row['category_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
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
