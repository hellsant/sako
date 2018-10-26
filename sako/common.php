<?php 
function getStudentGrade($mark,$link){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_grade order by g_id");
	while($row = mysqli_fetch_array($result)){
		if((int)$row['g_from'] <= (int)$mark && (int)$row['g_upto'] >= (int)$mark){
			return $row['g_name'] . '|' . $row['g_point'];
			break;
		}
	}
	return '';
}

?>