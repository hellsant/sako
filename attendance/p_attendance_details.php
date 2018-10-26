<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'parents'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="bio-graph-heading">
    <?php
 
	$id = '';
   $result = mysql_query("Select *,c.c_name,s.s_image from tbl_student_attendance a inner join tbl_add_student s on a.sid = s.s_id inner join tbl_add_class c on a.cid = c.c_id where a.sid='".$_GET['sid']."'",$link);

if($row = mysql_fetch_array($result)){
$s_image = WEB_URL . 'img/no_image.jpg';	
if(file_exists(ROOT_PATH . '/img/upload/' . $row['s_image']) && $row['s_image'] != ''){
$s_image = WEB_URL . 'img/upload/' . $row['s_image'];
}
  
?>
    <div align="center" style="width:100%;"><img class="img_ratio img-circle" src="<?php echo $s_image;  ?>"></div>
    <div class="details_top_text"><?php echo $row['s_name']; ?></div>
    <p><?php echo $row['c_name']; ?></p>
    <?php } ?>
  </div>
  <div style="padding:10px;">
    <h3 class="exam_table_style">Personal Information :</h3>
    <?php
    $result_info = mysql_query("Select a.sid,a.cid,a.attendance,a.roll_no,a.added_date,s.s_name,s.s_id,s.s_email,s.s_contact,p.p_father_name,s.s_dob,s.s_address,c.c_name,s.s_roll_no,s.s_gender,s.s_religion,s.s_profile_name,s.s_image from tbl_student_attendance a inner join tbl_add_student s on a.sid = s.s_id inner join tbl_add_class c on a.cid = c.c_id inner join tbl_add_parent p on p.p_id = s.parent_id where a.sid='".$_GET['sid']."' and a.cid = '".$_GET['cid']."'",$link);

	if($row = mysql_fetch_array($result_info)){?>
    <div style="font-size:13px;text-align:left;" class="row">
      <div class="col-md-6">
        <table class="table">
          <tr>
            <td><strong>Father's Name:</strong></td>
            <td><?php echo $row['p_father_name'];?></td>
          </tr>
          <tr>
            <td><strong>Email:</strong></td>
            <td><?php echo $row['s_email'];?></td>
          </tr>
          <tr>
            <td><strong>Phone:</strong></td>
            <td><?php echo $row['s_contact'];?></td>
          </tr>
          <tr>
            <td><strong>Address:</strong></td>
            <td><?php echo $row['s_address'];?></td>
          </tr>
          <tr>
            <td><strong>Date of Birth:</strong></td>
            <td><?php echo $row['s_dob'];?></td>
          </tr>
        </table>
      </div>
      <div class="col-md-6">
        <table class="table">
          <tr>
            <td><strong>Class Name:</strong></td>
            <td><?php echo $row['c_name'];?></td>
          </tr>
          <tr>
            <td><strong>Roll No:</strong></td>
            <td><?php echo $row['s_roll_no'];?></td>
          </tr>
          <tr>
            <td><strong>Gender:</strong></td>
            <td><?php echo $row['s_gender'];?></td>
          </tr>
          <tr>
            <td><strong>Religion:</strong></td>
            <td><?php echo $row['s_religion'];?></td>
          </tr>
          <tr>
            <td><strong>Profile Name:</strong></td>
            <td><?php echo $row['s_profile_name'];?></td>
          </tr>
        </table>
      </div>
    </div>
    <?php }  //mysql_query($link);?>
  </div>
  <div style="padding:10px;">
    <h3 class="exam_table_style">Attendance Information</h3>
    <div>
      <select class="form-control" onchange="getStudentAttByMonthForParents(this.value);" id="ddlFMonth" name="ddlFMonth">
        <option>--Select--</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '1'){echo 'selected';}?> value="1">January</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '2'){echo 'selected'; }?> value="2">February</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '3'){echo 'selected';}?> value="3">March</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '4'){echo 'selected';}?> value="4">April</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '5'){echo 'selected';}?> value="5">May</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '6'){echo 'selected';}?> value="6">June</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '7'){echo 'selected';}?> value="7">July</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '8'){echo 'selected';}?> value="8">August</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '9'){echo 'selected';}?> value="9">September</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '10'){echo 'selected';}?> value="10">October</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '11'){echo 'selected';}?> value="11">November</option>
        <option <?php if(isset($_GET['mval']) && $_GET['mval'] == '12'){echo 'selected';}?> value="12">December</option>
      </select>
    </div>
    <table class="table common_sakotable_routine table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>#</th>
          <?php
		  	$month_val = date('m');
			$monthName = date("F");
			$monthLastDay = date("t");
			if(isset($_GET['mval'])){
				$dateObj   = DateTime::createFromFormat('!m', $_GET['mval']);
				$monthName = $dateObj->format('F');
				$monthLastDay = $dateObj->format('t');
				$month_val = $dateObj->format('m');
			}
			for($i=1;$i<=(int)$monthLastDay;$i++){
				echo "<th style='width:10px;'>".$i."</th>";
			}
		  ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $monthName; ?></td>
          <?php
		
		for($i=1;$i<=(int)$monthLastDay;$i++){
		if($i < 10){
			$i = (int)0 . $i;
		}
		$xdate = $i . '/' . $month_val . '/' . date('Y');
		$result_att = mysql_query("Select * from tbl_student_attendance where sid='".$_GET['sid']."' and cid='".$_GET['cid']."' and a_month='".(int)date('m')."' and a_year='".(int)date('Y')."' and added_date = '" .$xdate. "' order by aid asc",$link);
		if($row_att = mysql_fetch_array($result_att)){?>
          <td><?php if($row_att['added_date'] == $xdate && $row_att['attendance'] == '1'){echo 'P';} else {echo '&nbsp;';} ?></td>
          <?php } else echo '<td>&nbsp;</td>';} //mysql_close($link); } ?>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="padding:10px;" align="center"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>p_dashboard.php"><i class="fa fa-home"></i>&nbsp;Dashboard</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>attendance/p_viewattendance.php?cid=<?php echo $_GET['cid']; ?>"><i class="fa fa-list"></i>&nbsp;Back To List</a></div>
</div>
<input type="hidden" id="a_cid" value="<?php if(isset($_GET['cid']) && $_GET['cid'] != ''){echo $_GET['cid']; }?>" />
<input type="hidden" id="a_sid" value="<?php if(isset($_GET['sid']) && $_GET['sid'] != ''){echo $_GET['sid']; }?>" />
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
