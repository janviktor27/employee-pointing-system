<?php include'includes/header-default.php'?>
<?php include'classes/class.main.php'?>
<body>
	<div id="sb-site">
		<div id="page-wrapper">
		<?php include'includes/top-menu.php';?>
			<!-- #page-header -->
			<?php include'includes/sidebar.php'?>
			<!-- #page-sidebar -->
			<div id="page-content-wrapper" class="rm-transition">
				<div id="page-content">
					<h1 class="font-gray-dark mrg25T mrg15B">Clerk Dashboard</h1>
					<div class="row">
						<div class="col-md-3">
							<div class="tile-box tile-box-alt bg-blue">
								<div class="tile-header">
										Reward Employee
									</div>
								<div class="tile-content-wrapper">
									<i class="glyph-icon icon-trophy"></i>
									<div class="tile-content">
											<?php cntRewards(); ?>
									</div>
								</div>
								<a href="givepoints.php?ref=quicklinks" title="" class="tile-footer">
										Give points now!
									<i class="glyph-icon icon-arrow-right"></i>
								</a>
							</div>
						</div>
						<div class="col-md-3">
							<div class="tile-box tile-box-alt bg-green">
								<div class="tile-header">
										Task List
								</div>
								<div class="tile-content-wrapper">
									<i class="glyph-icon icon-list"></i>
									<div class="tile-content">
										<?php cntTaskList(); ?>
									</div>
								</div>
								<a href="tasklist.php?ref=quicklinks" title="" class="tile-footer">
										Manage task list
									<i class="glyph-icon icon-arrow-right"></i>
								</a>
							</div>
						</div>
						<div class="col-md-3">
							<div class="tile-box tile-box-alt bg-red" title="">
								<div class="tile-header">
										Users
									</div>
								<div class="tile-content-wrapper">
									<i class="glyph-icon icon-user"></i>
									<div class="tile-content">
										<?php cntEMP();?>
									</div>
								</div>
								<a href="employee.php?ref=quicklinks" title="" class="tile-footer">
										Manage Users
									<i class="glyph-icon icon-arrow-right"></i>
								</a>
							</div>
						</div>
						<div class="col-md-3">
							<div class="tile-box tile-box-alt bg-blue">
								<div class="tile-header">
										Co-clerks
									</div>
								<div class="tile-content-wrapper">
									<i class="glyph-icon icon-wrench"></i>
									<div class="tile-content">
											<?php cntClerk();?>
									</div>
								</div>
								<a href="co-clerks.php?ref=quicklinks" title="" class="tile-footer">
										Managee Co-clerks
									<i class="glyph-icon icon-arrow-right"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- #page-content -->
			</div>
		</div>
	</div>
<?php include'includes/footer.php'?>