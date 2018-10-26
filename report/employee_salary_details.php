<?php include('../header.php');
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] != 'admin'){
	header("Location: logout.php");
	die();
}
?>

<link type="text/css" href="<?php echo WEB_URL; ?>css/bootstrap.css" rel="stylesheet" />
<div class="content content_inside">
  <div class="header_text">
    <div class="header_text_left">Employee Salary List</div>
    <div class="top_common_bar">
		<div class="obj_left">
        <select id="ddlClass" onChange="getRollClass(this.value,'employee_salary_details');" class="form-control" name="ddlClass">
          <option value="-1">--Select Employee--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_user order by u_id asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['cval']) && $_GET['cval'] == $row_class['u_id']){echo 'selected';}?> value="<?php echo $row_class['u_id'];?>"><?php echo $row_class['u_name'];?><?php echo '('.$row_class['u_designation'].')';?></option>
          <?php } ?>
        </select>
      </div>
      <div class="obj_left">
        <select onChange="getRollData(this.value,'employee_salary_details');" class="form-control" name="ddlRoll" id="ddlRoll">
          <option value="-1">--Select Month--</option>
          <?php
            	$result_class = mysql_query("Select * from tbl_add_month order by mid asc",$link);
				while($row_class = mysql_fetch_array($result_class)){?>
          <option <?php if(isset($_GET['tval']) && $_GET['tval'] == $row_class['mid']){echo 'selected';}?> value="<?php echo $row_class['mid'];?>"><?php echo $row_class['m_name'];?></option>
          <?php }?>
        </select>
      </div>
      <div class="obj_right" style="padding-right:10px !important;"><a class="btn btn_add_new btn-success" href="<?php echo WEB_URL; ?>report/report.php"><i class="fa"></i>Back To Report</a></div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div class="list" style="width:100%; height:480px; overflow:auto;">
    <table class="table sakotable table-bordered table-striped dt-responsive">
      <thead>
        <tr>
		  <th>ID#</th>
          <th>Name</th>
		  <th>Designation</th>
          <th>Month Name</th>
		  <th>Pay Date</th>
          <th>Salary Amount</th>
        </tr>
      </thead>
      <tbody>
	  	<?php
			$result = '';
		  		if(isset($_GET['cval']) && $_GET['cval'] != '' && isset($_GET['tval']) && $_GET['tval'] != ''){
					$result = mysql_query("Select *,u.u_name,m.m_name from tbl_add_employee_salary es inner join tbl_add_user u on es.e_name = u.u_id inner join tbl_add_month m on es.e_month = m.mid WHERE es.e_name = '" . $_GET['cval'] . "' and es.e_month = '" . $_GET['tval'] . "' order by es.e_id desc",$link);
				}
				else if(isset($_GET['cval']) && $_GET['cval'] != ''){
					$result = mysql_query("Select *,u.u_name,m.m_name from tbl_add_employee_salary es inner join tbl_add_user u on es.e_name = u.u_id inner join tbl_add_month m on es.e_month = m.mid WHERE es.e_name = '" . $_GET['cval'] . "' order by es.e_id desc",$link);
				}
				else if(isset($_GET['tval']) && $_GET['tval'] != ''){
					$result = mysql_query("Select *,u.u_name,m.m_name from tbl_add_employee_salary es inner join tbl_add_user u on es.e_name = u.u_id inner join tbl_add_month m on es.e_month = m.mid WHERE es.e_month = '" . $_GET['tval'] . "' order by es.e_id desc",$link);
				}
				else{
					$result = mysql_query("Select * from tbl_add_employee_salary where e_name = '-1' order by e_id desc",$link);
				}
				while($row = mysql_fetch_array($result)){?>
				
        <tr>
		<td><?php echo $row['u_id']; ?></td>
          <td><?php echo $row['u_name']; ?></td>
		  <td><?php echo $row['u_designation']; ?></td>
		  <td><?php echo $row['m_name']; ?></td>
          <td><?php echo $row['e_pay_date']; ?></td>
          <td><?php echo CURRENCY.' '.$row['e_amount']; ?></td>
        </tr>
        <?php } mysql_close($link); ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  function deleteSalary(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Employee Salary ?");
	if(iAnswer){
		window.location = 'e_salarylist.php?id=' + Id;
	}
  }
  </script>
<?php include('../copyright.php');?>
</div>
<?php include('../footer.php');?>
