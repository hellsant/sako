<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$g_name =  "";
$g_point =  "";
$g_from =  "";
$g_upto =  "";
$g_note =  "";
$title = 'Añadir Nuevo Grado';
$button_text="Guardar";
$id="";
$hdnid="0";

if(isset($_POST['txtGDName'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	
	$sql = mysqli_query($link,"INSERT INTO `tbl_add_grade`(`g_name`,`g_point`, `g_from`, `g_upto`, `g_note`) VALUES ('$_POST[txtGDName]','$_POST[txtGdPoint]','$_POST[txtGdFrom]','$_POST[txtGdUpto]','$_POST[txtGdNote]')");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'grade/grade_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
	
}
else{
	
	$sql =mysqli_query($link,"UPDATE `tbl_add_grade` SET `g_name`='".$_POST['txtGDName']."',`g_point`='".$_POST['txtGdPoint']."',`g_from`='".$_POST['txtGdFrom']."',`g_upto`='".$_POST['txtGdUpto']."',`g_note`='".$_POST['txtGdNote']."' WHERE g_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'grade/grade_list.php?m=u';
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_grade where g_id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){

		$g_name = $row['g_name'];
		$g_point = $row['g_point'];
		$g_from = $row['g_from'];
		$g_upto = $row['g_upto'];
		$g_note = $row['g_note'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Grado';
		$button_text="Actualizar";
	}
	
	//mysql_close($link);

}
	
?>

  <link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
  <div class="content">
    <div class="header_text_inside">
      <div class="header_text_left"><?php echo $title; ?></div>
    </div>
    <div class="main_content">
      <div class="main_content_left">
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/grade.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>dashboard.php">Ventana Principal</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>grade/grade_list.php">Volver a Lista de Grados</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtGDName"> Nombre Grado </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $g_name;?>" name="txtGDName" id="txtGDName" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            <div class="form-group">
            <label class="col-sm-2 control-label" for="txtGdPoint"> Puntaje Ponderado </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $g_point;?>" name="txtGdPoint" id="txtGdPoint" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtGdFrom"> Marcar Desde </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $g_from;?>" name="txtGdFrom" id="txtGdFrom" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtGdUpto"> Marcar Hasta </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $g_upto;?>" name="txtGdUpto" id="txtGdUpto" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
              <div class="form-group">
            <label class="col-sm-2 control-label" for="txtGdNote"> Nota </label>
            <div class="col-sm-6">
              <textarea name="txtGdNote" id="txtGdNote" style="resize:none;" class="form-control"><?php echo $g_note;?></textarea>
            </div>
            <span class="col-sm-4 control-label"></span></div>      
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
            </div>
          </div>
          <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
        </form>
      </div>
    </div>
    <div class="bottom_area"></div>
  </div>
  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
