<?php
/* Copyright (C) :ANA GRACE ESPIRITU|KRISTEIN HEINRICH DUMAPAY: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by ANA GRACE ESPIRITU && KRISTEIN HEINRICH DUMAPAY, OCTOBER 2016
 */
include_once('./../connect.php');

/////////////////////////////////////////////
// COUNT REWARDS
	function cntRewards(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, 
		"SELECT
		POINT_ID
		FROM
		pointing_table");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 1000){
			
		}else{
			echo $count;
		}
	}

/////////////////////////////////////////////
// COUNT TASK LINK
	function cntTaskList(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, 
		"SELECT
		JOB_ID
		FROM
		job_table");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 1000){
			
		}else{
			echo $count;
		}
	}

/////////////////////////////////////////////
// COUNT EMPLOYEE
	function cntEMP(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, 
		"SELECT
		EMP_ID
		FROM
		employee_table
		WHERE
		USER_TYPE=2");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 1000){
			
		}else{
			echo $count;
		}
	}
	
/////////////////////////////////////////////
// COUNT CLERK
	function cntClerk(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, 
		"SELECT
		EMP_ID
		FROM
		employee_table
		WHERE
		USER_TYPE=1");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 1000){
			
		}else{
			echo $count;
		}
	}
	
