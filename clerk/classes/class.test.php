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

/////////////////////////////////////////////
//UPDATE METHOD
	function updAction(){
		global $_CON;
			$_ID = 9;
			$inputEMP = mysqli_real_escape_string($_CON, "4");
			$inputTASK = mysqli_real_escape_string($_CON, "2");
			//GET DATE INPUTTED
			$s_qlSearch = mysqli_query($_CON, "SELECT DATE_ADDED FROM pointing_table WHERE POINT_ID='$_ID' ");
			$ro_w = mysqli_fetch_array($s_qlSearch);
			$date_inputted = $ro_w['DATE_ADDED'];
			$date_inputted = date('Y-m-d', strtotime($date_inputted));
			//CHECK IF TASK EXIST ON THE SAME DAY!
			$sqlSearch = mysqli_query($_CON, "SELECT EMP_ID, JOB_ID FROM pointing_table WHERE EMP_ID='$inputEMP' AND JOB_ID='$inputTASK' AND DATE_ADDED LIKE '%$date_inputted%' ");
			$count = mysqli_num_rows($sqlSearch);
			if($count == 1){
				ob_end_clean();
				header("location: givepoints.php?upd=exist");
				echo "1";
			}else{
				//*GET POINTS
				$_sqlSearch = mysqli_query($_CON, "SELECT JOB_POINTS FROM job_table WHERE JOB_ID='$inputTASK' ");
				$row = mysqli_fetch_array($_sqlSearch);
				$points = $row['JOB_POINTS'];
				
				echo "0<br/>";
				echo $points;

				//$sqlUpdate = mysqli_query($_CON,"UPDATE pointing_table SET
				//JOB_ID='$inputTASK', JOB_POINTS='$points' WHERE POINT_ID='$_ID' ");
				ob_end_clean();
				header("location: givepoints.php?upd=true");
			}
		
	}