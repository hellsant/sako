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
	$sqlx= mysqli_query($link,"DELETE FROM `tbl_add_student_charge` WHERE charge_id = ".$_GET['id']);
	mysqli_query($link,$sqlx); 
	$msg = 'Delete Student Charge Successfully';
	$token = 'block';
}
?>
<?php
if(isset($_GET['m']) && $_GET['m'] == 'i'){
	$msg = 'Added Student Charge Successfully';
	$token = 'block';
}

if(isset($_GET['m']) && $_GET['m'] == 'u'){
	$msg = 'Update Student Charge Information Successfully';
	$token = 'block';
}

?>
<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Lista de Pagos de Estudiantes</div>
    <div class="top_common_bar">
      <div class="obj_left">
        <select id="ddlClass" onChange="getRollClass(this.value,'chargelist');" class="form-control" name="ddlClass">
          <option value="-1">--Seleccionar Curso--</option>
          <?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_class order by c_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cval']) && $_GET['cval'] == $row_class['c_id']){echo 'selected';}?> value="<?php echo $row_class['c_id'];?>"><?php echo $row_class['c_name'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_left">
        <select onChange="getRollData(this.value,'chargelist');" class="form-control" name="ddlRoll" id="ddlRoll">
          <option value="-1">--Seleccionar No Lista--</option>
          <?php
            	$result_class = mysqli_query($link,"Select * from tbl_add_student_charge where sc_class = '" . $_GET['cval'] . "' order by charge_id asc");
				while($row_class = mysqli_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['sc_roll']){echo 'selected';}?> value="<?php echo $row_class['sc_roll'];?>"><?php echo $row_class['sc_roll'];?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/student_charge.php"><i class="fa fa-plus"></i>&nbsp;Añadir Pago</a>&nbsp;<a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>account/account.php"><i class="fa"></i>Ventana de Pagos</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div id="msg_boxx" style="display:<?php echo $token; ?>; color:#C00" role="alert" class="alert alert-success"><strong>Success!</strong> <?php echo $msg; ?></div>
  <div class="list" style="width:100%;">
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
          <th>Nombre Curso</th>
          <th>Nombre Estudiante</th>
          <th>No Lista</th>
          <th>Mes</th>
          <th>Tipo de Pago</th>
          <th>Fecha</th>
          <th>Cantidad Bs.</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <?php
			$result = '';
		  		if(isset($_GET['cval']) && $_GET['cval'] != '' && isset($_GET['tval']) && $_GET['tval'] != ''){
					$result = mysqli_query($link,"Select *,s.s_name,c.c_name,t.fee_type from tbl_add_student_charge sc inner join tbl_add_student s on sc.sc_student = s.s_id inner join tbl_add_class c on c.c_id = sc.sc_class inner join tbl_add_fee_type t on sc.sc_type_id = t.ft_id WHERE sc.sc_class = '" . $_GET['cval'] . "' and sc.sc_roll = '" . $_GET['tval'] . "' order by sc.charge_id desc");
				}
				else if(isset($_GET['cval']) && $_GET['cval'] != ''){
					$result = mysqli_query($link,"Select *,s.s_name,c.c_name,t.fee_type from tbl_add_student_charge sc inner join tbl_add_student s on sc.sc_student = s.s_id inner join tbl_add_class c on c.c_id = sc.sc_class inner join tbl_add_fee_type t on sc.sc_type_id = t.ft_id WHERE sc.sc_class = '" . $_GET['cval'] . "' order by sc.charge_id desc");
				}
				else if(isset($_GET['tval']) && $_GET['tval'] != ''){
					$result = mysqli_query($link,"Select *,s.s_name,c.c_name,t.fee_type from tbl_add_student_charge sc inner join tbl_add_student s on sc.sc_student = s.s_id inner join tbl_add_class c on c.c_id = sc.sc_class inner join tbl_add_fee_type t on sc.sc_type_id = t.ft_id WHERE sc.sc_roll = '" . $_GET['tval'] . "' order by sc.charge_id desc");
				}
				else if(isset($_GET['m']) && $_GET['m'] == 'i'){
					$result = mysqli_query($link,"Select *,s.s_name,c.c_name,t.fee_type from tbl_add_student_charge sc inner join tbl_add_student s on sc.sc_student = s.s_id inner join tbl_add_class c on c.c_id = sc.sc_class inner join tbl_add_fee_type t on sc.sc_type_id = t.ft_id WHERE sc.charge_id=(SELECT max(charge_id) FROM tbl_add_student_charge)");
				}
				else{
					$result = mysqli_query($link,"Select * from tbl_add_student_charge where sc_class = '-1' order by charge_id desc");
				}
				while($row = mysqli_fetch_array($result)){?>
        <tr>
          <td><?php echo $row['c_name']; ?></td>
          <td><?php echo $row['s_name']; ?></td>
          <td><?php echo $row['sc_roll']; ?></td>
          <td><?php echo $row['sc_month']; ?></td>
          <td><?php echo $row['fee_type']; ?></td>
          <td><?php echo $row['sc_date']; ?></td>
          <td><?php echo ' '.$row['sc_amount'];//CURRENCY.' '.$row['sc_amount']; ?></td>
          <td><a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-xs mrg" href="<?php echo WEB_URL;?>account/student_charge.php?id=<?php echo $row['charge_id']; ?>&cval=<?php echo $row['c_id']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-xs mrg" onClick="deleteCharge(<?php echo $row['charge_id']; ?>);" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></td>
        </tr>
        <?php } mysqli_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteCharge(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Student Charge ?");
	if(iAnswer){
		window.location = 'chargelist.php?id=' + Id;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
