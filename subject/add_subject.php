<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php 
$success = "none";
$sb_name =  "";
$sb_author =  "";
$sb_code =  "";
$sb_class_id =  "";
$sb_teacher_id =  "";
$title = 'Añadir Nuevo Materia';
$button_text="Guardar";
$form_url = WEB_URL . "subject/add_subject.php";
$id="";
$hdnid="0";







if(isset($_POST['txtSbName'])){
	
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	
	$nombre = $_FILES['archivo']['name'];
	
	$ruta = $_FILES['archivo']['tmp_name'];
    $destino = "../archivos/" . $nombre;                           //  $destino = "../archivos/" . $nombre;
	
	if ($nombre != "") {
        if (copy($ruta, $destino)) {
	//$sb_name = $_POST['txtSbName'];
 //$sb_author =  $_POST['txtSbAuthor'];

//$sb_class_id = $_POST['dllClassId'];
//$sb_teacher_id =  $_POST['dllTeacherId'];
	
	                                                                                                                                             
 
	
	//$sql =mysqli_query($link,"INSERT INTO `tbl_add_subject`(`sb_name`,`sb_author`, `sb_code`, `sb_class_id`, `sb_teacher_id`) VALUES ('$sb_name','$sb_autor','$nombre','$sb_class_id','$sb_teacher_id')");
	
	$sql =mysqli_query($link,"INSERT INTO `tbl_add_subject`(`sb_name`,`sb_author`, `sb_code`, `sb_class_id`, `sb_teacher_id`) VALUES ('$_POST[txtSbName]','$_POST[txtSbAuthor]','$nombre','$_POST[dllClassId]','$_POST[dllTeacherId]')");
	
		 //basura de vida
	
	mysqli_query($link,$sql);//mysqli_query($sql,$link);
	mysqli_close($link);
	 
	
	$redirect_url = WEB_URL . 'subject/subject_list.php?m=i';
	header('Location: ' . $redirect_url);
	die();
		}//basura de vida
		}//basura de vida

	}
else{
	
	$sql =mysqli_query($link,"UPDATE `tbl_add_subject` SET `sb_name`='".$_POST['txtSbName']."',`sb_author`='".$_POST['txtSbAuthor']."',`sb_code`='".$_POST['txtSbCode']."',`sb_class_id`='".$_POST['dllClassId']."',`sb_teacher_id`='".$_POST['dllTeacherId']."' WHERE sb_id='".$_GET['id']."'");
	mysqli_query($sql,$link);
	mysqli_close($link);
	$redirect_url = WEB_URL . 'subject/subject_list.php?m=u&cid='.$_POST['hdnCId'];
	header('Location: ' . $redirect_url);
	die();
}

$success = "block";
}


if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_subject where sb_id = '" . $_GET['id'] . "'");
	        
	while($row = mysqli_fetch_array($result)){
		
		
		
		

		
		
				
				
		$sb_name = $row['sb_name'];
		$sb_author = $row['sb_author'];
		$sb_code = $row['sb_code'];
		$sb_class_id = $row['sb_class_id'];
		$sb_teacher_id = $row['sb_teacher_id'];
		$hdnid = $_GET['id'];
		$title = 'Actualizar Materia';
		$button_text="Actualizar";
		$form_url = WEB_URL . "subject/add_subject.php?id=".$_GET['id'];
		
		
		
	



	
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
        <div><img height="200" width="200" src="<?php echo WEB_URL; ?>img/subject.png"/></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>dashboard.php">Ventana Principal</a></div>
        <div class="my_button"><a class="btn btn_back btn-success" href="<?php echo WEB_URL; ?>subject/subject_list.php">Volver a Lista de Materias</a></div>
      </div>
      <div class="frmstyle">
        <form enctype="multipart/form-data" onSubmit="return validationForm();" method="post" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtSbName"> NombreMateria * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $sb_name;?>" name="txtSbName" id="txtSbName" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            <div class="form-group">
            <label class="col-sm-2 control-label" for="txtSbAuthor"> AutorDocumeto * </label>
            <div class="col-sm-6">
              <input type="text" value="<?php echo $sb_author;?>" name="txtSbAuthor" id="txtSbAuthor" class="form-control">
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="txtSbCode"> Documento * </label>
            <div class="col-sm-6">
			
			
			
			
			
			
			   
                        <td colspan="2"><input type="file" name="archivo"></td>
                    <tr>
                        <td>
                            <div class="form-group"> 
                                <button type="submit" class="btn btn-primary btn-block" name="subir" value="subir">Buscar</button>
                            </div>
                        </td>
                    </tr>
					
					
					
			   
			   
			   
			   
			   
			   
			   
			   
			   
              <!--<input type="text" value="<?php echo $sb_code;?>" name="txtSbCode" id="txtSbCode" class="form-control">  -->
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
            <div class="form-group">
            <label class="col-sm-2 control-label" for="dllClassId"> NombredeCurso * </label>
            <div class="col-sm-6">
              <select class="form-control" id="dllClassId" name="dllClassId">
               <option value="">--Select--</option>
                <?php 
				  	$result_class = mysqli_query($link,"SELECT * FROM tbl_add_class order by c_id ASC");
					
					while($row_class = mysqli_fetch_array($result_class)){
				  ?>
                <option <?php if($sb_class_id == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>
             <div class="form-group">
            <label class="col-sm-2 control-label" for="dllTeacherId"> Docente de Curso * </label>
            <div class="col-sm-6">
              <select class="form-control" id="dllTeacherId" name="dllTeacherId">
               <option value="">--Select--</option>
                <?php 
				  	$result_designation = mysqli_query($link,"SELECT * FROM tbl_add_teacher order by t_name ASC");
					while($row_designation = mysqli_fetch_array($result_designation)){
				  ?>
                <option <?php if($sb_teacher_id == $row_designation['teacher_id']){echo 'selected';}?> value="<?php echo $row_designation['teacher_id'];?>"><?php echo $row_designation['t_name'];?></option>
                <?php } //mysql_close($link);?>
              </select>
            </div>
            <span class="col-sm-4 control-label"> </span> </div>       
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <input type="submit" value="<?php echo $button_text;?>" class="btn btn-success">
            </div>
          </div>
          <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
		  <input type="hidden" value="<?php echo $sb_class_id; ?>" name="hdnCId"/>
        </form>
      </div>
    </div>
    <div class="bottom_area"></div>
  </div>
  
  <script type="text/javascript">
function validationForm(){
	if($("#txtSbName").val() == ''){
		alert("Subject Name is Required !!!");
		$("#txtSbName").focus();
		return false;
	}
	else if($("#txtSbAuthor").val() == ''){
		alert("Subject Author is Required !!!");
		$("#txtSbAuthor").focus();
		return false;
	}
	else if($("#txtSbCode").val() == ''){
		alert("Subject Code is Required !!!");
		$("#txtSbCode").focus();
		return false;
	}
	else if($("#dllClassId").val() == ''){
		alert("Class Name is Required !!!");
		$("#dllClassId").focus();
		return false;
	}
	else if($("#dllTeacherId").val() == ''){
		alert("Teacher Name is Required !!!");
		$("#dllTeacherId").focus();
		return false;
	}
	else{
		return true;
	}
}
</script>

  <?php include('../copyright.php');?>
  <?php include('../footer.php');?>
