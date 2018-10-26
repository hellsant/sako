<?php include('header.php');?>
<?php
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
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
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>teacher/teacher_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/tr.png"></a></div>
      <div class="link_box_text">Docente</div>
    </div>
   <!--<div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>parent/parentlist.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/parent.png"></a></div>
      <div class="link_box_text">Parents</div>
    </div> --> 
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>student/student_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/student.png"></a></div>
      <div class="link_box_text">Estudiante</div>
    </div>
    <!--<div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>user/user_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/user.png"></a></div>
      <div class="link_box_text">Employee</div>
    </div>  -->
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>class/class_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/class.png"></a></div>
      <div class="link_box_text">Curso</div> <!--Class-->
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>subject/subject_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/subject.png"></a></div>
      <div class="link_box_text">Materias</div>  <!--Subject--> 
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>grade/grade_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/grade.png"></a></div>
      <div class="link_box_text">Puntaje</div>
    </div>  
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>examination/exm.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/exm.png"></a></div>
      <div class="link_box_text">Examen</div>
    </div> 
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>mark/mark.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/mark.png"></a></div>
      <div class="link_box_text">Calificaciones</div>
    </div>  
    <!-- <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>routine/routinelist.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/routine.png"></a></div>
      <div class="link_box_text">Routine</div>
    </div>  -->
    <!--<div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>attendance/addattendance.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/attendance.png"></a></div>
      <div class="link_box_text">Attendance</div>
    </div> -->
    <!-- <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>library/library.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/library.png"></a></div>
      <div class="link_box_text">TAREA A REVISAR</div>
    </div>   -->  
    <!--<div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>transport/transport.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/transport.png"></a></div>
      <div class="link_box_text">Transport</div>
    </div>   -->
    <!--<div class="link_box">
      <div class="link_box_img dashboard_image2"><a href="<?php echo WEB_URL; ?>hostel/hostel.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/hostel.png"></a></div>
      <div class="link_box_text">Hostel</div>
    </div>  -->
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>account/account.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/account.png"></a></div>
      <div class="link_box_text">Pagos</div>
    </div> 
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>notice/notice_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/notice.png"></a></div>
      <div class="link_box_text">Noticias</div>
    </div>  
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>report/report.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/report.png"></a></div>
      <div class="link_box_text">Reporte</div>
    </div>   
   <!-- <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>settings/setting.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/setting.png"></a></div>
      <div class="link_box_text">Settings</div>
    </div> -->
    <div style="clear:both"></div>
  </div>
  <br/>
  <br/>
</div>
<?php include('copyright.php');?>
<?php include('footer.php');?>
