<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'parents'){
	header("Location: logout.php");
	die();
}
?>

  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content">
    <div class="bio-graph-heading" style="background: #1cacbf none repeat scroll 0 0;border-radius: 4px 4px 0 0;color: #fff;font-size: 16px;font-style: italic;font-weight: 300;padding: 20px 110px;text-align: center;opacity:0.8;">
      <?php
 
$id = '';
$result = mysql_query("Select *,s.s_name,s.s_image,c.c_name from tbl_add_tp_member m inner join tbl_add_student s on m.sid = s.s_id inner join tbl_add_class c on m.cid = c.c_id where m.tpm_id='".$_GET['id']."'",$link);
while($row = mysql_fetch_array($result)){
$s_image = WEB_URL . 'img/no_image.jpg';	
if(file_exists(ROOT_PATH . '/img/upload/' . $row['s_image']) && $row['s_image'] != ''){
$s_image = WEB_URL . 'img/upload/' . $row['s_image'];
}
  
?>
      <img class="img_ratio img-circle" src="<?php echo $s_image;  ?>" alt="...">
      <p style="font-size:16px;text-transform:capitalize; font-weight:bold;font-family:Georgia, 'Times New Roman', Times, serif;"><?php echo $row['s_name']; ?></p>
      <p>Class - <?php echo $row['c_name']; ?></p>
      <?php } ?>
    </div>
    <div class="bio-graph-heading" style="background: #fff none repeat scroll 0 0;border-radius: 4px 4px 0 0;color: #000;font-size: 16px;font-style: italic;font-weight: 300;padding: 20px 20px;text-align: center;opacity:0.8;">
	
	<?php	
    $result = mysql_query("Select *,s.s_name,s.s_email,s.s_contact,s.s_address,s.s_dob,s.s_gender,s.s_religion,s.s_image,c.c_name,t.destination,t.fare from tbl_add_tp_member m inner join tbl_add_student s on m.sid = s.s_id inner join tbl_add_class c on m.cid = c.c_id inner join tbl_add_transport t on m.tpm_destination = t.transport_id where m.tpm_id='".$_GET['id']."'",$link);
	while($row = mysql_fetch_array($result)){?>
      <div style="font-size:13px;text-align:left;" class="row">
        <div class="col-md-6">
          <table class="table">
            <tr>
              <td><strong>Transport Destination :</strong></td>
              <td><?php echo $row['destination'];?></td>
            </tr>
			 <tr>
              <td><strong>Transport Fee :</strong></td>
              <td><?php echo CURRENCY.' '.$row['fare'];?></td>
            </tr>
			<tr>
              <td><strong>Roll No :</strong></td>
              <td><?php echo $row['s_roll_no'];?></td>
            </tr>
            <tr>
              <td><strong>Email :</strong></td>
              <td><?php echo $row['s_email'];?></td>
            </tr>
            <tr>
              <td><strong>Contact No :</strong></td>
              <td><?php echo $row['s_contact'];?></td>
            </tr>
          </table>
        </div>
        <div class="col-md-6">
          <table class="table">
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
    <div style="padding:10px;" align="center"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>p_dashboard.php"><i class="fa fa-home"></i>&nbsp;Dashboard</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>transport/p_t_member_list.php?cid=<?php echo $_GET['cid'];?>"><i class="fa fa-list"></i>&nbsp;T. Member List</a></div>
  </div>
  <script type="text/javascript">
  	$('#myModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
})
  </script>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>