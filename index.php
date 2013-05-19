<?php
ob_start();
require_once 'includes/db.php';
require_once 'includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: login.php');
	die();
}
if (!($user->hasMembership($odb)))
{
	header('location: purchase.php');
	die();
}
if (!($user -> notBanned($odb)))
{
	header('location: login.php');
	die();
}
?>

<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title><?php echo $bootername; ?>Dashboard</title>
		<meta name="description" content="">
		<meta name="author" content="Walking Pixels | www.walkingpixels.com">
		<meta name="robots" content="index, follow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- jQuery FullCalendar Styles -->
		<link rel='stylesheet' type='text/css' href='css/plugins/jquery.fullcalendar.css'>
		
		<!-- jQuery jGrowl Styles -->
		<link rel='stylesheet' type='text/css' href='css/plugins/jquery.jgrowl.css'>

		<!-- Style -->
		<link rel="stylesheet" href="css/lindworm-blue.css">
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		
		<!-- JS Libs -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/libs/jquery.js"><\/script>')</script>
		<script src="js/libs/modernizr.js"></script>
		<script src="js/libs/selectivizr.js"></script>

		<script>
			$(document).ready(function() {

				// Sidebar slide
				$('.nav-slide').pageslide();
				$(window).resize(function() {
					$.pageslide.close();
				});

				// Tooltips
				$('.user-profile-actions li a').tooltip({
					placement: 'bottom'
				});

			});
		</script>
		
	<body>
	
		<!-- Wrap all page content for sticky footer -->
		<div id="wrapper">
			
			<!-- Main page container -->
			<div class="container">
	
				<!-- Secondary navigation -->
				<ul class="secondary-navigation">
					<li><a href="#">Settings</a>
					<li><a href="#">Logout</a>
				</ul>
				<!-- /Secondary navigation -->
	
				<!-- Container style -->
				<div class="container-inner">
	
					<!-- Left (navigation) side -->
<?php include('sidebar.php'); ?>
					<!-- /Left (navigation) side -->
					
					<!-- Right (content) side -->
					<!-- Main content -->
					<div class="content">
					
						<!-- Page header -->
						<header class="page-header">

							<!-- Slide btn for sidebar navigation -->
							<a class="nav-slide" href="#nav">
								<span class="icon-align-justify"></span>
							</a>

							<h1>Welcome, <?php echo htmlentities($_SESSION['username']); ?>!</h1>
							<p>Welcome to Detnat booter source. If you have any questions you can open a support ticket on our sales website found here: http://hostcookie.me/panel</p>
						</header>
						<!-- /Page header -->
						
						<!-- Page container -->
						<section class="page-container" role="main">
						
							<!-- Breadcrumbs -->
							<ul class="breadcrumb">
								<li><a href="#"><span class="icon-home"></span> Home</a> <span class="icon-chevron-right"></span></li>
								<li><a href="#"><?php echo $name; ?></a> <span class="icon-chevron-right"></span></li>
								<li class="active">Dashboard</li>
							</ul>
							<!-- Breadcrumbs -->
							
							<!-- Grid row -->
							<div class="row">
							
								<!-- Data block -->
								<article class="span12 data-block">
									<div class="data-container">
										<section>
											
											
											<!-- Widgets -->
											<ul class="widgets">
												<li>
														<span class="widget-label">Estimated power</span>
														<strong>4Gbps</strong>
												</li>
												<li>
														<span class="widget-label">Total Boots</span>
														<strong><?php echo $stats -> totalBoots($odb); ?></strong>
												</li>
												<li>
														<span class="widget-label">Total Users</span>
														<strong><?php echo $stats -> totalUsers($odb); ?></strong>
												</li>
												<li>
														<span class="widget-label">Boots Running</span>
														<strong><?php echo $stats -> runningBoots($odb); ?></strong>
												</li>
											</ul>
											<!-- /Widgets -->
											
											<p>We try to keep a uptime percentage of >95%.</p>
											
										</section>
									</div>
								</article>
								<!-- /Data block -->
								
							</div>
							<!-- /Grid row -->
	
							<!-- Grid row -->
							<div class="row">
							
								<!-- Data block -->
								<article class="span4 data-block data-block-alt highlight highlight-green">
									<div class="data-container">
										<header>
											<h2><span class="icon-signal"></span> Statistics</h2>
										</header>
										<section>
											<ul class="stats">
												<li>
													<strong class="stats-count"><?php echo $stats -> totalBootsForUser($odb, $_SESSION['username']); ?></strong>
													<p>Your total boots</p>
												</li>
											</ul>
										</section>
									</div>
								</article>
								<!-- /Data block -->
								
								<!-- Data block -->
								<article class="span4 data-block data-block-alt highlight todo-block">
									<div class="data-container">
										<header>
											<h2><span class="icon-edit"></span> Upcoming updates</h2>
										</header>
										<section>
											<form>
												<table class="table">
													<tbody>
														<tr>
															<td></td>
															<td>
																<p>Upgrade network protection</p>
															</td>
														</tr>
														<tr>
															<td></td>
															<td>
																<p>Improve configuration panel</p>
															</td>
														</tr>
													</tbody>
												</table>
											</form>
										</section>
									</div>
								</article>
								<!-- /Data block -->
								
								<!-- Data block -->
								<article class="span4 data-block-alt data-block">
									<div class="data-container">
										<header>
											<h2><span class="icon-refresh"></span> News</h2>									
										</header>
										<section>
											<div id="accordion1" class="accordion">
												<div class="accordion-group">
													<div class="accordion-heading">
														<a class="accordion-toggle" href="#collapseOne" data-parent="#accordion1" data-toggle="collapse"> 7/05/2013 <span class="caret"></span></a>
													</div>
													<div id="collapseOne" class="accordion-body collapse">
														<div class="accordion-inner">ChemDDOS Protection is now launched.</div>
													</div>
												</div>
											</div>
										</section>
									</div>
								</article>
								<!-- /Data block -->
								
							</div>
							<!-- /Grid row -->
	
							<div class="alert alert-info fade in">
								<button class="close" data-dismiss="alert">&times;</button>
								<strong>Info!</strong> You can submit a support ticket here: http://hostcookie.me/panel.
							</div>
	
							<!-- Grid row -->
							<div class="row">
								
								<!-- Data block -->

								<!-- /Data block -->
								
								<!-- Data block -->
								<article class="span8 data-block">
									<div class="data-container">
										<section>
											<div class='fullcalendar'></div>
										</section>
									</div>
								</article>
								<!-- /Data block -->
								
							</div>
							<!-- /Grid row -->
							
						</section>
						<!-- /Page container -->
						
					</div>
					<!-- /Main content -->
					<!-- /Right (content) side -->
					
				</div>
				<!-- /Container style -->
				
			</div>
			<!-- /Main page container -->
			
			<!-- Push space for footer -->
			<div id="push"></div>
			
		</div>
		<!-- /Wrap all page content for sticky footer -->
		
		<!-- Main footer -->
		<footer id="footer">
			<ul>
				<li>Built with love on <a href="http://twitter.github.com/bootstrap/">Twitter Bootstrap</a> by <a href="http://www.walkingpixels.com/">Walking Pixels</a>.</li>
				<li><a href="#">Blog</a></li>
				<li><a href="#">Documentation</a></li>
				<li><a href="#">Support</a></li>
			</ul>
		</footer>
		<!-- /Main footer -->

		<!-- Scripts -->
		<script src="js/navigation.js"></script>

		<!-- Bootstrap scripts -->
		<!--
		<script src="js/bootstrap/bootstrap-tooltip.js"></script>
		<script src="js/bootstrap/bootstrap-dropdown.js"></script>
		<script src="js/bootstrap/bootstrap-button.js"></script>
		<script src="js/bootstrap/bootstrap-alert.js"></script>
		<script src="js/bootstrap/bootstrap-popover.js"></script>
		<script src="js/bootstrap/bootstrap-collapse.js"></script>
		<script src="js/bootstrap/bootstrap-transition.js"></script>
		-->
		<script src="js/bootstrap/bootstrap.min.js"></script>

		<!-- jQuery Flot Charts -->
		<!--[if lte IE 8]>
			<script language="javascript" type="text/javascript" src="js/plugins/flot/excanvas.min.js"></script>
		<![endif]-->

		<script src="js/plugins/flot/jquery.flot.js"></script>
		
		<script>
			$(document).ready(function() {
			
				// Demo #1
				// we use an inline data source in the example, usually data would be fetched from a server
				var data = [], totalPoints = 300;
				function getRandomData() {
					if (data.length > 0)
						data = data.slice(1);
				
					// do a random walk
					while (data.length < totalPoints) {
						var prev = data.length > 0 ? data[data.length - 1] : 50;
						var y = prev + Math.random() * 10 - 5;
						if (y < 0)
							y = 0;
						if (y > 100)
							y = 100;
						data.push(y);
					}
				
					// zip the generated y values with the x values
					var res = [];
					for (var i = 0; i < data.length; ++i)
						res.push([i, data[i]])
					return res;
				}
				
				// setup control widget
				var updateInterval = 80;
				$("#updateInterval").val(updateInterval).change(function () {
					var v = $(this).val();
					if (v && !isNaN(+v)) {
						updateInterval = +v;
					if (updateInterval < 1)
						updateInterval = 1;
					if (updateInterval > 2000)
						updateInterval = 2000;
					$(this).val("" + updateInterval);
					}
				});
				
				// setup plot
				var options = {
					series: { color: '#389abe' }, // drawing is faster without shadows
					yaxis: { min: 0, max: 100 },
					xaxis: { show: false },
					grid: { backgroundColor: 'transparent', color: '#b2b2b2', borderColor: '#e7e7e7', borderWidth: 1 }
				};
				var plot = $.plot($("#demo-1"), [ getRandomData() ], options);
				
				function update() {
					plot.setData([ getRandomData() ]);
					// since the axes don't change, we don't need to call plot.setupGrid()
					plot.draw();
					setTimeout(update, updateInterval);
				}
				
				update();
			
			});
		</script>
		
		<!-- Block TODO list -->
		<script>
			$(document).ready(function() {
				
				$('.todo-block input[type="checkbox"]').click(function(){
					$(this).closest('tr').toggleClass('done');
				});
				$('.todo-block input[type="checkbox"]:checked').closest('tr').addClass('done');
				
			});
		</script>
		
		<!-- jQuery FullCalendar -->
		<script src="js/plugins/fullCalendar/jquery.fullcalendar.min.js"></script>
		
		<script>
			$(document).ready(function() {
			
				var date = new Date();
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();
				
				$('.fullcalendar').fullCalendar({
					header: {
						left: 'title',
						center: '',
						right: 'today month,basicWeek prev,next'
					},
					buttonText: {
						prev: '<span class="icon-chevron-left"></span>',
						next: '<span class="icon-chevron-right"></span>'
					},
					editable: true,
					events: [
						{
							title: 'All Day Event',
							start: new Date(y, m, 1)
						},
						{
							title: 'Long Event',
							start: new Date(y, m, d-5),
							end: new Date(y, m, d-2),
							className: 'event-red'
						},
						{
							id: 999,
							title: 'Repeating Event',
							start: new Date(y, m, d-3, 16, 0),
							allDay: false,
							className: 'event-yellow'
						},
						{
							id: 999,
							title: 'Repeating Event',
							start: new Date(y, m, d+4, 16, 0),
							allDay: false,
							className: 'event-green'
						},
						{
							title: 'Meeting',
							start: new Date(y, m, d, 10, 30),
							allDay: false,
							className: 'event-blue'
						},
						{
							title: 'Lunch',
							start: new Date(y, m, d, 12, 0),
							end: new Date(y, m, d, 14, 0),
							allDay: false,
							className: 'event-red'
						},
						{
							title: 'Birthday Party',
							start: new Date(y, m, d+1, 19, 0),
							end: new Date(y, m, d+1, 22, 30),
							allDay: false,
							className: 'event-green'
						},
						{
							title: 'Walking Pixels website',
							start: new Date(y, m, 28),
							end: new Date(y, m, 29),
							url: 'http://www.walkingpixels.com/',
							className: 'event-black'
						}
					]
				});
				
			});
		</script>
		
		<!-- jQuery jGrowl -->

		
		<!-- jQuery SparkLines -->
		<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
		
		<script>
			$(document).ready(function() {
			
				// Sample line chart
				$('.sparkline.line').sparkline('html', {
					height: '45px',
					width: '90px',
					lineColor: '#6CC84C',
					fillColor: '#b1dfa1',
					spotColor: '#3a87ad',
					minSpotColor: false,
					maxSpotColor: false,
					spotRadius: 3
				});
				
				// Sample bar chart
				$('.sparkline.bar').sparkline([17, 23, 18, 14, 18, 19, 13], {
					type: 'bar',
					height: '45px',
					barWidth: '8px',
					barColor: '#3a87ad',
					tooltipFormat: '{{offset:names}}: {{value}} orders',
					tooltipValueLookups: {
					names: {
						0: 'Monday',
						1: 'Tuesday',
						2: 'Wednesday',
						3: 'Thursday',
						4: 'Friday',
						5: 'Saturday',
						6: 'Sunday'
						}
					}
				});
				
			});
		</script>

		<!-- Page slide plugin -->
		<script src="js/plugins/pageSlide/jquery.pageslide.min.js"></script>

	</body>
</html>
