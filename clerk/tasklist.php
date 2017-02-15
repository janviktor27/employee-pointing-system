<?php include'includes/header-default.php'?>
<?php include'classes/class.tasklist.php'?>
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
						Manage Task 
					</h3>
					<div class="example-box-wrapper">
						<?php
						//RESPONSE!!!
						uniRes();
						?>
						<div class="content-box">
							<h3 class="content-box-header bg-blue-alt">
								Task List
								<div class="header-buttons">
									<button class="btn btn-sm label-success" data-toggle="modal" data-target="#tbl_modal"><i class="glyph-icon icon-plus-circle"></i></button>
								</div>
							</h3>
							<div class="content-box-wrapper">
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<th>Name</th>
											<th>Description</th>
											<th>Points</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									<?php theview();?>
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
<div class="modal fade" id="tbl_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" method="post" action="<?php add(); ?>" role="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add task form</h4> </div>
				<div class="modal-body">
					<div class="form-group">
						<label for="inputJNAME" class="col-sm-3 control-label">Task name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputJNAME" id="inputJNAME" placeholder="Task name" required> </div>
					</div>
					<div class="form-group">
						<label for="inputJDESC" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-9">
							<textarea type="text" name="inputJDESC" id="inputJDESC" rows="2" class="form-control textarea-no-resize" placeholder="Task description (optional)"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="inputJPOINTS" class="col-sm-3 control-label">Task points</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="inputJPOINTS" id="inputJPOINTS" placeholder="Task points" required> </div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
						<button type="submit" name="btn_add" class="btn btn-info">Add task</button>
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