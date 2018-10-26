<?php include('header.php');
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'teacher'){
	header("Location: logout.php");
	die();
}

?>

<div class="content">
  <div style="position:absolute;right:0px;margin-right:10px;margin-top:5px;">
    <div><a href="javascript:;" data-target=".modal" data-toggle="modal"><img src="<?php echo WEB_URL; ?>img/profile-icon.png" /></a></div>
    <div style="text-align:center;font-size:10px;color:#000;font-weight:bold;"><a href="javascript:;" data-target=".modal" data-toggle="modal"><?php echo $name_x; ?></a></div>
  </div>
  <div class="header_text">
    <div align="center"><img id="window_size_img" src="<?php echo WEB_URL; ?>img/dashboard_image.png"><img id="mobile_size_img" style="display:none;" src="<?php echo WEB_URL; ?>img/mobile_dashboard.png"></div>
  </div>
  <div align="center" style="width:88%;margin:0 auto;padding:0;">
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>student/t_student_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/student.png"></a></div>
      <div class="link_box_text">Mis Estudiantes</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>class/t_class_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/class.png"></a></div>
      <div class="link_box_text">Mis Cursos</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>subject/teacher_subject_view.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/subject.png"></a></div>
      <div class="link_box_text">Mis Materias</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>grade/t_grade_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/grade.png"></a></div>
      <div class="link_box_text">Puntaje</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>examination/t_exm.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/exm.png"></a></div>
      <div class="link_box_text">Examen</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>mark/t_viewmark.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/mark.png"></a></div>
      <div class="link_box_text">Calificar</div>
    </div>
	<div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>library/library.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/library.png"></a></div>
      <div class="link_box_text">Tareas a Revisar</div>
    </div>
   <!-- <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>routine/t_routinelist.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/routine.png"></a></div>
      <div class="link_box_text">Routine</div>
    </div>  
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>attendance/t_addattendance.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/attendance.png"></a></div>
      <div class="link_box_text">Attendance</div>
    </div>   -->
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>notice/t_notice_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/notice.png"></a></div>
      <div class="link_box_text">Noticias</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>report/t_report.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/report.png"></a></div>
      <div class="link_box_text">Reporte</div>
    </div>
    <div style="clear:both"></div>
  </div>
</div>
<?php include('copyright.php');?>
<?php include('footer.php');?>
