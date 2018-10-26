<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location:logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left"><?php echo $_SESSION['objLogin']['s_name']?>&nbsp;Member List</div>
    <div class="top_common_bar">
      <div class="obj_right"> <a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>transport/s_transport.php"><i class="fa"></i>Back</a></div>
    </div>
  </div>
  <div>
    <table class="table common_sakotable_att table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Student Name</th>
          <th>Class name</th>
          <th>Destination</th>
          <th>Fee</th>
        </tr>
      </thead>
      <tbody>
        <?php
		  $result = '';
		  if(isset($_SESSION['objLogin']['s_id'])){
		  $result = mysql_query("Select *, c.c_name, s.s_name,tp.destination,tp.fare from tbl_add_tp_member tm INNER JOIN tbl_add_class c on c.c_id=tm.cid inner join tbl_add_student s on 	s.s_id=tm.sid inner join tbl_add_transport tp on tp.transport_id = tm.tpm_destination where s_id = '" . (int)$_SESSION['objLogin']['s_id'] . "' order by tm.sid desc",$link);
		  }
		  else{
			  $result = mysql_query("Select * from tbl_add_tp_member where sid = '-1' order by sid desc",$link);
		  }
		  while($row = mysql_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['s_name']; ?></td>
          <td><?php echo $row['c_name']; ?></td>
          <td><?php echo $row['destination']; ?></td>
          <td><?php echo CURRENCY.' '.$row['fare']; ?></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
