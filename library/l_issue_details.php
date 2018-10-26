<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'librarian'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div style="padding:24px; font-size:24px; color:black; text-align:center; font-weight:bold; text-decoration:underline; text-transform:uppercase;"> Issue Details </div>
  <div style="padding:10px;">
    <div class="bio-graph-heading">
      <?php
	$id = '';
    $result = mysqli_query($link,"Select *,b.book_name,b.author_name,b.subject_code from tbl_book_issue i inner join tbl_library_book_list b on i.bname = b.b_id  where issue_id='".$_GET['id']."'");
	while($row = mysqli_fetch_array($result)){?>
      <div style="font-size:13px;text-align:left;" class="row">
        <div class="col-md-6">
          <table class="table">
            <tr>
              <td><strong>Library ID :</strong></td>
              <td><?php echo $row['lid'];?></td>
            </tr>
            <tr>
              <td><strong>Book Name :</strong></td>
              <td><?php echo $row['book_name'];?></td>
            </tr>
            <tr>
              <td><strong>Author Name :</strong></td>
              <td><?php echo $row['author_name'];?></td>
            </tr>
            <tr>
              <td><strong>Subject Code :</strong></td>
              <td><?php echo $row['subject_code'];?></td>
            </tr>
          </table>
        </div>
        <div class="col-md-6">
          <table class="table">
            <tr>
              <td><strong>Issue Date :</strong></td>
              <td><?php echo $row['issue_date'];?></td>
            </tr>
            <tr>
              <td><strong>Return Date :</strong></td>
              <td><?php echo $row['return_date'];?></td>
            </tr>
            <tr>
              <td><strong>Fine :</strong></td>
              <td><?php echo $row['fine'];?></td>
            </tr>
            <tr>
              <td><strong>Note :</strong></td>
              <td><?php echo $row['note'];?></td>
            </tr>
          </table>
        </div>
      </div>
      <?php }  //mysql_query($link);?>
    </div>
	<div style="clear:both;"></div>
  </div>
<div style="padding:10px;" align="center"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>library/l_issue.php"><i class="fa fa-plus"></i>&nbsp;Add Issue</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>library/l_issuelist.php"><i class="fa fa-list"></i>&nbsp;Issue List</a>&nbsp;&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>l_dashboard.php"><i class="fa fa-home"></i>&nbsp;Dashboard</a></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
