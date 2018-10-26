<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'parents'){
	header("Location:logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content content_inside">
    <div class="header_text">
      <div class="header_text_left">Hostel Member List</div>
      	<div class="top_common_bar">
        <div class="obj_right">
        	<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>hostel/p_hostel.php"><i class="fa"></i>Hostel Dashboard</a></div>
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
				/*echo "Select *,c.c_name,s.s_id,c.c_id,m.sid,m.hmid,p.p_id from tbl_add_student s INNER JOIN tbl_add_class c on c.c_id=s.s_class_id left join tbl_add_hostel_member m on s.s_id = m.sid inner join tbl_add_parent p on p.p_id = s.parent_id where s.parent_id = '" . $_SESSION['objLogin']['p_id'] . "' order by s.s_id desc";
				die();*/
				//$result = '';
				$result = mysql_query("Select *,c.c_name,s.s_id,c.c_id,m.sid,m.hmid,p.p_id from tbl_add_student s INNER JOIN tbl_add_class c on c.c_id=s.s_class_id left join tbl_add_hostel_member m on s.s_id = m.sid inner join tbl_add_parent p on p.p_id = s.parent_id where s.parent_id = '" . $_SESSION['objLogin']['p_id'] . "' order by s.s_id desc",$link);
				while($row = mysql_fetch_array($result)){
					
				$s_image = WEB_URL . 'img/no_image.jpg';	
		if(file_exists(ROOT_PATH . '/img/upload/' . $row['s_image']) && $row['s_image'] != ''){
			$s_image = WEB_URL . 'img/upload/' . $row['s_image'];
		}
					
					 ?>
        <tr>
          <td><img class="photo_img_round" style="width:50px;height:50px;" src="<?php echo $s_image;  ?>" /></td>
          <td><?php echo $row['s_name']; ?></td>
          <td><?php echo $row['s_email']; ?></td>
          <td><?php echo $row['s_contact']; ?></td>
          <td><?php echo $row['c_name']; ?></td>
          <td><?php echo $row['s_address']; ?></td>
          <td><?php if(isset($row['hmid']) && $row['hmid'] != ''){ ?><a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-success btn-xs mrg" href="<?php echo WEB_URL;?>hostel/p_hostel_member_details.php?id=<?php echo $row['hmid']; ?>&cid=<?php echo $row['c_id']; ?>"><i class="fa fa-eye"></i></a><?php } else {?>Not register<?php }?></td>
        </tr>
        <?php } mysql_close($link); ?>
		</tbody>
      </table>
    </div>
  </div>
 
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
