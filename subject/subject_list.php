<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<?php
$token = 'none';
$msg = '';

if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx= mysqli_query($link,"DELETE FROM `tbl_add_subject` WHERE sb_id = ".$_GET['id']);
	mysqli_query($link,$sqlx);  //al revez
	$msg = 'Delete Subject Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Subject Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Subject Information Successfully';
	$token = 'block';
}

?>    


<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Lista de Materias</div>
 <div class="top_common_bar">
      	<div class="obj_left">
        	<select onChange="getClassData(this.value,'subject_list');" class="form-control" name="ddlClass">
            <option value="-1">--Seleccionar Curso--</option>
			<?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_class order by c_id asc");
				
				
				
				
				
				
				
				
				while($row_class = mysqli_fetch_array($result_class)){?>
                	<option <?php if(isset($_GET['cid']) && $_GET['cid'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
                <?php } ?>
            </select>	
        </div>
        <div class="obj_right">
        	<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>subject/add_subject.php"><i class="fa fa-plus"></i>&nbsp;Añadir Materia</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>dashboard.php"><i class="fa"></i>Ventana Principal</a></div>
        </div>
      </div>
    <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div>
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Nombre Materia</th>
          <th>Autor Documento</th>
          <th>Documento</th> <!--<th>Subject Code</th> -->
          <th>Nombre de Curso</th>
		  <th>Docente de Curso</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <?php
		  $result = '';
		  if(isset($_GET['cid']) && $_GET['cid'] != ''){
		  $result = mysqli_query($link,"Select *, c.c_name, t.t_name from tbl_add_subject s INNER JOIN tbl_add_class c on c_id=sb_class_id inner join tbl_add_teacher t on 	teacher_id=sb_teacher_id where sb_class_id = '" . $_GET['cid'] . "' order by sb_id desc");
		  }
		  else if(isset($_GET['m']) && $_GET['m'] == 'i'){
					$result = mysqli_query($link,"Select *, c.c_name, t.t_name from tbl_add_subject s INNER JOIN tbl_add_class c on c_id=sb_class_id inner join tbl_add_teacher t on 	teacher_id=sb_teacher_id WHERE s.sb_id=(SELECT max(sb_id) FROM tbl_add_subject)");
				}
		  else{
			  $result = mysqli_query($link,"Select * from tbl_add_subject where sb_class_id = '-1' order by sb_id desc");
			  
			  
			  
			  
			  
			  
			 //Aqui era
			  
			 
			
			  
		  }
		  while($row = mysqli_fetch_array($result)){
			  
			  
			  ?>
			       
           <tr>
          <td><?php echo $row['sb_name']; ?></td>
          <td><?php echo $row['sb_author']; ?></td>
		  
		  <!--Casi cerca-->
          
		  <td><a href="archivo.php?id=<?php echo $row['sb_id']?>"><?php echo $row['sb_code']; ?></a> </td>  
		  
		  
		 
      <td><?php echo $row['c_name']; ?></td>
		  <td><?php echo $row['t_name']; ?></td>
          <td><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>subject/add_subject.php?id=<?php echo $row['sb_id']; ?>&cid=<?php echo $row['c_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteSubject(<?php echo $row['sb_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div> 
</div>
<script type="text/javascript">
  function deleteSubject(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Subject ?");
	if(iAnswer){
		window.location = 'subject_list.php?id=' + Id;
	}
  }
  </script>

<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
