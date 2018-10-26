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

   $result = mysql_query("Select *,m.m_name,s.s_name,s.s_image,c.c_name from tbl_transport_monthly_fee tf inner join tbl_add_tp_member tm on tm.tpm_id = tf.t_member_id inner join tbl_add_month m on m.mid = tf.t_month inner join tbl_add_student s on s.s_id = tm.sid inner join tbl_add_class c on c.c_id = tm.cid where tf.t_member_id='".$_GET['id']."'",$link);

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
  <div style="padding:10px;">
    <h3 class="exam_table_style">Student's Information :</h3>
    <?php
	$id = '';
    $result = mysql_query("Select *,m.m_name,s.s_email,s.s_contact,s.s_address,s.s_roll_no,s.s_gender,s.s_religion,s.s_dob,p.p_father_name from tbl_transport_monthly_fee tf inner join tbl_add_tp_member tm on tm.tpm_id = tf.t_member_id inner join tbl_add_month m on m.mid = tf.t_month inner join tbl_add_student s on s.s_id = tm.sid inner join tbl_add_class c on c.c_id = tm.cid inner join tbl_add_parent p on p.p_id = s.parent_id where tf.t_member_id='".$_GET['id']."'",$link);

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
  <h3 style="text-align:center;text-decoration:underline;">Student Monthly Transport Fee Details</h3>
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
		$result = mysql_query("Select *,m.m_name from tbl_transport_monthly_fee tf inner join tbl_add_month m on m.mid = tf.t_month where tf.t_member_id='".$_GET['id']."' order by tf.t_month desc",$link);
		while($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['m_name']; ?></td>
          <td><?php echo CURRENCY.' '.$row['t_amount']; ?></td>
          <td><?php echo $row['t_date']; ?></td>
        </tr>
        <?php } //mysql_close($link); ?>
      </tbody>
    </table>
  </div>
  <div style="padding:10px;" align="center"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>p_dashboard.php"><i class="fa fa-home"></i>&nbsp;Dashboard</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>report/p_transport_fee_list.php?tid=<?php echo $_GET['id'];?>&cval=<?php echo $_GET['cval'];?>"><i class="fa fa-list"></i>&nbsp;Hostel Fee List</a></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
