<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'librarian'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$lid =  "";
$bname =  "";
$bauthor =  "";
$issue_date =  "";
$return_date = "";
$fine = "0.00";
$note = "";
$status = '';
$title = 'Add New Library Book Issue';
$button_text="Add Issue";
$id="";
$hdnid="0";


if(isset($_POST['txtLibraryID'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	  $sql = "INSERT INTO `tbl_book_issue`(`lid`,`bname`,`issue_date`,`return_date`,`fine`,`note`) VALUES ('$_POST[txtLibraryID]','$_POST[ddlBookName]','$_POST[txtIssueDate]','$_POST[txtReturnDate]','$_POST[txtFine]','$_POST[txtNote]')";
	  mysql_query($sql,$link);
	  
	  $result = mysql_query("SELECT * FROM tbl_library_book_list where b_id = '" . $_POST['ddlBookName'] . "'",$link);
	  if($row = mysql_fetch_array($result)){
	  	$old_qty = $row['issue_qty'];
		$old_qty = (int)$old_qty - 1;
		mysql_query("UPDATE `tbl_library_book_list` SET `issue_qty`='".$old_qty."' WHERE b_id='".$_POST['ddlBookName']."'",$link);
	  }
	  
	  //$issueid = mysql_insert_id();
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'library/l_issuelist.php?m=i';
	  header('Location: ' . $redirect_url);
	  die();
	
}
else{
	
	$sql = "UPDATE `tbl_book_issue` SET `lid`='".$_POST['txtLibraryID']."',`bname`='".$_POST['ddlBookName']."',`issue_date`='".$_POST['txtIssueDate']."',`return_date`='".$_POST['txtReturnDate']."',`fine`='".$_POST['txtFine']."',`note`='".$_POST['txtNote']."' WHERE issue_id='".$_GET['id']."'";
	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'library/l_issuelist.php?m=u';
	  header('Location: ' . $redirect_url);
	  die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_book_issue where issue_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$lid = $row['lid'];
		$bname = $row['bname'];
		$issue_date = $row['issue_date'];
		$return_date = $row['return_date'];
		$fine = $row['fine'];
		$note = $row['note'];
		$hdnid = $_GET['id'];
		$title = 'Update Library Book Issue';
		$button_text="Update Information";
	}
	
	//mysql_close($link);

}
	
?>
  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content">
    <div class="header_text_inside">
      <div class="header_text_left"><?php echo $title; ?></div>
    </div>
    <div class="main_content">
      <div class="main_content_left">
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/member.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>l_dashboard.php">Library</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>library/l_issuelist.php">Issue Book List</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtLibraryID"> Library ID </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $lid;?>" name="txtLibraryID" id="txtLibraryID" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlBookName"> Book Name </label>
            <div class="col-sm-6">
			   <select class="form-control" onchange="getAuthorName(this.value);" id="ddlBookName" name="ddlBookName">
                <option value="">--Select--</option>
                <?php 
				  	$result_book = mysql_query("SELECT * FROM tbl_library_book_list order by b_id ASC",$link);
					while($row_book = mysql_fetch_array($result_book)){
				  ?>
                <option <?php if($bname == $row_book['b_id']){echo 'selected';}?> value="<?php echo $row_book['b_id'];?>"><?php echo $row_book['book_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <!--<div class="form-group">
            <label class="col-sm-2 control-label" for="ddlAuthorName"> Author Name </label>
            <div class="col-sm-6">
			<input type="text" disabled="disabled" value="" name="ddlAuthorName" id="ddlAuthorName" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>-->
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtIssueDate"> Issue Date </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $issue_date;?>" name="txtIssueDate" id="txtIssueDate" class="form-control datepicker">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
			<div class="form-group">
            <label class="col-sm-2 control-label" for="txtReturnDate"> Return Date </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $return_date;?>" name="txtReturnDate" id="txtReturnDate" class="form-control datepicker">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
			<div class="form-group">
            <label class="col-sm-2 control-label" for="txtFine"> Fine </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $fine;?>" name="txtFine" id="txtFine" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
			<div class="form-group">
            <label class="col-sm-2 control-label" for="txtNote"> Note </label>
            <div class="col-sm-6">
			  <textarea name="txtNote" id="txtNote" class="form-control"><?php echo $note;?></textarea>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
            </div>
          </div>
          <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
        </form>
      </div>
    </div>
    <div class="bottom_area"></div>
  </div>
  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
