<?php
/* Copyright (C) :ANA GRACE ESPIRITU|KRISTEIN HEINRICH DUMAPAY: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by ANA GRACE ESPIRITU && KRISTEIN HEINRICH DUMAPAY, OCTOBER 2016
 */
include_once('./../connect.php');

/////////////////////////////////////////////
//GLOBAL DEFAULTS
date_default_timezone_set("Asia/Manila");
$_TODAY = date('Y-m-d');
$_MONTH = date('Y-m');
$_YEAR = date('Y');


/////////////////////////////////////////////
//EMPLOYEE SELECT OPTION
	function optEMP(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON,"SELECT EMP_ID, EMP_FNAME, EMP_LNAME
		FROM employee_table WHERE USER_TYPE='2'
		ORDER BY EMP_LNAME ASC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['EMP_ID']);
				$fname = mysqli_real_escape_string($_CON, $row['EMP_FNAME']);
				$lname = mysqli_real_escape_string($_CON, $row['EMP_LNAME']);
				echo"	<option value='$_ID'>$lname, $fname</option>";
			}
		}else{
			echo"		<option value=''>No data to show</option>";
		}
	}

	function monthControl(){
		$month = (int) (isset($_GET['month']) ? $_GET['month'] : date('m'));
		$year =  (int) (isset($_GET['year']) ? $_GET['year'] : date('Y'));

		echo "<h3 class='text-center'>".date("F",mktime(0,0,0,$month,1,$year))." ".$year."</h3>";
		$next = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'">Next</a>';
		/* "previous month" control */
		$previous = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.($month != 1 ? $year : $year - 1).'">Previous </a>';
		$controls = $previous."|".$next;
		echo $controls;
	}
/////////////////////////////////////////////
//View POINTS
	function theview(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM pointing_table ORDER BY DATE_ADDED DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['POINT_ID']);
				$EMP_ID = mysqli_real_escape_string($_CON, $row['EMP_ID']);
				$JOB_ID = mysqli_real_escape_string($_CON, $row['JOB_ID']);
				$JOB_POINTS = mysqli_real_escape_string($_CON, $row['JOB_POINTS']);
				$DATE_ADDED = New DateTime($row['DATE_ADDED']);
				$date_format = date_format($DATE_ADDED, "M d, Y h:i:A");
				//GET EMPLOYEE INFO
				$_sqlSearch = mysqli_query($_CON, "SELECT EMP_FNAME, EMP_LNAME FROM employee_table WHERE EMP_ID='$EMP_ID' ");
				$_row = mysqli_fetch_array($_sqlSearch);
				$fname = $_row['EMP_FNAME'];
				$lname = $_row['EMP_LNAME'];
				//GET TASK INFO
				$s_qlSearch = mysqli_query($_CON, "SELECT JOB_NAME, JOB_POINTS FROM job_table WHERE JOB_ID='$JOB_ID' ");
				$r_ow = mysqli_fetch_array($s_qlSearch);
				$NAME = $r_ow['JOB_NAME'];
				$POINTS = $r_ow['JOB_POINTS'];
				echo"
				 <tr>
				  <td>$lname, $fname</td>
				  <td>$NAME ($POINTS)</td>
				  <td>$date_format</td>
				  <td align='center'>
				   <button class='btn btn-info btn-xs' data-toggle='modal' data-target='#updMod$_ID'><i class='glyph-icon icon-edit'></i></button>
				   <button class='btn btn-danger btn-xs' data-toggle='modal' data-target='#delMod$_ID'><i class='glyph-icon icon-trash-o'></i></button>
				  </td>
				 </tr>
				";
			}
		}else{
			echo"
			 <tr>
			  <td colspan='5'>No data yet. </td>
			 </tr>
			";
		}
	}
