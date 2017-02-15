<?php
/* Copyright (C) :ANA GRACE ESPIRITU|KRISTEIN HEINRICH DUMAPAY: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by ANA GRACE ESPIRITU && KRISTEIN HEINRICH DUMAPAY, OCTOBER 2016
 */
include_once'../connect.php';
date_default_timezone_set("Asia/Manila");
$_MONTH = date('Y-m');

	function getHighest(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON,
		"SELECT EMP_ID,
		SUM(JOB_POINTS) AS user_points 
		FROM pointing_table 
		GROUP BY EMP_ID
		ORDER BY user_points DESC");
		$row = mysqli_fetch_array($sqlSearch);
			$emp_id = $row['EMP_ID'];
			$points = $row['user_points'];
			//echo "$emp_id: $points<br />";
			return $emp_id;
	}

////////////////////////////////////////////////////
//GET TOTAL POINTS 
	function totbyMonth(){
		global $_CON;
		global $_MONTH;
		$emp_id = getHighest();
		///////////////////////////////////////
		/*SELECT THE HIGHEST POINTS
		$sqlSearch = mysqli_query($_CON,
		"SELECT EMP_ID, 
		SUM(JOB_POINTS) AS user_points
		FROM pointing_table
		WHERE
		YEAR(DATE_ADDED) AND 
		MONTH(DATE_ADDED)
		GROUP BY
		EMP_ID
		ORDER BY
		YEAR(DATE_ADDED),
		MONTH(DATE_ADDED)
		ASC");*/
		
		//$count = mysqli_num_rows($sqlSearch);
		//if($count > 0){
			//$row = mysqli_fetch_array($sqlSearch);
			//$emp_id = $row['EMP_ID'];
			//$tepoints = $row['user_points'];
			//$points = $row['user_points'];
		//echo "$emp_id| $tepoints<br />";
				$sql_Search = mysqli_query($_CON,
				"SELECT
				SUM(JOB_POINTS) AS user_point
				FROM pointing_table 
				WHERE EMP_ID='$emp_id'
				GROUP BY
				YEAR(DATE_ADDED), 
				MONTH(DATE_ADDED)
				ORDER BY 
				YEAR(DATE_ADDED), 
				MONTH(DATE_ADDED) ASC");
				$counter = 0;
					while($finalROW=mysqli_fetch_array($sql_Search)){
					if($counter++ > 0){echo ",";}
					$points = $finalROW['user_point'];
					echo $points;
				}
		//}
	}
	
	//totbyMonth();
////////////////////////////////////////////////////
//GET MY TOTAL POINTS 
	function myTotMonth(){
		global $_CON;
		global $_MONTH;
		///////////////////////////////////////
		//SELECT EMP_RETURN_ID
		$emp_id = returnID();
			$sql_Search = mysqli_query($_CON,
			"SELECT
			SUM(JOB_POINTS) AS user_point
			FROM pointing_table 
			WHERE EMP_ID='$emp_id'
			GROUP BY
			YEAR(DATE_ADDED), 
			MONTH(DATE_ADDED)
			ORDER BY 
			YEAR(DATE_ADDED), 
			MONTH(DATE_ADDED) ASC");
			$counter = 0;
			while($finalROW=mysqli_fetch_array($sql_Search)){
				if($counter++ > 1 ){echo ",";}
				$points = $finalROW['user_point'];
				echo $points;
			}
	}
	function returnID(){
		global $_CON;
		$EIN = $_SESSION['emp_usr'];
		$sqlSearch = mysqli_query($_CON, "SELECT EMP_ID FROM employee_table WHERE EMP_EIN='$EIN' ");
		$row = mysqli_fetch_array($sqlSearch);
		$_ID = $row['EMP_ID'];
		return $_ID;
	}
	
	function myActivities(){
		global $_CON;
		$my_id = 3;
		$sqlSearch = mysqli_query($_CON,
		"SELECT * FROM pointing_table
		WHERE EMP_ID='$my_id'");
		$counter = mysqli_num_rows($sqlSearch);
		if($counter > 0){
			$count = 0;
			while($row=mysqli_fetch_array($sqlSearch)){
				$job_id = $row['JOB_ID'];
				$points = $row['JOB_POINTS'];
				$date_added = $row['DATE_ADDED'];
				//GET JOB INFO
				$_sqlSearch = mysqli_query($_CON,"SELECT JOB_NAME, JOB_DESC FROM job_table
				WHERE JOB_ID='$job_id' ");
				$_row = mysqli_fetch_array($_sqlSearch);
				$job_name = $_row['JOB_NAME'];
				$job_desc = $_row['JOB_DESC'];
				if($count++ % 2 == 0){
					echo "
					<div class='tl-row'>
						<div class='tl-item'>
							<div class='tl-icon bg-green'>
								<i class='glyph-icon icon-cog'></i>
							</div>
							<div class='tl-panel'>
														3:21 PM
													</div>
							<div class='popover left'>
								<div class='arrow'></div>
								<div class='popover-content'>
									<div class='tl-label bs-label label-success'>Meeting</div>
									<p class='tl-content'>Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.</p>
									<div class='tl-time'>
										<i class='glyph-icon icon-clock-o'></i>
										a few seconds ago
									</div>
								</div>
							</div>
						</div>
					</div>";
				}else{
					echo"
					<div class='tl-row'>
						<div class='tl-item float-right'>
							<div class='tl-icon bg-black'>
								<i class='glyph-icon icon-cog'></i>
							</div>
							<div class='tl-panel'>
														3:21 PM
													</div>
							<div class='popover right'>
								<div class='arrow'></div>
								<div class='popover-content'>
									<div class='tl-label bs-label label-info'>Appointment</div>
									<p class='tl-content'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
									<div class='tl-time'>
										<i class='glyph-icon icon-clock-o'></i>
																a few seconds ago
															
													
									</div>
								</div>
							</div>
						</div>
					</div>";
				}
			}
		}
	}
	myActivities();