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
		<title><?php echo $title_prefix; ?>Hub</title>
		<meta name="description" content="">
		<meta name="author" content="Walking Pixels | www.walkingpixels.com">
		<meta name="robots" content="index, follow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- jQuery TagsInput Styles -->
		<link rel='stylesheet' type='text/css' href='css/plugins/jquery.tagsinput.css'>
		
		<!-- jQuery jWYSIWYG Styles -->
		<link rel='stylesheet' type='text/css' href='css/plugins/jquery.jwysiwyg.css'>
		
		<!-- Bootstrap wysihtml5 Styles -->
		<link rel='stylesheet' type='text/css' href='css/plugins/bootstrap-wysihtml5.css'>

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
			$(document).ready(function(){
				
				// Tabs
				$('.demoTabs a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
				})

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
				
						<!-- Page container -->
						<section class="page-container" role="main">

							<!-- Nav slide button -->
							<a class="nav-slide" href="#nav">
								<span class="icon-align-justify"></span>
							</a>
							
							<!-- Breadcrumbs -->
							<ul class="breadcrumb">
								<li><a href="#"><span class="icon-home"></span> Home</a> <span class="icon-chevron-right"></span></li>
								<li class="active">Hub</li>
							</ul>
							<!-- Breadcrumbs -->
						
							
							<!-- Grid row -->
							<div class="row-fluid">
							
								<!-- Data (buttons) block -->
								<article class="span12 data-block tabbed-block highlight highlight-red">
									<div class="data-container">
										<header>
											<h2>HUB</h2>
											<ul class="data-header-actions tabs">
												<li class="demoTabs active"><a href="#horizontal">Detnat HUB</a></li>
											</ul>
										</header>

										<!-- Tab content -->
										<section class="tab-content">
													
											<!-- Tab #horizontal -->
											<div class="tab-pane fade in active" id="horizontal">
											
												<!-- Grid row -->
												<div class="row-fluid">

													<article class="span12 data-block data-block-alt">
														<div class="data-container">

															<section>
																<form class="form-horizontal">
																	<fieldset>
																		<legend>Boot</legend>
																		<div class="control-group">
																			<label class="control-label" for="input">Target IP</label>
																			<div class="controls">
																				<input id="input" class="input-xlarge" type="text">
																				<p class="help-block">The IP to flood</p>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="input">Port</label>
																			<div class="controls">
																				<input id="input" class="input-xlarge" type="text">
																				<p class="help-block">The port to flood</p>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="input">Time</label>
																			<div class="controls">
																				<input id="input" class="input-xlarge" type="text">
																				<p class="help-block">How long should we attack</p>
																			</div>
																		</div>																		
																		<div class="control-group">
																			<label class="control-label" for="select">Method</label>
																			<div class="controls">
																				<select id="select">
																					<option>UDP</option>
																					<option>SSYN</option>
																					<option>ESSYN</option>
																					<option>HEAD</option>
																					<option>RUDY</option>
																					<option>ARME</option>
																					<option>SLOW</option>
																					<option>POST</option>
																					<option>GET</option>
																				</select>
																			</div>
																		</div>
																		<div class="form-actions">
																			<button class="btn btn-alt btn-large btn-primary" type="submit">Send Attack</button>
																		</div>
																	</fieldset>
																</form>
															</section>

														</div>
													</article>

												</div>
												<!-- /Grid row -->

											</div>
											<!-- Tab #horizontal -->
												
										</section>
										<!-- /Tab content -->

									</div>
								<article>
								<!-- /Data (buttons) block -->

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
		<script src="js/bootstrap/bootstrap.min.js"></script>
		
		<!-- Fileupload and Inputmask plugin -->
		<script src="js/plugins/fileupload/bootstrap-fileupload.js"></script>
		<script src="js/plugins/inputmask/bootstrap-inputmask.js"></script>
		
		<!-- jQuery TagsInput -->
		<script src="js/plugins/tagsInput/jquery.tagsinput.min.js"></script>
		
		<script>
			$(document).ready(function() {
			
				$('.tagsinput').tagsInput();
			
			});
		</script>
		
		<!-- jQuery jWYSIWYG -->
		<script src="js/plugins/jWYSIWYG/jquery.wysiwyg.js"></script>
		
		<script>
			$(document).ready(function() {
				
				$('.wysiwyg').wysiwyg({
					controls: {
						bold          : { visible : true },
						italic        : { visible : true },
						underline     : { visible : true },
						strikeThrough : { visible : true },
						
						justifyLeft   : { visible : true },
						justifyCenter : { visible : true },
						justifyRight  : { visible : true },
						justifyFull   : { visible : true },
			
						indent  : { visible : true },
						outdent : { visible : true },
			
						subscript   : { visible : true },
						superscript : { visible : true },
						
						undo : { visible : true },
						redo : { visible : true },
						
						insertOrderedList    : { visible : true },
						insertUnorderedList  : { visible : true },
						
						cut   : { visible : true },
						copy  : { visible : true },
						paste : { visible : true },
						
						code : { visible : false }
					},
					events: {
						click: function(event) {
							if ($("#click-inform:checked").length > 0) {
								event.preventDefault();
								alert("You have clicked jWysiwyg content!");
							}
						}
					}
				});
				
			});
		</script>
		
		<!-- Wysihtml5 -->
		<script src="js/plugins/wysihtml5/wysihtml5-0.3.0.js"></script>
		<script src="js/plugins/wysihtml5/bootstrap-wysihtml5.js"></script>
		
		<script>
			$(document).ready(function() {
				
				$('.wysihtml5').wysihtml5();
				
			});
		</script>
		
		<!-- Colorpicker -->
		<script src="js/plugins/colorpicker/bootstrap-colorpicker.js"></script>
		
		<script>
			$(document).ready(function() {
				
				var preview = $('.colorpicker-preview')[0].style;
				$('.colorpicker').colorpicker().on('changeColor', function(ev){
					preview.backgroundColor = ev.color.toHex();
				});
				
			});
		</script>
		
		<!-- Datepicker -->
		<script src="js/plugins/datepicker/bootstrap-datepicker.js"></script>
		
		<script>
			$(document).ready(function() {
				
				$('.datepicker').datepicker();
				
			});
		</script>
		
		<!-- Page slide plugin -->
		<script src="js/plugins/pageSlide/jquery.pageslide.min.js"></script>

	</body>
</html>