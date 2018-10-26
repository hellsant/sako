</div>
</div>
<?php 
if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 'admin'){
	include('left_panel.php');
}
else if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 'student'){
	include('left_panel_s.php');
}
else if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 'teacher'){
	include('left_panel_t.php');
}
else if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 'accountant'){
	include('left_panel_a.php');
}
else if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 'librarian'){
	include('left_panel_l.php');
}
else if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == 'parents'){
	include('left_panel_p.php');
}
?>


<!-- modal end -->
<script src="<?php echo WEB_URL; ?>plugins/datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo WEB_URL; ?>plugins/datatable/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo WEB_URL; ?>plugins/datatable/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?php echo WEB_URL; ?>plugins/datatable/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
	$('.sakotable').dataTable({
	  "bPaginate": true,
	  "bLengthChange": true,
	  "bFilter": false,
	  "bSort": true,
	  "bInfo": true,
	  "bAutoWidth": false,
	  "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "<?php echo WEB_URL; ?>plugins/datatable/swf/copy_csv_xls_pdf.swf",
			"aButtons": [
                "print",
				"csv",
				"xls",
				"pdf"
            ]
        }
	});
});

$(function () {
	$('.sakotable_with_print').dataTable({
	  "bPaginate": false,
	  "bLengthChange": true,
	  "bFilter": false,
	  "bSort": true,
	  "bInfo": false,
	  "bAutoWidth": false,
	  "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "<?php echo WEB_URL; ?>plugins/datatable/swf/copy_csv_xls_pdf.swf",
			"aButtons": [
                "print",
				"csv",
				"xls",
				"pdf"
            ]
        }
	});
});

$(function () {
	$('.common_sakotable').dataTable({
	  "bPaginate": false,
	  "bLengthChange": true,
	  "bFilter": false,
	  "bSort": true,
	  "bInfo": false,
	  "bAutoWidth": false
	});
});

$(function () {
	$('.common_sakotable_routine').dataTable({
	  "bPaginate": false,
	  "bLengthChange": true,
	  "bFilter": false,
	  "bSort": false,
	  "bInfo": false,
	  "bAutoWidth": false
	});
});

$(function () {
	$('.common_sakotable_att').dataTable({
	  "bPaginate": false,
	  "bLengthChange": false,
	  "bFilter": false,
	  "bSort": false,
	  "bInfo": false,
	  "bAutoWidth": false
	});
});
</script>

</body>
</html>