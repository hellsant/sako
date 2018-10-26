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
	$sqlx= "DELETE FROM `tbl_hostel_monthly_fee` WHERE htl_id = ".$_GET['id'];
	mysql_query($sqlx,$link); 
	$msg = 'Delete Student Hostel Fee Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Student Hostel Fee Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Student Hostel Fee Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Hostel Monthly Fee List</div>
    <div class="top_common_bar">
	  <div class="obj_left">
        <select id="ddlClass" onChange="getRollClass(this.value,'a_hostel_fee_list');" class="form-control" name="ddlClass">
          <option value="-1">--Select Class--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_class order by c_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cval']) && $_GET['cval'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_left">
        <select onChange="getRollData(this.value,'a_hostel_fee_list');" class="form-control" name="ddlRoll" id="ddlRoll">
          <option value="-1">--Select Hostel--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_hostel order by h_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['h_id']){echo 'selected';}?> value="<?php echo $row_class['h_id'];?>"><?php echo $row_class['h_name'];?></option>
          <?php }?>
        </select>
      </div>
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/a_add_hostel_fee.php"><i class="fa fa-plus"></i>&nbsp;Hostel Fee</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/a_account.php"><i class="fa"></i>Account</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div class="list" style="width:100%;">
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Class Name</th>
          <th>Student Name</th>
		  <th>Hostel Name</th>
		  <th>Month</th>
          <th>Date</th>
          <th>Monthly Fee</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
			if(isset($_GET['cval']) && $_GET['cval'] != '-1' && isset($_GET['tval']) && $_GET['tval'] != '-1'){
			$result = mysql_query("Select *,c.c_name,s.s_name,h.h_name,m.m_name from tbl_hostel_monthly_fee hf inner join tbl_add_hostel_member hm on hm.hmid = h_member_id inner join tbl_add_student s on s.s_id = hm.sid inner join tbl_add_class c on c.c_id = hm.cid inner join tbl_add_hostel h on h.h_id = hm.hostel_name inner join tbl_add_month m on m.mid = hf.h_month WHERE c.c_id = '" . $_GET['cval'] . "' and h.h_id = '" . $_GET['tval'] . "' order by hf.htl_id desc",$link);
			}
			else if(isset($_GET['cval']) && $_GET['cval'] != '-1'){
			$result = mysql_query("Select *,c.c_name,s.s_name,h.h_name,m.m_name from tbl_hostel_monthly_fee hf inner join tbl_add_hostel_member hm on hm.hmid = h_member_id inner join tbl_add_student s on s.s_id = hm.sid inner join tbl_add_class c on c.c_id = hm.cid inner join tbl_add_hostel h on h.h_id = hm.hostel_name inner join tbl_add_month m on m.mid = hf.h_month WHERE c.c_id = '" . $_GET['cval'] . "' order by hf.htl_id desc",$link);
				}
			else if(isset($_GET['tval']) && $_GET['tval'] != '-1'){
			$result = mysql_query("Select *,c.c_name,s.s_name,h.h_name,m.m_name from tbl_hostel_monthly_fee hf inner join tbl_add_hostel_member hm on hm.hmid = h_member_id inner join tbl_add_student s on s.s_id = hm.sid inner join tbl_add_class c on c.c_id = hm.cid inner join tbl_add_hostel h on h.h_id = hm.hostel_name inner join tbl_add_month m on m.mid = hf.h_month WHERE h.h_id = '" . $_GET['tval'] . "' order by hf.htl_id desc",$link);
			}
			else if(isset($_GET['m']) && $_GET['m'] == 'i'){
					$result = mysql_query("Select *,c.c_name,s.s_name,h.h_name,m.m_name from tbl_hostel_monthly_fee hf inner join tbl_add_hostel_member hm on hm.hmid = h_member_id inner join tbl_add_student s on s.s_id = hm.sid inner join tbl_add_class c on c.c_id = hm.cid inner join tbl_add_hostel h on h.h_id = hm.hostel_name inner join tbl_add_month m on m.mid = hf.h_month WHERE hf.htl_id=(SELECT max(htl_id) FROM tbl_hostel_monthly_fee)",$link);
				}
			else{
				$result = mysql_query("Select * from tbl_hostel_monthly_fee where h_member_id = '-1' order by htl_id desc",$link);
			}
			while($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['c_name']; ?></td>
		  <td><?php echo $row['s_name']; ?></td>
          <td><?php echo $row['h_name']; ?></td>
          <td><?php echo $row['m_name']; ?></td>
          <td><?php echo $row['h_date']; ?></td>
		  <td><?php echo CURRENCY.' '.$row['h_amount']; ?></td>
          <td><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>account/a_add_hostel_fee.php?id=<?php echo $row['htl_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteTransport(<?php echo $row['htl_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteTransport(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Student Hostel Fee ?");
	if(iAnswer){
		window.location = 'a_hostel_fee_list.php?id=' + Id;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
