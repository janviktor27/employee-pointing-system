<?php include'includes/header-default.php'?>
<?php include'classes/class.test.php'?>
<body>
	<div id="sb-site">
		<div id="page-wrapper">
		<?php include'includes/top-menu.php';?>
			<!-- #page-header -->
			<?php include'includes/sidebar.php'?>
			<!-- #page-sidebar -->
			<div id="page-content-wrapper" class="rm-transition">
				<div id="page-content">
				<?php updAction();?>
				<!-- #page-content -->
			</div>
		</div>
	</div>
<?php include'includes/footer.php'?>