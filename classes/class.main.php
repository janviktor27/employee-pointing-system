<?php
/* Copyright (C) :ANA GRACE ESPIRITU|KRISTEIN HEINRICH DUMAPAY: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by ANA GRACE ESPIRITU && KRISTEIN HEINRICH DUMAPAY, OCTOBER 2016
 */
include_once'connect.php';
/////////////////////////////////////////////
//GLOBAL DEFAULTS
date_default_timezone_set("Asia/Manila");
$_TODAY = date('Y-m-d');
$_MONTH = date('Y-m');
$_MONTHRanker = date('M Y');
$_YEAR = date('Y');

$usr_ein = $_SESSION['emp_usr'];
////////////////////////////////////////////////////
//GET THE HIGHEST RANKER OF THE MONTH
	function getMonthHighest(){
		global $_CON;
		global $_MONTH;
		global $_MONTHRanker;
		$sqlSearch = mysqli_query($_CON,
		"SELECT EMP_ID,
		SUM(JOB_POINTS) AS user_points 
		FROM pointing_table 
		WHERE DATE_ADDED LIKE '%$_MONTH%'
		GROUP BY EMP_ID
		ORDER BY user_points DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			$row = mysqli_fetch_array($sqlSearch);
			$emp_id = $row['EMP_ID'];
			$points = $row['user_points'];
			//GET HIGHEST USER INFO
			$sqlEMP = mysqli_query($_CON,
			"SELECT EMP_ID, EMP_FNAME,
			EMP_LNAME FROM employee_table WHERE EMP_ID='$emp_id'");
			$_row = mysqli_fetch_array($sqlEMP);
			$EMP_ID = $_row['EMP_ID'];
			$fname = $_row['EMP_FNAME'];
			$lname = $_row['EMP_LNAME'];
			$fullname = "$fname $lname";
			$sqlImage = mysqli_query($_CON,"
			SELECT
			file_name
			FROM
			profile_picture
			WHERE
			EMP_ID='$EMP_ID' ");
			$countImage = mysqli_num_rows($sqlImage);
			if($countImage == 1){
				$row_image = mysqli_fetch_array($sqlImage);
				$file_name = $row_image['file_name'];
				$img = "<img src='profile_pictures/thumb_$file_name' height='82' width='82' alt='' class='meta-image img-bordered img-circle'>";
			}else{
				$img = "<img src='assets-minified/dummy-images/default_image.png' height='82' width='82' alt='' class='meta-image img-bordered img-circle'>";
			}
				echo"
				<div class='meta-box meta-box-offset'>
				$img
						<h3 class='meta-heading font-size-16'>
							<strong>$fullname</strong> | <span class='bs-badge badge-purple'>$points</span> <strong>pts</strong>
						</h3>
						<h4 class='meta-subheading font-size-13'>$_MONTHRanker, TOP RANKER</h4>
				</div>
				";
		}else{
			echo "
			<div class='meta-box meta-box-offset'>
				<img src='assets-minified/dummy-images/default_image.png' height='82' width='82' alt='' class='meta-image img-bordered img-circle'>
					<h3 class='meta-heading font-size-16'>
						No one has gain points yet.
					</h3>
					<h4 class='meta-subheading font-size-13'></h4>
			</div>
			";
		}
	}
////////////////////////////////////////////////////
//GET THE HIGHEST RANKER OF THE MONTH
	function getHighestRET(){
		global $_CON;
		global $_MONTH;
		$sqlSearch = mysqli_query($_CON,
		"SELECT EMP_ID,
		SUM(JOB_POINTS) AS user_points 
		FROM pointing_table 
		WHERE DATE_ADDED LIKE '%$_MONTH%'
		GROUP BY EMP_ID
		ORDER BY user_points DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			$row = mysqli_fetch_array($sqlSearch);
			$emp_id = $row['EMP_ID'];
			return $emp_id;
		}
	}
////////////////////////////////////////////////////
//GET TOTAL POINTS 
	function tobyMon(){
		global $_CON;
		global $_MONTH;
		$sqlSearch = mysqli_query($_CON,
		"SELECT EMP_ID,
		SUM(JOB_POINTS) AS user_points 
		FROM pointing_table 
		WHERE DATE_ADDED LIKE '%$_MONTH%'
		GROUP BY EMP_ID
		ORDER BY user_points DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			$row = mysqli_fetch_array($sqlSearch);
			$emp_id = $row['EMP_ID'];
			$points = $row['user_points'];
			//GET HIGHEST USER INFO
			$sqlEMP = mysqli_query($_CON,
			"SELECT EMP_FNAME,
			EMP_LNAME FROM employee_table WHERE EMP_ID='$emp_id'");
			$_row = mysqli_fetch_array($sqlEMP);
			$fname = $_row['EMP_FNAME'];
			$lname = $_row['EMP_LNAME'];
			$fullname = "$fname $lname";
			echo "$fullname | <span class='bs-badge badge-purple'>$points</span> points";
		}else{
			echo "No one has gain points this month.";
		}
	}

////////////////////////////////////////////////////
//GET TOTAL POINTS 
	function highestTotalMonth(){
		global $_CON;
		global $_MONTH;
		$emp_id = getHighestRET();

			//$row = mysqli_fetch_array($sqlSearch);
			//$emp_id = $row['EMP_ID'];
			//$points = $row['user_points'];
			//echo "$emp_id";
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
					if($counter++ > 0 ){echo ",";}
					$points = $finalROW['user_point'];
					echo $points;
				}
	}
////////////////////////////////////////////////////
//GET TOTAL POINTS 
	function myMonthlyTotalPoints(){
		global $_CON;
		global $_YEAR;
		$emp_id = returnID();
			$sql_Search = mysqli_query($_CON,
			"SELECT
			SUM(JOB_POINTS) AS user_point
			FROM pointing_table 
			WHERE EMP_ID='$emp_id' AND DATE_ADDED LIKE '%$_YEAR%'
			ORDER BY 
			YEAR(DATE_ADDED), 
			MONTH(DATE_ADDED) ASC");
			$count = mysqli_num_rows($sql_Search);
			if($count > 0){
				$finalROW=mysqli_fetch_array($sql_Search);
				$points = $finalROW['user_point'];
				if($points > 0){
					echo "
					<h4 class='title-hero'>My Graph</h4>
					<span class='bs-badge badge-blue-alt'>$points TOTAL POINTS</span> ";
				}else{
					echo "GET SOME WORK DONE!";
				}
			}
	}
////////////////////////////////////////////////////
//GET MY TOTAL POINTS 
	function myTotByMonth(){
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
				if($counter++ > 0 ){echo ",";}
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

////////////////////////////////////////////////////
//DISPLAY ACTIVITIES 
	function myActivities(){
		global $_CON;
		$my_id = returnID();
		$sqlSearch = mysqli_query($_CON,
		"SELECT * FROM pointing_table
		WHERE EMP_ID='$my_id' ORDER BY DATE_ADDED DESC LIMIT 0,35");
		$counter = mysqli_num_rows($sqlSearch);
		if($counter > 0){
			$count = 0;
			echo "
			<script type='text/javascript'>
			jQuery(document).ready(function() {jQuery('time.timeago').timeago();});
			</script>
			";
			while($row=mysqli_fetch_array($sqlSearch)){
				$job_id = $row['JOB_ID'];
				$points = $row['JOB_POINTS'];
				$date_added1 = $row['DATE_ADDED'];
				$date_added = date('h:i:a', strtotime($date_added1));
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
							$date_added
							</div>
							<div class='popover left'>
								<div class='arrow'></div>
								<div class='popover-content'>
									<div class='tl-label bs-label label-success'>$job_name</div>
									<p class='tl-content'>$job_desc</p>
									<div class='tl-time'>
										<i class='glyph-icon icon-clock-o'></i>
				<time class='timeago' datetime='$date_added1'>$date_added1</time>
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
							$date_added
							</div>
							<div class='popover right'>
								<div class='arrow'></div>
								<div class='popover-content'>
									<div class='tl-label bs-label label-info'>$job_name</div>
									<p class='tl-content'>$job_desc</p>
									<div class='tl-time'>
										<i class='glyph-icon icon-clock-o'></i>
										<time class='timeago' datetime='$date_added1'>$date_added1</time>
									</div>
								</div>
							</div>
						</div>
					</div>";
				}
			}
		}else{
			echo"
			<div class='tl-row'>
				<div class='tl-item float-left'>
					<div class='tl-icon bg-black'>
						<i class='glyph-icon icon-question'></i>
					</div>
					<div class='tl-panel'>
					No job? No points.
					</div>
					<div class='popover left'>
						<div class='arrow'></div>
						<div class='popover-content'>
							<div class='tl-label bs-label label-info'>Get some work done!</div>
							<p class='tl-content'>Try fixing something!</p>
						</div>
					</div>
				</div>
			</div>";
		}
	}////////////////////////////////////////////////////
//DISPLAY USERS 
	function theView(){
		global $_CON;
		global $_MONTH;
		$sqlSearch = mysqli_query($_CON,
		"SELECT EMP_ID,
		SUM(JOB_POINTS) AS user_points 
		FROM pointing_table 
		WHERE DATE_ADDED LIKE '%$_MONTH%'
		GROUP BY EMP_ID
		ORDER BY user_points DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$emp_id = $row['EMP_ID'];
				$points = $row['user_points'];
				//GET HIGHEST USER INFO
				$sqlEMP = mysqli_query($_CON,
				"SELECT EMP_FNAME,
				EMP_LNAME FROM employee_table WHERE EMP_ID='$emp_id'");
				$_row=mysqli_fetch_array($sqlEMP);
				$fname = $_row['EMP_FNAME'];
				$lname = $_row['EMP_LNAME'];
				$fullname = "$lname, $fname";
				echo "
				<tr>
				 <td align='left'>$fullname</td>
				 <td>$points</td>
				</tr>
				";
			}
		}else{
			echo "
			<tr>
			 <td colspan='2'>
				No one has gain points this month.
			 </td>
			</tr>
			";
		}
	}
	
	function uploadPhoto(){
		global $_CON;
		$usr_id = usrID();
		if(isset($_POST['btn_upload'])){
			$target_dir = 'profile_pictures/';
			$target_file = $target_dir . basename($_FILES['profilePhoto']['name']);	
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			///////////////////////////////////
			// CHECK IF FILE IS IMAGE
			$check = getimagesize($_FILES['profilePhoto']['tmp_name']);
			if($check !== false) {
			$uploadOk = 1;
			}else{
			header('location: index.php?image=false');
			$uploadOk = 0;
			}
			// CHECK FILE SIZE
			if($_FILES['profilePhoto']['size'] > 500000) {
				header('location: index.php?image=toolarge');
				$uploadOk = 0;
			}			
			// ALLOW ONLY THIS FILETYPES
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			header('location: index.php?image=notallowed');
			$uploadOk = 0;
			}
				////////////////////////////////////////
				//READY FOR UPLOADING
				if($uploadOk == 1){
					if(move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $target_file)){
					    $filetmp = $_FILES['profilePhoto']['tmp_name'];
					    $filename = $_FILES['profilePhoto']['name'];
					    $filetype = $_FILES['profilePhoto']['type'];
						$unq = uniqid();
						
						$kaboom = explode(".", $filename); // Split file name into an array using the dot
						$fileExt = end($kaboom); // Now target the last array element to get the file extension
						// ---------- Include Universal Image Resizing Function --------
						include_once('ak_php_img_lib_1.0.php');
						$target_file = "$target_dir/$filename";
						$resized_file = "$target_dir/resized_$filename";
						$wmax = 300;
						$hmax = 300;
						ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
						// ----------- End Universal Image Resizing Function ----------
						// ------ Start Universal Image Thumbnail(Crop) Function ------
						$target_file = "$target_dir/resized_$filename";
						$thumbnail = "$target_dir/thumb_$unq$filename";
						$save_name = "$unq$filename";
						$wthumb = 150;
						$hthumb = 150;
						ak_img_thumb($target_file, $thumbnail, $wthumb, $hthumb, $fileExt);
						// ------- End Universal Image Thumbnail(Crop) Function -------
						$sqlSearch = mysqli_query($_CON,
						"SELECT
						file_name
						FROM
						profile_picture
						WHERE
						EMP_ID='$usr_id'");
						$count = mysqli_fetch_array($sqlSearch);
						if($count > 0){
							$fetchres = mysqli_fetch_array($sqlSearch);
							$file_name = $fetchres['file_name'];
							//DELETE OLD PHOTOS
							unlink("$target_dir/resized_$file_name");
							unlink("$target_dir/thumb_$file_name");
							//UPDATE FILE NAME
							$sqlUpdate = mysqli_query($_CON,"
							UPDATE
							profile_picture
							SET
							file_name='$save_name'
							WHERE
							EMP_ID='$usr_id'");
							header('location: index.php?image=updated');
							ob_end_clean();
							exit;
						}else{
							$sqlInsert = mysqli_query($_CON,"
							INSERT
							INTO
							profile_picture
							(EMP_ID,file_name)
							VALUES
							('$usr_id','$save_name')");
							header('location: index.php?image=newphoto');
							ob_end_clean();
							exit;
						}
						unlink("$target_dir/$save_name");
					}
				}
		}
	}
	
/////////////////////////////////////////////
//UPDATE METHOD
	function updPWD(){
		global $_CON;
		//////////////////////////////
		//CURRENT USER ID
		$usr_ID = usrID();
		if(isset($_POST['upd_btn'])){
			$inpOldPassword = mysqli_real_escape_string($_CON, $_POST['inpOldPassword']);
			$inpNewPassword = mysqli_real_escape_string($_CON, $_POST['inpNewPassword']);
			$inpNewPasswordRe = mysqli_real_escape_string($_CON, $_POST['inpNewPasswordRe']);
			if($inpNewPassword == $inpNewPasswordRe){
				$sqlSearch = mysqli_query($_CON,"
				SELECT
				EMP_PASSWORD
				FROM
				employee_table
				WHERE
				EMP_ID='$usr_ID'");
				$row = mysqli_fetch_array($sqlSearch);
				$oldpassword = $row['EMP_PASSWORD'];
				if($oldpassword == md5($inpOldPassword)){
					$inpNewPassword = md5($inpNewPassword);
					$sqlUpdate = mysqli_query($_CON,"
					UPDATE
					employee_table
					SET
					EMP_PASSWORD='$inpNewPassword'
					WHERE
					EMP_ID='$usr_ID' ");					
					header("location: index.php?changepass=true");
					ob_end_clean();
					exit;
				}else{
					header("location: index.php?changepass=false");
					ob_end_clean();
					exit;
				}
			}else{
				header("location: index.php?errno=donotmatch");
				ob_end_clean();
				exit;
			}
		}
	}
	
	function myPointList(){
		global $_CON;
		$usr_id = usrID();
		$sqlSearch = mysqli_query($_CON, "SELECT
		JOB_ID,
		JOB_POINTS,
		DATE_ADDED
		FROM
		pointing_table
		WHERE
		EMP_ID='$usr_id'
		ORDER
		BY 
		DATE_ADDED
		DESC");
		$count = mysqli_num_rows($sqlSearch);
		if($count > 0){
			while($row=mysqli_fetch_array($sqlSearch)){
				$JOB_ID = $row['JOB_ID'];
				$JOB_POINTS = $row['JOB_POINTS'];
				$DATE_ADDED = New DateTime($row['DATE_ADDED']);
				$date_format = date_format($DATE_ADDED, "M d, Y h:i:A ");
				$sqlJob = mysqli_query($_CON, "
				SELECT
				JOB_NAME,
				JOB_DESC
				FROM job_table
				WHERE 
				JOB_ID='$JOB_ID'
				");
				$jobRow = mysqli_fetch_array($sqlJob);
				$JOB_NAME = $jobRow['JOB_NAME'];
				$JOB_DESC = $jobRow['JOB_DESC'];
				echo"
					<tr>
						<td>$JOB_NAME($JOB_POINTS pts)</td>
						<td>$JOB_DESC</td>
						<td>$date_format</td>
					</tr>
				";
			}
		}
	}
	
	function usrID(){
		global $_CON;
		global $usr_ein;
		$sqlSearch = mysqli_query($_CON,"
		SELECT
		EMP_ID
		FROM
		employee_table
		WHERE
		EMP_EIN='$usr_ein' ");
		$row = mysqli_fetch_array($sqlSearch);
		$usr_id = $row['EMP_ID'];
		return $usr_id;
	}