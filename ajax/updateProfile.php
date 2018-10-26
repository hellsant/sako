<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
		if(isset($_POST['txtProfileName'])){
			$name = $_POST['txtProfileName'];
			$email = $_POST['txtProfileEmail'];
			$password = $_POST['txtProfilePassword'];
			$sql = '';
			if($_SESSION['login_type'] == 'admin'){
				$sql = mysqli_query($link,"UPDATE `tbl_admin_login` set d_name = '$name', a_email = '$email', password = '$password' where aid = '$_POST[user_id]'");
			}
			else if($_SESSION['login_type'] == 'teacher'){
				$sql = mysqli_query($link,"UPDATE `tbl_add_teacher` set t_username = '$name', t_email = '$email', t_password = '$password' where teacher_id = '$_POST[user_id]'");
			}
			else if($_SESSION['login_type'] == 'student'){
				$sql = mysqli_query($link,"UPDATE `tbl_add_student` set s_profile_name = '$name', s_email = '$email', s_password = '$password' where s_id = '$_POST[user_id]'");
			}
			else if($_SESSION['login_type'] == 'parents'){
				$sql = mysqli_query($link,"UPDATE `tbl_add_parent` set p_profile_name = '$name', p_email = '$email', p_password = '$password' where p_id = '$_POST[user_id]'");
			}
			else if($_SESSION['login_type'] == 'accountant'){
				$sql = mysqli_query($link,"UPDATE `tbl_add_user` set u_profile_name = '$name', u_email = '$email', u_password = '$password' where u_id = '$_POST[user_id]' and u_designation = 'Accountant'");
			}
			else if($_SESSION['login_type'] == 'librarian'){
				$sql = mysqli_query($link,"UPDATE `tbl_add_user` set u_profile_name = '$name', u_email = '$email', u_password = '$password' where u_id = '$_POST[user_id]' and u_designation = 'Librarian'");
			}
			mysqli_query($sql,$link);
			echo "1";
			die();
		}
		else{
			echo '-99';
		}
	}
	else{
		echo '-99';
		die();
	}
?>
