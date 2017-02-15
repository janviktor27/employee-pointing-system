<?php
session_start();
include'classes/class.login.php';
include'classes/class.VerifyLoggedIn.php';
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title> Clerk Login </title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!-- JS Core -->
	<script type="text/javascript" src="../assets-minified/js-core.js"></script>
	<!-- HELPERS -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/helpers/helpers-all.css">
	<!-- ELEMENTS -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/elements/elements-all.css">
	<!-- Icons -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/icons/fontawesome/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="../assets-minified/icons/linecons/linecons.css">
	<!-- SNIPPETS -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/snippets/snippets-all.css">
	<!-- APPLICATIONS -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/applications/mailbox.css">
	<!-- Admin Theme -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/themes/supina/layout.css">
	<link id="layout-color" rel="stylesheet" type="text/css" href="../assets-minified/themes/supina/default/layout-color.css">
	<link id="framework-color" rel="stylesheet" type="text/css" href="../assets-minified/themes/supina/default/framework-color.css">
	<link rel="stylesheet" type="text/css" href="../assets-minified/themes/supina/border-radius.css">
	<!-- Color Helpers CSS -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/helpers/colors.css"> </head>

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
                            Clerk Login
                            <small>Login to your account.</small>
                        </div>
                    </h3>
                    <div class="content-box-wrapper">
                        <div class="form-group"> 
                            <div class="input-group">
                                <input name="inpCLERKEIN" type="text" class="form-control" placeholder="Enter employee #" required>
                                <span class="input-group-addon">
                                    <i class="glyph-icon icon-barcode"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input name="inpCLERKPASSWORD" type="password" class="form-control" placeholder="Password">
                                <span class="input-group-addon">
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
</body>
</html>