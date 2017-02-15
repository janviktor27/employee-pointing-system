<?php
session_start();
include'classes/class.login.php';
include'classes/class.VerifyLoggedIn.php';
//isOnline();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title> Employee Login </title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!-- HELPERS -->
	<link rel="stylesheet" type="text/css" href="assets-minified/helpers/helpers-all.css">
	<!-- ELEMENTS -->
	<link rel="stylesheet" type="text/css" href="assets-minified/elements/elements-all.css">
	<!-- Icons -->
	<link rel="stylesheet" type="text/css" href="assets-minified/icons/fontawesome/fontawesome.css">
	<!-- Admin Theme -->
	<link rel="stylesheet" type="text/css" href="assets-minified/themes/supina/layout.css">
	<link id="layout-color" rel="stylesheet" type="text/css" href="assets-minified/themes/supina/default/layout-color.css">
	<link id="framework-color" rel="stylesheet" type="text/css" href="assets-minified/themes/supina/default/framework-color.css">
<body>
	<div class="center-vertical">
		<div class="center-content">
        <div class="col-md-4 center-margin">

            <form method="post" action="<?php loginUser(); ?>">
                <div class="content-box wow bounceInDown modal-content">
                    <h3 class="content-box-header content-box-header-alt bg-default">
                        <span class="icon-separator">
                            <i class="glyph-icon icon-user"></i>
                        </span>
                        <div class="header-wrapper">
                            Employee Login
                            <small>Login to your account.</small>
                        </div>
                    </h3>
                    <div class="content-box-wrapper">
                        <div class="form-group"> 
                            <div class="input-group">
                                <input name="inpEMPEIN" type="text" class="form-control" placeholder="Enter employee #" required>
                                <span class="input-group-addon bg-blue">
                                    <i class="glyph-icon icon-barcode"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input name="inpEMPPASSWORD" type="password" class="form-control" placeholder="Password">
                                <span class="input-group-addon bg-blue">
                                    <i class="glyph-icon icon-unlock-alt"></i>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Sign In</button>
                    </div>
                </div>
            </form>			
			
		</div>
		</div>
	</div>
	<!-- JS Core -->
	<script type="text/javascript" src="assets-minified/js-core.js"></script>
</body>
</html>