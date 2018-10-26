<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'teacher'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$title = 'Add Student Attendance';
$button_text="Add Attendence";
$id='';
$hdnid="0";
$sf_class_id = 0;
$s_id = 0;
$added_date = '';
$form_show = 'none';
$date = '';

if(isset($_GET['cid'])){
	$c_name = $_GET['cid'];
	$form_show = 'block';
}
if(isset($_GET['cid'])){
	$sf_class_id = $_GET['cid'];
}
if(isset($_GET['sid'])){
	$s_id = $_GET['sid'];
}
if(isset($_GET['date'])){
	$date = $_GET['date'];
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text_inside">
    <div class="header_text_left"><?php echo $title; ?></div>
  </div>
  <div class="main_content">
    <div class="main_content_left">
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/charge.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>t_dashboard.php">Dashboard</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>attendance/t_viewattendance.php">View Attendence</a></div>
    </div>
    <form id="frmAddMark" action="../ajax/addStudentAtt.php" method="post">
      <div class="frmstyle">
        <div  class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="dllStClassId"> Class </label>
            <div class="col-sm-6">
              <select class="form-control" id="dllStClassId" name="dllStClassId">
                <option value="">--Select--</option>
                <?php 
				  	$result_class = mysql_query("SELECT * FROM tbl_add_class order by c_id ASC",$link);
					while($row_class = mysql_fetch_array($result_class)){
				  ?>
                <option <?php if($sf_class_id == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtDate"> Date </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $date; ?>" name="txtDate" id="txtDate" class="form-control datepicker">
            </div>
			</div>
			<div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <input type="button" onclick="getStudentInfoByAtt();" value="<?php echo $button_text;?>" class="btn btn-success">
            </div>
          </div>
          <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
        </div>
        <div style="display:<?php echo $form_show; ?>;">
          <table class="table common_sakotable table-bordered table-striped dt-responsive">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Attendance</th>
              </tr>
            </thead>
            <tbody>
              <?php
				$result = '';
				if(isset($_GET['cid']) && $_GET['cid'] != ''){
					$result = mysql_query("Select s.s_roll_no,s.s_name,s.s_email,s.s_contact,s.s_id,a.attendance from tbl_add_student s left join tbl_student_attendance a on a.sid = s.s_id and a.cid = '" . (int)$_GET['cid'] . "' and a.added_date = '".(string)$_GET['date']."' where s.s_class_id = '".(int)$_GET['cid']."' order by s.s_id desc",$link);
				}
				else{
					$result = mysql_query("Select * from tbl_add_student where s_class_id = '-1' order by s_id desc",$link);
				}
				while($row = mysql_fetch_array($result)){?>
              <tr>
                <td><?php echo $row['s_name']; ?></td>
                <td><?php echo $row['s_email']; ?></td>
                <td><?php echo $row['s_contact']; ?></td>
                <td><input type="checkbox" id="txt_<?php echo $row['s_id']; ?>" style="text-align:center" <?php if(isset($row['attendance']) && $row['attendance'] == '1'){echo 'checked';}?> value="<?php echo $row['s_roll_no']; ?>" name="attendance[<?php echo $row['s_id']; ?>]" /></td>
              </tr>
              <?php } mysql_close($link); ?>
            </tbody>
          </table>
        </div>
        <br/>
        <div class="row" style="display:<?php echo $form_show; ?>;">
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <input type="button" class="btn btn-success" style="width:400px;" value="Sumit Attendance" onclick="submitStudentMark();">
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="bottom_area"></div>
</div>
<script type="text/javascript">
	function getStudentInfoByAtt(){
		var class_id = $("#dllStClassId").val();
		var date = $("#txtDate").val();
		if(class_id != '' && date != ''){
			window.location = "<?php echo WEB_URL;?>attendance/t_addattendance.php?cid=" + class_id +'&date='+ date;
		}
		else{
			alert('Please select two field');
		}
	}
	function submitStudentMark(){
		$("#frmAddMark").submit();
	}
	
	$("#frmAddMark").submit(function(e)
	{
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR) 
			{
				alert(data);
				//data: return data from server
			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
				//if fails      
			}
		});
		e.preventDefault(); //STOP default action
	});
	
</script>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
