<?php ob_start(); require 'includes/db.php'; require 'includes/init.php'; ?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title><?php echo $title_prefix; ?>Register</title>
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
						<a href="#" class="brand" title="Back to homepage"></a>

					</article>
					<!-- /Data block -->

					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<header>
								<h2>
									<span class="icon-lock"></span>
									Register
								</h2>
							</header>
							<section>
	<?php
		if ($user -> LoggedIn())
		{
			header('Location: index.php');
			echo 'balls';
			die();
		}
		
		if (isset($_POST['registerBtn']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$rpassword = $_POST['rpassword'];
			$email = $_POST['email'];
			$errors = array();
			$checkUsername = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username");
			$checkUsername -> execute(array(':username' => $username));
			$countUsername = $checkUsername -> fetchColumn(0);
			if ($checkUsername > 0)
			{
				$errors['Username is already taken'];
			}
			if (!ctype_alnum($username) || strlen($username) < 4 || strlen($username) > 15)
			{
				$errors[] = 'Username Must Be  Alphanumberic And 4-15 characters in length';
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$errors[] = 'Email is invalid';
			}
			if (empty($username) || empty($password) || empty($rpassword) || empty($email))
			{
				$errors[] = 'Please fill in all fields';
			}
			if ($password != $rpassword)
			{
				$errors[] = 'Passwords do not match';
			}
			if (empty($errors))
			{
				$insertUser = $odb -> prepare("INSERT INTO `users` VALUES(NULL, :username, :password, :email, 0, 0, 0, 0)");
				$insertUser -> execute(array(':username' => $username, ':password' => SHA1($password), ':email' => $email));
				echo '<strong>SUCCESS: </strong>User has been registered.  Redirecting...<meta http-equiv="refresh" content="2;url=login.php">';
			}
			else
			{
				echo '<strong>ERROR:</strong><br />';
				foreach($errors as $error)
				{
					echo '-'.$error.'<br />';
				}
				echo '';
			}
		}
		?>
								<form class="form-horizontal" action="" method="POST">
									<div class="control-group">
										<label class="control-label" for="inputEmail">Username</label>
										<div class="controls">
											<input type="text" name="username" id="username" placeholder="Your username">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="inputPassword">Password</label>
										<div class="controls">
											<input type="password" name="password" id="password" placeholder="Password">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="inputPassword">Repeat Password</label>
										<div class="controls">
											<input type="password" name="rpassword" id="rpassword" placeholder="Password">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="inputPassword">Email</label>
										<div class="controls">
											<input type="text" name="email" id="email" placeholder="Email">
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<label class="checkbox">
											</label>
											<button type="submit" name="registerBtn" class="btn">Register</button>
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
				<li><a href="register.php">Register</a></li>
			</ul>
		</footer>
		<!-- /Main footer -->
		
	</body>
</html>
