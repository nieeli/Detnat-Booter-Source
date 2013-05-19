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
						<a href="index.html" class="brand" title="Back to homepage"></a>

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
<?php
if (!($user -> LoggedIn()))
{
	if (isset($_POST['loginBtn']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$errors = array();
		if (!ctype_alnum($username) || strlen($username) < 4 || strlen($username) > 15)
		{
			$errors[] = 'Username must be alphanumberic and 4-15 characters in length';
		}
		
		if (empty($username) || empty($password))
		{
			$errors[] = 'Please fill in all fields';
		}
		
		if (empty($errors))
		{
			$SQLCheckLogin = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username AND `password` = :password");
			$SQLCheckLogin -> execute(array(':username' => $username, ':password' => SHA1($password)));
			$countLogin = $SQLCheckLogin -> fetchColumn(0);
			if ($countLogin == 1)
			{
				$SQLGetInfo = $odb -> prepare("SELECT `username`, `ID` FROM `users` WHERE `username` = :username AND `password` = :password");
				$SQLGetInfo -> execute(array(':username' => $username, ':password' => SHA1($password)));
				$userInfo = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);
				if ($userInfo['status'] == 0)
				{
					$_SESSION['username'] = $userInfo['username'];
					$_SESSION['ID'] = $userInfo['ID'];
					echo '<strong>SUCCESS: </strong>Login Successful. Redirecting...<meta http-equiv="refresh" content="2;url=index.php">';
				}
				else
				{
					echo '<strong>ERROR: </strong>Your are banned';
				}
			}
			else
			{
				echo '<strong>ERROR: </strong>Login Failed';
			}
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
}
else
{
	header('location: index.php');
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
										<div class="controls">
											<label class="checkbox">
												<input type="checkbox"> Remember me
											</label>
											<button type="submit" name="loginBtn" class="btn">Sign in</button>
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

		<!-- /Main footer -->
		
	</body>
</html>
