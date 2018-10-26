<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'parents'){
	header("Location: logout.php");
	die();
}

?>
  
  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content content_inside">
    <div class="header_text">
      <div class="header_text_left">Student List</div>
      <div class="top_common_bar">
      	
        <div class="obj_right">
        	<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>p_dashboard.php"><i class="fa"></i>Dashboard</a></div>
        </div>
      </div>
    <div style="clear:both;"></div>
    <div class="list" style="width:100%; height:480px; overflow:auto;">
      <table class="table sakotable table-bordered table-striped dt-responsive">
	  <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Class Name</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
			$result = mysqli_query($link,"Select *,c.c_name from tbl_add_student s INNER JOIN tbl_add_class c on c.c_id = s.s_class_id where s.parent_id = '" . $_SESSION['objLogin']['p_id'] . "' order by s.s_name ASC");
			while($row = mysqli_fetch_array($result)){					
			$s_image = WEB_URL . 'img/no_image.jpg';	
			if(file_exists(ROOT_PATH . '/img/upload/' . $row['s_image']) && $row['s_image'] != ''){
				$s_image = WEB_URL . 'img/upload/' . $row['s_image'];
			}	
		?>
        <tr>
          <td><img class="img-round" style="width:50px;height:50px;" src="<?php echo $s_image;  ?>" /></td>
          <td><?php echo $row['s_name']; ?></td>
          <td><?php echo $row['s_email']; ?></td>
          <td><?php echo $row['s_contact']; ?></td>
          <td><?php echo $row['c_name']; ?></td>
          <td><?php echo $row['s_address']; ?></td>
          <td><a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>student/p_student_details.php?id=<?php echo $row['s_id']; ?>&cid=<?php echo $row['c_id']; ?>"><i class="fa fa-eye"></i></a></td>
        </tr>
        <?php } mysqli_close($link); ?>
		</tbody>
      </table>
    </div>
  </div>
  
  <?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
