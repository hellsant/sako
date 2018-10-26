<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'parents'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Subject List</div>
 <div class="top_common_bar">
      	<div class="obj_left">
        	<select onChange="getClassData(this.value,'p_subject_list');" class="form-control" name="ddlClass">
            <option value="-1">--Select Class--</option>
			<?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_class order by c_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
                	<option <?php if(isset($_GET['cid']) && $_GET['cid'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
                <?php } ?>
            </select>	
        </div>
        <div class="obj_right">
        	<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>p_dashboard.php"><i class="fa"></i>Dashboard</a></div>
        </div>
      </div>
    <div style="clear:both;"></div>
  <div>
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Subject Name</th>
          <th>Subject Author</th>
          <th>Subject Code</th>
          <th>Class Name</th>
		  <th>Class Teacher</th>
        </tr>
      </thead>
      <tbody>
        <?php
		  $result = '';
		  if(isset($_GET['cid']) && $_GET['cid'] != ''){
		  $result = mysqli_query($link,"Select *, c.c_name, t.t_name from tbl_add_subject s INNER JOIN tbl_add_class c on c_id=sb_class_id inner join tbl_add_teacher t on 	teacher_id=sb_teacher_id where sb_class_id = '" . $_GET['cid'] . "' order by sb_id desc");
		  }
		  else{
			  $result = mysqli_query($link,"Select * from tbl_add_subject where sb_class_id = '-1' order by sb_id desc");
		  }
		  while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['sb_name']; ?></td>
          <td><?php echo $row['sb_author']; ?></td>
          <td><?php echo $row['sb_code']; ?></td>
          <td><?php echo $row['c_name']; ?></td>
		  <td><?php echo $row['t_name']; ?></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteSubject(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Subject ?");
	if(iAnswer){
		window.location = 'subject_list.php?id=' + Id;
	}
  }
  </script>

<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
