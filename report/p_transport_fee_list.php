<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'parents'){
	header("Location: logout.php");
	die();
}
?>

<?php
$member_id = '';
if(isset($_GET['member_id']) && $_GET['member_id'] != ''){
	$member_id = $_GET['member_id'];
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Hostel Monthly Fee List</div><br/>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>report/p_report.php"><i class="fa"></i>Back To Report</a></div>
    </div>
	<div>
		<div class="obj_left">
        <select id="ddlClass" onChange="getRollClass(this.value,'p_transport_fee_list');" class="form-control" name="ddlClass">
          <option value="-1">--Select Class--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_class order by c_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cval']) && $_GET['cval'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_left">
        <select onChange="getRollData(this.value,'p_transport_fee_list');" class="form-control" name="ddlRoll" id="ddlRoll">
          <option value="-1">--Select Destination--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_transport order by transport_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['transport_id']){echo 'selected';}?> value="<?php echo $row_class['transport_id'];?>"><?php echo $row_class['destination'];?></option>
          <?php }?>
        </select>
      </div>
	  <div class="obj_left">
        <input type="text" class="form-control" id="txt_member_id" name="txt_member_id" value="<?php echo $member_id; ?>" placeholder="Member Id" />
      </div>
	  <div class="obj_left">
	  	&nbsp;&nbsp;<a href="javascript:;" onclick="gotoMemberInfo();" class="btn btn_add_new btn-danger"><i class="fa"></i>Submit</a>
	  </div>
	</div>
  </div>
  <div style="clear:both;"></div>
  <div class="list" style="width:100%; height:480px; overflow:auto;">
    <table class="table common_sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Class Name</th>
          <th>Student Name</th>
		  <th>Roll No</th>
		  <th>Destination</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
			if(isset($_GET['cval']) && $_GET['cval'] != '-1' && isset($_GET['tval']) && $_GET['tval'] != '-1'){
				$result = mysql_query("Select *,s.s_name,s.s_roll_no,c.c_name,m.m_name,tm.tpm_destination,ts.transport_id,ts.destination from tbl_transport_monthly_fee tf inner join tbl_add_tp_member tm on tm.tpm_id = tf.t_member_id inner join tbl_add_student s on tm.sid = s.s_id inner join tbl_add_class c on c.c_id = tm.cid inner join tbl_add_month m on m.mid = tf.t_month inner join tbl_add_transport ts on ts.transport_id = tm.tpm_destination WHERE c.c_id = '" . $_GET['cval'] . "' and ts.transport_id = '" . $_GET['tval'] . "' order by tf.t_id desc",$link);
				}
				else if(isset($_GET['cval']) && $_GET['cval'] != '-1'){
			$result = mysql_query("Select *,s.s_name,s.s_roll_no,c.c_name,m.m_name,tm.tpm_destination,ts.transport_id,ts.destination from tbl_transport_monthly_fee tf inner join tbl_add_tp_member tm on tm.tpm_id = tf.t_member_id inner join tbl_add_student s on tm.sid = s.s_id inner join tbl_add_class c on c.c_id = tm.cid inner join tbl_add_month m on m.mid = tf.t_month inner join tbl_add_transport ts on ts.transport_id = tm.tpm_destination WHERE c.c_id = '" . $_GET['cval'] . "' order by tf.t_id desc",$link);
				}
			else if(isset($_GET['tval']) && $_GET['tval'] != '-1'){
			$result = mysql_query("Select *,s.s_name,s.s_roll_no,c.c_name,m.m_name,tm.tpm_destination,ts.transport_id,ts.destination from tbl_transport_monthly_fee tf inner join tbl_add_tp_member tm on tm.tpm_id = tf.t_member_id inner join tbl_add_student s on tm.sid = s.s_id inner join tbl_add_class c on c.c_id = tm.cid inner join tbl_add_month m on m.mid = tf.t_month inner join tbl_add_transport ts on ts.transport_id = tm.tpm_destination WHERE ts.transport_id = '" . $_GET['tval'] . "' order by tf.t_id desc",$link);
			}
			else if(isset($_GET['m']) && $_GET['m'] == 'i'){
					$result = mysql_query("Select *,s.s_name,s.s_roll_no,c.c_name,m.m_name,tm.tpm_destination,ts.transport_id,ts.destination from tbl_transport_monthly_fee tf inner join tbl_add_tp_member tm on tm.tpm_id = tf.t_member_id inner join tbl_add_student s on tm.sid = s.s_id inner join tbl_add_class c on c.c_id = tm.cid inner join tbl_add_month m on m.mid = tf.t_month inner join tbl_add_transport ts on ts.transport_id = tm.tpm_destination WHERE tf.t_id=(SELECT max(t_id) FROM tbl_transport_monthly_fee)",$link);
				}
			else if(isset($_GET['member_id']) && $_GET['member_id'] != ''){
				$result = mysql_query("Select *,s.s_name,s.s_roll_no,c.c_name,m.m_name,tm.tpm_destination,ts.transport_id,ts.destination from tbl_transport_monthly_fee tf inner join tbl_add_tp_member tm on tm.tpm_id = tf.t_member_id inner join tbl_add_student s on tm.sid = s.s_id inner join tbl_add_class c on c.c_id = tm.cid inner join tbl_add_month m on m.mid = tf.t_month inner join tbl_add_transport ts on ts.transport_id = tm.tpm_destination WHERE tf.t_member_id = '" . $_GET['member_id'] . "' order by tf.t_id desc",$link);
			}
			else{
				$result = mysql_query("Select * from tbl_transport_monthly_fee where t_member_id = '-1' order by t_id desc",$link);
			}
			if($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['c_name']; ?></td>
		  <td><?php echo $row['s_name']; ?></td>
		  <td><?php echo $row['s_roll_no']; ?></td>
          <td><?php echo $row['destination']; ?></td>
          <td><a data-toggle="tooltip" data-placement="top" title="View Details" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>report/p_transport_fee_details.php?id=<?php echo $row['t_member_id']; ?>&cval=<?php echo $row['c_id']; ?>"><i class="fa fa-eye"></i></a></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function gotoMemberInfo(){
  	if($("#txt_member_id").val() != ''){
		window.location = "<?php echo WEB_URL . 'report/p_transport_fee_list.php?member_id='; ?>" + $("#txt_member_id").val();
	}
	else{
		alert("Member Id Required !!!");
		$("#txt_member_id").focus();
		$("#ddlClass").val("-1");
		$("#ddlRoll").val("-1");
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
