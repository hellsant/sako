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
	$sqlx= "DELETE FROM `tbl_add_fee_set` WHERE fs_id = ".$_GET['id'];
	mysql_query($sqlx,$link); 
	$msg = 'Delete Fee Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Fee Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Fee Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Fee Set List</div>
    <div class="top_common_bar">
	   <div class="obj_left">
        <select id="ddlClass" onChange="getRollClass1(this.value,'a_fee_set_list');" class="form-control" name="ddlClass">
          <option value="-1">--Select Class--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_class order by c_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cval']) && $_GET['cval'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/a_fee_set.php"><i class="fa fa-plus"></i>&nbsp;Add Fee</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/a_account.php"><i class="fa"></i>Account</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div class="list" style="width:100%;">
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Class Name</th>
          <th>Fee Type</th>
		  <th>Fee</th>
          <th>Date</th>
		  <th>Fine</th>
		  <th>Fine Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
	  	<?php
			$result = '';
		  		if(isset($_GET['cval']) && $_GET['cval'] != ''){
					$result = mysql_query("Select *,c.c_name,ft.fee_type from tbl_add_fee_set fs inner join tbl_add_class c on fs.class_name_id = c.c_id inner join tbl_add_fee_type ft on fs.f_type_id = ft.ft_id WHERE fs.class_name_id = '" . $_GET['cval'] . "' order by fs.fs_id desc",$link);
				}
				else if(isset($_GET['m']) && $_GET['m'] == 'i'){
					$result = mysql_query("Select *,c.c_name,ft.fee_type from tbl_add_fee_set fs inner join tbl_add_class c on fs.class_name_id = c.c_id inner join tbl_add_fee_type ft on fs.f_type_id = ft.ft_id WHERE fs.fs_id=(SELECT max(fs_id) FROM tbl_add_fee_set)",$link);
				}
				else{
					$result = mysql_query("Select * from tbl_add_fee_set where class_name_id = '-1' order by fs_id desc",$link);
				}
				while($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['c_name']; ?></td>
		  <td><?php echo $row['fee_type']; ?></td>
          <td><?php echo CURRENCY.' '.$row['f_fee']; ?></td>
          <td><?php echo $row['f_date']; ?></td>
		  <td><?php echo CURRENCY.' '.$row['f_fine']; ?></td>
		  <td><?php echo $row['fine_date']; ?></td>
          <td><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>account/a_fee_set.php?id=<?php echo $row['fs_id']; ?>&cval=<?php echo $row['class_name_id'];?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteFee(<?php echo $row['fs_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteFee(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Fee ?");
	if(iAnswer){
		window.location = 'a_fee_set_list.php?id=' + Id;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
