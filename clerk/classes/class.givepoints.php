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
//Add employee
	function add(){
		global $_CON;
		global $_TODAY;
		if(isset($_POST['btn_add'])){
			$inputEMP = mysqli_real_escape_string($_CON, $_POST['inputEMP']);
			$inputTASK = mysqli_real_escape_string($_CON, $_POST['inputTASK']);
			//CHECK IF EIN EXIST
			$sqlSearch = mysqli_query($_CON, "SELECT EMP_ID, JOB_ID FROM pointing_table WHERE EMP_ID='$inputEMP' AND JOB_ID='$inputTASK' AND DATE_ADDED LIKE '%$_TODAY%' ");
			$count = mysqli_num_rows($sqlSearch);
			if($count > 0){
				ob_end_clean();
				header("location: givepoints.php?add=exist");
			}else{
				//GET POINTS
				$_sqlSearch = mysqli_query($_CON, "SELECT JOB_POINTS FROM job_table WHERE JOB_ID='$inputTASK' ");
				$row = mysqli_fetch_array($_sqlSearch);
				$points = $row['JOB_POINTS'];
				$sqlInsert = mysqli_query($_CON, "INSERT INTO pointing_table 
				(EMP_ID, JOB_ID, JOB_POINTS, DATE_ADDED)
				VALUES('$inputEMP','$inputTASK','$points',now())");
				ob_end_clean();
				header("location: givepoints.php?add=true");
			}
		}
	}
	
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

/////////////////////////////////////////////
//TASK SELECT OPTION
	function optTASK(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON,"SELECT JOB_ID, JOB_NAME 
		FROM job_table ORDER BY JOB_NAME ASC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['JOB_ID']);
				$name = mysqli_real_escape_string($_CON, $row['JOB_NAME']);
				echo"	<option value='$_ID'> $name </option>";
			}
		}else{
			echo"		<option value=''>No data to show</option>";
		}
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

/////////////////////////////////////////////
//UPDATE MODAL
	function updMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM pointing_table ");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['POINT_ID']);
				$EMP_ID = mysqli_real_escape_string($_CON, $row['EMP_ID']);
				$JOB_ID = mysqli_real_escape_string($_CON, $row['JOB_ID']);
				$JOB_POINTS = mysqli_real_escape_string($_CON, $row['JOB_POINTS']);
				$DATE_ADDED = mysqli_real_escape_string($_CON, $row['DATE_ADDED']);
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
				//
				echo"
<!--Modal Start-->
<div class='modal fade' id='updMod$_ID' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<form method='post' action='"; updAction(); echo"'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
					<h4 class='modal-title'>Update Employee</h4> </div>
					<div class='modal-body'>
						<div class='row'>
						  <div class='col-sm-6'>
							<div class='form-group'>
								<select class='form-control' disabled id='inputEMP'>
								 <option default>$lname, $fname</option>
								</select>
								<input type='hidden' name='inputEMP' value='$EMP_ID' >
							</div>
						  </div>
						  <div class='col-sm-6'>
							<div class='form-group'>
								<select class='form-control' id='inputTASK' name='inputTASK' required>
								 <option value='$JOB_ID' default>$NAME</option>
								 "; optTASK(); echo"
								</select>
							</div>
						  </div>
						 </div>
					</div>
					<div class='modal-footer'>
						<input type='hidden' name='UPD_ID' value='$_ID'>
						<button type='button' class='btn btn-danger pull-left' data-dismiss='modal'>Close</button>
						<button type='submit' name='btn_upd' class='btn btn-info'>Update</button>
					</div>
			</form>
			</div>
		</div>
	</div>
</div>";
			}
		}
	}

/////////////////////////////////////////////
//UPDATE METHOD
	function updAction(){
		global $_CON;
		if(isset($_POST['btn_upd'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['UPD_ID']);
			$inputEMP = mysqli_real_escape_string($_CON, $_POST['inputEMP']);
			$inputTASK = mysqli_real_escape_string($_CON, $_POST['inputTASK']);
			//GET DATE INPUTTED
			$s_qlSearch = mysqli_query($_CON, "SELECT DATE_ADDED FROM pointing_table WHERE POINT_ID='$_ID' ");
			$ro_w = mysqli_fetch_array($s_qlSearch);
			$date_inputted = $ro_w['DATE_ADDED'];
			$date_inputted = date('Y-m-d', strtotime($date_inputted));
			//CHECK IF TASK EXIST ON THE SAME DAY!
			$sqlSearch = mysqli_query($_CON, "SELECT EMP_ID, JOB_ID FROM pointing_table WHERE EMP_ID='$inputEMP' AND JOB_ID='$inputTASK' AND DATE_ADDED LIKE '%$date_inputted%' ");
			$count = mysqli_num_rows($sqlSearch);
			if($count == 0){
				//*GET POINTS
				$_sqlSearch = mysqli_query($_CON, "SELECT JOB_POINTS FROM job_table WHERE JOB_ID='$inputTASK' ");
				$row = mysqli_fetch_array($_sqlSearch);
				$points = $row['JOB_POINTS'];

				$sqlUpdate = mysqli_query($_CON,"UPDATE pointing_table SET
				JOB_ID='$inputTASK', JOB_POINTS='$points' WHERE POINT_ID='$_ID' ");
				ob_end_clean();
				header("location: givepoints.php?upd=true");
				exit(0);
			}else{
				ob_end_clean();
				header("location: givepoints.php?upd=exist");
				exit(0);
			}
		}
	}
	
/////////////////////////////////////////////
//DELETE MODAL
	function delMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM pointing_table");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['POINT_ID']);
				$EMP_ID = mysqli_real_escape_string($_CON, $row['EMP_ID']);
				$JOB_ID = mysqli_real_escape_string($_CON, $row['JOB_ID']);
				$JOB_POINTS = mysqli_real_escape_string($_CON, $row['JOB_POINTS']);
				$DATE_ADDED = mysqli_real_escape_string($_CON, $row['DATE_ADDED']);
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
<!--Modal Start-->
<div class='modal fade' id='delMod$_ID' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<form class='form-horizontal' method='post' action='"; delAction(); echo"'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
					<h4 class='modal-title'>Are you sure you want to delete ?</h4> </div>
					<div class='modal-body'>
					$fname $lname <br />
					$NAME ($POINTS) <br />
					</div>
					<div class='modal-footer'>
						<input type='hidden' name='DEL_ID' value='$_ID'>
						<button type='button' class='btn btn-danger pull-left' data-dismiss='modal'>Close</button>
						<button type='submit' name='btn_del' class='btn btn-info'>Yes</button>
					</div>
			</form>
			</div>
		</div>
	</div>
</div>";
			}
		}
	}

/////////////////////////////////////////////
//DELETE MODAL
	function delAction(){
		global $_CON;
		if(isset($_POST['btn_del'])){
			$_ID = mysqli_real_escape_string($_CON, $_POST['DEL_ID']);
			$sqlDel = mysqli_query($_CON, "DELETE FROM pointing_table WHERE POINT_ID='$_ID' ");
			if($sqlDel){
				ob_end_clean();
				header("location: givepoints.php?del=true");
			}else{
				ob_end_clean();
				header("location: givepoints.php?del=false");
			}
		}
	}

///////////////////////////////////////////
//UNIVERSAL RESPONSE
	function uniRes(){
		addRes();
		updRes();
		delRes();
	}
///////////////////////////////////////////
//ADD RESPONSE
	function addRes(){
		if(isset($_GET['add'])){
			$_RES = $_GET['add'];
			if($_RES == 'true'){
				echo"
								<div class='alert alert-notice'>
									<div class='bg-blue alert-icon'>
										<i class='glyph-icon icon-info'></i>
									</div>
									<div class='alert-content'>
										<h4 class='alert-title'>Adding Success</h4>
										<p>Successfully added your new employee reward. </p>
									</div>
								</div>";
			}
			if($_RES == 'exist'){
				echo"
								<div class='alert alert-danger'>
									<div class='bg-red alert-icon'>
										<i class='glyph-icon icon-times'></i>
									</div>
									<div class='alert-content'>
										<h4 class='alert-title'>Adding Failed</h4>
										<p>Failed adding new employee reward due to <code>Reward</code> repetition.</p>
									</div>
								</div>";
			}
		}
	}
///////////////////////////////////////////
//UPDATE RESPONSE
	function updRes(){
		if(isset($_GET['upd'])){
			$_RES = $_GET['upd'];
			if($_RES == 'true'){
				echo"
								<div class='alert alert-notice'>
									<div class='bg-blue alert-icon'>
										<i class='glyph-icon icon-info'></i>
									</div>
									<div class='alert-content'>
										<h4 class='alert-title'>Updating Success</h4>
										<p>Successfully updated your employee reward. </p>
									</div>
								</div>";
				}
			if($_RES == 'exist'){
				echo"
								<div class='alert alert-danger'>
									<div class='bg-red alert-icon'>
										<i class='glyph-icon icon-times'></i>
									</div>
									<div class='alert-content'>
										<h4 class='alert-title'>Updating Failed</h4>
										<p>Failed to update employee reward due to <code>Reward</code> repetition.</p>
									</div>
								</div>";
			}
		}
	}
///////////////////////////////////////////
//DELETE RESPONSE
	function delRes(){
		if(isset($_GET['del'])){
			$_RES = $_GET['del'];
			if($_RES == 'true'){
				echo"
								<div class='alert alert-notice'>
									<div class='bg-blue alert-icon'>
										<i class='glyph-icon icon-info'></i>
									</div>
									<div class='alert-content'>
										<h4 class='alert-title'>Deleting Success</h4>
										<p>Successfully deleted employee reward. </p>
									</div>
								</div>";
				}
			if($_RES == 'false'){
				echo"
								<div class='alert alert-danger'>
									<div class='bg-red alert-icon'>
										<i class='glyph-icon icon-times'></i>
									</div>
									<div class='alert-content'>
										<h4 class='alert-title'>Deleting Failed</h4>
										<p>Deleting failed due to repetitive action.</p>
									</div>
								</div>";
			}
		}
	}