<?php include('header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
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
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>class/student_class_view.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/class.png"></a></div>
      <div class="link_box_text">Curso</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>subject/student_subject_view.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/subject.png"></a></div>
      <div class="link_box_text">Materia</div>
    </div>
   <!-- <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>routine/student_routine_view.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/routine.png"></a></div>
      <div class="link_box_text">Routine</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>attendance/student_attendance_details.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/attendance.png"></a></div>
      <div class="link_box_text">Attendance</div>
    </div>    -->
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>grade/student_grade_list_view.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/grade.png"></a></div>
      <div class="link_box_text">Escala Puntaje</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>examination/student_exam_schedule_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/exm.png"></a></div>
      <div class="link_box_text">Examination</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>mark/student_mark_details.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/mark.png"></a></div>
      <div class="link_box_text">Calificaciones</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>library/student_library.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/library.png"></a></div>
      <div class="link_box_text">Enviar Tareas</div>
    </div>
   <!-- <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>transport/s_transport.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/transport.png"></a></div>
      <div class="link_box_text">Transport</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image2"><a href="<?php echo WEB_URL; ?>hostel/s_hostel.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/hostel.png"></a></div>
      <div class="link_box_text">Hostel</div>
    </div>   -->
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>notice/s_notice_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/notice.png"></a></div>
      <div class="link_box_text">Noticias</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>report/s_student_report.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/report.png"></a></div>
      <div class="link_box_text">Reporte</div>
    </div>
    <div style="clear:both"></div>   <!--library/student_issuelist_view.php"-->
  </div>
  <br/>
  <br/>
</div>
<?php include('copyright.php');?>      
<?php include('footer.php');?>
