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
					<h1 class="title-hero">Admin Dashboard</h1>
					<div class="row">
						<div class="col-md-3">
							<div class="tile-box tile-box-alt bg-blue">
								<div class="tile-header">
										Reward
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
						<div class="col-md-2">
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
						<div class="col-md-2">
							<div class="tile-box tile-box-alt bg-blue">
								<div class="tile-header">
										Administrator
									</div>
								<div class="tile-content-wrapper">
									<i class="glyph-icon icon-wrench"></i>
									<div class="tile-content">
											<?php cntClerk();?>
									</div>
								</div>
								<a href="co-clerks.php?ref=quicklinks" title="" class="tile-footer">
										Managee Admins
									<i class="glyph-icon icon-arrow-right"></i>
								</a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="tile-box tile-box-alt bg-green">
								<div class="tile-header">
										Print
									</div>
								<div class="tile-content-wrapper">
									<i class="glyph-icon icon-print"></i>
									<div class="tile-content">
										&nbsp;
									</div>
								</div>
								<a href="print.php?ref=quicklinks" title="" class="tile-footer">
										Print logs
									<i class="glyph-icon icon-arrow-right"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- #MORIS -->
						<div class="col-md-12">
								<h1 class="title-hero">Employee of the Month</h1>
								<div class="content-box">
										<div id="hero-bar" class="graph"></div>
								</div>
						</div>
						<!-- #MORIS -->
					</div>
				</div>
				<!-- #page-content -->
			</div>
		</div>
	</div>
<?php include'includes/footer.php'?>
