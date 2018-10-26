<?php 
include('../header.php');
include('../sako/common.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
$school_image = '';
$school_name = '';
$result_s_arr = mysqli_query($link,"Select * from tbl_add_school");
if($row_arr = mysqli_fetch_array($result_s_arr)){
	$school_image = WEB_URL . 'img/upload/' . $row_arr['s_image'];
	$school_name = $row_arr['st_title'];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Mark Information</title>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<style type="text/css">
.btn_save {
	background: #3498db;
	background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
	background-image: -moz-linear-gradient(top, #3498db, #2980b9);
	background-image: -ms-linear-gradient(top, #3498db, #2980b9);
	background-image: -o-linear-gradient(top, #3498db, #2980b9);
	background-image: linear-gradient(to bottom, #3498db, #2980b9);
	-webkit-border-radius: 28;
	-moz-border-radius: 28;
	border-radius: 28px;
	font-family: Georgia;
	color: white;
	font-weight:bold;
	font-size: 15px;
	padding: 5px 20px 5px 20px;
	text-decoration: none;
}
.btn_save :hover {
	background: #3cb0fd;
	background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
	background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
	background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
	background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
	background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
	text-decoration: none;
}
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:14px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	/*background-color: #dedede;*/
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>
</head>
<body>
<div>
<div align="center" style="margin:50px;">
  <div align="right"> <a class="btn btn-success" onClick="javascript:window.print();">Print</a> </div>
  <div>
    <input type="hidden" id="web_url" value="<?php echo WEB_URL; ?>" />
    <?php if($school_image != '') {?>
    <!--<img style="width:200px;height:200px; margin:0 auto" src="img/logo.png"/>-->
    <img style="width:200px;height:200px;" src="<?php echo $school_image; ?>" />
    <p style="color:black;font-size:24px; font-weight:bold;text-transform:uppercase;"><?php echo $school_name; ?></p>
    <?php }?>
  </div>
  <div>
    <div align="center" style="font-size:20px; font-weight:bold; color:black; text-align:center; margin-top:20px; margin-bottom:20px; text-decoration:underline;">MARK DETAILS</div>
    <div align="left">
      <table class="gridtable" align="left"  style="width:100%">
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Class Name</th>
			<th>Class Roll</th>
            <th>Subject</th>
            <th>Mark</th>
            <th>Grade</th>
            <th>Point</th>
          </tr>
        </thead>
        <tbody>
          <?php
		$id = '';
		$result = mysqli_query($link,"Select sm.class_id,sm.subject_id,sm.student_id,sm.marks,sm.exam_id,s.sb_name,st.s_name,c.c_name,st.s_roll_no from tbl_student_marks sm inner join tbl_add_subject s on sm.subject_id = s.sb_id inner join tbl_add_student st on sm.student_id = st.s_id inner join tbl_add_class c on sm.class_id = c.c_id where sm.exam_id='".$_GET['eid']."' and sm.class_id='".$_GET['cid']."' and sm.subject_id='".$_GET['sbid']."'");
		while($row = mysqli_fetch_array($result)){
		 $g_name = '';
		 $g_point = '0.00';
		 $gp = getStudentGrade($row['marks'],$link);
		 if($gp != ''){
		 	$s1 = explode('|',$gp);
			$g_name = $s1[0];
			$g_point = $s1[1];
		 }
		?>
          <tr>
            <td><?php echo $row['s_name']; ?></td>
            <td><?php echo $row['c_name']; ?></td>
			<td><?php echo $row['s_roll_no']; ?></td>
            <td><?php echo $row['sb_name']; ?></td>
            <td><?php echo $row['marks']; ?></td>
            <td><?php echo $g_name;?></td>
            <td><?php echo $g_point; ?></td>
          </tr>
          <?php } //mysql_close($link); ?>
        </tbody>
      </table>
    </div>
  </div>
  <div style="clear:both"></div>
</div>
</body>
</html>
