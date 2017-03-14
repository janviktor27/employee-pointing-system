<?php
/* Copyright (C) :ANA GRACE ESPIRITU|KRISTEIN HEINRICH DUMAPAY: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by ANA GRACE ESPIRITU && KRISTEIN HEINRICH DUMAPAY, OCTOBER 2016
 */
include_once('./../connect.php');
$usr_ein = $_SESSION['clerk_usr'];
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
			<img src='../profile_pictures/thumb_$file_name'>
			";
		}else{
			echo"
			<img src='../assets-minified/dummy-images/default_image.png'>
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
			<img width='36' src='../profile_pictures/thumb_$file_name'>
			";
		}else{
			echo"
			<img width='36' src='../assets-minified/dummy-images/default_image.png'>
			";
		}
	}
	
	function uploadPhoto(){
		global $_CON;
		$usr_id = usrID();
		if(isset($_POST['btn_upload'])){
			$target_dir = '../profile_pictures/';
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
	
