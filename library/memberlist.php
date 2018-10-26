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
	$sqlx= mysqli_query($link,"DELETE FROM `tbl_library_member` WHERE lmid = ".$_GET['id']);
	mysqli_query($sqlx,$link); 
	$msg = 'Delete Student Successfully';
	$token = 'block';
}
?>
  <?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Student Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Student Information Successfully';
	$token = 'block';
}

?>
  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content content_inside">
    <div class="header_text">
      <div class="header_text_left">Member List</div>
      <div class="top_common_bar">
      	<div class="obj_left">
        	<select onChange="getClassData(this.value,'memberlist');" class="form-control" name="ddlClass">
            <option value="-1">--Select Class--</option>
			<?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_class order by c_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
                	<option <?php if(isset($_GET['cid']) && $_GET['cid'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
                <?php } ?>
            </select>	
        </div>
        <div class="obj_right">
        	<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>library/library.php"><i class="fa"></i>Library</a></div>
        </div>
      </div>
    <div style="clear:both;"></div>
    <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
    <div class="list" style="width:100%; height:480px; overflow:auto;">
      <table class="table sakotable table-bordered table-striped dt-responsive">
	  <thead>
        <tr>
          <th>Image</th>
		  <th>Library ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Class Name</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
				$result = '';
				if(isset($_GET['cid']) && $_GET['cid'] != ''){
					$result = mysqli_query($link,"Select *,c.c_name,s.s_id,c.c_id,m.sid,m.lmid from tbl_add_student s INNER JOIN tbl_add_class c on c_id=s_class_id left join tbl_library_member m on s.s_id = m.sid where s_class_id = '" . $_GET['cid'] . "' order by s_id desc");
				}
				else{
					$result = mysqli_query($link,"Select * from tbl_add_student where s_class_id = '-1' order by s_id desc");
				}
				while($row = mysqli_fetch_array($result)){
					
				$s_image = WEB_URL . 'img/no_image.jpg';	
		if(file_exists(ROOT_PATH . '/img/upload/' . $row['s_image']) && $row['s_image'] != ''){
			$s_image = WEB_URL . 'img/upload/' . $row['s_image'];
		}
					
					 ?>
        <tr>
          <td><img class="photo_img_round" style="width:50px;height:50px;" src="<?php echo $s_image;  ?>" /></td>
		  <td><?php echo $row['lmid']; ?></td>
          <td><?php echo $row['s_name']; ?></td>
          <td><?php echo $row['s_email']; ?></td>
          <td><?php echo $row['s_contact']; ?></td>
          <td><?php echo $row['c_name']; ?></td>
          <td><?php echo $row['s_address']; ?></td>
          <td><?php if(isset($row['lmid']) && $row['lmid'] != ''){ ?><a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>library/member_details.php?id=<?php echo $row['lmid']; ?>"><i class="fa fa-eye"></i></a><?php } else {?><a data-toggle="tooltip" data-placement="top" title="Add Member" class="btn btn-success btn-xs mrg" onclick="addLibraryMember(<?php echo $row['s_id']; ?>,<?php echo $row['c_id']; ?>);"><i class="fa fa-plus"></i></a><?php }?>&nbsp;&nbsp;<?php if(isset($row['lmid']) && $row['lmid'] != ''){ ?><a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteMember(<?php echo $row['lmid']; ?>,<?php echo $row['c_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a><?php } else {?>&nbsp;&nbsp;<?php }?></td>
        </tr>
        <?php } mysqli_close($link); ?>
		</tbody>
      </table>
    </div>
  </div>
  <script type="text/javascript">
  function deleteMember(id,cid){
  	var iAnswer = confirm("Are you sure you want to delete this Member ?");
	if(iAnswer){
		window.location = 'memberlist.php?id=' + id + '&cid=' + cid;
	}
  }
  </script>
  <?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
