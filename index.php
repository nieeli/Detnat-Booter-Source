old	new	
...	...	@@ -0,0 +1,515 @@
	1	+<?php
	2	+ob_start();
	3	+require_once 'includes/db.php';
	4	+require_once 'includes/init.php';
	5	+if (!($user -> LoggedIn()))
	6	+{
	7	+	header('location: login.php');
	8	+	die();
	9	+}
	10	+if (!($user->hasMembership($odb)))
	11	+{
	12	+	header('location: purchase.php');
	13	+	die();
	14	+}
	15	+if (!($user -> notBanned($odb)))
	16	+{
	17	+	header('location: login.php');
	18	+	die();
	19	+}
	20	+?>
	21	+
	22	+<!DOCTYPE html>
	23	+<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
	24	+<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
	25	+<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	26	+	<head>
	27	+		<meta charset="utf-8">
	28	+		<title><?php echo $bootername; ?>Dashboard</title>
	29	+		<meta name="description" content="">
	30	+		<meta name="author" content="Walking Pixels | www.walkingpixels.com">
	31	+		<meta name="robots" content="index, follow">
	32	+		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	33	+
	34	+		<!-- jQuery FullCalendar Styles -->
	35	+		<link rel='stylesheet' type='text/css' href='css/plugins/jquery.fullcalendar.css'>
	36	+		
	37	+		<!-- jQuery jGrowl Styles -->
	38	+		<link rel='stylesheet' type='text/css' href='css/plugins/jquery.jgrowl.css'>
	39	+
	40	+		<!-- Style -->
	41	+		<link rel="stylesheet" href="css/lindworm-blue.css">
	42	+		
	43	+		<!-- Favicon -->
	44	+		<link rel="shortcut icon" href="favicon.ico">
	45	+		
	46	+		<!-- JS Libs -->
	47	+		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	48	+		<script>window.jQuery || document.write('<script src="js/libs/jquery.js"><\/script>')</script>
	49	+		<script src="js/libs/modernizr.js"></script>
	50	+		<script src="js/libs/selectivizr.js"></script>
	51	+
	52	+		<script>
	53	+			$(document).ready(function() {
	54	+
	55	+				// Sidebar slide
	56	+				$('.nav-slide').pageslide();
	57	+				$(window).resize(function() {
	58	+					$.pageslide.close();
	59	+				});
	60	+
	61	+				// Tooltips
	62	+				$('.user-profile-actions li a').tooltip({
	63	+					placement: 'bottom'
	64	+				});
	65	+
	66	+			});
	67	+		</script>
	68	+		
	69	+	<body>
	70	+	
	71	+		<!-- Wrap all page content for sticky footer -->
	72	+		<div id="wrapper">
	73	+			
	74	+			<!-- Main page container -->
	75	+			<div class="container">
	76	+	
	77	+				<!-- Secondary navigation -->
	78	+				<ul class="secondary-navigation">
	79	+					<li><a href="#">Settings</a>
	80	+					<li><a href="#">Logout</a>
	81	+				</ul>
	82	+				<!-- /Secondary navigation -->
	83	+	
	84	+				<!-- Container style -->
	85	+				<div class="container-inner">
	86	+	
	87	+					<!-- Left (navigation) side -->
	88	+<?php include('sidebar.php'); ?>
	89	+					<!-- /Left (navigation) side -->
	90	+					
	91	+					<!-- Right (content) side -->
	92	+					<!-- Main content -->
	93	+					<div class="content">
	94	+					
	95	+						<!-- Page header -->
	96	+						<header class="page-header">
	97	+
	98	+							<!-- Slide btn for sidebar navigation -->
	99	+							<a class="nav-slide" href="#nav">
	100	+								<span class="icon-align-justify"></span>
	101	+							</a>
	102	+
	103	+							<h1>Welcome, <?php echo htmlentities($_SESSION['username']); ?>!</h1>
	104	+							<p>Welcome to Detnat booter source. If you have any questions you can open a support ticket on our sales website found here: http://hostcookie.me/panel</p>
	105	+						</header>
	106	+						<!-- /Page header -->
	107	+						
	108	+						<!-- Page container -->
	109	+						<section class="page-container" role="main">
	110	+						
	111	+							<!-- Breadcrumbs -->
	112	+							<ul class="breadcrumb">
	113	+								<li><a href="#"><span class="icon-home"></span> Home</a> <span class="icon-chevron-right"></span></li>
	114	+								<li><a href="#"><?php echo $name; ?></a> <span class="icon-chevron-right"></span></li>
	115	+								<li class="active">Dashboard</li>
	116	+							</ul>
	117	+							<!-- Breadcrumbs -->
	118	+							
	119	+							<!-- Grid row -->
	120	+							<div class="row">
	121	+							
	122	+								<!-- Data block -->
	123	+								<article class="span12 data-block">
	124	+									<div class="data-container">
	125	+										<section>
	126	+											
	127	+											
	128	+											<!-- Widgets -->
	129	+											<ul class="widgets">
	130	+												<li>
	131	+														<span class="widget-label">Estimated power</span>
	132	+														<strong>4Gbps</strong>
	133	+												</li>
	134	+												<li>
	135	+														<span class="widget-label">Total Boots</span>
	136	+														<strong><?php echo $stats -> totalBoots($odb); ?></strong>
	137	+												</li>
	138	+												<li>
	139	+														<span class="widget-label">Total Users</span>
	140	+														<strong><?php echo $stats -> totalUsers($odb); ?></strong>
	141	+												</li>
	142	+												<li>
	143	+														<span class="widget-label">Boots Running</span>
	144	+														<strong><?php echo $stats -> runningBoots($odb); ?></strong>
	145	+												</li>
	146	+											</ul>
	147	+											<!-- /Widgets -->
	148	+											
	149	+											<p>We try to keep a uptime percentage of >95%.</p>
	150	+											
	151	+										</section>
	152	+									</div>
	153	+								</article>
	154	+								<!-- /Data block -->
	155	+								
	156	+							</div>
	157	+							<!-- /Grid row -->
	158	+	
	159	+							<!-- Grid row -->
	160	+							<div class="row">
	161	+							
	162	+								<!-- Data block -->
	163	+								<article class="span4 data-block data-block-alt highlight highlight-green">
	164	+									<div class="data-container">
	165	+										<header>
	166	+											<h2><span class="icon-signal"></span> Statistics</h2>
	167	+										</header>
	168	+										<section>
	169	+											<ul class="stats">
	170	+												<li>
	171	+													<strong class="stats-count"><?php echo $stats -> totalBootsForUser($odb, $_SESSION['username']); ?></strong>
	172	+													<p>Your total boots</p>
	173	+												</li>
	174	+											</ul>
	175	+										</section>
	176	+									</div>
	177	+								</article>
	178	+								<!-- /Data block -->
	179	+								
	180	+								<!-- Data block -->
	181	+								<article class="span4 data-block data-block-alt highlight todo-block">
	182	+									<div class="data-container">
	183	+										<header>
	184	+											<h2><span class="icon-edit"></span> Upcoming updates</h2>
	185	+										</header>
	186	+										<section>
	187	+											<form>
	188	+												<table class="table">
	189	+													<tbody>
	190	+														<tr>
	191	+															<td></td>
	192	+															<td>
	193	+																<p>Upgrade network protection</p>
	194	+															</td>
	195	+														</tr>
	196	+														<tr>
	197	+															<td></td>
	198	+															<td>
	199	+																<p>Improve configuration panel</p>
	200	+															</td>
	201	+														</tr>
	202	+													</tbody>
	203	+												</table>
	204	+											</form>
	205	+										</section>
	206	+									</div>
	207	+								</article>
	208	+								<!-- /Data block -->
	209	+								
	210	+								<!-- Data block -->
	211	+								<article class="span4 data-block-alt data-block">
	212	+									<div class="data-container">
	213	+										<header>
	214	+											<h2><span class="icon-refresh"></span> News</h2>									
	215	+										</header>
	216	+										<section>
	217	+											<div id="accordion1" class="accordion">
	218	+												<div class="accordion-group">
	219	+													<div class="accordion-heading">
	220	+														<a class="accordion-toggle" href="#collapseOne" data-parent="#accordion1" data-toggle="collapse"> 7/05/2013 <span class="caret"></span></a>
	221	+													</div>
	222	+													<div id="collapseOne" class="accordion-body collapse">
	223	+														<div class="accordion-inner">ChemDDOS Protection is now launched.</div>
	224	+													</div>
	225	+												</div>
	226	+											</div>
	227	+										</section>
	228	+									</div>
	229	+								</article>
	230	+								<!-- /Data block -->
	231	+								
	232	+							</div>
	233	+							<!-- /Grid row -->
	234	+	
	235	+							<div class="alert alert-info fade in">
	236	+								<button class="close" data-dismiss="alert">&times;</button>
	237	+								<strong>Info!</strong> You can submit a support ticket here: http://hostcookie.me/panel.
	238	+							</div>
	239	+	
	240	+							<!-- Grid row -->
	241	+							<div class="row">
	242	+								
	243	+								<!-- Data block -->
	244	+
	245	+								<!-- /Data block -->
	246	+								
	247	+								<!-- Data block -->
	248	+								<article class="span8 data-block">
	249	+									<div class="data-container">
	250	+										<section>
	251	+											<div class='fullcalendar'></div>
	252	+										</section>
	253	+									</div>
	254	+								</article>
	255	+								<!-- /Data block -->
	256	+								
	257	+							</div>
	258	+							<!-- /Grid row -->
	259	+							
	260	+						</section>
	261	+						<!-- /Page container -->
	262	+						
	263	+					</div>
	264	+					<!-- /Main content -->
	265	+					<!-- /Right (content) side -->
	266	+					
	267	+				</div>
	268	+				<!-- /Container style -->
	269	+				
	270	+			</div>
	271	+			<!-- /Main page container -->
	272	+			
	273	+			<!-- Push space for footer -->
	274	+			<div id="push"></div>
	275	+			
	276	+		</div>
	277	+		<!-- /Wrap all page content for sticky footer -->
	278	+		
	279	+		<!-- Main footer -->
	280	+		<footer id="footer">
	281	+			<ul>
	282	+				<li>Built with love on <a href="http://twitter.github.com/bootstrap/">Twitter Bootstrap</a> by <a href="http://www.walkingpixels.com/">Walking Pixels</a>.</li>
	283	+				<li><a href="#">Blog</a></li>
	284	+				<li><a href="#">Documentation</a></li>
	285	+				<li><a href="#">Support</a></li>
	286	+			</ul>
	287	+		</footer>
	288	+		<!-- /Main footer -->
	289	+
	290	+		<!-- Scripts -->
	291	+		<script src="js/navigation.js"></script>
	292	+
	293	+		<!-- Bootstrap scripts -->
	294	+		<!--
	295	+		<script src="js/bootstrap/bootstrap-tooltip.js"></script>
	296	+		<script src="js/bootstrap/bootstrap-dropdown.js"></script>
	297	+		<script src="js/bootstrap/bootstrap-button.js"></script>
	298	+		<script src="js/bootstrap/bootstrap-alert.js"></script>
	299	+		<script src="js/bootstrap/bootstrap-popover.js"></script>
	300	+		<script src="js/bootstrap/bootstrap-collapse.js"></script>
	301	+		<script src="js/bootstrap/bootstrap-transition.js"></script>
	302	+		-->
	303	+		<script src="js/bootstrap/bootstrap.min.js"></script>
	304	+
	305	+		<!-- jQuery Flot Charts -->
	306	+		<!--[if lte IE 8]>
	307	+			<script language="javascript" type="text/javascript" src="js/plugins/flot/excanvas.min.js"></script>
	308	+		<![endif]-->
	309	+
	310	+		<script src="js/plugins/flot/jquery.flot.js"></script>
	311	+		
	312	+		<script>
	313	+			$(document).ready(function() {
	314	+			
	315	+				// Demo #1
	316	+				// we use an inline data source in the example, usually data would be fetched from a server
	317	+				var data = [], totalPoints = 300;
	318	+				function getRandomData() {
	319	+					if (data.length > 0)
	320	+						data = data.slice(1);
	321	+				
	322	+					// do a random walk
	323	+					while (data.length < totalPoints) {
	324	+						var prev = data.length > 0 ? data[data.length - 1] : 50;
	325	+						var y = prev + Math.random() * 10 - 5;
	326	+						if (y < 0)
	327	+							y = 0;
	328	+						if (y > 100)
	329	+							y = 100;
	330	+						data.push(y);
	331	+					}
	332	+				
	333	+					// zip the generated y values with the x values
	334	+					var res = [];
	335	+					for (var i = 0; i < data.length; ++i)
	336	+						res.push([i, data[i]])
	337	+					return res;
	338	+				}
	339	+				
	340	+				// setup control widget
	341	+				var updateInterval = 80;
	342	+				$("#updateInterval").val(updateInterval).change(function () {
	343	+					var v = $(this).val();
	344	+					if (v && !isNaN(+v)) {
	345	+						updateInterval = +v;
	346	+					if (updateInterval < 1)
	347	+						updateInterval = 1;
	348	+					if (updateInterval > 2000)
	349	+						updateInterval = 2000;
	350	+					$(this).val("" + updateInterval);
	351	+					}
	352	+				});
	353	+				
	354	+				// setup plot
	355	+				var options = {
	356	+					series: { color: '#389abe' }, // drawing is faster without shadows
	357	+					yaxis: { min: 0, max: 100 },
	358	+					xaxis: { show: false },
	359	+					grid: { backgroundColor: 'transparent', color: '#b2b2b2', borderColor: '#e7e7e7', borderWidth: 1 }
	360	+				};
	361	+				var plot = $.plot($("#demo-1"), [ getRandomData() ], options);
	362	+				
	363	+				function update() {
	364	+					plot.setData([ getRandomData() ]);
	365	+					// since the axes don't change, we don't need to call plot.setupGrid()
	366	+					plot.draw();
	367	+					setTimeout(update, updateInterval);
	368	+				}
	369	+				
	370	+				update();
	371	+			
	372	+			});
	373	+		</script>
	374	+		
	375	+		<!-- Block TODO list -->
	376	+		<script>
	377	+			$(document).ready(function() {
	378	+				
	379	+				$('.todo-block input[type="checkbox"]').click(function(){
	380	+					$(this).closest('tr').toggleClass('done');
	381	+				});
	382	+				$('.todo-block input[type="checkbox"]:checked').closest('tr').addClass('done');
	383	+				
	384	+			});
	385	+		</script>
	386	+		
	387	+		<!-- jQuery FullCalendar -->
	388	+		<script src="js/plugins/fullCalendar/jquery.fullcalendar.min.js"></script>
	389	+		
	390	+		<script>
	391	+			$(document).ready(function() {
	392	+			
	393	+				var date = new Date();
	394	+				var d = date.getDate();
	395	+				var m = date.getMonth();
	396	+				var y = date.getFullYear();
	397	+				
	398	+				$('.fullcalendar').fullCalendar({
	399	+					header: {
	400	+						left: 'title',
	401	+						center: '',
	402	+						right: 'today month,basicWeek prev,next'
	403	+					},
	404	+					buttonText: {
	405	+						prev: '<span class="icon-chevron-left"></span>',
	406	+						next: '<span class="icon-chevron-right"></span>'
	407	+					},
	408	+					editable: true,
	409	+					events: [
	410	+						{
	411	+							title: 'All Day Event',
	412	+							start: new Date(y, m, 1)
	413	+						},
	414	+						{
	415	+							title: 'Long Event',
	416	+							start: new Date(y, m, d-5),
	417	+							end: new Date(y, m, d-2),
	418	+							className: 'event-red'
	419	+						},
	420	+						{
	421	+							id: 999,
	422	+							title: 'Repeating Event',
	423	+							start: new Date(y, m, d-3, 16, 0),
	424	+							allDay: false,
	425	+							className: 'event-yellow'
	426	+						},
	427	+						{
	428	+							id: 999,
	429	+							title: 'Repeating Event',
	430	+							start: new Date(y, m, d+4, 16, 0),
	431	+							allDay: false,
	432	+							className: 'event-green'
	433	+						},
	434	+						{
	435	+							title: 'Meeting',
	436	+							start: new Date(y, m, d, 10, 30),
	437	+							allDay: false,
	438	+							className: 'event-blue'
	439	+						},
	440	+						{
	441	+							title: 'Lunch',
	442	+							start: new Date(y, m, d, 12, 0),
	443	+							end: new Date(y, m, d, 14, 0),
	444	+							allDay: false,
	445	+							className: 'event-red'
	446	+						},
	447	+						{
	448	+							title: 'Birthday Party',
	449	+							start: new Date(y, m, d+1, 19, 0),
	450	+							end: new Date(y, m, d+1, 22, 30),
	451	+							allDay: false,
	452	+							className: 'event-green'
	453	+						},
	454	+						{
	455	+							title: 'Walking Pixels website',
	456	+							start: new Date(y, m, 28),
	457	+							end: new Date(y, m, 29),
	458	+							url: 'http://www.walkingpixels.com/',
	459	+							className: 'event-black'
	460	+						}
	461	+					]
	462	+				});
	463	+				
	464	+			});
	465	+		</script>
	466	+		
	467	+		<!-- jQuery jGrowl -->
	468	+
	469	+		
	470	+		<!-- jQuery SparkLines -->
	471	+		<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
	472	+		
	473	+		<script>
	474	+			$(document).ready(function() {
	475	+			
	476	+				// Sample line chart
	477	+				$('.sparkline.line').sparkline('html', {
	478	+					height: '45px',
	479	+					width: '90px',
	480	+					lineColor: '#6CC84C',
	481	+					fillColor: '#b1dfa1',
	482	+					spotColor: '#3a87ad',
	483	+					minSpotColor: false,
	484	+					maxSpotColor: false,
	485	+					spotRadius: 3
	486	+				});
	487	+				
	488	+				// Sample bar chart
	489	+				$('.sparkline.bar').sparkline([17, 23, 18, 14, 18, 19, 13], {
	490	+					type: 'bar',
	491	+					height: '45px',
	492	+					barWidth: '8px',
	493	+					barColor: '#3a87ad',
	494	+					tooltipFormat: '{{offset:names}}: {{value}} orders',
	495	+					tooltipValueLookups: {
	496	+					names: {
	497	+						0: 'Monday',
	498	+						1: 'Tuesday',
	499	+						2: 'Wednesday',
	500	+						3: 'Thursday',
	501	+						4: 'Friday',
	502	+						5: 'Saturday',
	503	+						6: 'Sunday'
	504	+						}
	505	+					}
	506	+				});
	507	+				
	508	+			});
	509	+		</script>
	510	+
	511	+		<!-- Page slide plugin -->
	512	+		<script src="js/plugins/pageSlide/jquery.pageslide.min.js"></script>
	513	+
	514	+	</body>
	515	+</html>
