<?php
/* Copyright (C) :ANA GRACE ESPIRITU|KRISTEIN HEINRICH DUMAPAY: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by ANA GRACE ESPIRITU && KRISTEIN HEINRICH DUMAPAY, OCTOBER 2016
 */
include_once'connect.php';
$usr_ein = $_SESSION['emp_usr'];
////////////////////////////////////////////////////
//GET USER FULL NAME
	function userFullname(){
		global $_CON;
		global $usr_ein;
		$sqlSearch = mysqli_query($_CON,"
		SELECT
		EMP_FNAME,
		EMP_LNAME
		FROM
		employee_table
		WHERE
		EMP_EIN='$usr_ein'");
		$row = mysqli_fetch_array($sqlSearch);
		$lname = $row['EMP_LNAME'];
		$fname = $row['EMP_FNAME'];
		echo "$fname $lname";
	}

////////////////////////////////////////////////////
//GET USER CURRENT JOB
	function userCurJob(){
		global $_CON;
		global $usr_ein;
		$sqlSearch = mysqli_query($_CON,"
		SELECT
		EMP_CUR_JOB
		FROM
		employee_table
		WHERE
		EMP_EIN='$usr_ein'");
		$row = mysqli_fetch_array($sqlSearch);
		$curjob = $row['EMP_CUR_JOB'];
		echo "$curjob";
	}

////////////////////////////////////////////////////
//GET USER CURRENT PREVIOUS JOB
	function userPrevJob(){
		global $_CON;
		global $usr_ein;
		$sqlSearch = mysqli_query($_CON,"
		SELECT
		EMP_PREV_JOB
		FROM
		employee_table
		WHERE
		EMP_EIN='$usr_ein'");
		$row = mysqli_fetch_array($sqlSearch);
		$curprevjob = $row['EMP_PREV_JOB'];
		echo "$curprevjob";
	}
	
////////////////////////////////////////////////////
//GET PROFILE PICTURE
	function profPicSmall(){
		global $_CON;
		$usr_id = usrID();
		$sqlSearch = mysqli_query($_CON,"
		SELECT
		file_name
		FROM
		profile_picture
		WHERE
		EMP_ID='$usr_id' ");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			$row = mysqli_fetch_array($sqlSearch);
			$file_name = $row['file_name'];
			echo"
			<img src='profile_pictures/thumb_$file_name'>
			";
		}else{
			echo"
			<img src='assets-minified/dummy-images/default_image.png'>
			";
		}
	}

////////////////////////////////////////////////////
//GET PROFILE PICTURE
	function profPicXS(){
		global $_CON;
		$usr_id = usrID();
		$sqlSearch = mysqli_query($_CON,"
		SELECT
		file_name
		FROM
		profile_picture
		WHERE
		EMP_ID='$usr_id' ");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			$row = mysqli_fetch_array($sqlSearch);
			$file_name = $row['file_name'];
			echo"
			<img width='36' src='profile_pictures/thumb_$file_name'>
			";
		}else{
			echo"
			<img width='36' src='assets-minified/dummy-images/default_image.png'>
			";
		}
	}

////////////////////////////////////////////////////
//GET PROFILE PICTURE
	function profPicCircle(){
		global $_CON;
		$usr_id = usrID();
		$sqlSearch = mysqli_query($_CON,"
		SELECT
		file_name
		FROM
		profile_picture
		WHERE
		EMP_ID='$usr_id' ");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			$row = mysqli_fetch_array($sqlSearch);
			$file_name = $row['file_name'];
			echo"
			<img src='profile_pictures/thumb_$file_name' style='width: 60px;' class='img-bordered img-circle mrg10B'>
			";
		}else{
			echo"
			<img src='assets-minified/dummy-images/default_image.png' style='width: 60px;' class='img-bordered img-circle mrg10B'>
			";
		}
	}
	
