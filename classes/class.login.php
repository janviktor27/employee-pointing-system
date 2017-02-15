<?php
/* Copyright (C) :ANA GRACE ESPIRITU|KRISTEIN HEINRICH DUMAPAY: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by ANA GRACE ESPIRITU && KRISTEIN HEINRICH DUMAPAY, OCTOBER 2016
 */
	
	function loginUser(){
		if (isset($_POST['inpEMPEIN']) && isset($_POST['inpEMPPASSWORD'])){
			require_once('connect.php');
			$usrCIN = mysqli_real_escape_string($_CON, $_POST['inpEMPEIN']);
			$password = mysqli_real_escape_string($_CON, $_POST['inpEMPPASSWORD']);
			$pass = md5($password);
			$query = "SELECT * FROM employee_table WHERE EMP_EIN='$usrCIN' AND EMP_PASSWORD='$pass' AND USER_TYPE='2' ";
			$result = mysqli_query($_CON,$query) or die(mysqli_connect_error());
			$count = mysqli_num_rows($result);
			if($count == 1){
				$_SESSION['emp_usr'] = $usrCIN;
			}else{
				header("location: login.php?credentials=false");
				ob_end_clean();
			}
		}
		///////////
		//Check if Session is Set Then redirects to index?session=true
		if(isset($_SESSION['emp_usr'])){
		$usrCIN = $_SESSION['emp_usr'];
		setcookie("emp_usr", $usrCIN, strtotime( '+30 days' ), "/", "", "", TRUE);
		header("location: ./index.php?session=loggedin");
		}
	}