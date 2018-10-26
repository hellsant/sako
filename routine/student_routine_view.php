<?php include('../header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Routine List</div>
    <div class="top_common_bar">
      <div class="obj_right"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>s_dashboard.php"><i class="fa"></i>Dashboard</a></div>
    </div>
  </div>
  <div style="display:<?php echo $show; ?>;">
    <table class="table common_sakotable_routine table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>WeekDay</th>
          <th>Subject</th>
        </tr>
      </thead>
      <?php
           $result_routine = mysqli_query($link,"SELECT * FROM tbl_routine_setup order by sort ASC");
		   while($row_routine = mysqli_fetch_array($result_routine)){?>
      <tr>
        <td style="text-transform:uppercase;width:10%; font-weight:bold;"><?php echo $row_routine['weekday'];?></td>
        <td align="left"><?php
					$result_get_class = mysqli_query($link,"SELECT *,r.routine_id,s.sb_name as subject FROM tbl_add_routine r inner join tbl_add_subject s on s.sb_id = r_subject_id where r.routine_day = '" . (string)$row_routine['weekday'] . "' and r.r_class_id = '". (int)$_SESSION['objLogin']['s_class_id'] ."'");
					while($row_routine_subject = mysqli_fetch_array($result_get_class)){ ?>
          <div style="float:left;margin:5px;">
            <div class="routine btn-group">
              <div><?php echo $row_routine_subject['subject']; ?></div>
              <div><?php echo $row_routine_subject['routine_time_start'];?>&nbsp;<?php echo $row_routine_subject['start_am_pm']; ?> - <?php echo $row_routine_subject['routine_time_end'];?>&nbsp;<?php echo $row_routine_subject['end_am_pm']; ?> </div>
              <div>Room No - <?php echo $row_routine_subject['routine_room']; ?></div>
              <div></div>
            </div>
          </div>
        <?php }?>
        <div style="clear:both;"></div></td>
      </tr>
      <?php }?>
    </table>
  </div>
</div>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
