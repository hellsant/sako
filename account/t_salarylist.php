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
	$sqlx= mysqli_query($link,"DELETE FROM `tbl_add_teacher_salary` WHERE t_id = ".$_GET['id']);
	mysqli_query($link,$sqlx); 
	$msg = 'Delete Teacher Salary Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Teacher Salary Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Teacher Salary Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Lista de Salarios de Docentes</div>
    <div class="top_common_bar">
		<div class="obj_left">
        <select id="ddlClass" onChange="getRollClass(this.value,'t_salarylist');" class="form-control" name="ddlClass">
          <option value="-1">--Seleccionar Docente--</option>
          <?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_teacher order by teacher_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cval']) && $_GET['cval'] == $row_class['teacher_id']){echo 'selected';}?> value="<?php echo $row_class['teacher_id'];?>"><?php echo $row_class['t_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_left">
        <select onChange="getRollData(this.value,'t_salarylist');" class="form-control" name="ddlRoll" id="ddlRoll">
          <option value="-1">--Seleccionar Mes--</option>
          <?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_month order by mid asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['mid']){echo 'selected';}?> value="<?php echo $row_class['mid'];?>"><?php echo $row_class['m_name'];?></option>
          <?php }?>
        </select>
      </div>
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/teacher_salary.php"><i class="fa fa-plus"></i>&nbsp;Añadir Salario Docente</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/account.php"><i class="fa"></i>Ventana de Pagos</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div class="list" style="width:100%;">
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Nombre Docente</th>
          <th>Nombre Mes</th>
		  <th>Fecha Pago</th>
          <th>Salario Bs.</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
	  	<?php
			$result = '';
		  		if(isset($_GET['cval']) && $_GET['cval'] != '-1' && isset($_GET['tval']) && $_GET['tval'] != '-1'){
					$result = mysqli_query($link,"Select *,t.t_name as tr_name from tbl_add_teacher_salary ts inner join tbl_add_teacher t on ts.t_name = t.teacher_id inner join tbl_add_month m on ts.t_month = m.mid WHERE ts.t_name = '" . $_GET['cval'] . "' and ts.t_month = '" . $_GET['tval'] . "' order by ts.t_id desc");
				}
				else if(isset($_GET['cval']) && $_GET['cval'] != '-1'){
					$result = mysqli_query($link,"Select *,t.t_name as tr_name from tbl_add_teacher_salary ts inner join tbl_add_teacher t on ts.t_name = t.teacher_id inner join tbl_add_month m on ts.t_month = m.mid WHERE ts.t_name = '" . $_GET['cval'] . "' order by ts.t_id desc");
				}
				else if(isset($_GET['tval']) && $_GET['tval'] != '-1'){
					$result = mysqli_query($link,"Select *,t.t_name as tr_name from tbl_add_teacher_salary ts inner join tbl_add_teacher t on ts.t_name = t.teacher_id inner join tbl_add_month m on ts.t_month = m.mid WHERE ts.t_month = '" . $_GET['tval'] . "' order by ts.t_id desc");
				}
				else{
					$result = mysqli_query($link,"Select * from tbl_add_teacher_salary where t_name = '-1' order by t_id desc");
				}
				while($row = mysqli_fetch_array($result)){?>
				
        <tr>
          <td><?php echo $row['tr_name']; ?></td>
		  <td><?php echo $row['m_name']; ?></td>
          <td><?php echo $row['t_pay_date']; ?></td>
          <td><?php echo ' '.$row['t_amount']; ?></td>
          <td><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>account/teacher_salary.php?id=<?php echo $row['t_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteSalary(<?php echo $row['t_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteSalary(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Teacher Salary ?");
	if(iAnswer){
		window.location = 't_salarylist.php?id=' + Id;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
