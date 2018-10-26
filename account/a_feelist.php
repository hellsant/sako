<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>

<?php
$token = 'none';
$msg = '';

if(isset($_GET['fid']) && $_GET['fid'] != '' && $_GET['fid'] > 0){
	$sqlx= "DELETE FROM `tbl_student_fee` WHERE sf_id = ".$_GET['fid'];
	mysql_query($sqlx,$link); 
	$msg = 'Delete Student Fee Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Student Fee Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Student Fee Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Fee List</div>
    <div class="top_common_bar">
		<div class="obj_left">
        <select id="ddlClass" onChange="getRollClass(this.value,'a_feelist'),getRoll(this.value);" class="form-control" name="ddlClass">
          <option value="-1">--Select Class--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_class order by c_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cval']) && $_GET['cval'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_left">
        <select onChange="getRollData(this.value,'a_feelist');" class="form-control" name="ddlRoll" id="ddlRoll">
          <option value="-1">--Select Roll--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_student_fee where sf_class_id = '" . $_GET['cval'] . "' order by sf_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['sf_roll']){echo 'selected';}?> value="<?php echo $row_class['sf_roll'];?>"><?php echo $row_class['sf_roll'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/a_student_fee.php"><i class="fa fa-plus"></i>&nbsp;Add Fee</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/a_account.php"><i class="fa"></i>Account</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div>
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Class Name</th>
          <th>Student Name</th>
		  <th>Roll No.</th>
		  <th>Exam Type</th>
          <th>Date</th>
          <th>Exam Fee</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
			$result = '';
		  		if(isset($_GET['cval']) && $_GET['cval'] != '' && isset($_GET['tval']) && $_GET['tval'] != ''){
					$result = mysql_query("Select *,s.s_name,c.c_name,ss.schedule_name from tbl_student_fee sf inner join tbl_add_student s on sf.sf_name_id = s.s_id inner join tbl_add_class c on c.c_id = sf.sf_class_id inner join tbl_schedule_setup ss on sf.sf_exam_type = ss.schedule_id WHERE sf.sf_class_id = '" . $_GET['cval'] . "' and sf.sf_roll = '" . $_GET['tval'] . "' order by sf.sf_id desc ",$link);
				}
				else if(isset($_GET['cval']) && $_GET['cval'] != ''){
					$result = mysql_query("Select *,s.s_name,c.c_name,ss.schedule_name from tbl_student_fee sf inner join tbl_add_student s on sf.sf_name_id = s.s_id inner join tbl_add_class c on c.c_id = sf.sf_class_id inner join tbl_schedule_setup ss on sf.sf_exam_type = ss.schedule_id WHERE sf.sf_class_id = '" . $_GET['cval'] . "' order by sf.sf_id desc ",$link);
				}
				else if(isset($_GET['tval']) && $_GET['tval'] != ''){
					$result = mysql_query("Select *,s.s_name,c.c_name,ss.schedule_name from tbl_student_fee sf inner join tbl_add_student s on sf.sf_name_id = s.s_id inner join tbl_add_class c on c.c_id = sf.sf_class_id inner join tbl_schedule_setup ss on sf.sf_exam_type = ss.schedule_id WHERE sf.sf_roll = '" . $_GET['tval'] . "' order by sf.sf_id desc ",$link);
				}
				else if(isset($_GET['m']) && $_GET['m'] == 'i'){
					$result = mysql_query("Select *,s.s_name,c.c_name,ss.schedule_name from tbl_student_fee sf inner join tbl_add_student s on sf.sf_name_id = s.s_id inner join tbl_add_class c on c.c_id = sf.sf_class_id inner join tbl_schedule_setup ss on sf.sf_exam_type = ss.schedule_id WHERE sf.sf_id=(SELECT max(sf_id) FROM tbl_student_fee)",$link);
				}
				else{
					$result = mysql_query("Select * from tbl_student_fee where sf_class_id = '-1' order by sf_id desc",$link);
				}
				while($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['c_name']; ?></td>
		  <td><?php echo $row['s_name']; ?></td>
          <td><?php echo $row['sf_roll']; ?></td>
          <td><?php echo $row['schedule_name']; ?></td>
          <td><?php echo $row['sf_date']; ?></td>
          <td><?php echo CURRENCY.' '.$row['sf_amount']; ?></td>
          <td><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>account/a_student_fee.php?id=<?php echo $row['sf_id']; ?>&tval=<?php echo $row['sf_roll'];?>&cval=<?php echo $row['sf_class_id'];?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteFee(<?php echo $row['sf_id']; ?>,<?php echo $_GET['cval']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteFee(sfid,cval){
  	var iAnswer = confirm("Are you sure you want to delete this Student Fee ?");
	if(iAnswer){
		window.location = 'a_feelist.php?fid=' + sfid + "&cval=" + cval;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
