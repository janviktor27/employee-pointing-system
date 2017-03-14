<?php
/* Copyright (C) :ANA GRACE ESPIRITU|KRISTEIN HEINRICH DUMAPAY: - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by ANA GRACE ESPIRITU && KRISTEIN HEINRICH DUMAPAY, OCTOBER 2016
 */
include_once('./../connect.php');
////////////////////////////////////////////////////
//GET THE HIGHEST RANKER OF THE MONTH
	function getMonthHighest(){
		global $_CON;
    $yrMon = GetMonYr();
		$json_data = array();

    if(count($yrMon) > 0)://IF COUNT YRMON
    foreach ($yrMon as $_YRMON) {
      $sqlSearch = mysqli_query($_CON,
  		"SELECT
      EMP_ID,
  		SUM(JOB_POINTS) AS user_points
  		FROM
      pointing_table
  		WHERE
      DATE_ADDED LIKE '%$_YRMON%'
      GROUP BY
      DATE_FORMAT(DATE_ADDED, '%Y%m')
  		ORDER BY
      user_points
      DESC");

      $count = mysqli_num_rows($sqlSearch);
  		if($count > 0){
  			while($row = $sqlSearch->fetch_array()){
    			$emp_id = $row['EMP_ID'];
    			$points = $row['user_points'];
    			//GET HIGHEST USER INFO
    			$sqlEMP = mysqli_query($_CON,
    			"SELECT
          EMP_ID,
          EMP_FNAME,
    			EMP_LNAME
          FROM
          employee_table
          WHERE
          EMP_ID='$emp_id'");
    			$_row = mysqli_fetch_array($sqlEMP);
    			$EMP_ID = $_row['EMP_ID'];
    			$fname = $_row['EMP_FNAME'];
    			$lname = $_row['EMP_LNAME'];
					$month = date('M',strtotime($_YRMON));
    			$fullname = "$month: $fname $lname";
					$json_array['name'] = $fullname;
					$json_array['userpoints'] = $points;
					array_push($json_data,$json_array);
          	// $out = array_values($myData);
    				// echo"<br/><br/>ID: $emp_id <br> Name: $fullname <br> Total Points: $points<br> Month: $_YRMON<br>";
        }//END WHILE
  		}//END COUNT
  }//END FOREACH
	echo json_encode($json_data,JSON_UNESCAPED_UNICODE);
  endif;// END IF YR MON
	}

function GetMonYr(){
  global $_CON;
  $sqlSearch = mysqli_query($_CON,
  "SELECT
  DATE_ADDED
  FROM
  pointing_table
  GROUP BY
  DATE_FORMAT(DATE_ADDED, '%Y%m')");
  if($sqlSearch->num_rows > 0 ){
    $myArr = array();
    while($row = $sqlSearch->fetch_array()){
      $yrMon = date("Y-m", strtotime($row['DATE_ADDED']));
      $myArr[] = $yrMon;
    }
    return $myArr;
  }
}
