<?php
	function logout(){
		if(isset($_GET['out'])){
			$_SESSION = array();
			if(isset($_COOKIE["emp_usr"])) {
				setcookie("emp_usr", '', strtotime( '-5 days' ), '/');
			}
			session_destroy();
			header("location: login.php?session=false");
			ob_end_clean();
			exit;
		}
	}