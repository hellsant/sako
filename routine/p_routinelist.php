<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'parents'){
	header("Location: logout.php");
	die();
}
?>
<?php
$token = 'none';
$msg = '';
$show = 'none';
if(isset($_GET['cid'])){
	$cid = $_GET['cid'];
	$show = 'block';
}

if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx= "DELETE FROM `tbl_add_routine` WHERE routine_id = ".$_GET['id'];
	mysql_query($sqlx,$link); 
	$msg = 'Delete Subject Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Subject Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Subject Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Routine List</div>
    <div class="top_common_bar">
      <div class="obj_left">
        <select onChange="getClassData(this.value,'p_routinelist');" class="form-control" name="ddlClass">
          <option value="-1">--Select Class--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_class order by c_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cid']) && $_GET['cid'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_right"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>p_dashboard.php"><i class="fa"></i>Dashboard</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div style="display:<?php echo $show; ?>;">
    <table class="table common_sakotable_routine table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>WeekDay</th>
          <th>Subject</th>
        </tr>
      </thead>
	  <?php
           $result_routine = mysql_query("SELECT * FROM tbl_routine_setup order by sort ASC",$link);
		   while($row_routine = mysql_fetch_array($result_routine)){?>
      <tr>
        <td style="text-transform:uppercase;font-weight:bold;"><?php echo $row_routine['weekday'];?></td>
        <td align="left"><?php
					if(isset($_GET['cid'])){
					$result_get_class = mysql_query("SELECT *,r.routine_id,s.sb_name as subject FROM tbl_add_routine r inner join tbl_add_subject s on s.sb_id = r_subject_id where r.routine_day = '" . (string)$row_routine['weekday'] . "' and r.r_class_id = '". $_GET['cid']."'",$link);
					while($row_routine_subject = mysql_fetch_array($result_get_class)){ ?>
          <div style="float:left;margin:5px;">
            <div class="routine btn-group">
              <div><?php echo $row_routine_subject['subject']; ?></div>
              <div><?php echo $row_routine_subject['routine_time_start'];?>&nbsp;<?php echo $row_routine_subject['start_am_pm']; ?> - <?php echo $row_routine_subject['routine_time_end'];?>&nbsp;<?php echo $row_routine_subject['end_am_pm']; ?> </div>
              <div>Room No - <?php echo $row_routine_subject['routine_room']; ?></div>
              <div></div>
            </div>
          </div>
          <?php }} ?>
          <div style="clear:both;"></div></td>
      </tr>
      <?php }?>
    </table>
  </div>
</div>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
