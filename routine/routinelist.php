<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
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
	$sqlx= mysqli_query($link,"DELETE FROM `tbl_add_routine` WHERE routine_id = ".$_GET['id']);
	mysqli_query($sqlx,$link); 
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
        <select onChange="getClassData(this.value,'routinelist');" class="form-control" name="ddlClass">
          <option value="-1">--Select Class--</option>
          <?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_class order by c_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cid']) && $_GET['cid'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_right"> <a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>routine/addroutine.php"><i class="fa fa-plus"></i>&nbsp;Add Routine</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>dashboard.php"><i class="fa"></i>Dashboard</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
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
        <td style="text-transform:uppercase;font-weight:bold;"><?php echo $row_routine['weekday'];?></td>
        <td align="left"><?php
					if(isset($_GET['cid'])){
					$result_get_class = mysqli_query($link,"SELECT *,r.routine_id,s.sb_name as subject FROM tbl_add_routine r inner join tbl_add_subject s on s.sb_id = r_subject_id where r.routine_day = '" . (string)$row_routine['weekday'] . "' and r.r_class_id = '". $_GET['cid']."'");
					while($row_routine_subject = mysqli_fetch_array($result_get_class)){ ?>
          <div style="float:left;margin:5px;">
            <div class="routine btn-group">
              <div><?php echo $row_routine_subject['subject']; ?></div>
              <div><?php echo $row_routine_subject['routine_time_start'];?>&nbsp;<?php echo $row_routine_subject['start_am_pm']; ?> - <?php echo $row_routine_subject['routine_time_end'];?>&nbsp;<?php echo $row_routine_subject['end_am_pm']; ?> </div>
              <div>Room No - <?php echo $row_routine_subject['routine_room']; ?></div>
              <div><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>routine/addroutine.php?id=<?php echo $row_routine_subject['routine_id']?>&cid=<?php echo $_GET['cid']?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteRoutine(<?php echo $row_routine_subject['routine_id']; ?>,<?php echo $_GET['cid']?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></div>
            </div>
          </div>
          <?php }} ?>
          <div style="clear:both;"></div></td>
      </tr>
      <?php }?>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteRoutine(Id,cid){
  	var iAnswer = confirm("Are you sure you want to delete this Routine ?");
	if(iAnswer){
		window.location = 'routinelist.php?id=' + Id + '&cid=' + cid ;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
