<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'accountant'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$tpm_destination =  "";
$title = 'Add New Member';
$button_text="Add Member";
$id="";
$hdnid="0";
$sid = 0;
$cid = 0;

if(isset($_GET['sid']) && $_GET['sid'] != ''){
	$sid = $_GET['sid'];
}
if(isset($_GET['cid']) && $_GET['cid'] != ''){
	$cid = $_GET['cid'];
}



if(isset($_POST['ddlTrMbDestination'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	  $sql = "INSERT INTO `tbl_add_tp_member`(`sid`,`cid`,`tpm_destination`) VALUES ('$_POST[hdnsid]','$_POST[hdncid]','$_POST[ddlTrMbDestination]')";
	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'transport/a_t_member_list.php?m=i&cid='.$_GET['cid'];
	  header('Location: ' . $redirect_url);
	  die();
	
}
else{
	
	$sql = "UPDATE `tbl_add_tp_member` SET `tpm_destination`='".$_POST['ddlTrMbDestination']."' WHERE tpm_id='".$_GET['id']."'";
	  mysql_query($sql,$link);
	  mysql_close($link);
	  $redirect_url = WEB_URL . 'transport/a_t_member_list.php?m=u&cid='.$_GET['cid'];
	  header('Location: ' . $redirect_url);
	  die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_tp_member where tpm_id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$tpm_destination = $row['tpm_destination'];
		$hdnid = $_GET['id'];
		$title = 'Update Member';
		$button_text="Update";
	}
	
	//mysql_close($link);

}
	
?>
  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content">
    <div class="header_text_inside">
      <!--<div id="me" style="width:100%;text-align:center;background:#666;color:#fff;margin-bottom:20px; display:none;">
        <?php //echo $successful_msg; ?>
      </div>-->
      <div class="header_text_left"><?php echo $title; ?></div>
    </div>
    <div class="main_content">
      <div class="main_content_left">
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/member.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>transport/a_transport.php">Transport</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>transport/a_t_member_list.php">Back To Member List</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="ddlTrMbDestination"> Destination </label>
            <div class="col-sm-6">
			  <select onChange="getTransportPay(this.value);" class="form-control" name="ddlTrMbDestination" id="ddlTrMbDestination">
            <option value="-1">--Select Destination--</option>
			<?php
            	$result_pay = mysql_query("Select * from tbl_add_transport order by transport_id asc",$link);
				while($row_pay = mysql_fetch_array($result_pay)){?>
                	<option <?php if($tpm_destination == $row_pay['transport_id']){echo 'selected';}?> value="<?php echo $row_pay['transport_id'];?>"><?php echo $row_pay['destination'];?></option>
                <?php } ?>
            </select>	
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtTrMbFee"> Transport Fee </label>
            <div class="col-sm-6">
              <input type="text" readonly value="" name="txtTrMbFee" id="txtTrMbFee" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
            </div>
          </div>
          <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
		  <input type="hidden" value="<?php echo $sid; ?>" name="hdnsid"/>
          <input type="hidden" value="<?php echo $cid; ?>" name="hdncid"/>
        </form>
      </div>
    </div>
    <div class="bottom_area"></div>
  </div>
  <script type="text/javascript">
$(document).ready(function() {
  if($("#ddlTrMbDestination").val() != ''){
  	getTransportPay($("#ddlTrMbDestination").val());
  }
});
</script>
<?php include('../copyright.php');?>
<?php include('../footer.php');?>
