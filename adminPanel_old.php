<?php
session_start();
//rederict user if he hasn't logged in
if (!(isset($_SESSION['user_id']) OR $_SESSION['user_type'] != "admin")) {
	header('Location: login.html');
}
?>
<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>SB Admin 2 - Bootstrap Admin Theme</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Custom Fonts -->
		<link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>

	<body>

		<div id="wrapper">

			<!-- Navigation -->
			<?php
			include ('navbar-admin.php');
 ?>

			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Administrator</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->

				<!-- /.row -->
				<div class="row vert-offset-top-6">
					<div class="col-md-5 col-md-offset-1">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-circle fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											View active
										</div>
									</div>
								</div>
							</div>
							<a href="tableloggedin.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div> </a>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											Add
										</div>
									</div>
								</div>
							</div>
							<a href="adduser.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div> </a>
						</div>
					</div>
					<div class="col-md-5">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-calendar fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											View Period
										</div>
									</div>
								</div>
							</div>
							<a href="tableall.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div> </a>
						</div>
						<div class="panel panel-warning">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-edit fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											Edit
										</div>
									</div>
								</div>
							</div>
							<a href="edit.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div> </a>
						</div>
					</div>

				</div>
				<!-- /.row -->
			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->

		<!-- jQuery -->
		<script src="js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.js"></script>

	</body>

</html>
