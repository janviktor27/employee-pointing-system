<?php
include'includes/header.php';
include'classes/class.main.php';
include'classes/class.who.is.php';
?>
<body>
<div id="sb-site">
	<div id="page-wrapper">
		<?php include'includes/top-menu.php';?>
		<!-- #page-header -->
		<div id="page-content">
			<div class="row">
				<div class="col-md-8">
					<!--MONTHLY RANKER-->
					<div class="panel-layout">
						<div class="panel-box">
							<div class="panel-content bg-blue">
								<div class="image-content font-white">
									<div class="center-vertical">
										<div class="center-content">
											<div class="sparkline-big">0,<?php highestTotalMonth(); ?></div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-content pad0A bg-white">
								<?php getMonthHighest(); ?>
								<table class="table mrg0B mrg10T">
									<tbody>
									<?php theView(); ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!--MONTHLY RANKER-->
					<div class="content-box mrg25T mrg25B">
						<h3 class="content-box-header content-box-header-alt bg-white">
							<span class="icon-separator">
								<i class="glyph-icon icon-clock-o"></i>
							</span>
							<div class="header-wrapper">
							Timeline
							</div>
						</h3>
						<div class="content-box-wrapper">
							<div class="timeline-box mrg25A">
							<?php myActivities(); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel-layout">
						<div class="panel-box">
							<div class="panel-content bg-white">
								<div class="">
									<?php profPicCircle(); ?>
										<h5 class="font-bold"><?php userFullname(); ?></h5>
										<h6><?php userCurJob(); ?></h6>
										<h6>Previous work: <?php userPrevJob(); ?></h6>
									</div>
								</div>
								<div class="panel-content pad15A bg-white">
								<div class="center-vertical">
									<ul class="center-content list-group list-group-separator row mrg0A">
										<li class="col-md-6">
											<a href="#"  data-toggle="modal" data-target="#myPointsList" title="">
												<i class="glyph-icon opacity-60 icon-list"></i>
												<p class="mrg5T">All Points</p>
											</a>
										</li>
										<li class="col-md-6">
											<a href="#" data-toggle="modal" data-target="#changePWDMOD">
												<i class="glyph-icon opacity-60 icon-shield"></i>
												<p class="mrg5T">Change Password</p>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-layout">
						<div class="panel-box col-xs-8">
							<div class="panel-content  bg-black">
								<div class="sparkline-big">0,<?php myTotByMonth();?></div>
							</div>
							<div class="panel-content bg-white">
								<div class="center-vertical">
									<ul class="nav">
										<li>
											<h4 class="font-green"><?php myMonthlyTotalPoints(); ?></h4>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- #page-content -->
	</div>
</div>
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
		<!-- LIST -->
        <div class="modal fade" id="myPointsList" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="glyph-icon opacity-60 icon-list"></i> <strong>All points list</strong></h4>
						</div>
						<div class="modal-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Job (points)</th>
										<th>Description</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
									<?php myPointList(); ?>
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
                </div>
            </div>
        </div>
		<!-- LIST -->
<?php include'includes/footer.php'?>