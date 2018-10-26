<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'teacher'){
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
        <select id="ddlClass" onChange="getClassData2(this.value,'t_exam_schedule_list');" class="form-control" name="ddlClass">
          <option value="-1">--Select Class--</option>
          <?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_class order by c_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cval']) && $_GET['cval'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_left">
        <select onChange="getTerminalData(this.value,'t_exam_schedule_list');" class="form-control" name="ddlTeminal" id="ddlTeminal">
          <option value="-1">--Select Terminal--</option>
          <?php
            	$result_class = mysqli_query($link,"Select * from tbl_schedule_setup order by schedule_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['schedule_id']){echo 'selected';}?> value="<?php echo $row_class['schedule_id'];?>"><?php echo $row_class['schedule_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_right"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>examination/t_exm.php"><i class="fa"></i>Examination Dashboard</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div>
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Schedule Name</th>
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
		  		if(isset($_GET['cval']) && $_GET['cval'] != '-1' && isset($_GET['tval']) && $_GET['tval'] != '-1'){
					$result = mysqli_query($link,"SELECT * , c.c_name, s.sb_name,ss.schedule_name FROM tbl_add_exam_schedule es INNER JOIN tbl_add_class c ON c_id = es_class_id INNER JOIN tbl_add_subject s ON sb_id = es_subject_id inner join tbl_schedule_setup ss on ss.schedule_id = es.es_term_id WHERE es.es_class_id = '" . $_GET['cval'] . "' and es.es_term_id = '" . $_GET['tval'] . "' order by es.es_id ASC");
				}
				else if(isset($_GET['cval']) && $_GET['cval'] != '-1'){
					$result = mysqli_query($link,"SELECT * , c.c_name, s.sb_name,ss.schedule_name FROM tbl_add_exam_schedule es INNER JOIN tbl_add_class c ON c_id = es_class_id INNER JOIN tbl_add_subject s ON sb_id = es_subject_id inner join tbl_schedule_setup ss on ss.schedule_id = es.es_term_id WHERE es.es_class_id = '" . $_GET['cval'] . "' order by es.es_id ASC");
				}
				else if(isset($_GET['tval']) && $_GET['tval'] != '-1'){
					$result = mysqli_query($link,"SELECT * , c.c_name, s.sb_name,ss.schedule_name FROM tbl_add_exam_schedule es INNER JOIN tbl_add_class c ON c_id = es_class_id INNER JOIN tbl_add_subject s ON sb_id = es_subject_id inner join tbl_schedule_setup ss on ss.schedule_id = es.es_term_id WHERE es.es_term_id = '" . $_GET['tval'] . "' order by es.es_id ASC");
				}
				else{
					$result = mysqli_query($link,"Select * from tbl_add_exam_schedule where es_class_id = '-1' order by es_id desc");
				}
				while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['schedule_name']; ?></td>
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

<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
