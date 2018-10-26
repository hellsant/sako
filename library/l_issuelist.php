<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'librarian'){
	header("Location: logout.php");
	die();
}
?>

<?php
$token = 'none';
$msg = '';
$f_val = '';
$xQuery = mysqli_query($link,'Select *,b.book_name from tbl_book_issue i inner join tbl_library_book_list b on i.bname = b.b_id where i.status = 1 order by issue_id desc');
//$show = 'none';

if(isset($_GET['rid']) && $_GET['rid'] != '' && $_GET['rid'] > 0){
	$sqlx= mysqli_query($link,"UPDATE `tbl_book_issue` SET `status`='0' WHERE issue_id='".$_GET['rid']."'");
	mysqli_query($sqlx,$link); 
	
	 $result = mysqli_query($link,"SELECT * FROM tbl_library_book_list where b_id = '" . $_GET['bid'] . "'");
	  if($row = mysqli_fetch_array($result)){
	  	$old_qty = $row['issue_qty'];
		$old_qty = (int)$old_qty + 1;
		mysqli_query($link,"UPDATE `tbl_library_book_list` SET `issue_qty`='".(int)$old_qty."' WHERE b_id='".$_GET['bid']."'");
	  }
	
	$msg = 'Return Issue Book Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Issue Book Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Issue Book Successfully';
	$token = 'block';
}

if(isset($_GET['sid']) && $_GET['sid'] != ''){
	$f_val = $_GET['sid'];
	$xQuery = mysqli_query($link,"Select *,b.book_name from tbl_book_issue i inner join tbl_library_book_list b on i.bname = b.b_id WHERE i.lid = '" . (int)$f_val ."' and  i.status = 1");
	//$show = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Issue List</div>
    <div class="top_common_bar">
      <div class="obj_left">
        <div class="form-group">
          <div class="col-sm-6">
            <input type="text" value="<?php echo $f_val; ?>" name="txtSearch" id="txtSearch" class="form-control">
          </div>
          <div class="col-sm-4">
            <input type="button" onclick="filterLibrary();" value="Search" class="btn btn-success">
          </div>
        </div>
      </div>
      <div class="obj_right"> <a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>library/l_issue.php"><i class="fa fa-plus"></i>&nbsp;Add Issue</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>l_dashboard.php">Back</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div style="display:<?php echo $show; ?>;">
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Library ID </th>
          <th>Book Name </th>
          <th>Issue Date</th>
          <th>Return Date</th>
          <th>Fine</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
			$result = mysqli_query($xQuery,$link);
			while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['lid']; ?></td>
          <td><?php echo $row['book_name']; ?></td>
          <td><?php echo $row['issue_date']; ?></td>
          <td><?php echo $row['return_date']; ?></td>
          <td><?php echo $row['fine']; ?></td>
          <td><a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>library/l_issue_details.php?id=<?php echo $row['issue_id']; ?>"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;<a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>library/l_issue.php?id=<?php echo $row['issue_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Return" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-xs mrg" onClick="deleteIssue(<?php echo $row['issue_id']; ?>,<?php echo $row['b_id']; ?>);" href="javascript:void(0);"><i class="fa fa-mail-forward"></i></a></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteIssue(rid,bid){
  	var iAnswer = confirm("Are you sure you want to return this book?");
	if(iAnswer){
		window.location = 'l_issuelist.php?rid=' + rid + "&bid=" + bid;
	}
  }
  //for search student ID
  function filterLibrary(){
	window.location = 'l_issuelist.php?sid=' + $("#txtSearch").val();
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
