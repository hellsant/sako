<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location: logout.php");
	die();
}
?>

  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content">
    <div class="bio-graph-heading">
      <?php
 
$id = '';
$cid = 0;
if(isset($_GET['cid']) && $_GET['cid'] != ''){
	$cid = $_GET['cid'];
}

$result = mysql_query("Select *,s.s_name,s.s_email,s.s_contact,s.s_address,s.s_dob,s.s_gender,s.s_religion,s.s_image,c.c_name from tbl_add_hostel_member m inner join tbl_add_student s on m.sid = s.s_id inner join tbl_add_class c on m.cid = c.c_id where s_id = '" . (int)$_SESSION['objLogin']['s_id'] . "'",$link);
while($row = mysql_fetch_array($result)){
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
	
	<?php
	 if(isset($_SESSION['objLogin']['s_id'])){
    $result = mysql_query("Select *,s.s_name,p.p_father_name,s.s_email,s.s_contact,s.s_address,s.s_dob,s.s_gender,s.s_religion,s.s_image,c.c_name,h.h_name,hc.hostel_fee from tbl_add_hostel_member hm inner join tbl_add_student s on hm.sid = s.s_id inner join tbl_add_class c on hm.cid = c.c_id inner join tbl_add_hostel h on hm.hostel_name = h.h_id inner join tbl_hostel_category hc on hm.hostel_name = hc.hostel_id inner join tbl_add_parent p on p.p_id = s.parent_id where s_id = '" . (int)$_SESSION['objLogin']['s_id'] . "'",$link);
	}
	 else
	 {
	 $result = mysql_query("Select * from tbl_add_hostel_member where sid = '-1' order by sid desc",$link);
	 }
	while($row = mysql_fetch_array($result)){?>
      <div style="font-size:13px;text-align:left;" class="row">
        <div class="col-md-6">
          <table class="table">
            <tr>
              <td><strong>Hostel Name :</strong></td>
              <td><?php echo $row['h_name'];?></td>
            </tr>
			 <tr>
              <td><strong>Hostel Type :</strong></td>
              <td><?php echo $row['h_type'];?></td>
            </tr>
			 <tr>
              <td><strong>Hostel Category :</strong></td>
              <td><?php echo $row['hostel_category'];?></td>
            </tr>
			<tr>
              <td><strong>Hostel Fee :</strong></td>
              <td><?php echo CURRENCY.' '.$row['hostel_fee'];?></td>
            </tr>
			<tr>
              <td><strong>Roll No :</strong></td>
              <td><?php echo $row['s_roll_no'];?></td>
            </tr>
            <tr>
              <td><strong>Email :</strong></td>
              <td><?php echo $row['s_email'];?></td>
            </tr>
          </table>
        </div>
        <div class="col-md-6">
          <table class="table">
		  	<tr>
              <td><strong>Contact No :</strong></td>
              <td><?php echo $row['s_contact'];?></td>
            </tr>
            <tr>
              <td><strong>Address :</strong></td>
              <td><?php echo $row['s_address'];?></td>
            </tr>
			<tr>
              <td><strong>Date Of Birth :</strong></td>
              <td><?php echo $row['s_dob'];?></td>
            </tr>
            <tr>
              <td><strong>Religion :</strong></td>
              <td><?php echo $row['s_religion'];?></td>
            </tr>
            <tr>
              <td><strong>Gender :</strong></td>
              <td><?php echo $row['s_gender'];?></td>
            </tr>
			<tr>
              <td><strong>Joining Date :</strong></td>
              <td><?php echo date('d/m/Y', strtotime($row['created_date']));?></td>
            </tr>
          </table>
        </div>
      </div>
      <?php }  //mysql_query($link);?>
    </div>
    <div style="padding:10px;" align="center"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>hostel/s_hostel.php"><i class="fa fa-home"></i>&nbsp;Back</a></div>
  </div>
  <script type="text/javascript">
  	$('#myModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
})
  </script>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>