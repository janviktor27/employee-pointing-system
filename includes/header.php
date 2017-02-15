<?php
session_start();
include'classes/class.login.php';
include'classes/class.VerifyLoggedIn.php';
include'classes/func.logout.php';
logout();
onlineChecker();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Welcome to Employee Pointing System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!-- JS Core -->
	<script type="text/javascript" src="assets-minified/js-core.js"></script>
	<!-- HELPERS -->
	<link rel="stylesheet" type="text/css" href="assets-minified/helpers/helpers-all.css">
	<!-- ELEMENTS -->
	<link rel="stylesheet" type="text/css" href="assets-minified/elements/elements-all.css">
	<!-- Icons -->
	<link rel="stylesheet" type="text/css" href="assets-minified/icons/fontawesome/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="assets-minified/icons/linecons/linecons.css">
	<!-- SNIPPETS -->
	<link rel="stylesheet" type="text/css" href="assets-minified/snippets/snippets-all.css">
	<!-- Admin Theme -->
	<link rel="stylesheet" type="text/css" href="assets-minified/themes/supina/layout.css">
	<link id="layout-color" rel="stylesheet" type="text/css" href="assets-minified/themes/supina/default/layout-color.css">
	<link id="framework-color" rel="stylesheet" type="text/css" href="assets-minified/themes/supina/default/framework-color.css">
	<link rel="stylesheet" type="text/css" href="assets-minified/themes/supina/border-radius.css">
	<!-- Color Helpers CSS -->
	<link rel="stylesheet" type="text/css" href="assets-minified/helpers/colors.css"> </head>