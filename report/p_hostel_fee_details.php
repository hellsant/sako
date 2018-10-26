<?php 
include('../header.php');
include('../sako/common.php');
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
   $cval = 0;
if(isset($_GET['cval']) && $_GET['cval'] != ''){
	$cval = $_GET['cval'];
}

   $result = mysql_query("Select *,s.s_name,s.s_image,c.c_name from tbl_hostel_monthly_fee hm inner join tbl_add_hostel h on h.h_id = hm.hostel_id inner join tbl_add_hostel_member ht on ht.hmid = hm.h_member_id inner join tbl_add_month m on m.mid = hm.h_month inner join tbl_add_student s on s.s_id = ht.sid inner join tbl_add_class c on c.c_id = ht.cid where hm.h_member_id='".$_GET['id']."'",$link);

if($row = mysql_fetch_array($result)){
$s_image = WEB_URL . 'img/no_image.jpg';	
if(file_exists(ROOT_PATH . '/img/upload/' . $row['s_image']) && $row['s_image'] != ''){
$s_image = WEB_URL . 'img/upload/' . $row['s_image'];
}
  
?>
    <div align="center" style="width:100%;"><img class="img_ratio img-circle" src="<?php echo $s_image;  ?>"></div>
    <div class="details_top_text"><?php echo $row['s_name']; ?></div>
    <p>Class - <?php echo $row['c_name']; ?></p>
    <?php } ?>
  </div>
  <div style="margin:10px;">
    <h3 class="exam_table_style">Student's Information :</h3>
    <?php
	$id = '';
    $result = mysql_query("Select *,p.p_father_name from tbl_add_student s inner join tbl_add_hostel_member ht on ht.sid = s.s_id inner join tbl_hostel_monthly_fee hm on hm.h_member_id = ht.hmid inner join tbl_add_parent p on p.p_id = s.parent_id where hm.h_member_id='".$_GET['id']."'",$link);

	if($row = mysql_fetch_array($result)){?>
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
        </table>
      </div>
      <div class="col-md-6">
        <table class="table">
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
            <td><strong>Date of Birth:</strong></td>
            <td><?php echo $row['s_dob'];?></td>
          </tr>
        </table>
      </div>
    </div>
    <?php }  //mysql_query($link);?>
  </div>
  <div style="margin:10px;">
  <h4 class="exam_table_style">Student Monthly Hostel Fee Details</h4>
    <table class="table common_sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Month Name</th>
          <th>Monthly Fee</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
		$id = '';
		$result = mysql_query("Select *,h.h_name,ht.hostel_category,m.m_name from tbl_hostel_monthly_fee hm inner join tbl_add_hostel h on h.h_id = hm.hostel_id inner join tbl_add_hostel_member ht on ht.hmid = hm.h_member_id inner join tbl_add_month m on m.mid = hm.h_month where hm.h_member_id='".$_GET['id']."'",$link);
		while($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['m_name']; ?></td>
          <td><?php echo CURRENCY.' '.$row['h_amount']; ?></td>
          <td><?php echo $row['h_date']; ?></td>
        </tr>
        <?php } //mysql_close($link); ?>
      </tbody>
    </table>
  </div>
  <div style="padding:10px;" align="center"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>p_dashboard.php"><i class="fa fa-home"></i>&nbsp;Dashboard</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>report/p_hostel_fee_list.php?hid=<?php echo $_GET['id'];?>&cval=<?php echo $_GET['cval'];?>"><i class="fa fa-list"></i>&nbsp;Hostel Fee List</a></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
