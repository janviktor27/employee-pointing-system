<?php include'includes/header-default.php'?>
<?php include'classes/class.givepoints.php'?>
<body>
	<div id="sb-site">
		<div id="page-wrapper">
		<?php include'includes/top-menu.php';?>
			<!-- #page-header -->
			<?php include'includes/sidebar.php'?>
			<!-- #page-sidebar -->
			<div id="page-content-wrapper" class="rm-transition">
				<div id="page-content">
					<div class="page-box">
						<h3 class="page-title">
						 Reward Employee
						</h3>
						<div class="example-box-wrapper">
						<?php uniRes();?>
							<form role="form" method="post" action="<?php add(); ?>">
							 <div class="row">
							  <div class="col-md-6">
								<div class="form-group">
									<select class="form-control" id="inputEMP" name="inputEMP" required>
									 <option value="">Select employee</option>
									 <?php optEMP()?>
									</select>
								</div>
							  </div>
							  <div class="col-md-6">
								<div class="input-group">
									<select class="form-control" id="inputTASK" name="inputTASK" required>
									 <option value="">Select task</option>
									 <?php optTASK()?>
									</select>
									<span class="input-group-btn">
										<button class="btn btn-info" type="submit" name="btn_add"><i class="glyph-icon icon-plus-circle"></i></button>
									</span>
								</div>
							  </div>
							 </div>
							</form>
							<div class="content-box">
								<h3 class="content-box-header bg-blue-alt">
									Task List
								</h3>
								<div class="content-box-wrapper">
									<table class="table table-hover table-bordered">
										<thead>
											<tr>
												<th>Employee</th>
												<th>Job (points)</th>
												<th>Date & time</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										<?php theview(); ?>
										</tbody>
									</table>
								</div>
							</div>

						</div>
					</div>
					<!-- #page-box -->
				</div>
				<!-- #page-content -->
			</div>
		</div>
<!--MODAL-->
<?php
updMod(); 
delMod();
?>
	</div>
<?php include'includes/footer.php'?>