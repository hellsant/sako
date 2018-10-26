<?php include('../header.php');
$success = "none";
if(isset($_POST['submit'])){
	mysql_query("delete from tbl_user_access_setup",$link);
	if(isset($_POST['txtTeacherAccess'])){
		mysql_query("insert into tbl_user_access_setup(access_type,access) values('teacher','" . json_encode($_POST['txtTeacherAccess']) . "')",$link);
	}
	if(isset($_POST['txtStuAccess'])){
		mysql_query("insert into tbl_user_access_setup(access_type,access) values('student','" . json_encode($_POST['txtStuAccess']) . "')",$link);
	}
	if(isset($_POST['txtParentAccess'])){
		mysql_query("insert into tbl_user_access_setup(access_type,access) values('parent','" . json_encode($_POST['txtParentAccess']) . "')",$link);
	}
	if(isset($_POST['txtEmpAccess'])){
		mysql_query("insert into tbl_user_access_setup(access_type,access) values('employee','" . json_encode($_POST['txtEmpAccess']) . "')",$link);
	}
	if(isset($_POST['txtAccAccess'])){
		mysql_query("insert into tbl_user_access_setup(access_type,access) values('account','" . json_encode($_POST['txtAccAccess']) . "')",$link);
	}
	if(isset($_POST['txtLibAccess'])){
		mysql_query("insert into tbl_user_access_setup(access_type,access) values('library','" . json_encode($_POST['txtLibAccess']) . "')",$link);
	}
	$success = "block";
}

$result = mysql_query("SELECT * FROM tbl_user_access_setup",$link);
while($row = mysql_fetch_array($result)){
	print_r($row);
	die();
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content">
  <div class="header_text_inside">
    <div class="header_text_left">User Access Setup</div>
  </div>
  <form method="post">
    <div class="main_content">
      <div style="float:left;margin-left:20px;border:1px solid #000;width:250px;">
        <div align="center" style="color:#FF0000; font-weight:bold;">Teacher Access</div>
        <div align="center" style="width:245px; height:110px; overflow:auto;">
          <table>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="teacher" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Teacher</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="student" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Student</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="parent" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Parent</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="employee" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Employee</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="class" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Class</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="subject" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Subject</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="grade" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Grade</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="examination" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Examination</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="mark" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Mark</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="routine" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Routine</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="attendance" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Attendance</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="library" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Library</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="transport" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Transport</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="hostel" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Hostel</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="account" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Account</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="notice" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Notice</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="report" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Report</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="settings" name="txtTeacherAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Settings</td>
            </tr>
          </table>
        </div>
      </div>
      <div style="float:left;margin-left:20px;border:1px solid #000;width:250px;">
        <div align="center" style="color:#FF0000; font-weight:bold;">Student Access</div>
        <div align="center" style="width:245px; height:110px; overflow:auto;">
          <table>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="teacher" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Teacher</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="student" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Student</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="parent" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Parent</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="employee" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Employee</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="class" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Class</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="subject" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Subject</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="grade" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Grade</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="examination" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Examination</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="mark" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Mark</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="routine" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Routine</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="attendance" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Attendance</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="library" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Library</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="transport" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Transport</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="hostel" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Hostel</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="account" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Account</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="notice" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Notice</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="report" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Report</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="settings" name="txtStuAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Settings</td>
            </tr>
          </table>
        </div>
      </div>
      <div style="float:left;margin-left:20px;border:1px solid #000;width:250px;">
        <div align="center" style="color:#FF0000; font-weight:bold;">Parent Access</div>
        <div align="center" style="width:245px; height:110px; overflow:auto;">
          <table>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="teacher" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Teacher</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="student" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Student</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="parent" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Parent</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="employee" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Employee</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="class" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Class</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="subject" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Subject</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="grade" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Grade</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="examination" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Examination</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="mark" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Mark</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="routine" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Routine</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="attendance" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Attendance</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="library" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Library</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="transport" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Transport</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="hostel" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Hostel</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="account" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Account</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="notice" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Notice</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="report" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Report</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="settings" name="txtParentAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Settings</td>
            </tr>
          </table>
        </div>
      </div>
      <div style="float:left;margin-left:20px;border:1px solid #000;width:250px;">
        <div align="center" style="color:#FF0000; font-weight:bold;">Employee Access</div>
        <div align="center" style="width:245px; height:110px; overflow:auto;">
          <table>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="teacher" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Teacher</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="student" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Student</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="parent" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Parent</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="employee" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Employee</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="class" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Class</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="subject" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Subject</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="grade" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Grade</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="examination" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Examination</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="mark" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Mark</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="routine" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Routine</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="attendance" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Attendance</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="library" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Library</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="transport" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Transport</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="hostel" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Hostel</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="account" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Account</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="notice" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Notice</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="report" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Report</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="settings" name="txtEmpAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Settings</td>
            </tr>
          </table>
        </div>
      </div>
	  <div style="float:left;margin-left:20px;border:1px solid #000;width:250px;margin-top:20px;">
        <div align="center" style="color:#FF0000; font-weight:bold;">Account Access</div>
        <div align="center" style="width:245px; height:110px; overflow:auto;">
          <table>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="teacher" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Teacher</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="student" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Student</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="parent" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Parent</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="employee" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Employee</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="class" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Class</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="subject" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Subject</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="grade" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Grade</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="examination" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Examination</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="mark" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Mark</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="routine" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Routine</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="attendance" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Attendance</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="library" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Library</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="transport" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Transport</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="hostel" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Hostel</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="account" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Account</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="notice" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Notice</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="report" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Report</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="settings" name="txtAccAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Settings</td>
            </tr>
          </table>
        </div>
      </div>
	  <div style="float:left;margin-left:20px;border:1px solid #000;width:250px;margin-top:20px;">
        <div align="center" style="color:#FF0000; font-weight:bold;">Librarian Access</div>
        <div align="center" style="width:245px; height:110px; overflow:auto;">
          <table>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="teacher" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Teacher</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="student" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Student</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="parent" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Parent</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="employee" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Employee</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="class" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Class</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="subject" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Subject</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="grade" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Grade</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="examination" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Examination</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="mark" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Mark</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="routine" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Routine</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="attendance" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Attendance</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="library" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Library</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="transport" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Transport</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="hostel" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Hostel</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="account" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Account</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="notice" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Notice</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="report" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Report</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;
                <input type="checkbox" value="settings" name="txtLibAccess[]"/>
                &nbsp;&nbsp;</td>
              <td>Settings</td>
            </tr>
          </table>
        </div>
      </div>
	  
	  
    </div>
	<div style="clear:both;"></div>
	<br/><br/>
	<div align="center"><input type="submit" class="btn btn_add_new btn-success" value="Save Access" /></div>
  </form>
  <div class="bottom_area"></div>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
