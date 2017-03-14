<?php
/* Copyright (C) :ANA GRACE ESPIRITU|KRISTEIN HEINRICH DUMAPAY: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by ANA GRACE ESPIRITU && KRISTEIN HEINRICH DUMAPAY, OCTOBER 2016
 */
include_once('./../connect.php');

/////////////////////////////////////////////
//Add employee
	function add(){
		global $_CON;
		if(isset($_POST['btn_add'])){
			$inputJNAME = mysqli_real_escape_string($_CON, $_POST['inputJNAME']);
			$inputJDESC = mysqli_real_escape_string($_CON, $_POST['inputJDESC']);
			$inputJPOINTS = mysqli_real_escape_string($_CON, $_POST['inputJPOINTS']);
			//CHECK IF EIN EXIST
			$sqlSearch = mysqli_query($_CON, "SELECT JOB_NAME FROM job_table WHERE JOB_NAME='$inputJNAME' ");
			$count = mysqli_num_rows($sqlSearch);
			if($count > 0){
				ob_end_clean();
				header("location: tasklist.php?add=exist");
			}else{
				$sqlInsert = mysqli_query($_CON, "INSERT INTO job_table 
				(JOB_NAME,JOB_DESC,	JOB_POINTS)
				VALUES('$inputJNAME','$inputJDESC','$inputJPOINTS')");
				ob_end_clean();
				header("location: tasklist.php?add=true");
			}
		}
	}

/////////////////////////////////////////////
//View employee
	function theview(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM job_table ");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['JOB_ID']);
				$jname = mysqli_real_escape_string($_CON, $row['JOB_NAME']);
				$jdesc = mysqli_real_escape_string($_CON, $row['JOB_DESC']);
				$jpoint = mysqli_real_escape_string($_CON, $row['JOB_POINTS']);
				echo"
				 <tr>
				  <td>$jname</td>
				  <td>$jdesc</td>
				  <td>$jpoint</td>
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
			  <td colspan='4'>No data yet. </td>
			 </tr>
			";
		}
	}

/////////////////////////////////////////////
//UPDATE MODAL
	function updMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM job_table ");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['JOB_ID']);
				$jname = mysqli_real_escape_string($_CON, $row['JOB_NAME']);
				$jdesc = mysqli_real_escape_string($_CON, $row['JOB_DESC']);
				$jpoint = mysqli_real_escape_string($_CON, $row['JOB_POINTS']);
				echo"
<!--Modal Start-->
<div class='modal fade' id='updMod$_ID' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<form class='form-horizontal' method='post' action='"; updAction(); echo"'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
					<h4 class='modal-title'>Update Clerk</h4> </div>
				<div class='modal-body'>
					<div class='form-group'>
						<label for='inputJNAME' class='col-sm-3 control-label'>Task name</label>
						<div class='col-sm-9'>
							<input value='$jname' type='text' class='form-control' name='inputJNAME' id='inputJNAME' placeholder='Task name' required> </div>
					</div>
					<div class='form-group'>
						<label for='inputJDESC' class='col-sm-3 control-label'>Description</label>
						<div class='col-sm-9'>
							<textarea type='text' name='inputJDESC' id='inputJDESC' rows='2' class='form-control textarea-no-resize' placeholder='Task description (optional)'>$jdesc</textarea>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputJPOINTS' class='col-sm-3 control-label'>Task points</label>
						<div class='col-sm-3'>
							<input value='$jpoint' type='number' class='form-control' name='inputJPOINTS' id='inputJPOINTS' placeholder='Task points' required> </div>
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
			$inputJNAME = mysqli_real_escape_string($_CON, $_POST['inputJNAME']);
			$inputJDESC = mysqli_real_escape_string($_CON, $_POST['inputJDESC']);
			$inputJPOINTS = mysqli_real_escape_string($_CON, $_POST['inputJPOINTS']);

			//CHECK IF EIN ARE THE SAME FROM TEXTBOX AND DATABASE
			$sqlSearch = mysqli_query($_CON, "SELECT JOB_NAME FROM job_table WHERE JOB_ID='$_ID'");
			$_row = mysqli_fetch_array($sqlSearch);
			$_GETNAME = $_row['JOB_NAME'];
			if($inputJNAME == $_GETNAME){
				//UPDATE QUERY
				$sqlUpdate = mysqli_query($_CON,"UPDATE job_table SET
				JOB_DESC='$inputJDESC', JOB_POINTS='$inputJPOINTS' WHERE JOB_ID='$_ID' ");
				ob_end_clean();
				header("location: tasklist.php?upd=true");
			}else{
				//CHECK IF EIN EXIST
				$sqlSearch = mysqli_query($_CON, "SELECT JOB_NAME FROM job_table WHERE JOB_NAME='$inputJNAME' ");
				$count = mysqli_num_rows($sqlSearch);
				if($count == 1){
					ob_end_clean();
					header("location: tasklist.php?upd=exist");
				}else{
					$sqlUpdate = mysqli_query($_CON,"UPDATE job_table SET
					JOB_NAME='$inputJNAME', JOB_DESC='$inputJDESC', JOB_POINTS='$inputJPOINTS' WHERE JOB_ID='$_ID' ");
					ob_end_clean();
					header("location: tasklist.php?upd=true");
				}
			}
		}
	}
	
/////////////////////////////////////////////
//DELETE MODAL
	function delMod(){
		global $_CON;
		$sqlSearch = mysqli_query($_CON, "SELECT * FROM job_table");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$_ID = mysqli_real_escape_string($_CON, $row['JOB_ID']);
				$jname = mysqli_real_escape_string($_CON, $row['JOB_NAME']);
				$jdesc = mysqli_real_escape_string($_CON, $row['JOB_DESC']);
				$jpoint = mysqli_real_escape_string($_CON, $row['JOB_POINTS']);
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
					$jname <br />
					$jdesc <br />
					$jpoint point/s<br />
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
			$sqlDel = mysqli_query($_CON, "DELETE FROM job_table WHERE JOB_ID='$_ID' ");
			if($sqlDel){
				ob_end_clean();
				header("location: tasklist.php?del=true");
			}else{
				ob_end_clean();
				header("location: tasklist.php?del=false");
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
										<p>Successfully added your new task. </p>
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
										<p>Failed adding new task due to <code>Task Name</code> repetition.</p>
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
										<p>Successfully updated your task info. </p>
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
										<p>Failed to update task due to <code>Task Name</code> repetition.</p>
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
										<p>Successfully deleted your task. </p>
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