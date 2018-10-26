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
	$sqlx= "DELETE FROM `tbl_add_tp_member` WHERE tpm_id = ".$_GET['id'];
	mysql_query($sqlx,$link); 
	$msg = 'Delete Transport Member Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Transport Member Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Transport Member Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Transport Member List</div>
    <!--<div class="header_text_right"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>student/add_student.php"><i class="fa fa-plus"></i>&nbsp;Add Student</a></div>-->
    <div class="top_common_bar">
      <div class="obj_left">
        <select onChange="getClassData(this.value,'t_member_list');" class="form-control" name="ddlClass">
          <option value="-1">--Select Class--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_class order by c_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cid']) && $_GET['cid'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_right"> <a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>transport/transport.php"><i class="fa"></i>Transport</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div class="list" style="width:100%;">
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Class Name</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <!-- onclick="addTransportMember(<?php //echo $row['s_id']; ?>,<?php //echo $row['c_id']; ?>);"-->
      <tbody>
        <?php
		
				$result = '';
				if(isset($_GET['cid']) && $_GET['cid'] != ''){
					$result = mysql_query("Select *,c.c_name,s.s_id,c.c_id,m.sid,m.tpm_id from tbl_add_student s INNER JOIN tbl_add_class c on c_id=s_class_id left join tbl_add_tp_member m on s.s_id = m.sid where s_class_id = '" . $_GET['cid'] . "' order by s_id desc",$link);
				}
				else{
					$result = mysql_query("Select * from tbl_add_student where s_class_id = '-1' order by s_id desc",$link);
				}
				while($row = mysql_fetch_array($result)){
					
				$s_image = WEB_URL . 'img/no_image.jpg';	
		if(file_exists(ROOT_PATH . '/img/upload/' . $row['s_image']) && $row['s_image'] != ''){
			$s_image = WEB_URL . 'img/upload/' . $row['s_image'];
		}
					
					 ?>
        <tr>
          <td><img class="photo_img_round" style="width:50px;height:50px;" src="<?php echo $s_image;  ?>" /></td>
          <td><?php echo $row['s_name']; ?></td>
          <td><?php echo $row['s_email']; ?></td>
          <td><?php echo $row['s_contact']; ?></td>
          <td><?php echo $row['c_name']; ?></td>
          <td><?php echo $row['s_address']; ?></td>
          <td><?php if(isset($row['tpm_id']) && $row['tpm_id'] != ''){ ?>
            <a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>transport/t_member_details.php?id=<?php echo $row['tpm_id']; ?>&cid=<?php echo $row['c_id']; ?>"><i class="fa fa-eye"></i></a>
            <?php } else {?>
            <a data-toggle="tooltip" data-placement="top" title="Add Member" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>transport/add_t_member.php?sid=<?php echo $row['s_id']; ?>&cid=<?php echo $row['c_id']; ?>"><i class="fa fa-plus"></i></a>
            <?php }?>
            &nbsp;&nbsp;
            <?php if(isset($row['tpm_id']) && $row['tpm_id'] != ''){ ?>
            <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>transport/add_t_member.php?id=<?php echo $row['tpm_id']; ?>&cid=<?php echo $row['c_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteMember(<?php echo $row['tpm_id']; ?>,<?php echo $row['c_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>
            <?php } else {?>
            &nbsp;&nbsp;
            <?php }?></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteMember(tpid,cid){
  	var iAnswer = confirm("Are you sure you want to delete this Member ?");
	if(iAnswer){
		window.location = 't_member_list.php?id=' + tpid + "&cid=" + cid ;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
