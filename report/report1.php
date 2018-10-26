<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$p_student_class_id =  "";
$p_student_name_id =  "";
$c_teacher =  "";
$es_term_id =  "";
$es_class_id =  "";
$es_subject_id =  "";
$title = 'Add New Examination Date';
$button_text="Submit";
$id="";
$hdnid="0";

if(isset($_POST['dllExName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	
	$sql = mysqli_query($link,"INSERT INTO `tbl_add_exam_date`(`ex_name`,`ex_class_id`,`ex_date`, `ex_note`) VALUES ('$_POST[dllExName]','$_POST[dllClassId]','$_POST[txtExDate]','$_POST[txtExNote]')");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'examination/exam_date_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql = mysqli_query($link,"UPDATE `tbl_add_exam_date` SET `ex_name`='".$_POST['dllExName']."',`ex_class_id`='".$_POST['dllClassId']."',`ex_date`='".$_POST['txtExDate']."',`ex_note`='".$_POST['txtExNote']."' WHERE ex_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'examination/exam_date_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_exam_date where ex_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){

		$ex_name = $row['ex_name'];
		$ex_class_id = $row['ex_class_id'];
		$ex_date = $row['ex_date'];
		$ex_note = $row['ex_note'];
		$hdnid = $_GET['id'];
		$title = 'Update Examination Date';
		$button_text="Update";
	}
	
	//mysql_close($link);

}
	
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text_inside">
    <div class="header_text_left"><?php echo $title; ?></div>
  </div>
  <div class="main_content">
    <div class="main_content_left">
      <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/exm.png"/></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>examination/exam_date_list.php">Exam. Date List</a></div>
      <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>examination/exm.php">Exam. Dashboard</a></div>
    </div>
    <div class="frmstyle">
      <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="dllClassId">Student Report </label>
          <div class="col-sm-3">
           <select class="form-control" onchange="getStudentWithRoll(this.value);" id="dllStClassId" name="dllStClassId">
              <option value="">--Select Class--</option>
              <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_class order by c_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
              <option <?php if($p_student_class_id == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
              <?php } //mysql_close($link);?>
            </select>
          </div>
          <div class="col-sm-3">
            <select class="form-control" id="dllStNameId" name="dllStNameId">
			<option value="">--Select Name--</option>
            </select>
          </div>
          <div class="col-sm-3">
            <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="dllClassId">Teacher Report </label>
          <div class="col-sm-3">
            <select class="form-control" id="ddlClTeacher" name="ddlClTeacher">
                <option value="">--Select Teacher--</option>
                <?php 
				  	$result_teacher = mysqli_query($link,"SELECT * FROM tbl_add_teacher order by t_name ASC");
					while($row_teacher = mysqli_fetch_array($result_teacher)){
				  ?>
                <option <?php if($c_teacher == $row_teacher['t_name']){echo 'selected';}?> value="<?php echo $row_teacher['t_name'];?>"><?php echo $row_teacher['t_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
          </div>
          <div class="col-sm-3">
            <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
          </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 control-label" for="dllClassId">Mark Report </label>
          <div class="col-sm-3">
           <select class="form-control" id="txtESId" name="txtESId">
                <option value="">--Select Schedule--</option>
                <?php 
				  	$result_term = mysqli_query($link,"SELECT * FROM tbl_schedule_setup order by schedule_id ASC");
					while($row_term = mysqli_fetch_array($result_term)){
				  ?>
                <option <?php if($es_term_id == $row_term['schedule_id']){echo 'selected';}?> value="<?php echo $row_term['schedule_id'];?>"><?php echo $row_term['schedule_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
          </div>
          <div class="col-sm-2">
            <select class="form-control" id="dllESClassId" onChange="getSubject(this.value);" name="dllESClassId">
                <option value="">--Select Class--</option>
                <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_class order by c_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
                <option <?php if($es_class_id == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
          </div>
		  <div class="col-sm-3">
            <select class="form-control" id="dllESSubjectId" name="dllESSubjectId">
                <option value="">--Select Subject--</option>
				 <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_subject order by sb_id ASC");
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
                <option <?php if($es_subject_id == $row_class['sb_id']){echo 'selected';}?> value="<?php echo $row_class['sb_id'];?>"><?php echo $row_class['sb_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
          </div>
          <div class="col-sm-2">
            <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
          </div>
        </div>
        <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
      </form>
    </div>
  </div>
  <div class="bottom_area"></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
