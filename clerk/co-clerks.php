<?php include'includes/header-default.php'?>
<?php include'classes/class.co-clerk.php';?>
<body>
<div id="sb-site">
	<div id="page-wrapper">
		<?php include 'includes/top-menu.php';?>
		<!-- #page-header -->
		<?php include 'includes/sidebar.php'; ?>
		<!-- #page-sidebar -->
		<div id="page-content-wrapper" class="rm-transition">
			<div id="page-content">
				<div class="page-box">
					<h3 class="page-title">
						Manage Clerks 
					</h3>
					<div class="example-box-wrapper">
						<?php
						//RESPONSE!!!
						uniRes();
						?>
						<div class="content-box">
							<h3 class="content-box-header bg-blue-alt">
								Clerk List
								<div class="header-buttons">
									<button class="btn btn-sm label-success" data-toggle="modal" data-target="#myModal"><i class="glyph-icon icon-plus-circle"></i></button>
								</div>
							</h3>
							<div class="content-box-wrapper">
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<th>Employee #</th>
											<th>Name</th>
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
<!--Modal Start-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" method="post" action="<?php add(); ?>" role="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add clerk form</h4> </div>
				<div class="modal-body">
					<div class="form-group">
						<label for="inputEIN" class="col-sm-3 control-label">Employee #</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputEIN" id="inputEIN" placeholder="Employee number" required> </div>
					</div>
					<div class="form-group">
						<label for="inputFNAME" class="col-sm-3 control-label">First name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputFNAME" id="inputFNAME" placeholder="First name" required> </div>
					</div>
					<div class="form-group">
						<label for="inputLNAME" class="col-sm-3 control-label">Last name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputLNAME" id="inputLNAME" placeholder="Last name" required> </div>
					</div>
					<div class="form-group">
						<label for="inputPWD" class="col-sm-3 control-label"></label>
						<div class="col-sm-9">
							<h4>Default password is 123456</h4> </div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
						<button type="submit" name="btn_add" class="btn btn-info">Add clerk</button>
					</div>
			</form>
			</div>
		</div>
	</div>
</div>
<?php 
/////////////////////////
//MODAL FUNCTIONS
updMod();
delMod();
?>
<!--Modal End-->

</div>
<!--SITE END-->
<?php include'includes/footer.php'; ?>