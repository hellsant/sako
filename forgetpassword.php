<?php
include("config.php");
$msg = 'none';
$sql = '';
$xMsg = "No information Found";
if(isset($_POST['username']) && $_POST['username'] != ''){
	$password = '';
	if($_POST['ddlLoginType'] == 'admin'){
		//here for admin
		$sql= mysqli_query($link,"SELECT * FROM tbl_admin_login WHERE a_email = '".make_safe($_POST['username'])."'");
		$password = 'password';
	}
	else if($_POST['ddlLoginType'] == 'teacher'){
		//here for teacher
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_teacher WHERE t_email = '".make_safe($_POST['username'])."'");
		$password = 't_password';
	}
	else if($_POST['ddlLoginType'] == 'student'){
		//here for student
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_student WHERE s_email = '".make_safe($_POST['username'])."'");
		$password = 's_password';
	}
	else if($_POST['ddlLoginType'] == 'parents'){
		//here for parent
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_parent WHERE p_email = '".make_safe($_POST['username'])."'");
		$password = 'p_password';
	}
	else if($_POST['ddlLoginType'] == 'employee'){
		//here for employee
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_user WHERE u_email = '".make_safe($_POST['username'])."'");
		$password = 'u_password';
	}
	else if($_POST['ddlLoginType'] == 'librarian'){
		//here for librarian
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_user WHERE u_email = '".make_safe($_POST['username'])."'");
		$password = 'u_password';
	}
	else if($_POST['ddlLoginType'] == 'accountant'){
		//here for accountant
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_user WHERE u_email = '".make_safe($_POST['username'])."'");
		$password = 'u_password';
	}
	if($row = mysqli_fetch_array($sql)){
		//here success
		$xMsg = 'Check your Email Address for login details';
		$msg = 'block';
		//now send and email to user
		$result_s_arr = mysqli_query($link,"Select * from tbl_add_school");
		if($row_arr = mysqli_fetch_array($result_s_arr)){
			$to = trim($_POST['username']);
			$subject = $row_arr['email'] . ' User Login Details';
			$headers = "From: " . strip_tags($row_arr['email']) . "\r\n";
			$headers .= "Reply-To: ". strip_tags($row_arr['email']) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = '<html><body>';
			$message .= '<h1>User Login Information</h1>';
			$message .= '<div>Username: '.$_POST['username'].'</div>';
			$message .= '<div>Password: '.$row[$password].'</div>';
			$message .= '</body></html>';
			//echo $message;
			//die();
			mail($to, $subject, $message, $headers);
		}
	}
	else{
		$msg = 'block';
	}
}
function make_safe($variable) 
{
	

	
	$link = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   $variable = trim(mysqli_real_escape_string($link,$variable));
   return $variable; 
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>SAKO School Management System</title>
<!-- BOOTSTRAP STYLES-->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONTAWESOME STYLES-->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLES-->
<link href="assets/css/custom.css" rel="stylesheet" />
<!-- GOOGLE FONTS-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<div class="container">
  <div class="row text-center ">
    <div class="col-md-12"> <br />
      <img style="width:105px;height:100px;" src="<?php echo WEB_URL; ?>img/upload/1827155dea48642c1d.png" /> </div>
  </div>
  <div class="row ">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
      <div style="margin-bottom:8px;padding-top:2px;width:100%;height:25px;background:#E52740;color:#fff; display:<?php echo $msg; ?>" align="center"><?php echo $xMsg; ?></div>
      <div class="panel panel-default" id="loginBox">
        <div class="panel-heading"> <strong> Forget Your Password </strong> </div>
        <div class="panel-body">
          <form onSubmit="return validationForm();" role="form" id="form" method="post">
            <br />
            <div class="form-group input-group"> <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
              <input type="text" name="username" id="username" class="form-control" placeholder="Your Email Address " />
            </div>
            <div class="form-group input-group"> <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
              <select name="ddlLoginType" id="ddlLoginType" class="form-control">
                <option value="-1">-- Select --</option>
                <option value="admin">Admin</option>
                <option value="teacher">Teacher</option>
                <option value="student">Student</option>
                <option value="parents">Parents</option>
                <option value="accountant">Accountant</option>
				<option value="librarian">Librarian</option>
              </select>
            </div>
            <div class="form-group">
              <button style="width:100%;" type="submit" id="login" class="btn btn-primary">Submit</button>
            </div>
			<div class="form-group">
			  <a style="width:100%;" type="submit" id="login" class="btn btn-success" href="<?php echo WEB_URL;?>index.php">Back To Login</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function validationForm(){
	if($("#username").val() == ''){
		alert("Valid Email Required !!!");
		$("#username").focus();
		return false;
	}
	else if($("#ddlLoginType").val() == '-1'){
		alert("Select Login Type !!!");
		return false;
	}
	else{
		return true;
	}
}
</script>
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
