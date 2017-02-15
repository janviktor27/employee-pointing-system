		<!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
					<form method="post" enctype="multipart/form-data" action="<?php uploadPhoto(); ?>">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Upload Photo</h4>
						</div>
						<div class="modal-body">
								<input name="profilePhoto" type="file" accept="image/*" required>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" name="btn_upload" class="btn btn-info">Upload</button>
						</div>
					</form>
                </div>
            </div>
        </div>
		<!-- Modal -->
		<!-- CHANGE PASSWORD -->
        <div class="modal fade" id="changePWDMOD" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
					<form id="passwordForm" onSubmit="return changePasswordko();" method="post" action="<?php updPWD(); ?>">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="glyph-icon opacity-60 icon-shield"></i> <strong>Change Password</strong></h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="form-group col-md-12">
									<input type="password" class="form-control" name="inpOldPassword" placeholder="OLD PASSWORD">
								</div>
								<div class="form-group col-md-6">
									<input id="pass1" type="password" class="form-control" name="inpNewPassword" placeholder="NEW PASSWORD">
								</div>
								<div class="form-group col-md-6">
									<input id="pass2" type="password" class="form-control" name="inpNewPasswordRe" placeholder="RE-TYPE NEW PASSWORD">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
							<button type="submit" name="upd_btn" class="btn btn-info">Update Password</button>
						</div>
					</form>
                </div>
            </div>
        </div>
		<!-- CHANGE PASSWORD -->
	<!-- Change Password Script-->
	<script type="text/javascript">function changePasswordko(){var a=document.getElementById("pass1").value,b=document.getElementById("pass2").value,c=!0;return a!=b?(document.getElementById("pass1").style.borderColor="#E34234",document.getElementById("pass2").style.borderColor="#E34234",c=!1):document.getElementById("passwordForm").submit(),c}</script>
	<!-- JS Core -->
	<script type="text/javascript" src="../assets-minified/js-core.js"></script>
	<!-- Bootstrap Dropdown -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/widgets/dropdown/dropdown.css">
	<script type="text/javascript" src="../assets-minified/widgets/dropdown/dropdown.js"></script>
	<!-- PieGage charts -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/widgets/charts/piegage/piegage.css">
	<script type="text/javascript" src="../assets-minified/widgets/charts/piegage/piegage.js"></script>
	<script type="text/javascript" src="../assets-minified/widgets/charts/piegage/piegage-demo.js"></script>
	<!-- Bootstrap Tooltip -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/widgets/tooltip/tooltip.css">
	<script type="text/javascript" src="../assets-minified/widgets/tooltip/tooltip.js"></script>
	<!-- Bootstrap Popover -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/widgets/popover/popover.css">
	<script type="text/javascript" src="../assets-minified/widgets/popover/popover.js"></script>
	<!-- Bootstrap Buttons -->
	<script type="text/javascript" src="../assets-minified/widgets/button/button.js"></script>
	<!-- Bootstrap Collapse -->
	<script type="text/javascript" src="../assets-minified/widgets/collapse/collapse.js"></script>
	<!-- Uniform -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/widgets/uniform/uniform.css">
	<script type="text/javascript" src="../assets-minified/widgets/uniform/uniform.js"></script>
	<!-- Chosen -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/widgets/chosen/chosen.css">
	<script type="text/javascript" src="../assets-minified/widgets/chosen/chosen.js"></script>
	<!-- Superfish -->
	<script type="text/javascript" src="../assets-minified/widgets/superfish/superfish.js"></script>
	<!-- Superclick -->
	<script type="text/javascript" src="../assets-minified/widgets/superclick/superclick.js"></script>
	<!-- Nice scroll -->
	<script type="text/javascript" src="../assets-minified/widgets/nicescroll/nicescroll.js"></script>
	<!-- Overlay -->
	<script type="text/javascript" src="../assets-minified/widgets/overlay/overlay.js"></script>
	<!-- jQueryUI Autocomplete -->
	<script type="text/javascript" src="../assets-minified/widgets/autocomplete/autocomplete.js"></script>
	<script type="text/javascript" src="../assets-minified/widgets/autocomplete/menu.js"></script>
	<!-- Skycons -->
	<script type="text/javascript" src="../assets-minified/widgets/skycons/skycons.js"></script>
	<!-- Content box -->
	<script type="text/javascript" src="../assets-minified/widgets/content-box/contentbox.js"></script>
	<!-- Bootstrap Tabs -->
	<script type="text/javascript" src="../assets-minified/widgets/tabs/tabs.js"></script>
	<!-- Sparklines charts -->
	<script type="text/javascript" src="../assets-minified/widgets/charts/sparklines/sparklines.js"></script>
	<script type="text/javascript" src="../assets-minified/widgets/charts/sparklines/sparklines-demo.js"></script>
	<!-- Slidebars -->
	<link rel="stylesheet" type="text/css" href="../assets-minified/widgets/slidebars/slidebars.css">
	<script type="text/javascript" src="../assets-minified/widgets/slidebars/slidebars.js"></script>
	<!-- Widgets init for demo -->
	<script type="text/javascript" src="../assets-minified/widgets-init.js"></script>
	<!-- Theme layout -->
	<script type="text/javascript" src="../assets-minified/themes/supina/js/layout.js"></script>
	<!-- Modal-->
	<link rel="stylesheet" type="text/css" href="../assets-minified/widgets/modal/modal.css">
	<script type="text/javascript" src="../assets-minified/widgets/modal/modal.js"></script>

</body>
</html>