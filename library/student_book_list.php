<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'student'){
	header("Location: logout.php");
	die();
}
?>

<?php
$token = 'none';
$msg = '';

if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx=mysqli_query($link,"DELETE FROM `tbl_library_book_list` WHERE b_id = ".$_GET['id']);
	mysqli_query($sqlx,$link); 
	$msg = 'Delete Book Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Book Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Book Information Successfully';
	$token = 'block';
}

?>


<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Lista de Tareas</div>
    <div class="top_common_bar">
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>library/student_books.php"><i class="fa fa-plus"></i>&nbsp;Añadir Tarea</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>library/student_library.php"><i class="fa"></i>Ventana de Tareas</a></div>
    </div>
    </div>
    <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div>
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Nombre Tarea</th>
          <th>Nombre Estudiante</th>
		  <th>Tarea</th>
		  <th>No Modulo</th>
		  <th>Curso</th>
		  <th>Estado</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
         <?php
        		//echo "Select * from tbl_library_book_list order by b_id desc";   linea 67 dentro el php => echo CURRENCY.' '.$row['price'];
				$result = mysqli_query($link,"Select * from tbl_library_book_list order by b_id desc");
				while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['subject_code']; ?></td>
          <td><?php echo $row['book_name']; ?></td>
          <td><?php echo $row['author_name']; ?></td>
		   <td><a href="tarea.php?id=<?php echo $row['b_id']?>"><?php echo $row['quantity']; ?></a> </td>  
			
        
		  <td><?php echo ' '.$row['price']; ?></td> 
		  <td><?php echo $row['rack_no']; ?></td>
		  <td><?php if($row['status'] == '1'){echo '<strong style="color:orange;">ENVIADA</strong>';} else{echo 'Un Available';}?></td>
          <td><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>library/student_books.php?id=<?php echo $row['b_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteBook(<?php echo $row['b_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteRoutine(Id){
  	function deleteBook(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Book ?");
	if(iAnswer){
		window.location = 'student_book_list.php?id=' + Id;
	}
  }
  </script>

<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
