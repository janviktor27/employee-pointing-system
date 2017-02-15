<div id="page-header" class="clearfix">
	<div id="header-logo" class="rm-transition">
		<a href="#" class="tooltip-button hidden-desktop" title="Navigation Menu" id="responsive-open-menu"> <i class="glyph-icon icon-align-justify"></i> </a> <span>Pointing <i class="opacity-80">System</i></span>
		<a id="collapse-sidebar" href="#" title=""> <i class="glyph-icon icon-chevron-left"></i> </a>
	</div>
	<!-- #header-logo -->
	<div id="header-right">
		<div class="user-profile dropdown">
			<a href="#" title="" class="user-ico clearfix" data-toggle="dropdown">
			<?php profPicXS();?>
			<i class="glyph-icon icon-chevron-down"></i> </a>
			<div class="dropdown-menu pad0B float-right">
				<div class="box-sm">
					<div class="login-box clearfix">
						<div class="user-img"> <a href="#" data-toggle="modal" data-target="#myModal" class="change-img">Change photo</a>
							<?php profPicSmall(); ?>
						</div>
						<div class="user-info"> 
						 <span>
                          <?php userFullname();?>
                          <i><?php userCurJob(); ?></i>
                         </span>
						 <a href="#" data-toggle="modal" data-target="#changePWDMOD">Change Password</a></div>
					</div>
					<div class="pad5A button-pane button-pane-alt text-center">
						<a href="?out=true" class="btn pull-right font-normal btn-danger"> <i class="glyph-icon icon-power-off"></i> Logout </a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>