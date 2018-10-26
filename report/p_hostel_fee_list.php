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
        <select id="ddlClass" onChange="getRollClass(this.value,'p_hostel_fee_list');" class="form-control" name="ddlClass">
          <option value="-1">--Select Class--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_class order by c_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cval']) && $_GET['cval'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_left">
        <select onChange="getRollData(this.value,'p_hostel_fee_list');" class="form-control" name="ddlRoll" id="ddlRoll">
          <option value="-1">--Select Hostel--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_hostel order by h_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['h_id']){echo 'selected';}?> value="<?php echo $row_class['h_id'];?>"><?php echo $row_class['h_name'];?></option>
          <?php }?>
        </select>
      </div>
	  <div class="obj_left">
        <input type="text" class="form-control" <?php if($member_id == $row_class['h_member_id']){echo 'selected';}?> id="txt_member_id" name="txt_member_id" value="<?php echo $member_id; ?>" placeholder="Member Id" />
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
		  <th>Hostel Name</th>
		  <th>Hostel Category</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
			if(isset($_GET['cval']) && $_GET['cval'] != '-1' && isset($_GET['tval']) && $_GET['tval'] != ''){
			$result = mysql_query("Select *,c.c_name,s.s_name,s.s_roll_no,h.h_name,m.m_name,hm.hostel_category from tbl_hostel_monthly_fee hf inner join tbl_add_hostel_member hm on hm.hmid = h_member_id inner join tbl_add_student s on s.s_id = hm.sid inner join tbl_add_class c on c.c_id = hm.cid inner join tbl_add_hostel h on h.h_id = hm.hostel_name inner join tbl_add_month m on m.mid = hf.h_month WHERE c.c_id = '" . $_GET['cval'] . "' and h.h_id = '" . $_GET['tval'] . "' order by hf.htl_id desc",$link);
			}
			else if(isset($_GET['cval']) && $_GET['cval'] != '-1'){
			$result = mysql_query("Select *,c.c_name,s.s_name,s.s_roll_no,h.h_name,m.m_name,hm.hostel_category from tbl_hostel_monthly_fee hf inner join tbl_add_hostel_member hm on hm.hmid = h_member_id inner join tbl_add_student s on s.s_id = hm.sid inner join tbl_add_class c on c.c_id = hm.cid inner join tbl_add_hostel h on h.h_id = hm.hostel_name inner join tbl_add_month m on m.mid = hf.h_month WHERE c.c_id = '" . $_GET['cval'] . "' order by hf.htl_id desc",$link);
				}
			else if(isset($_GET['tval']) && $_GET['tval'] != '-1'){
			$result = mysql_query("Select *,c.c_name,s.s_name,s.s_roll_no,h.h_name,m.m_name,hm.hostel_category from tbl_hostel_monthly_fee hf inner join tbl_add_hostel_member hm on hm.hmid = h_member_id inner join tbl_add_student s on s.s_id = hm.sid inner join tbl_add_class c on c.c_id = hm.cid inner join tbl_add_hostel h on h.h_id = hm.hostel_name inner join tbl_add_month m on m.mid = hf.h_month WHERE h.h_id = '" . $_GET['tval'] . "' order by hf.htl_id desc",$link);
			}
			else if(isset($_GET['m']) && $_GET['m'] == 'i'){
					$result = mysql_query("Select *,c.c_name,s.s_name,s.s_roll_no,h.h_name,m.m_name,hm.hostel_category from tbl_hostel_monthly_fee hf inner join tbl_add_hostel_member hm on hm.hmid = h_member_id inner join tbl_add_student s on s.s_id = hm.sid inner join tbl_add_class c on c.c_id = hm.cid inner join tbl_add_hostel h on h.h_id = hm.hostel_name inner join tbl_add_month m on m.mid = hf.h_month WHERE hf.htl_id=(SELECT max(htl_id) FROM tbl_hostel_monthly_fee)",$link);
			}
			else if(isset($_GET['member_id']) && $_GET['member_id'] != ''){
				$result = mysql_query("Select *,c.c_name,s.s_name,s.s_roll_no,h.h_name,m.m_name,hm.hostel_category from tbl_hostel_monthly_fee hf inner join tbl_add_hostel_member hm on hm.hmid = h_member_id inner join tbl_add_student s on s.s_id = hm.sid inner join tbl_add_class c on c.c_id = hm.cid inner join tbl_add_hostel h on h.h_id = hm.hostel_name inner join tbl_add_month m on m.mid = hf.h_month WHERE hf.h_member_id = '" . $_GET['member_id'] . "' order by hf.htl_id desc",$link);
			}
			else{
				$result = mysql_query("Select * from tbl_hostel_monthly_fee where h_member_id = '-1' order by htl_id desc",$link);
			}
			if($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['c_name']; ?></td>
		  <td><?php echo $row['s_name']; ?></td>
		  <td><?php echo $row['s_roll_no']; ?></td>
          <td><?php echo $row['h_name']; ?></td>
		  <td><?php echo $row['hostel_category']; ?></td>
          <td><a data-toggle="tooltip" data-placement="top" title="View Details" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>report/p_hostel_fee_details.php?id=<?php echo $row['h_member_id']; ?>&cval=<?php echo $row['c_id']; ?>"><i class="fa fa-eye"></i></a></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function gotoMemberInfo(){
  	if($("#txt_member_id").val() != ''){
		window.location = "<?php echo WEB_URL . 'report/p_hostel_fee_list.php?member_id='; ?>" + $("#txt_member_id").val();
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
