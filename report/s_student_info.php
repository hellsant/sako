<?php include('../header.php');
include('../sako/common.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'&& $_SESSION['login_type'] != 'student'){
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
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location: logout.php");
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>Student Information</title>
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
  <div align="right"> <a class="btn btn-success" onClick="javascript:window.print();">&nbsp;Print</a> </div>
  <div>
    <input type="hidden" id="web_url" value="<?php echo WEB_URL; ?>" />
    <?php if($school_image != '') {?>
    <!--<img style="width:200px;height:200px; margin:0 auto" src="img/logo.png"/>-->
    <img style="width:200px;height:200px;" src="<?php echo $school_image; ?>" />
    <p style="color:black;font-size:24px; font-weight:bold;text-transform:uppercase;"><?php echo $school_name; ?></p>
    <?php }?>
  </div>
  <div style="margin:20px;"></div>
  <div align="left">
    <?php
 
$id = '';
   $result = mysqli_query($link,"Select sm.class_id,sm.subject_id,sm.student_id,sm.marks,sm.exam_id,s.s_name,s.s_id,s.s_email,s.s_dob,s.s_address,c.c_name,s.s_roll_no,s.s_gender,s.s_religion,s.s_profile_name,s.s_image from tbl_student_marks sm inner join tbl_add_student s on sm.student_id = s.s_id inner join tbl_add_class c on sm.class_id = c.c_id where s_id = '" . (int)$_SESSION['objLogin']['s_id'] . "'");

if($row = mysqli_fetch_array($result)){
$s_image = WEB_URL . 'img/no_image.jpg';	
if(file_exists(ROOT_PATH . '/img/upload/' . $row['s_image']) && $row['s_image'] != ''){
$s_image = WEB_URL . 'img/upload/' . $row['s_image'];
}
  
?>
    <img style="width:100px;height:100px; margin:0 auto" src="<?php echo $s_image;  ?>" /></div>
  <?php } ?>
  <div>
    <div style="font-size:20px; font-weight:bold; color:black; text-align:left; margin-top:20px; margin-bottom:20px; text-decoration:underline;">Personal Information:</div>
    <div align="left" style="width:100%; margin-bottom:30px;">
      <?php
	  if(isset($_SESSION['objLogin']['s_id'])){
    $result = mysqli_query($link,"Select sm.class_id,sm.subject_id,sm.student_id,sm.marks,sm.exam_id,s.s_name,s.s_id,s.s_email,s.s_contact,s.s_dob,s.s_address,c.c_name,s.s_roll_no,s.s_gender,s.s_religion,s.s_profile_name,s.s_image,p.p_father_name from tbl_student_marks sm inner join tbl_add_student s on sm.student_id = s.s_id inner join tbl_add_class c on sm.class_id = c.c_id inner join tbl_add_parent p on p.p_id = s.parent_id where s_id = '" . (int)$_SESSION['objLogin']['s_id'] . "'");
	}
	else{
		$result = mysqli_query($link,"Select * from tbl_student_marks where smid = '-1' order by smid desc");
	}

	if($row = mysqli_fetch_array($result)){?>
      <table class="gridtable" align="left"  style="width:100%">
        <tr>
          <td style="font-weight:bold;">Nombre :</td>
          <td><?php echo $row['s_name']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Grado de Instruccion :</td>
          <td><?php echo $row['p_father_name']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Email :</td>
          <td><?php echo $row['s_email']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Celular :</td>
          <td><?php echo $row['s_contact']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Direccion :</td>
          <td><?php echo $row['s_address']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Fecha de Nacimiento :</td>
          <td><?php echo $row['s_dob']; ?></td>
        </tr>
		<tr>
          <td style="font-weight:bold;">Genero :</td>
          <td><?php echo $row['s_gender']; ?></td>
        </tr>
		 <tr>
          <td style="font-weight:bold;">Religion :</td>
          <td><?php echo $row['s_religion']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Curso :</td>
          <td><?php echo $row['c_name']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">No Lista :</td>
          <td><?php echo $row['s_roll_no']; ?></td>
        </tr>
        <tr>
          <td style="font-weight:bold;">Nombre de Perfil :</td>
          <td><?php echo $row['s_profile_name']; ?></td>
        </tr>
        <?php }?>
      </table>
    </div>
  </div>
  <div style="clear:both;"></div>
  <br/>
  <div>
    <div align="center" style="font-size:20px; font-weight:bold; color:black; text-align:center; margin-top:20px; margin-bottom:20px; text-decoration:underline;">Notas Primer Parcial</div>
    <div align="left" style="width:100%; margin-bottom:30px;">
      <table class="gridtable" align="left"  style="width:100%">
        <thead>
          <tr>
            <th>Materia</th>
            <th>Calificacion</th>
            <th>Grado</th>
            <th>Ponderado</th>
          </tr>
        </thead>
        <tbody>
          <?php
		$id = '';
		$result = mysqli_query($link,"Select sm.class_id,sm.subject_id,sm.student_id,sm.marks,sm.exam_id,s.sb_name from tbl_student_marks sm inner join tbl_add_subject s on sm.subject_id = s.sb_id  where sm.class_id='".$_GET['cid']."' and sm.exam_id='".(int)TERM_1."' and sm.student_id = '" . (int)$_SESSION['objLogin']['s_id'] . "'");
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
            <td><?php echo $row['sb_name']; ?></td>
            <td><?php echo $row['marks']; ?></td>
            <td><?php echo $g_name;?></td>
            <td><?php echo $g_point; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div style="clear:both;"></div>
  <br/>
  <div>
    <div align="center" style="font-size:20px; font-weight:bold; color:black; text-align:center; margin-top:20px; margin-bottom:20px; text-decoration:underline;">Notas Segundo Parcial</div>
    <div align="left" style="width:100%; margin-bottom:30px;">
      <table class="gridtable" align="left"  style="width:100%">
        <thead>
          <tr>
            <th>Materia</th>
            <th>Calificacion</th>
            <th>Grado</th>
            <th>Ponderado</th>
          </tr>
        </thead>
        <tbody>
          <?php
		$id = '';
		$result = mysqli_query($link,"Select sm.class_id,sm.subject_id,sm.student_id,sm.marks,sm.exam_id,s.sb_name from tbl_student_marks sm inner join tbl_add_subject s on sm.subject_id = s.sb_id  where sm.student_id='".$_GET['sid']."' and sm.class_id='".$_GET['cid']."' and sm.exam_id='".(int)TERM_2."'");
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
            <td><?php echo $row['sb_name']; ?></td>
            <td><?php echo $row['marks']; ?></td>
            <td><?php echo $g_name ;?></td>
            <td><?php echo $g_point; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div style="clear:both;"></div>
  <br/>
  <div>
    <div align="center" style="font-size:20px; font-weight:bold; color:black; text-align:center; margin-top:20px; margin-bottom:20px; text-decoration:underline;">Notas Examen Final</div>
    <div align="left" style="width:100%; margin-bottom:30px;">
      <table class="gridtable" align="left" style="width:100%">
        <thead>
          <tr>
            <th>Materia</th>
            <th>Calificacion</th>
            <th>Grado</th>
            <th>Ponderado</th>
          </tr>
        </thead>
        <tbody>
          <?php
		$id = '';
		$result = mysqli_query($link,"Select sm.class_id,sm.subject_id,sm.student_id,sm.marks,sm.exam_id,s.sb_name from tbl_student_marks sm inner join tbl_add_subject s on sm.subject_id = s.sb_id  where sm.student_id='".$_GET['sid']."' and sm.class_id='".$_GET['cid']."' and sm.exam_id='".(int)TERM_3."'");
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
            <td><?php echo $row['sb_name']; ?></td>
            <td><?php echo $row['marks']; ?></td>
            <td><?php echo $g_name ;?></td>
            <td><?php echo $g_point; ?></td>
          </tr>
          <?php } mysqli_close($link); ?>
        </tbody>
      </table>
    </div>
  </div>
  <div style="clear:both"></div>
</div>
</body>
</html>
