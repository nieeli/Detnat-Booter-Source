<?php 
ob_start();
require_once 'includes/db.php';
?>
					<!-- Sidebar -->
					<div class="sidebar" id="nav">
						
						<!-- Sample logo -->
						<a href="index.php" class="brand" title="Back to homepage">Detnat</a>
						
						<!-- User profile -->
						<div class="user-profile">
							<img alt="John Pixel avatar" src="http://placekitten.com/60/60">
							<div>
								<a href="#"><?php echo htmlentities($_SESSION['username']); ?></a>
				<?php 
				$plansql = $odb -> prepare("SELECT `users`.*,`plans`.`name`, `plans`.`mbt` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id LIMIT 1");
				$plansql -> execute(array(":id" => $_SESSION['ID']));
				$userInfo = $plansql -> fetch(PDO::FETCH_ASSOC);
				?>
								<em><?php echo $userInfo['name']; ?></em>
								<ul class="user-profile-actions">
									<li><a href="unset.php" title="Logout"><span class="icon-key"></span></a></li>
								</ul>
							</div>
						</div>
						<!-- /User profile -->
						
						<!-- Main navigation -->
						<nav class="main-navigation iconic" role="navigation">
							<ul>
	<?php
	if ($user -> hasMembership($odb))
	{
	?>
								<li>
									<a href="index.php" class="no-submenu"><span class="icon-home"></span>Dashboard</a>
								</li>
								<li>
									<a href="hub.php" class="no-submenu"><span class="icon-signal"></span>HUB</a>
								</li>
								<li>
									<a href="fe.php" class="no-submenu"><span class="icon-signal"></span>Friends and Enemies</a>
								</li>
								<li>
									<a href="resolver.php" class="no-submenu"><span class="icon-signal"></span>Resolvers</a>
								</li>
								<li>
									<a href="iplogger.php" class="no-submenu"><span class="icon-signal"></span>IP Logger</a>
								</li>
	<?php
	}
	?>
								<li>
									<a href="purchase.php" class="no-submenu"><span class="icon-signal"></span>Purchase</a>
								</li>
								
		<?php
		if ($user -> isAdmin($odb))
		{
		?>
								<li>
									<a href=""><span class="icon-gift"></span>Admin</a>
									<ul>
								<li>
									<a href="index.php" class="no-submenu"><span class="icon-signal"></span>TCP Proxy</a>
								</li>
								<li>
									<a href="hub.php" class="no-submenu"><span class="icon-signal"></span>TCP Proxy</a>
								</li>
								<li>
									<a href="fe.php" class="no-submenu"><span class="icon-signal"></span>TCP Proxy</a>
								</li>
								<li>
									<a href="resolver.php" class="no-submenu"><span class="icon-signal"></span>TCP Proxy</a>
								</li>
								<li>
									<a href="iplogger.php" class="no-submenu"><span class="icon-signal"></span>TCP Proxy</a>
								</li>									
									</ul>
								</li>
		<?php
		}
		?>
		
							</ul>
						</nav>
						<!-- /Main navigation -->
						
						<!-- Sidebar note -->
						<div class="sidebar-note">
							<p>Detnat.</p>
							<a href="#" class="btn btn-flat btn-danger">Details &rarr;</a>
						</div>
						<!-- /Sidebar note -->
						
					</div>
					<!-- /Sidebar -->