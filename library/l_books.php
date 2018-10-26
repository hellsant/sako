<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'librarian'){
	header("Location: logout.php");
	die();
}
?>
<?php 
$success = "none";
$subject_code =  "";
$book_name =  "";
$author_name =  "";
$quantity =  "";
$issue_qty = "";
$rack_no =  "";
$price =  "";
$status = "";
$title = 'Add New Library Book';
$button_text="Add Book";
$id="";
$hdnid="0";


if(isset($_POST['txtLbSubjectCode'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	  $sql = "INSERT INTO `tbl_library_book_list`(`subject_code`,`book_name`,`author_name`,`quantity`,`issue_qty`,`rack_no`,`price`) VALUES ('$_POST[txtLbSubjectCode]','$_POST[txtLbBookName]','$_POST[txtLbAuthorName]','$_POST[txtLbQuantity]','$_POST[txtLbQuantity]','$_POST[txtLbRackNo]','$_POST[txtLbPrice]')";
	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'library/book_list.php?m=i';
	  header('Location: ' . $redirect_url);
	  die();
	
}
else{
	
	$sql = "UPDATE `tbl_library_book_list` SET `subject_code`='".$_POST['txtLbSubjectCode']."',`book_name`='".$_POST['txtLbBookName']."',`author_name`='".$_POST['txtLbAuthorName']."',`quantity`='".$_POST['txtLbQuantity']."',`rack_no`='".$_POST['txtLbRackNo']."',`price`='".$_POST['txtLbPrice']."' WHERE b_id='".$_GET['id']."'";
	  mysql_query($sql,$link);
	  
	  $result = mysql_query("SELECT * FROM tbl_library_book_list where b_id = '" . $_GET['id'] . "'",$link);
	  if($row = mysql_fetch_array($result)){
	  	$old_qty = $row['issue_qty'];
		$old_qty = (int)((int)$old_qty + (int)$_POST['txtLbQuantity']);
		mysql_query("UPDATE `tbl_library_book_list` SET `issue_qty`='".$_POST['txtLbQuantity']."' WHERE b_id='".$_GET['id']."'",$link);
	  }
	  
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'library/book_list.php?m=u';
	  header('Location: ' . $redirect_url);
	  die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_library_book_list where b_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$subject_code = $row['subject_code'];
		$book_name = $row['book_name'];
		$author_name = $row['author_name'];
		$quantity = $row['quantity'];
		$rack_no = $row['rack_no'];
		$price = $row['price'];
		$hdnid = $_GET['id'];
		$title = 'Update Library Book';
		$button_text="Update";
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
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>library/l_book_list.php">Library Book List</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtLbSubjectCode"> Code </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $subject_code;?>" name="txtLbSubjectCode" id="txtLbSubjectCode" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtLbBookName"> Book Name </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $book_name;?>" name="txtLbBookName" id="txtLbBookName" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtLbAuthorName"> Author Name </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $author_name;?>" name="txtLbAuthorName" id="txtLbAuthorName" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtLbQuantity"> Quantity </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $quantity;?>" name="txtLbQuantity" id="txtLbQuantity" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtLbRackNo"> Rack No </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $rack_no;?>" name="txtLbRackNo" id="txtLbRackNo" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtLbPrice"> Price Per Piece </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $price;?>" name="txtLbPrice" id="txtLbPrice" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
            </div>
          </div>
          <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
		  <input type="hidden" value="<?php echo $b_id; ?>" name="hdnId"/>
        <input type="hidden" value="<?php echo $quantity; ?>" name="hdnQty"/>
        </form>
      </div>
    </div>
    <div class="bottom_area"></div>
  </div>
  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
