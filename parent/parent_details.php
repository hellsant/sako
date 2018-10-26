<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div id="print_area">
    <div class="bio-graph-heading">
      <?php 
$id = '';
$p_image = '';
$p_father_name = '';
$p_father_profession = '';
$p_mother_name = '';
$p_email = '';
$p_contact = '';
$p_address = '';
$p_profile_name = '';
$s_name = '';
$c_name = '';
$s_roll_no = '';
$s_email = '';
$s_contact = '';
$s_address = '';
$s_profile_name = '';

$result = mysqli_query($link,"Select * from tbl_add_parent where p_id='".$_GET['id']."'");
if($row = mysqli_fetch_array($result)){
	$p_image = WEB_URL . 'img/no_image.jpg';	
	if(file_exists(ROOT_PATH . '/img/upload/' . $row['p_image']) && $row['p_image'] != ''){
		$p_image = WEB_URL . 'img/upload/' . $row['p_image'];
	}
	$p_father_name = $row['p_father_name'];
	$p_father_profession = $row['p_father_profession'];
	$p_mother_name = $row['p_mother_name'];
	$p_email = $row['p_email'];
	$p_contact = $row['p_contact'];
	$p_address = $row['p_address'];
	$p_profile_name = $row['p_profile_name'];
}
?>
      <div align="center" style="width:100%;"><img class="img_ratio img-circle" src="<?php echo $p_image;  ?>"></div>
      <div class="details_top_text">Guardiun Name :&nbsp;<?php echo $p_father_name; ?></div>
      <p>Contact :&nbsp;<?php echo $p_contact; ?></p>
    </div>
    <div style="padding:10px;">
      <div style="font-size:13px;text-align:left;" class="row">
        <div class="col-md-12">
          <div class="top_text_title_style">Parent Information :</div>
          <table class="table">
            <tr>
              <td><strong>Father's Name:</strong></td>
              <td><?php echo $p_father_name; ?></td>
            </tr>
            <tr>
              <td><strong>Profession:</strong></td>
              <td><?php echo $p_father_profession; ?></td>
            </tr>
            <tr>
              <td><strong>Mother's Name:</strong></td>
              <td><?php echo $p_mother_name;?></td>
            </tr>
            <tr>
              <td><strong>Email:</strong></td>
              <td><?php echo $p_email;?></td>
            </tr>
            <tr>
              <td><strong>Phone:</strong></td>
              <td><?php echo $p_contact;?></td>
            </tr>
            <tr>
              <td><strong>Address:</strong></td>
              <td><?php echo $p_address;?></td>
            </tr>
            <tr>
              <td><strong>Profile Name:</strong></td>
              <td><?php echo $p_profile_name;?></td>
            </tr>
          </table>
        </div>
        <div class="col-md-12">
          <div>
            <table class="table common_sakotable_att table-bordered table-striped dt-responsive">
              <thead>
                <tr>
                  <th>Student Name</th>
                  <th>Email</th>
                  <th>Contact</th>
                  <th>Class Name</th>
                  <th>Roll No</th>
                </tr>
              </thead>
              <tbody>
              <h3 class="top_text_title_style">Student Information :</h3>
              <?php
			$resultx = mysqli_query($link,"Select *, c.c_name from tbl_add_student s inner join tbl_add_class c on s.s_class_id = c.c_id where s.parent_id='".$_GET['id']."'");
			while($rowx = mysqli_fetch_array($resultx)){ ?>
              <tr>
                <td><?php echo $rowx['s_name']; ?></td>
                <td><?php echo $rowx['s_email']; ?></td>
                <td><?php echo $rowx['s_contact']; ?></td>
                <td><?php echo $rowx['c_name']; ?></td>
                <td><?php echo $rowx['s_roll_no']; ?></td>
              </tr>
              <?php } ?>
              </tbody>
              
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div style="padding:10px;" align="center"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>parent/addparent.php"><i class="fa fa-plus"></i>&nbsp;Add Parent</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>parent/parentlist.php"><i class="fa fa-list"></i>&nbsp;Parent List</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>dashboard.php"><i class="fa fa-home"></i>&nbsp;Dashboard</a>&nbsp;&nbsp;<a href="javascript:;" class="btn btn_add_new btn-success" onclick="printContent('print_area','Parent Information')"><i class="fa fa-print"></i>&nbsp;Print</a></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
