<?php
require 'includes/db.php';
require 'includes/init.php';
?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title><?php echo $title_prefix; ?>Login</title>
		<meta name="description" content="">
		<meta name="author" content="Walking Pixels | www.walkingpixels.com">
		<meta name="robots" content="index, follow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- CSS styles -->
		<link rel='stylesheet' type='text/css' href='css/lindworm-green.css'>
		
		<!-- Fav and touch icons -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/icons/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/icons/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="img/icons/apple-touch-icon-57-precomposed.png">
		
		<!-- JS Libs -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/libs/jquery.js"><\/script>')</script>
		<script src="js/libs/modernizr.js"></script>
		<script src="js/libs/selectivizr.js"></script>
		
	</head>
	<body class="login-page">

			<!-- Main content -->
			<div class="content">

				<!-- Grid row -->
				<div class="row-fluid">

					<article class="span12 login-header">

						<!-- Sample logo -->
						<a href="index.html" class="brand" title="Back to homepage">Lindworm Responsive Twitter Bootstrap Admin Template</a>

					</article>
					<!-- /Data block -->

					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<header>
								<h2>
									<span class="icon-lock"></span>
									Login
								</h2>
							</header>
							<section>

								<form class="form-horizontal">
									<div class="control-group">
										<label class="control-label" for="inputEmail">Username</label>
										<div class="controls">
											<input type="text" id="inputEmail" placeholder="Your username">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="inputPassword">Password</label>
										<div class="controls">
											<input type="password" id="inputPassword" placeholder="Password">
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<label class="checkbox">
												<input type="checkbox"> Remember me
											</label>
											<button type="submit" class="btn">Sign in</button>
										</div>
									</div>
								</form>
								
							</section>
						</div>
					</article>
					<!-- /Data block -->
					
				</div>
				<!-- /Grid row -->

			</div>
			<!-- /Main content -->

		<!-- Main footer -->
		<footer id="footer">
			<ul>
				<li><a href="#">Lost password?</a></li>
				<li><a href="#">Support</a></li>
				<li><a href="#">Back to page</a></li>
			</ul>
		</footer>
		<!-- /Main footer -->
		
	</body>
</html>
