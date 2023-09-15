<!DOCTYPE html>
<html lang="en">

<head>
	<!-- basic -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- mobile metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<!-- site metas -->
	<title><?= $title ?></title>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="">
	<?php require_once('_css.php'); ?>
</head>

<body class="dashboard dashboard_1">
	<div class="full_container">
		<div class="inner_container">
			<!-- Sidebar  -->
			<?php require_once('_sidebar2.php'); ?>
			<!-- end sidebar -->
			<!-- right content -->
			<div id="content">
				<!-- topbar -->
				<?php require_once('_topbar.php'); ?>
				<!-- end topbar -->
				<!-- dashboard inner -->
				<div class="midde_cont">
					<?= $contents ?>
					<!-- footer -->
					<?php require_once('_footer.php'); ?>
				</div>
				<!-- end dashboard inner -->
			</div>
		</div>
	</div>
	<?php require_once('_js.php'); ?>
</body>

</html>
