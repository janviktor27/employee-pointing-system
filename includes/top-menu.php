<div id="page-header" class="clearfix">
	<!-- #header-logo -->
	<div id="header-right">
		<div class="user-profile dropdown">
			<a href="#" title="" class="user-ico clearfix" data-toggle="dropdown">
				<?php profPicXS(); ?>
					<i class="glyph-icon icon-chevron-down"></i>
				</a>
				<div class="dropdown-menu pad0B float-right">
					<div class="box-sm">
						<div class="login-box clearfix">
							<div class="user-img">
								<a data-toggle="modal" data-target="#myModal" href="#" class="change-img">Change photo</a>
								<?php profPicSmall(); ?>
							</div>
								<div class="user-info">
									<span>
									<?php userFullname(); ?>
										<i><?php userCurJob(); ?></i>
									</span>
									<a href="#" data-toggle="modal" data-target="#changePWDMOD">Change password</a>
								</div>
							</div>
							<div class="pad5A button-pane button-pane-alt text-center">
								<a href="?out=true" class="btn font-normal btn-danger pull-right">
									<i class="glyph-icon icon-power-off"></i> Logout 
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
