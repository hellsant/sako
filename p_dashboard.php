<?php include('header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'parents'){
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
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>student/p_student_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/student.png"></a></div>
      <div class="link_box_text">Student</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>class/p_class_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/class.png"></a></div>
      <div class="link_box_text">Class</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>subject/p_subject_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/subject.png"></a></div>
      <div class="link_box_text">Subject</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>grade/p_grade_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/grade.png"></a></div>
      <div class="link_box_text">Grade</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>examination/p_exm.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/exm.png"></a></div>
      <div class="link_box_text">Examination</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>mark/p_viewmark.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/mark.png"></a></div>
      <div class="link_box_text">Mark</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>routine/p_routinelist.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/routine.png"></a></div>
      <div class="link_box_text">Routine</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>attendance/p_viewattendance.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/attendance.png"></a></div>
      <div class="link_box_text">Attendance</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image3"><a href="<?php echo WEB_URL; ?>transport/p_transport.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/transport.png"></a></div>
      <div class="link_box_text">Transport</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image2"><a href="<?php echo WEB_URL; ?>hostel/p_hostel.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/hostel.png"></a></div>
      <div class="link_box_text">Hostel</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>notice/p_notice_list.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/notice.png"></a></div>
      <div class="link_box_text">Notice</div>
    </div>
    <div class="link_box">
      <div class="link_box_img dashboard_image"><a href="<?php echo WEB_URL; ?>report/p_report.php"><img height="80" width="80" src="<?php echo WEB_URL; ?>img/report.png"></a></div>
      <div class="link_box_text">Report</div>
    </div>
    <div style="clear:both"></div>
  </div>
  <br/>
  <br/>
</div>
<?php include('copyright.php');?>
<?php include('footer.php');?>
