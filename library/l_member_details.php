<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'librarian'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="bio-graph-heading">
    <?php
 
$id = '';
$result = mysql_query("Select *,s.s_name,s.s_email,s.s_contact,s.s_address,s.s_dob,s.s_gender,s.s_religion,s.s_image,c.c_name from tbl_library_member lm inner join tbl_add_student s on lm.sid = s.s_id inner join tbl_add_class c on lm.cid = c.c_id where lm.lmid='".$_GET['id']."'",$link);
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
    $result = mysql_query("Select *,s.s_roll_no,s.s_name,s.s_email,s.s_contact,s.s_address,s.s_dob,s.s_gender,s.s_religion,s.s_image,c.c_name from tbl_library_member lm inner join tbl_add_student s on lm.sid = s.s_id inner join tbl_add_class c on lm.cid = c.c_id where lm.lmid='".$_GET['id']."'",$link);
	while($row = mysql_fetch_array($result)){?>
    <div style="font-size:13px;text-align:left;" class="row">
      <div class="col-md-6">
        <table class="table">
          <tr>
            <td><strong>Library ID :</strong></td>
            <td><?php echo $row['lmid'];?></td>
          </tr>
          <tr>
            <td><strong>Library Fee :</strong></td>
            <td><?php echo $row['library_fee'];?></td>
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
            <td><?php echo date('d/m/Y', strtotime($row['join_date']));?></td>
          </tr>
        </table>
      </div>
    </div>
    <?php }  //mysql_query($link);?>
    <h3 class="top_text_title_style">Book Issue Information</h3>
    <table class="table common_sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>#</th>
          <th>Book</th>
          <th>Author</th>
          <th>Subject Code</th>
          <th>Issue Date</th>
          <th>Return Date</th>
          <th>Fine</th>
        </tr>
      </thead>
      <tbody>
        <?php
	   $result_att = mysql_query("Select *,m.lmid,b.book_name,b.author_name,b.subject_code from tbl_book_issue i inner join tbl_library_member m on m.lmid = i.lid inner join tbl_library_book_list b on i.bname = b.b_id where i.lid='".$_GET['id']."' order by i.issue_id asc",$link);
		while($row_att = mysql_fetch_array($result_att)){?>
        <tr style="text-align:left;font-size:13px;">
          <td><?php echo $row_att['issue_id']; ?></td>
          <td><?php echo $row_att['book_name']; ?></td>
          <td><?php echo $row_att['author_name']; ?></td>
          <td><?php echo $row_att['subject_code']; ?></td>
          <td><?php echo $row_att['issue_date']; ?></td>
          <td><?php echo $row_att['return_date']; ?></td>
          <td><?php echo $row_att['fine']; ?></td>
        </tr>
        <?php } //mysql_close($link); ?>
      </tbody>
    </table>
  </div>
  <div style="padding:10px;" align="center"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>library/l_memberlist.php?cid=<?php echo $_GET['cid']; ?>"><i class="fa fa-list"></i>&nbsp;Member List</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>l_dashboard.php"><i class="fa fa-home"></i>&nbsp;Dashboard</a></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
