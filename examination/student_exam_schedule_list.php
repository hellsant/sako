<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Examination Schedule List</div>
    <div class="top_common_bar">
      <div class="obj_left">
        <select onChange="getExamData(this.value);" class="form-control" name="ddlTeminal" id="ddlTeminal">
          <option value="-1">--Select Terminal--</option>
          <?php
            	$result_class = mysqli_query($link,"Select * from tbl_schedule_setup order by schedule_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['schedule_id']){echo 'selected';}?> value="<?php echo $row_class['schedule_id'];?>"><?php echo $row_class['schedule_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_right"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>s_dashboard.php"><i class="fa"></i>Dashboard</a></div>
    </div>
  </div>
  <div>
    <table class="table common_sakotable_att table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Class Name</th>
          <th>Subject Name</th>
          <th>Exam. Date</th>
          <th>Exam. Start</th>
          <th>Exam. End</th>
          <th>Room No</th>
        </tr>
      </thead>
      <tbody>
        <?php
		$result = '';
		if(isset($_GET['tval']) && $_GET['tval'] != ''){
			$result = mysqli_query($link,"SELECT * , c.c_name, s.sb_name FROM tbl_add_exam_schedule es INNER JOIN tbl_add_class c ON c_id = es_class_id INNER JOIN tbl_add_subject s ON sb_id = es_subject_id WHERE es.es_class_id = '" . (int)$_SESSION['objLogin']['s_class_id'] . "' and es.es_term_id = '" . $_GET['tval'] . "' order by es.es_id ASC");
		}
		else{
			$result = mysqli_query($link,"Select * from tbl_add_exam_schedule where es_class_id = '-1' order by es_id desc");
		}
		while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['c_name']; ?></td>
          <td><?php echo $row['sb_name']; ?></td>
          <td><?php echo $row['es_date']; ?></td>
          <td><?php echo $row['es_start_time']; ?></td>
          <td><?php echo $row['es_end_time']; ?></td>
          <td><?php echo $row['es_room_no']; ?></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
function getExamData(xdata){
	if(xdata != ''){
		window.location = 'student_exam_schedule_list.php?tval=' + xdata;
	}
}
</script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
