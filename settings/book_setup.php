<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <?php 
  	$bk_name = '';
	$bk_author = '';
	$button_text = "Save";
	$hval = 0;
	
	if(isset($_POST['txtBookName'])){
		if($_POST['hdnSpid'] == '0'){
			$sql=mysqli_query($link,"INSERT INTO `tbl_book_setup`(`bk_name`,`bk_author`) VALUES ('$_POST[txtBookName]','$_POST[txtBookAuthor]')");	
			mysqli_query($sql, $link);
		}
		else{
			$sql_update=mysqli_query($link,"UPDATE `tbl_book_setup` set `bk_name` = '$_POST[txtBookName]', `bk_author` = '$_POST[txtBookAuthor]' where bk_id= '" . (int)$_POST['hdnSpid'] . "'");	
			mysqli_query($sql_update, $link);
			echo "<script>alert('Update Successfully');</script>";
		}
	}
	
	if(isset($_GET['spid']) && $_GET['spid'] != ''){
		$result = mysqli_query($link,"SELECT * FROM tbl_book_setup where bk_id= '" . (int)$_GET['spid'] . "'");
		if($row = mysqli_fetch_array($result)){
		 	$bk_name = $row['bk_name'];
			$bk_author = $row['bk_author'];
			$button_text = "Update";
			$hval = $row['bk_id'];
		}
			
	}
	
	if(isset($_GET['delid']) && $_GET['delid'] != ''){
		mysqli_query($link,"DELETE from tbl_book_setup where bk_id= '" . (int)$_GET['delid'] . "'");
		echo "<script>alert('Delete Successfully');</script>";
	}
	
  ?>
  
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Book Setup</div>
    <div class="top_common_bar">
      <div class="obj_right"><a class="btn btn-success" href="<?php echo WEB_URL; ?>settings/setting.php">Setting</a></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
	<form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
      <div class="box-body">
        <div class="form-group">
          <label for="txtBookName">Book Name :</label>
          <input type="text" name="txtBookName" value="<?php echo $bk_name; ?>" id="txtBookName" class="form-control"/>
        </div>
		<div class="form-group">
          <label for="txtBookAuthor">Author Name :</label>
          <input type="text" name="txtBookAuthor" value="<?php echo $bk_author; ?>" id="txtBookAuthor" class="form-control"/>
        </div>
        <div class="form-group pull-right">
          <input type="submit" name="submit" class="btn btn-success" value="<?php echo $button_text; ?>"/>
          &nbsp;
          <input type="reset" onClick="javascript:window.location.href='<?php echo WEB_URL; ?>settings/book_setup.php';" name="btnReset" id="btnReset" value="Reset" class="btn btn-success"/>
        </div>
        <input type="hidden" name="hdnSpid" value="<?php echo $hval; ?>"/>
        </form>
      </div>
    </div>
  </div>
  <!-- end insert dept. name -->
  <!--show department name-->
  <!--show department name-->
  <div class="row">
    <div class="col-xs-12">
      <div class="box-body">
        <table class="table common_sakotable table-bordered table-striped dt-responsive">
          <thead>
            <tr>
              <th>Book Name</th>
			  <th>Author Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
             <?php
				$result = mysqli_query($link,"SELECT * FROM tbl_book_setup order by bk_id ASC");
				while($row = mysqli_fetch_array($result)){ ?>
              <tr>
                <td><?php echo $row['bk_name']; ?></td>
				<td><?php echo $row['bk_author']; ?></td>
                <td><a class="btn btn-primary btn-xs mrg" data-toggle="tooltip" title="Edit Me" href="<?php echo WEB_URL;?>settings/book_setup.php?spid=<?php echo $row['bk_id']; ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-danger btn-xs mrg" data-toggle="tooltip" title="Delete Me" onclick=deleteMe("<?php echo WEB_URL;?>settings/book_setup.php?delid=<?php echo $row['bk_id'];?>"); href="javascript:void(0);" data-original-title="Delete"><i class="fa fa-trash-o"></i></a></td>
              </tr>
              <?php } mysqli_close($link); ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div style="clear:both"></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
