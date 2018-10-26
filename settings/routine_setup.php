<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<?php 
  	$weekday = array();
	$sort = array();
	$button_text = "Save";
	$hval = 0;
	
	$sat = false;
	$sun = false;
	$mon = false;
	$tues = false;
	$wed = false;
	$thus = false;
	$fri = false;
	
	$sort_sat = '';
	$sort_sun = '';
	$sort_mon = '';
	$sort_tues = '';
	$sort_wed = '';
	$sort_thus = '';
	$sort_fri = '';
	
	
	if(isset($_POST['weekday'])){
		mysql_query("delete from tbl_routine_setup",$link);
		foreach($_POST['weekday'] as $sweek){
			if(isset($sweek['day']) && $sweek['day'] != '' && isset($sweek['sort']) && $sweek['sort'] != ''){
				$sql = "INSERT INTO `tbl_routine_setup`(`weekday`,`sort`) VALUES ('$sweek[day]','$sweek[sort]')";
	 			mysql_query($sql,$link);
			}
		}
		echo "<script>alert('Added Successfully');</script>";
	}
	
	$result = mysql_query("SELECT * FROM tbl_routine_setup order by rsid ASC ",$link);
	while($row = mysql_fetch_array($result)){
		if($row['weekday'] == 'saturday'){
			$sat = true;
			$sort_sat = $row['sort'];
		}
		if($row['weekday'] == 'sunday'){
			$sun = true;
			$sort_sun = $row['sort'];
		}
		if($row['weekday'] == 'monday'){
			$mon = true;
			$sort_mon = $row['sort'];
		}
		if($row['weekday'] == 'tuesday'){
			$tues = true;
			$sort_tues = $row['sort'];
		}
		if($row['weekday'] == 'wednesday'){
			$wed = true;
			$sort_wed = $row['sort'];
		}
		if($row['weekday'] == 'thursday'){
			$thus = true;
			$sort_thus = $row['sort'];
		}
		if($row['weekday'] == 'friday'){
			$fri = true;
			$sort_fri = $row['sort'];
		}
	}

	
  ?>
<div class="content">
  <div class="header_text">Routine Setup</div>
  <div align="right" style="margin-right:20px;">
    <div style="margin-left:800px;" class="header_text_right_list"><a class="btn btn-success" href="<?php echo WEB_URL; ?>settings/setting.php">Setting</a></div>
  </div>
  <div>
    <!-- start insert department name-->
    <div align="center">
      <div style="width:40%;border:solid 1px #666;padding:5px;"> <br/>
        <form method="post">
          <table>
            <tr>
              <td>Week Day</td>
              <td>Sort Order</td>
            </tr>
            <tr>
              <td><input type="checkbox" name="weekday[0][day]" <?php if($sat){echo 'checked';}?> value="saturday" id="txtSaturDay"/>
                &nbsp;&nbsp;&nbsp;Saturday&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="weekday[0][sort]" value="<?php echo $sort_sat; ?>" id="txtOne"/></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="weekday[1][day]" <?php if($sun){echo 'checked';}?> value="sunday" id="txtSunDay"/>
                &nbsp;&nbsp;&nbsp;Sunday&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="weekday[1][sort]" value="<?php echo $sort_sun; ?>" id="txtTwo"/></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="weekday[2][day]" <?php if($mon){echo 'checked';}?> value="monday" id="txtMonDay"/>
                &nbsp;&nbsp;&nbsp;Monday&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="weekday[2][sort]" value="<?php echo $sort_mon; ?>" id="txtThree"/></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="weekday[3][day]" <?php if($tues){echo 'checked';}?> value="tuesday" id="txtTuesDay"/>
                &nbsp;&nbsp;&nbsp;Tuesday&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="weekday[3][sort]" value="<?php echo $sort_tues; ?>" id="txtFour"/></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="weekday[4][day]" <?php if($wed){echo 'checked';}?> value="wednesday" id="txtWednesDay"/>
                &nbsp;&nbsp;&nbsp;Wednesday&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="weekday[4][sort]" value="<?php echo $sort_wed; ?>" id="txtFive"/></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="weekday[5][day]" <?php if($thus){echo 'checked';}?> value="thursday" id="txtThursDay"/>
                &nbsp;&nbsp;&nbsp;Thursday&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="weekday[5][sort]" value="<?php echo $sort_thus; ?>" id="txtSix"/></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="weekday[6][day]" <?php if($fri){echo 'checked';}?> value="friday" id="txtFriDay"/>
                &nbsp;&nbsp;&nbsp;Friday&nbsp;&nbsp;&nbsp;</td>
              <td><input type="text" name="weekday[6][sort]" value="<?php echo $sort_fri; ?>" id="txtSeven"/></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;</td>
              <td>&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><input class="btn btn-success" type="submit" name="save" value="<?php echo $button_text; ?>"/></td>
            </tr>
          </table>
        </form>
        <br/>
      </div>
    </div>
    <br/>
  </div>
  <!-- end insert dept. name -->
</div>
<div style="clear:both"></div>
<br/>
</div>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
