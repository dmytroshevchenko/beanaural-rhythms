<?php
	error_reporting( E_ALL );
	
	require_once( 'config.php' );
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Audio Mixer</title>

    <!-- Bootstrap -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">		
		<link rel="stylesheet" href="css/select-theme-chosen.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css">	
		<link href="//fonts.googleapis.com/css?family=Raleway:300,600|Open+Sans:300,400,700|Roboto:300" rel="stylesheet">		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
		<!-- Latest compiled and minified JavaScript -->
		<!-- <script src="//cdn.numerologist.com/silver-solutions/____/js/metrics-init-min.js"></script> -->
		<!-- <script src="//cdn.numerologist.com/silver-solutions/js/metrics-min.js"></script>		 -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.html5loader/1.8.0/jquery.html5Loader.min.js"></script>
		<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script> -->
		<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.min.js"></script> -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.4.1/packaged/jquery.noty.packaged.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/jplayer/jquery.jplayer.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.3/js.cookie.min.js"></script> -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
		<script src="js/select-min.js"></script>		
		<script>
			window.maxFileSize = <?php echo MAX_AUDIO_SIZE; ?>;
		</script>
		<script src="js/functions.js?ver=<?php echo rand(  ); ?>"></script>
		<script src="js/app.js?ver=<?php echo rand(  ); ?>"></script>		
		<link href="//cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" rel="stylesheet">
		<script src="//cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
		<link href="css/app.css?ver=<?php echo rand(  ); ?>" rel="stylesheet">
  
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
		<!-- <style type="text/css"> -->

		<!-- </style>		 -->
		<!-- <script src="//cdn.optimizely.com/js/64607647.js" async></script> -->
  </head>
  <body class="fadeIn animated">
		<!-- <noscript><iframe height=0 src="https://www.googletagmanager.com/ns.html?id=GTM-K56LND"style=display:none;visibility:hidden width=0></iframe></noscript> -->
		<!-- Header -->		
		<div id="header">
			<!-- <div id="header_space_DIV_1"> </div>		 -->
			<div id="header-outer" class="header-wrapper">
				<div id="header_DIV_2">
					<div id="header_DIV_3">
						<div id="header_DIV_4">
							<div id="header_DIV_5">
								<div id="header_DIV_6">
									<form action="http://numerologist.com/portal" method="GET" id="header_FORM_7">
										<input type="text" name="s" id="header_INPUT_8" value="Start Typing..." />
									</form>
								</div>
								<!--/span_12-->

							</div>
							<!--/search-box-->

							<div id="header_DIV_9">
								<a href="#" id="header_A_10"><span id="header_SPAN_11"></span></a>
							</div>
						</div>
						<!--/container-->

					</div>
					<!--/search-->

				</div>
				<!--/search-outer-->

				<header id="header_HEADER_12">
					<div id="header_DIV_13">
						<div id="header_DIV_14">
							<div id="header_DIV_15">
								 <a id="header_A_16" href="http://numerologist.com/portal"><img alt="Numerologist.com" src="http://media.numerologist.com/uploads/2016/02/05192215/PastedGraphic-2.jpg" id="header_IMG_17" /><img alt="Numerologist.com" src="http://media.numerologist.com/uploads/2016/02/05192215/PastedGraphic-2.jpg" id="header_IMG_18" /></a>
							</div>
							<!--/span_3-->

							<div id="header_DIV_19">
								 <a href="#mobilemenu" id="header_A_20"><i id="header_I_21"></i></a>
								<nav id="header_NAV_22">
									<!--
									<ul id="header_UL_23">
										<li id="header_LI_24">
											<div id="header_DIV_25">
												<a href="#searchbox" id="header_A_26"><span id="header_SPAN_27"></span></a>
											</div>
										</li>
									</ul>
									-->
									<ul id="header_UL_28">
										<li id="header_LI_29">
											<a href="#" id="header_A_30">Home</a>
										</li>
										<li id="header_LI_31">
											<a href="#" id="header_A_32">About</a>
										</li>
										<li id="header_LI_33">
											<a href="#" id="header_A_34">Reviews</a>
										</li>
										<li id="header_LI_35">
											<a href="#" id="header_A_36">Training<!--<span id="header_SPAN_37"><i id="header_I_38"></i></span>--></a>
											<ul id="header_UL_39">
												<li id="header_LI_40">
													<a href="#" id="header_A_41">Calculating Your #1 Core Number: The Life Path Number</a>
												</li>
												<li id="header_LI_42">
													<a href="#" id="header_A_43">Calculating Your #2 Core Number: The Expression Number</a>
												</li>
												<li id="header_LI_44">
													<a href="#" id="header_A_45">Calculating Your #3 Core Number: The Soul Urge Number</a>
												</li>
												<li id="header_LI_46">
													<a href="#" id="header_A_47">Discover Numerology</a>
												</li>
												<li id="header_LI_48">
													<a href="#" id="header_A_49">Create Your Own Astrology Natal Chart</a>
												</li>
											</ul>
										</li>
										<li id="header_LI_50">
											<a href="#" id="header_A_51">Products</a>
										</li>
										<li id="header_LI_52">
											<a href="#" id="header_A_53">Contact</a>
										</li>
										<li id="header_LI_54">
											<a href="#" id="header_A_55">Blog<!--<span id="header_SPAN_56"><i id="header_I_57"></i></span>--></a>
											<ul id="header_UL_58">
												<li id="header_LI_59">
													<a href="#" id="header_A_60">Numerology</a>
												</li>
												<li id="header_LI_61">
													<a href="#" id="header_A_62">Predictions &amp; Forecasts</a>
												</li>
												<li id="header_LI_63">
													<a href="#" id="header_A_64">Career &amp; Wealth</a>
												</li>
												<li id="header_LI_65">
													<a href="#" id="header_A_66">Health &amp; Well-Being</a>
												</li>
												<li id="header_LI_67">
													<a href="#" id="header_A_68">Love &amp; Relationships</a>
												</li>
												<li id="header_LI_69">
													<a href="#" id="header_A_70">Personal Growth &amp; Success</a>
												</li>
												<li id="header_LI_71">
													<a href="#" id="header_A_72">Astrology</a>
												</li>
												<li id="header_LI_73">
													<a href="#" id="header_A_74">Divination</a>
												</li>
												<li id="header_LI_75">
													<a href="#" id="header_A_76">Tarot</a>
												</li>
											</ul>
										</li>
									</ul>
								</nav>
							</div>
							<!--/span_9-->

						</div>
						<!--/row-->

					</div>
					<!--/container-->

				</header>
				<div id="header_DIV_77">
				</div>
			</div>		
		</div>		
		<!-- END Header -->	
	
		<div class="container-fluid">
			<div id="form-container" class="row">
				<div class="row-height">
					<div class="col-height col-middle">
						<div id="main-container">	
							<div id="bg">
								<div id="main-bg"> </div>
							</div>   
							<div id="main-header-container" class="outer-header-container">
								<div class="inner-header-container">
									<div class="header-container">								
										<h1 class="main-header">Audio Mixer</h1>
										<!-- <p class="main-description"> -->
											<!-- <span>____</span> -->
											<!-- <br/> -->
											<!-- <span>____</span> -->
										<!-- </p>										 -->
									</div>
								</div> 
							</div>  
													
							<div id="main-form-container">
								<form id="user-form" name="user-form" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" action="" method="post" enctype="multipart/form-data">
									<div id="inner-form-container" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">																								
										<div id="categories-outer-box" class="form-group col-xs-12 col-md-12">
											<div id="categories-box" class="form-group col-xs-12 col-md-4 categories">
												<label for="categories" class="control-label">Choose Category</label>
												<select id="categories" name="categories" class="form-control">
													<!-- <option value="meditation-relaxation">Meditation & Relaxation</option> -->
												</select>
											</div>										
										</div>										
										
										<div id="binaural-beats-box" class="form-group col-xs-12 col-md-4 binaural-beats">
											<h5 class="secondary-header">Choose Binaural Beats</h5>
											
											<!-- <div class="music-box"> -->
												<!-- <span data-music-name="binaural-beat-1.mp3" data-music-type="binaural-beat" class="glyphicon glyphicon-play listening-btn" aria-hidden="true"></span>  -->
												<!-- <div class="radio-inline"> -->
													<!-- <label> -->
														<!-- <input type="radio" name="binaural-beat" value="binaural-beat-1.mp3"> -->
														<!-- Binaural Beat 1 -->
													<!-- </label> -->
												<!-- </div>											 -->
											<!-- </div>									 -->
										</div>
										
										<div id="bg-music-box" class="form-group col-xs-12 col-md-4 bg-music">
											<h5 class="secondary-header">Choose Background Music</h5>
											
											<!-- <div class="music-box"> -->
												<!-- <span data-music-name="music-1.mp3" data-music-type="bg-music" class="glyphicon glyphicon-play listening-btn" aria-hidden="true"></span>  -->
												<!-- <div class="radio-inline"> -->
													<!-- <label> -->
														<!-- <input type="radio" name="bg-music" value="music-1.mp3"> -->
														<!-- Music 1 -->
													<!-- </label> -->
												<!-- </div>											 -->
											<!-- </div>											 -->
										</div>										
										
										<div id="affirmations-box" class="form-group col-xs-12 col-md-4 affirmations">
											<h5 class="secondary-header">Choose Powerful Affirmations</h5>
											
											<!-- <div class="music-box"> -->
												<!-- <span data-music-name="powerful-affirmation-1.mp3" data-music-type="affirmation" class="glyphicon glyphicon-play listening-btn" aria-hidden="true"></span>  -->
												<!-- <div class="radio-inline"> -->
													<!-- <label> -->
														<!-- <input type="radio" name="affirmation" value="powerful-affirmation-1.mp3"> -->
														<!-- Powerful Affirmation 1 -->
													<!-- </label> -->
												<!-- </div>											 -->
											<!-- </div>											 -->
										</div>

										<div id="upload-box" class="form-group col-xs-12 col-md-12 zero-padding-left">
											<h4 class="secondary-header">Or Upload Your Audio</h4>	
											<div id="insert-box">
												<h5 class="secondary-header">Add loaded audio to category?</h5>
												<div class="radio-inline">
													<label>
														<input type="radio" name="add-to-category" value="0">
														No
													</label>
												</div>
												<div class="radio-inline">
													<label>
														<input type="radio" name="add-to-category" value="1">
														Yes
													</label>
												</div>												
											</div>																				
											<h5 class="secondary-header">Max Audio Size: <span id="max-audio-size"><?php echo ini_get( 'upload_max_filesize' ); ?>B</span></h5>	

											<div id="audio-upload-form">
												<!-- 100 MB -->
												<!-- <input type="hidden" name="MAX_FILE_SIZE" value="104857600"> -->
												
												<div class="form-group col-xs-12 col-md-4 audio-upload-outer-box">
													<div class="audio-upload-box">
														<input id="audio1" name="audio1" type="file" accept=".mp3" class="btn btn-default audio-upload-btn" disabled>
													</div>
													
													<div id="audio1-info-box" class="audio-info-box form-group zero-padding-left">
														<div id="audio1-category-box" class="audio-category-box form-group zero-padding-left">
															<label for="audio1-category" class="control-label">Category</label>
															<select id="audio1-category" name="audio1-category" class="form-control audio-category">
																<!-- <option value="meditation-relaxation">Meditation & Relaxation</option> -->
															</select>
														</div>	

														<div id="audio1-type-box" class="audio-type-box form-group zero-padding-left">
															<label for="audio1-type" class="control-label">Type</label>
															<select id="audio1-type" name="audio1-type" class="form-control audio-type">
																<option value="binaural-beat">Binaural Beat</option>
																<option value="bg-music">Background Music</option>
																<option value="affirmation">Affirmation</option>
															</select>
														</div>	

														<div id="audio1-name-box" class="audio-name-box form-group zero-padding-left">
															<input id="audio1-name" name="audio1-name" class="audio-name form-control" placeholder="Audio Name" type="text" autocomplete="off">
														</div>															
													</div>
												</div>
												
												<div class="form-group col-xs-12 col-md-4 audio-upload-outer-box">
													<div class="audio-upload-box">
														<input id="audio2" name="audio2" type="file" accept=".mp3" class="btn btn-default audio-upload-btn" disabled>
													</div>
													
													<div id="audio2-info-box" class="audio-info-box form-group zero-padding-left">
														<div id="audio2-category-box" class="audio-category-box form-group zero-padding-left">
															<label for="audio2-category" class="control-label">Category</label>
															<select id="audio2-category" name="audio2-category" class="form-control audio-category">
																<!-- <option value="meditation-relaxation">Meditation & Relaxation</option> -->
															</select>
														</div>	

														<div id="audio2-type-box" class="audio-type-box form-group zero-padding-left">
															<label for="audio2-type" class="control-label">Type</label>
															<select id="audio2-type" name="audio2-type" class="form-control audio-type">
																<option value="binaural-beat">Binaural Beat</option>
																<option value="bg-music">Background Music</option>
																<option value="affirmation">Affirmation</option>
															</select>
														</div>	

														<div id="audio2-name-box" class="audio-name-box form-group zero-padding-left">
															<input id="audio2-name" name="audio2-name" class="audio-name form-control" placeholder="Audio Name" type="text" autocomplete="off">
														</div>															
													</div>
												</div>
												
												<div class="form-group col-xs-12 col-md-4 audio-upload-outer-box">
													<div class="audio-upload-box">
														<input id="audio3" name="audio3" type="file" accept=".mp3" class="btn btn-default audio-upload-btn" disabled>
													</div>
													
													<div id="audio3-info-box" class="audio-info-box form-group zero-padding-left">
														<div id="audio3-category-box" class="audio-category-box form-group zero-padding-left">
															<label for="audio3-category" class="control-label">Category</label>
															<select id="audio3-category" name="audio3-category" class="form-control audio-category">
																<!-- <option value="meditation-relaxation">Meditation & Relaxation</option> -->
															</select>
														</div>	

														<div id="audio3-type-box" class="audio-type-box form-group zero-padding-left">
															<label for="audio3-type" class="control-label">Type</label>
															<select id="audio3-type" name="audio3-type" class="form-control audio-type">
																<option value="binaural-beat">Binaural Beat</option>
																<option value="bg-music">Background Music</option>
																<option value="affirmation">Affirmation</option>
															</select>
														</div>	

														<div id="audio3-name-box" class="audio-name-box form-group zero-padding-left">
															<input id="audio3-name" name="audio3-name" class="audio-name form-control" placeholder="Audio Name" type="text" autocomplete="off">
														</div>															
													</div>
												</div>
												
												<div id="upload-submit-box" class="form-group col-xs-12 col-md-4">
													<button id="submit-audio-upload" class="submit-button btn btn-primary form-control text-left" type="button" disabled><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload Audio</button>
												</div>
											</div>											
										</div>
										
										<div id="audio-waveform-box" class="form-group col-xs-12 col-md-12 zero-padding-left">
											<canvas id="audio-waveform" width="800" height="350"></canvas> 											
										</div>
										
										<div id="volume-box" class="form-group col-xs-12 col-md-12 zero-padding-left">
											<h3 class="secondary-header">Volume</h3>
											
											<div id="binaural-volume-box" class="form-group col-xs-12 col-md-4">
												<h5 class="inessential-header">Binaural Beats</h5>
												
												<div id="jp_container_1">
													<div class="jp-gui ui-widget ui-widget-content ui-corner-all">
														<ul>
															<!-- <li class="jp-play ui-state-default ui-corner-all"><a href="javascript:;" class="jp-play ui-icon ui-icon-play" tabindex="1" title="play">play</a></li> -->
															<!-- <li class="jp-pause ui-state-default ui-corner-all"><a href="javascript:;" class="jp-pause ui-icon ui-icon-pause" tabindex="1" title="pause">pause</a></li> -->
															<!-- <li class="jp-stop ui-state-default ui-corner-all"><a href="javascript:;" class="jp-stop ui-icon ui-icon-stop" tabindex="1" title="stop">stop</a></li> -->
															<!-- <li class="jp-repeat ui-state-default ui-corner-all"><a href="javascript:;" class="jp-repeat ui-icon ui-icon-refresh" tabindex="1" title="repeat">repeat</a></li> -->
															<!-- <li class="jp-repeat-off ui-state-default ui-state-active ui-corner-all"><a href="javascript:;" class="jp-repeat-off ui-icon ui-icon-refresh" tabindex="1" title="repeat off">repeat off</a></li> -->
															<li class="jp-mute ui-state-default ui-corner-all"><a href="javascript:;" class="jp-mute ui-icon ui-icon-volume-off" tabindex="1" title="mute">mute</a></li>
															<li class="jp-unmute ui-state-default ui-state-active ui-corner-all"><a href="javascript:;" class="jp-unmute ui-icon ui-icon-volume-off" tabindex="1" title="unmute">unmute</a></li>
															<li class="jp-volume-max ui-state-default ui-corner-all"><a href="javascript:;" class="jp-volume-max ui-icon ui-icon-volume-on" tabindex="1" title="max volume">max volume</a></li>
														</ul>
														<!-- <div class="jp-progress-slider"></div> -->
														<div class="jp-volume-slider"></div>
														<!-- <div class="jp-current-time"></div> -->
														<!-- <div class="jp-duration"></div> -->
														<div class="jp-clearboth"></div>
													</div>
													<div class="jp-no-solution">
														<span>Update Required</span>
														To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
													</div>
												</div>												
											</div>

											<div id="bg-volume-box" class="form-group col-xs-12 col-md-4">
												<h5 class="inessential-header">Background Music</h5>
												
												<div id="jp_container_2">
													<div class="jp-gui ui-widget ui-widget-content ui-corner-all">
														<ul>
															<!-- <li class="jp-play ui-state-default ui-corner-all"><a href="javascript:;" class="jp-play ui-icon ui-icon-play" tabindex="1" title="play">play</a></li> -->
															<!-- <li class="jp-pause ui-state-default ui-corner-all"><a href="javascript:;" class="jp-pause ui-icon ui-icon-pause" tabindex="1" title="pause">pause</a></li> -->
															<!-- <li class="jp-stop ui-state-default ui-corner-all"><a href="javascript:;" class="jp-stop ui-icon ui-icon-stop" tabindex="1" title="stop">stop</a></li> -->
															<!-- <li class="jp-repeat ui-state-default ui-corner-all"><a href="javascript:;" class="jp-repeat ui-icon ui-icon-refresh" tabindex="1" title="repeat">repeat</a></li> -->
															<!-- <li class="jp-repeat-off ui-state-default ui-state-active ui-corner-all"><a href="javascript:;" class="jp-repeat-off ui-icon ui-icon-refresh" tabindex="1" title="repeat off">repeat off</a></li> -->
															<li class="jp-mute ui-state-default ui-corner-all"><a href="javascript:;" class="jp-mute ui-icon ui-icon-volume-off" tabindex="1" title="mute">mute</a></li>
															<li class="jp-unmute ui-state-default ui-state-active ui-corner-all"><a href="javascript:;" class="jp-unmute ui-icon ui-icon-volume-off" tabindex="1" title="unmute">unmute</a></li>
															<li class="jp-volume-max ui-state-default ui-corner-all"><a href="javascript:;" class="jp-volume-max ui-icon ui-icon-volume-on" tabindex="1" title="max volume">max volume</a></li>
														</ul>
														<!-- <div class="jp-progress-slider"></div> -->
														<div class="jp-volume-slider"></div>
														<!-- <div class="jp-current-time"></div> -->
														<!-- <div class="jp-duration"></div> -->
														<div class="jp-clearboth"></div>
													</div>
													<div class="jp-no-solution">
														<span>Update Required</span>
														To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
													</div>
												</div>												
											</div>
											
											<div id="affirmation-volume-box" class="form-group col-xs-12 col-md-4">
												<h5 class="inessential-header">Affirmation</h5>
												
												<div id="jp_container_3">
													<div class="jp-gui ui-widget ui-widget-content ui-corner-all">
														<ul>
															<!-- <li class="jp-play ui-state-default ui-corner-all"><a href="javascript:;" class="jp-play ui-icon ui-icon-play" tabindex="1" title="play">play</a></li> -->
															<!-- <li class="jp-pause ui-state-default ui-corner-all"><a href="javascript:;" class="jp-pause ui-icon ui-icon-pause" tabindex="1" title="pause">pause</a></li> -->
															<!-- <li class="jp-stop ui-state-default ui-corner-all"><a href="javascript:;" class="jp-stop ui-icon ui-icon-stop" tabindex="1" title="stop">stop</a></li> -->
															<!-- <li class="jp-repeat ui-state-default ui-corner-all"><a href="javascript:;" class="jp-repeat ui-icon ui-icon-refresh" tabindex="1" title="repeat">repeat</a></li> -->
															<!-- <li class="jp-repeat-off ui-state-default ui-state-active ui-corner-all"><a href="javascript:;" class="jp-repeat-off ui-icon ui-icon-refresh" tabindex="1" title="repeat off">repeat off</a></li> -->
															<li class="jp-mute ui-state-default ui-corner-all"><a href="javascript:;" class="jp-mute ui-icon ui-icon-volume-off" tabindex="1" title="mute">mute</a></li>
															<li class="jp-unmute ui-state-default ui-state-active ui-corner-all"><a href="javascript:;" class="jp-unmute ui-icon ui-icon-volume-off" tabindex="1" title="unmute">unmute</a></li>
															<li class="jp-volume-max ui-state-default ui-corner-all"><a href="javascript:;" class="jp-volume-max ui-icon ui-icon-volume-on" tabindex="1" title="max volume">max volume</a></li>
														</ul>
														<!-- <div class="jp-progress-slider"></div> -->
														<div class="jp-volume-slider"></div>
														<!-- <div class="jp-current-time"></div> -->
														<!-- <div class="jp-duration"></div> -->
														<div class="jp-clearboth"></div>
													</div>
													<div class="jp-no-solution">
														<span>Update Required</span>
														To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
													</div>
												</div>													
											</div>											
										</div>
										<div id="mix-box" class="form-button-container form-group col-xs-12 col-md-12 zero-padding-left">
											<div class="form-group col-xs-12 col-md-3 submit-form-group zero-padding-left">
												<!-- <label for="submit-user-form" class="control-label">&nbsp;</label> -->   
												<button type="button" id="mix-audio" class="submit-button btn btn-warning form-control" disabled><span class="glyphicon glyphicon-play" aria-hidden="true"></span> Start</button>
											</div>										
										</div>	
										<div id="save-box" class="form-button-container form-group col-xs-12 col-md-12 zero-padding-left">
											<div id="mix-duration-box" class="form-group col-xs-12 col-md-3 zero-padding-left mix-duration">
												<label for="mix-duration" class="control-label">Choose Mix Duration</label>
												<select id="mix-duration" name="mix-duration" class="form-control">
													<option value="1">1 m</option>
													<option value="3">3 m</option>
													<option value="5">5 m</option>
													<option value="7">7 m</option>
													<option value="10">10 m</option>
													<option value="15">15 m</option>
													<option value="20">20 m</option>
													<option value="30">30 m</option>
												</select>
											</div>											
											<div id="mix-name-box" class="form-group col-xs-12 col-md-3 zero-padding-left">
												<input class="form-control" id="mix-name" name="mix-name" placeholder="Mix Name" type="text" autocomplete="off">
											</div>								
											<div class="form-group col-xs-12 col-md-3 submit-form-group zero-padding-left">
												<label for="submit-user-form" class="control-label">&nbsp;</label>
												<button type="button" id="save-mix" class="submit-button btn btn-info form-control" disabled><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save</button>
											</div>											
										</div>											
									</div>
								</form>	
							</div>
						</div>  
						<!-- Footer -->
						<div id="footer">
							<div id="DIV_1">
								<div id="DIV_2">
									<div id="DIV_3">
										<div id="DIV_4">
											<div id="DIV_5">
												<!-- Footer widget area 1 -->

												<div id="DIV_6">
													<h4 id="H4_7">
														Categories
													</h4>
													<div id="DIV_8">
														<ul id="UL_9">
															<li id="LI_10">
																<a href="#" id="A_11">Numerology</a>
															</li>
															<li id="LI_12">
																<a href="#" id="A_13">Predictions &amp; Forecasts</a>
															</li>
															<li id="LI_14">
																<a href="#" id="A_15">Career &amp; Wealth</a>
															</li>
															<li id="LI_16">
																<a href="#" id="A_17">Love &amp; Relationships</a>
															</li>
															<li id="LI_18">
																<a href="#" id="A_19">Health &amp; Well Being</a>
															</li>
															<li id="LI_20">
																<a href="#" id="A_21">Personal Growth &amp; Success</a>
															</li>
															<li id="LI_22">
																<a href="#" id="A_23">Astrology</a>
															</li>
															<li id="LI_24">
																<a href="#" id="A_25">Divination</a>
															</li>
															<li id="LI_26">
																<a href="#" id="A_27">Tarot</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
											<!--/span_3-->

											<div id="DIV_28">
												<!-- Footer widget area 2 -->

												<div id="DIV_29">
													<h4 id="H4_30">
														Company Policy
													</h4>
													<div id="DIV_31">
														<ul id="UL_32">
															<li id="LI_33">
																<a href="#" id="A_34">Terms of Use</a>
															</li>
															<li id="LI_35">
																<a href="#" id="A_36">Earnings Disclaimer</a>
															</li>
															<li id="LI_37">
																<a href="#" id="A_38">Privacy Policy</a>
															</li>
														</ul>
													</div>
												</div>
												<div id="DIV_39">
													<h4 id="H4_40">
														Affiliates
													</h4>
													<div id="DIV_41">
														<ul id="UL_42">
															<li id="LI_43">
																<a href="#" id="A_44">Affiliate Information</a>
															</li>
														</ul>
													</div>
												</div>
												<div id="DIV_45">
													<h4 id="H4_46">
														Contact Us
													</h4>
													<div id="DIV_47">
														<a href="#" id="A_54">Instagram</a>
													</div>
												</div>
											</div>
											<!--/span_3-->

											<div id="DIV_55">
												<!-- Footer widget area 3 -->

												<div id="DIV_56">
													<h4 id="H4_57">
														Free Numerology Report
													</h4>
													<div id="DIV_58">
														<img src="https://s3.amazonaws.com/blog-newsletter/small_clean_trans.png" id="IMG_60" alt='' />Customized to your exact birth date and name... <strong id="STRONG_61">So take note:</strong> <em id="EM_62">the information you're about to receive may shock you.</em><br id="BR_63" /><br id="BR_64" />
														 <a href="#" id="A_66"><span id="SPAN_67">Get Your Free Numerology Reading Here</span><i id="I_68"></i></a>
													</div>
												</div>
											</div>
											<!--/span_3-->

											<div id="DIV_69">
												<!-- Footer widget area 4 -->

												<div id="DIV_70">
													<h4 id="H4_71">
														Connect On Facebook
													</h4>
													<div id="DIV_72">
														Over 400,000 People Agree: We are the #1 most trusted source for numerology reports and training.<br id="BR_73" /><br id="BR_74" />
														<div id="DIV_75">
															<span id="SPAN_76"></span>
															
														</div>
													</div>
												</div>
												<div id="DIV_78">
													<div id="DIV_79">
														<p id="P_80">
															ClickBank is the retailer of products on this site. CLICKBANK® is a registered trademark of Click Sales, Inc., a Delaware corporation located at 917 S. Lusk Street, Suite 200, Boise Idaho, 83706, USA and used by permission. ClickBank's role as retailer does not constitute an endorsement, approval or review of these products or any claim, statement or opinion used in promotion of these products.
														</p>
													</div>
												</div>
											</div>
											<!--/span_3-->

										</div>
										<!--/row-->

									</div>
									<!--/container-->

								</div>
								<!--/footer-widgets-->
								
								<div id="DIV_81">
									<div id="DIV_82">
										<div id="DIV_83">
											<p id="P_84">
												© 2017 Numerologist.com.
											</p>
										</div>
										<!--/span_5-->

										<div id="DIV_85">
											<ul id="UL_86">
												<li id="LI_87">
													<!-- <a href="#" id="A_88"><i id="I_89"></i></a> -->
												</li>
												<li id="LI_90">
													<!-- <a href="#" id="A_91"><i id="I_92"></i></a> -->
												</li>
												<li id="LI_93">
													<!-- <a href="#" id="A_94"><i id="I_95"></i></a> -->
												</li>
											</ul>
										</div>
										<!--/span_7-->

									</div>
									<!--/container-->

								</div>
								<!--/row-->

							</div>						
						</div>						
						<!-- END Footer -->					  	
					</div>
				</div>
			</div>
		</div>
		
		<div class="loader">

		</div>	
		 
		<div id="jquery_jplayer_1" class="jp-jplayer"></div>		
		<div id="jquery_jplayer_2" class="jp-jplayer"></div>		
		<div id="jquery_jplayer_3" class="jp-jplayer"></div>			
  </body>
</html>