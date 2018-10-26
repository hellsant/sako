<?php
define('DIR_APPLICATION', str_replace('\'', '/', realpath(dirname(__FILE__))) . '/');
define('DIR_SMS', str_replace('\'', '/', realpath(DIR_APPLICATION . '../')) . '/');
$success_token = '';
$base_url = home_base_url();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$options = array(
		'server'		=> $base_url,
		'root'			=> DIR_SMS,
		'db_host'		=> trim($_POST['txtHostName']),
		'db_user'		=> trim($_POST['txtDBUserName']),
		'db_password'	=> trim($_POST['txtPassword']),
		'db_name'		=> trim($_POST['txtDBName'])
	);
	if(importDatabase(trim($_POST['txtHostName']),trim($_POST['txtDBName']),trim($_POST['txtDBUserName']),trim($_POST['txtPassword']))){
		write_config_files($options);
		$success_token = 'SAKO SCHOOL MANAGEMENT SETUP SUCCESSFULLY <br/><a href="'.$base_url.'">Go to Website</a>';
	}
	else{
		$success_token = 'Error Occured Please Enter Valid Database Access Information !!!!!';
	}
}

function importDatabase($mysql_host,$mysql_database,$mysql_user,$mysql_password){
	$db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
	$query = file_get_contents("sms.sql");
	$stmt = $db->prepare($query);
	if ($stmt->execute())
		 return true;
	else 
		 return false;
}

function write_config_files($options) {
	$output  = '<?php' . "\n";
	$output .= 'define(\'CURRENCY\', \'USD\');' . "\n";
	$output .= 'define(\'WEB_URL\', \'' . $options['server'] . '\');' . "\n";
	$output .= 'define(\'ROOT_PATH\', \'' . $options['root'] . '\');' . "\n\n\n";
	
	$output .= 'define(\'TERM_1\', \'1\');' . "\n";
	$output .= 'define(\'TERM_2\', \'2\');' . "\n";
	$output .= 'define(\'TERM_3\', \'3\');' . "\n\n\n";
	
	$output .= 'define(\'DB_HOSTNAME\', \'' . addslashes($options['db_host']) . '\');' . "\n";
	$output .= 'define(\'DB_USERNAME\', \'' . addslashes($options['db_user']) . '\');' . "\n";
	$output .= 'define(\'DB_PASSWORD\', \'' . addslashes($options['db_password']) . '\');' . "\n";
	$output .= 'define(\'DB_DATABASE\', \'' . addslashes($options['db_name']) . '\');' . "\n";
	$output .= '$link = mysql_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD) or die(mysql_error());';
	$output .= 'mysql_select_db(DB_DATABASE, $link) or die(mysql_error());';
	$output .= '?>';

	$file = fopen($options['root'] . 'config.php', 'w');

	fwrite($file, $output);

	fclose($file);
}

function home_base_url(){   
	$base_url = (isset($_SERVER['HTTPS']) &&
	$_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
	$tmpURL = dirname(__FILE__);
	$tmpURL = str_replace(chr(92),'/',$tmpURL);
	$tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
	$tmpURL = ltrim($tmpURL,'/');
	$tmpURL = rtrim($tmpURL, '/');
	$tmpURL = str_replace('install','',$tmpURL);
	$base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL;
	/*if (strpos($tmpURL,'/')){
		$tmpURL = explode('/',$tmpURL);
		$tmpURL = $tmpURL[0];
	}
	if ($tmpURL !== $_SERVER['HTTP_HOST'])
		$base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL.'/';
	else
		echo $_SERVER['REQUEST_URI'];
		$base_url .= $tmpURL.'/';
		die();*/
	return $base_url; 
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SAKO SMS SETUP PAGE</title>
</head>
<body>
<br/>
<br/>
<br/>
<div></div>
<div style="font-weight:bold;font-size:30px;text-align:center;text-decoration:underline;color:#FF6600;"> Sako School Management Setup Wizard </div>
<br/>
<div align="center" style="width:450px;margin:0 auto;padding:0;">
  <?php if($success_token == ''){ ?>
  <fieldset>
  <legend style="font-size:bold;color:red;font-size:20px;">Path Details</legend>
  <table align="center">
    <tr>
      <td>URL : </td>
      <td><input type="text" size="50" name="txtUrl" id="txtUrl" value="<?php echo $base_url; ?>" /></td>
    </tr>
    <tr>
      <td>Root Path : </td>
      <td><input type="text" size="50" name="txtDocRoot" id="txtDocRoot" value="<?php echo DIR_SMS; ?>" /></td>
    </tr>
  </table>
  </fieldset>
  <br/>
  <fieldset>
  <legend style="font-size:bold;color:red;font-size:20px;">Enter Database Details</legend>
  <form method="post">
    <table align="center">
      <tr>
        <td>Host Name : </td>
        <td><input type="text" name="txtHostName" id="txtHostName" />
          &nbsp;<span style="color:red;font-weight:bold;">*</span></td>
      </tr>
      <tr>
        <td>Database UserName : </td>
        <td><input type="text" name="txtDBUserName" id="txtDBUserName" />
          &nbsp;<span style="color:red;font-weight:bold;">*</span></td>
      </tr>
      <tr>
        <td>Database Password : </td>
        <td><input type="text" name="txtPassword" id="txtPassword" />
          &nbsp;<span style="color:red;font-weight:bold;">*</span></td>
      </tr>
      <tr>
        <td>Database Name : </td>
        <td><input type="text" name="txtDBName" id="txtDBName" />
          &nbsp;<span style="color:red;font-weight:bold;">*</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" value="Setup Now" /></td>
      </tr>
    </table>
  </form>
  </fieldset>
  <?php } else { ?>
  <div style="color:#000;background:#FFFFFF;text-align:center;"><?php echo $success_token; ?></div>
  <?php } ?>
</div>
</body>
</html>
