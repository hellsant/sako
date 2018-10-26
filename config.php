<?php
define('WEB_URL', 'http://localhost/sako_sms/');
define('ROOT_PATH', 'C:\xampp\htdocs\sako_sms/');


define('TERM_1', '1');
define('TERM_2', '2');
define('TERM_3', '3');


define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'sms');
$link = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);// or die(mysqli_error());
//mysqli_select_db(DB_DATABASE, $link) or die(mysqli_error());?>