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
	$sqlx= "DELETE FROM `tbl_transport_monthly_fee` WHERE t_id = ".$_GET['id'];
	mysql_query($sqlx,$link); 
	$msg = 'Delete Student Transport Fee Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Student Transport Fee Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Student Transport Fee Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Transport Fee List</div>
    <div class="top_common_bar">
	<div class="obj_left">
        <select id="ddlClass" onChange="getRollClass(this.value,'transport_fee_list');" class="form-control" name="ddlClass">
          <option value="-1">--Select Class--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_class order by c_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cval']) && $_GET['cval'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_left">
        <select onChange="getRollData(this.value,'transport_fee_list');" class="form-control" name="ddlRoll" id="ddlRoll">
          <option value="-1">--Select Destination--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_transport order by transport_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['transport_id']){echo 'selected';}?> value="<?php echo $row_class['transport_id'];?>"><?php echo $row_class['destination'];?></option>
          <?php }?>
        </select>
      </div>
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/add_transport_fee.php"><i class="fa fa-plus"></i>&nbsp;Transport Fee</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/account.php"><i class="fa"></i>Account</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div class="list" style="width:100%;">
    <table class="table common_sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Class Name</th>
          <th>Student Name</th>
		  <th>Roll No.</th>
		  <th>Month</th>
          <th>Date</th>
		  <th>Destination</th>
          <th>Amount</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
				if(isset($_GET['cval']) && $_GET['cval'] != '-1' && isset($_GET['tval']) && $_GET['tval'] != '-1'){
				$result = mysql_query("Select *,s.s_name,s.s_roll_no,c.c_name,m.m_name,tm.tpm_destination,ts.transport_id from tbl_transport_monthly_fee tf inner join tbl_add_tp_member tm on tm.tpm_id = tf.t_member_id inner join tbl_add_student s on tm.sid = s.s_id inner join tbl_add_class c on c.c_id = tm.cid inner join tbl_add_month m on m.mid = tf.t_month inner join tbl_add_transport ts on ts.transport_id = tm.tpm_destination WHERE c.c_id = '" . $_GET['cval'] . "' and ts.transport_id = '" . $_GET['tval'] . "' order by tf.t_id desc",$link);
				}
				else if(isset($_GET['cval']) && $_GET['cval'] != '-1'){
			$result = mysql_query("Select *,s.s_name,s.s_roll_no,c.c_name,m.m_name,tm.tpm_destination,ts.transport_id from tbl_transport_monthly_fee tf inner join tbl_add_tp_member tm on tm.tpm_id = tf.t_member_id inner join tbl_add_student s on tm.sid = s.s_id inner join tbl_add_class c on c.c_id = tm.cid inner join tbl_add_month m on m.mid = tf.t_month inner join tbl_add_transport ts on ts.transport_id = tm.tpm_destination WHERE c.c_id = '" . $_GET['cval'] . "' order by tf.t_id desc",$link);
				}
			else if(isset($_GET['tval']) && $_GET['tval'] != '-1'){
			$result = mysql_query("Select *,s.s_name,s.s_roll_no,c.c_name,m.m_name,tm.tpm_destination,ts.transport_id from tbl_transport_monthly_fee tf inner join tbl_add_tp_member tm on tm.tpm_id = tf.t_member_id inner join tbl_add_student s on tm.sid = s.s_id inner join tbl_add_class c on c.c_id = tm.cid inner join tbl_add_month m on m.mid = tf.t_month inner join tbl_add_transport ts on ts.transport_id = tm.tpm_destination WHERE ts.transport_id = '" . $_GET['tval'] . "' order by tf.t_id desc",$link);
			}
			else if(isset($_GET['m']) && $_GET['m'] == 'i'){
					$result = mysql_query("Select *,s.s_name,s.s_roll_no,c.c_name,m.m_name,tm.tpm_destination,ts.transport_id from tbl_transport_monthly_fee tf inner join tbl_add_tp_member tm on tm.tpm_id = tf.t_member_id inner join tbl_add_student s on tm.sid = s.s_id inner join tbl_add_class c on c.c_id = tm.cid inner join tbl_add_month m on m.mid = tf.t_month inner join tbl_add_transport ts on ts.transport_id = tm.tpm_destination WHERE tf.t_id=(SELECT max(t_id) FROM tbl_transport_monthly_fee)",$link);
				}
			else{
				$result = mysql_query("Select * from tbl_transport_monthly_fee where t_member_id = '-1' order by t_id desc",$link);
			}
				while($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['c_name']; ?></td>
		  <td><?php echo $row['s_name']; ?></td>
          <td><?php echo $row['s_roll_no']; ?></td>
          <td><?php echo $row['m_name']; ?></td>
          <td><?php echo $row['t_date']; ?></td>
		  <td><?php echo $row['t_destination']; ?></td>
          <td><?php echo CURRENCY.' '.$row['t_amount']; ?></td>
          <td><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>account/add_transport_fee.php?id=<?php echo $row['t_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteTransport(<?php echo $row['t_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteTransport(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Student Transport Fee ?");
	if(iAnswer){
		window.location = 'transport_fee_list.php?id=' + Id;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
