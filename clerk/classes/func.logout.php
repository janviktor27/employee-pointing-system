<?php
	function logout(){
		if(isset($_GET['out'])){
			$_SESSION = array();
			if(isset($_COOKIE["clerk_usr"])) {
				setcookie("clerk_usr", '', strtotime( '-5 days' ), '/');
			}
			session_destroy();
			header("location: login.php?session=unknown");
			
		}
	}