<?php
define('DIR_APPLICATION', str_replace('\'', '/', realpath(dirname(__FILE__))) . '/');
include(DIR_APPLICATION."config.php");
ob_start();
session_start();
$msg = 'none';
$sql = '';
if(isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != ''){
	if($_POST['ddlLoginType'] == 'admin'){
		//here for admin
		$sql= mysqli_query($link,"SELECT * FROM tbl_admin_login WHERE a_email = '".make_safe($_POST['username'])."' and password = '".make_safe($_POST['password'])."'");
	}
	else if($_POST['ddlLoginType'] == 'teacher'){
		//here for teacher
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_teacher WHERE t_email = '".make_safe($_POST['username'])."' and t_password = '".make_safe($_POST['password'])."'");
	}
	else if($_POST['ddlLoginType'] == 'student'){
		//here for student
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_student WHERE s_email = '".make_safe($_POST['username'])."' and s_password = '".make_safe($_POST['password'])."'");
	}
	else if($_POST['ddlLoginType'] == 'parents'){
		//here for parent
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_parent WHERE p_email = '".make_safe($_POST['username'])."' and p_password = '".make_safe($_POST['password'])."'");
	}
	else if($_POST['ddlLoginType'] == 'employee'){
		//here for employee
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_user WHERE u_email = '".make_safe($_POST['username'])."' and u_password = '".make_safe($_POST['password'])."'");
	}
	else if($_POST['ddlLoginType'] == 'librarian'){
		//here for employee
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_user WHERE u_email = '".make_safe($_POST['username'])."' and u_password = '".make_safe($_POST['password'])."'");
	}
	else if($_POST['ddlLoginType'] == 'accountant'){
		//here for employee
		$sql= mysqli_query($link,"SELECT * FROM tbl_add_user WHERE u_email = '".make_safe($_POST['username'])."' and u_password = '".make_safe($_POST['password'])."'");
	}
	if($row = mysqli_fetch_array($sql)){
		//here success
		$_SESSION['objLogin'] = $row;
		$_SESSION['login_type'] = $_POST['ddlLoginType'];
		if($_POST['ddlLoginType'] == 'admin'){
			header("Location: dashboard.php");
			die();
		}
		else if($_POST['ddlLoginType'] == 'teacher'){
			header("Location: t_dashboard.php");
			die();
		}
		else if($_POST['ddlLoginType'] == 'student'){
			header("Location: s_dashboard.php");
			die();
		}
		else if($_POST['ddlLoginType'] == 'parents'){
			header("Location: p_dashboard.php");
			die();
		}
		else if($_POST['ddlLoginType'] == 'accountant'){
			header("Location: a_dashboard.php");
			die();
		}
		else if($_POST['ddlLoginType'] == 'librarian'){
			header("Location: l_dashboard.php");
			die();
		}
	}
	else{
		$msg = 'block';
	}
   }
function make_safe($variable) 
{     
$link = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   //$variable= trim($variable);
   $variable =trim(mysqli_real_escape_string($link,$variable));
	//$variable = strip_tags(mysqli_real_escape_string(trim($link,$variable)));
   return $variable; 
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>EVA Entornos Virtuales de Aprendizaje</title>
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
      <img style="width:105px;height:100px;" src="<?php echo WEB_URL; ?>img/upload/birrete.png" /> </div>    <!--  img/upload/1827155dea48642c1d.png" /> </div> -->
  </div>
  <div class="row ">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
      <div style="margin-bottom:8px;padding-top:2px;width:100%;height:25px;background:#E52740;color:#fff; display:<?php echo $msg; ?>" align="center">Wrong login information</div>
      <div class="panel panel-default" id="loginBox">
        <div class="panel-heading"> <strong> Ingrese sus datos</strong> </div>
        <div class="panel-body">
          <form onSubmit="return validationForm();" role="form" id="form" method="post">
            <br />
            <div class="form-group input-group"> <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
              <input type="text" name="username" id="username" class="form-control" placeholder="Your Username " />
            </div>
            <div class="form-group input-group"> <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
              <input type="password" name="password" id="password" class="form-control"  placeholder="Your Password" />
            </div>
            <div class="form-group input-group"> <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
              <select name="ddlLoginType" id="ddlLoginType" class="form-control">
                <option value="-1">-- Seleccionar --</option>
                <option value="admin">Administrador</option>
                <option value="teacher">Docente</option>
                <option value="student">Estudiante</option>
               <!-- <option value="parents">Parents</option>
               <option value="accountant">Accountant</option>
				<option value="librarian">Librarian</option>  -->
              </select>
            </div>
            <div class="form-group">
              <label class="checkbox-inline">
              </label>
             <!-- <span class="pull-right"> <a href="<?php echo WEB_URL;?>forgetpassword.php" >Forget password ? </a> </span> </div> -->
            <hr />
            <div align="center">
              <button style="width:100%;" type="submit" id="login" class="btn btn-primary">Login</button>
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
		alert("Username Required !!!");
		$("#username").focus();
		return false;
	}
	else if($("#password").val() == ''){
		alert("Password Required !!!");
		$("#password").focus();
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