$( document ).ready( function(  ) { 

	var platform = getOS(  );
	// platform = "Android";
	
	console.log( "Platform: " + platform );
	
	if( window.navigator.userAgent.indexOf( "Edge" ) > -1 ) {
		window.browserName = 'Edge';
	}	
	else if( navigator.appVersion.indexOf( "Chrome/" ) !== -1 ) {
		window.browserName = 'Chrome';
	}	
	else if( /^((?!chrome|android).)*safari/i.test( navigator.userAgent ) ) {
		window.browserName = 'Safari';
	}	
	else {
   var ua = window.navigator.userAgent;
   var msie = ua.indexOf( "MSIE " );

    if( msie > 0 || !!navigator.userAgent.match( /Trident.*rv\:11\./ ) ) {
			window.browserName = 'IE';  
		}
	}	
	
	console.log( "Browser: " + window.browserName );	
	
	var urlString = window.location.href
	var url = new URL( urlString );
	var devModeParam = url.searchParams.get( 'dev-mode' );
	
	console.log( 'devModeParam: ' + devModeParam );	
	
	var devMode;
	
	if( devModeParam === 'false' ) {
		// for developer
		devMode = false;
	}		
	else {
		// for users
		devMode = false;
	}
	
	window.devMode = devMode;
	
	console.log( ajax_var.url );
	$.ajax( {
		type: "POST",
		dataType: "json",
		crossDomain: true,
		url: ajax_var.url,//"get-categories-data.php",
		data: { 'action' : 'get_categories_data' },
		error: function (jqXHR, exception) {
	        var msg = '';
	        if (jqXHR.status === 0) {
	            msg = 'Not connect.\n Verify Network.';
	        } else if (jqXHR.status == 404) {
	            msg = 'Requested page not found. [404]';
	        } else if (jqXHR.status == 500) {
	            msg = 'Internal Server Error [500].';
	        } else if (exception === 'parsererror') {
	            msg = 'Requested JSON parse failed.';
	        } else if (exception === 'timeout') {
	            msg = 'Time out error.';
	        } else if (exception === 'abort') {
	            msg = 'Ajax request aborted.';
	        } else {
	            msg = 'Uncaught Error.\n' + jqXHR.responseText;
	        }
	        console.log( msg );
		} 				
	} ) 
		.done( function( categoriesData ) {
			if( categoriesData ) {
				window.categoriesData = categoriesData.data.categoriesData;
				$.each( 
					window.categoriesData, 			
					
					function( index, categoryData ) {
						console.log(categoryData);
						// console.log( index );	
						// console.log( categoryData );	
							
						$( '#categories' ).append( '<option value="' + categoryData.id + '">' + categoryData.name + '</option>' );
						$( '.audio-category' ).append( '<option value="' + categoryData.id + '">' + categoryData.name + '</option>' );
					} 
				);				
				
				var categoryID = 'brain-power';
				
				setCategoryData( categoryID );				
			}
			else {
				var errorMessage = 'Categories Data Error!';
				console.log( errorMessage );
				
				noty( {
					layout: 'bottomCenter',
					timeout: 3000,
					progressBar: false,
					theme: 'defaultTheme',
					text: errorMessage,
					maxVisible: 1, // [integer] you can set max visible notification count for dismissQueue true option,
					force: true,
					type: 'error',
					animation: {
						open: 'animated bounceIn', // Animate.css class names
						close: 'animated bounceOut', // Animate.css class names
						easing: 'swing', // unavailable - no need
						speed: 1000 // unavailable - no need
					}
				} );					
			}						
		} );	
	
	$( '.audio-upload-btn' )
		.val( '' )
		.prop( 'disabled', true );
		
	$( '#insert-box input[type="radio"]' ).prop( 'checked', false );
	$( '#submit-audio-upload' ).prop( 'disabled', true );
	
	$( '.audio-info-box' ).css( {
		height: 'auto',
		visibility: 'hidden'
	} );	
	
	var audioInfoHeight = $( '.audio-info-box' ).innerHeight(  );	
	
	// console.log( 'audioInfoHeight: ' + audioInfoHeight );
	
	$( '.audio-info-box' ).attr( 'data-initial-height', audioInfoHeight );
	
	$( '.audio-info-box' ).css( {
		height: '0px',
		visibility: 'visible',
		height: '0px',
		opacity: '0'
	} );					
	
	$( '#mix-audio' ).prop( 'disabled', true );
	$( '#save-mix' ).prop( 'disabled', true );		
	
	window.categoriesSelect = new Select( {
		el: document.querySelector( '#categories' ),
		className: 'select-theme-chosen categories-select form-control col-xs-12 col-md-4',
		useNative: false
	} ); 
	window.categoriesSelect.on( 'open', function(  ) {
		var selectContentID = '.categories-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceIn' );
	} );
	window.categoriesSelect.on( 'close', function(  ) {
		var selectContentID = '.categories-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceOut' );
	} );	
	
	window.audio1CategorySelect = new Select( {
		el: document.querySelector( '#audio1-category' ),
		className: 'select-theme-chosen audio1-category-select form-control',
		useNative: false
	} ); 
	window.audio1CategorySelect.on( 'open', function(  ) {
		var selectContentID = '.audio1-category-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceIn' );
	} );
	window.audio1CategorySelect.on( 'close', function(  ) {
		var selectContentID = '.audio1-category-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceOut' );
	} );	

	window.audio1TypeSelect = new Select( {
		el: document.querySelector( '#audio1-type' ),
		className: 'select-theme-chosen audio1-type-select form-control',
		useNative: false
	} ); 
	window.audio1TypeSelect.on( 'open', function(  ) {
		var selectContentID = '.audio1-type-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceIn' );
	} );
	window.audio1TypeSelect.on( 'close', function(  ) {
		var selectContentID = '.audio1-type-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceOut' );
	} );			
	
	window.audio2CategorySelect = new Select( {
		el: document.querySelector( '#audio2-category' ),
		className: 'select-theme-chosen audio2-category-select form-control',
		useNative: false
	} ); 
	window.audio2CategorySelect.on( 'open', function(  ) {
		var selectContentID = '.audio2-category-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceIn' );
	} );
	window.audio2CategorySelect.on( 'close', function(  ) {
		var selectContentID = '.audio2-category-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceOut' );
	} );	

	window.audio2TypeSelect = new Select( {
		el: document.querySelector( '#audio2-type' ),
		className: 'select-theme-chosen audio2-type-select form-control',
		useNative: false
	} ); 
	window.audio2TypeSelect.on( 'open', function(  ) {
		var selectContentID = '.audio2-type-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceIn' );
	} );
	window.audio2TypeSelect.on( 'close', function(  ) {
		var selectContentID = '.audio2-type-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceOut' );
	} );

	window.audio3CategorySelect = new Select( {
		el: document.querySelector( '#audio3-category' ),
		className: 'select-theme-chosen audio3-category-select form-control',
		useNative: false
	} ); 
	window.audio3CategorySelect.on( 'open', function(  ) {
		var selectContentID = '.audio3-category-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceIn' );
	} );
	window.audio3CategorySelect.on( 'close', function(  ) {
		var selectContentID = '.audio3-category-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceOut' );
	} );	

	window.audio3TypeSelect = new Select( {
		el: document.querySelector( '#audio3-type' ),
		className: 'select-theme-chosen audio3-type-select form-control',
		useNative: false
	} ); 
	window.audio3TypeSelect.on( 'open', function(  ) {
		var selectContentID = '.audio3-type-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceIn' );
	} );
	window.audio3TypeSelect.on( 'close', function(  ) {
		var selectContentID = '.audio3-type-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceOut' );
	} );	
	
	window.mixDurationSelect = new Select( {
		el: document.querySelector( '#mix-duration' ),
		className: 'select-theme-chosen mix-duration-select form-control col-xs-12 col-md-3',
		useNative: false
	} ); 
	window.mixDurationSelect.on( 'open', function(  ) {
		var selectContentID = '.mix-duration-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceIn' );
	} );
	window.mixDurationSelect.on( 'close', function(  ) {
		var selectContentID = '.mix-duration-select .select-content';
		$( selectContentID ).removeClass( 'animated bounceIn bounceOut' );
		$( selectContentID ).addClass( 'animated bounceOut' );
	} );		
	
	$( window ).resize( setAllSelectsWidth );	
	  
	setAllSelectsWidth(  );		
	  
	var durationOptions = $( '#mix-duration option' );
	
	window.durationOptions = durationOptions;		
		
	$.html5Loader( {
		filesToLoad:    
		{
			"files": [
				{
					"type": "IMAGE",
					"source": ajax_var.images_url + "closed-select.png",
					"size": 1341
				},			
				{
					"type": "IMAGE",
					"source": ajax_var.images_url + "opened-select.png",
					"size": 1310
				},		
			]
		},
		onBeforeLoad: function(  ) {  },
		onComplete: function(  ) {  
			// console.log( 'Main Page Loaded' );			
			
			setAllSelectsWidth(  );									
			
			if( ! window.devMode ) {
				var transitionEnd = 'webkitTransitionEnd mozTransitionEnd MSTransitionEnd otransitionend transitionend';
				
				$( '.loader' ).one( transitionEnd, function(  ) {
					$( '.loader' ).css( { visibility: "hidden" } );
				} );			

				$( '.loader' ).css( { opacity: '0' } );		
			}
			else {
				$( '.loader' ).html( '<span style="color: #ffffff;position: relative;top: 50%;left: 50%;transform: translate(-50%,-50%);text-transform: uppercase;font-size: 5vw;display: inline-block;">Reconstruction!</span>' );
			}
		},
		onElementLoaded: function( obj, elm ) {  },
		onUpdate: function( percentage ) {  }
	} );		
	
	/*
	 * jQuery UI ThemeRoller
	 *
	 * Includes code to hide GUI volume controls on mobile devices.
	 * ie., Where volume controls have no effect. See noVolume option for more info.
	 *
	 * Includes fix for Flash solution with MP4 files.
	 * ie., The timeupdates are ignored for 1000ms after changing the play-head.
	 * Alternative solution would be to use the slider option: {animate:false}
	 */
	 
	window.binauralBeatPlayer = $( "#jquery_jplayer_1" );

	var binauralBeatFixFlash_mp4; // Flag: The m4a and m4v Flash player gives some old currentTime values when changed.
	var binauralBeatFixFlash_mp4_id; // Timeout ID used with fixFlash_mp4
	var binauralBeatIgnore_timeupdate; // Flag used with fixFlash_mp4
	var binauralBeatOptions = {
		ready: function (event) {
			// Hide the volume slider on mobile browsers. ie., They have no effect.
			if(event.jPlayer.status.noVolume) {
				// Add a class and then CSS rules deal with it.
				// $(event.jPlayer.options.cssSelectorAncestor + " .jp-gui").addClass("jp-no-volume");
				$( event.jPlayer.options.cssSelectorBox ).css( {
					display: 'none'
				} );
			}
			// Determine if Flash is being used and the mp4 media type is supplied. BTW, Supplying both mp3 and mp4 is pointless.
			binauralBeatFixFlash_mp4 = event.jPlayer.flash.used && /m4a|m4v/.test(event.jPlayer.options.supplied);

			
			$( '#jquery_jplayer_1 audio' ).attr( 'crossorigin', 'anonymous' );
		},
		timeupdate: function(event) {
			if(!binauralBeatIgnore_timeupdate) {
				binauralBeatControl.progress.slider("value", event.jPlayer.status.currentPercentAbsolute);
			}
		},
		volumechange: function(event) {
			if(event.jPlayer.options.muted) {
				binauralBeatControl.volume.slider("value", 0);
			} else {
				binauralBeatControl.volume.slider("value", event.jPlayer.options.volume);
			}
		},
		ended: function(  ) {
			window.binauralBeatPlayer.jPlayer( 'stop' );
			window.bgMusicPlayer.jPlayer( 'stop' );
			window.affirmationPlayer.jPlayer( 'stop' );
			
			// window.binauralBeatPlayer.jPlayer( 'play' );
			// window.bgMusicPlayer.jPlayer( 'play' );
			// window.affirmationPlayer.jPlayer( 'play' );							
		},			
		swfPath: "https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/jplayer",
		supplied: "mp3",
		// supplied: "m4a, oga",
		cssSelectorAncestor: "#jp_container_1",
		cssSelectorBox: "#volume-box",
		wmode: "window",
		keyEnabled: true
	};
	
	var binauralBeatControl = {
		progress: $(binauralBeatOptions.cssSelectorAncestor + " .jp-progress-slider"),
		volume: $(binauralBeatOptions.cssSelectorAncestor + " .jp-volume-slider")
	};

	// Instance jPlayer
	window.binauralBeatPlayer.jPlayer(binauralBeatOptions);

	// A pointer to the jPlayer data object
	var binauralBeatData = window.binauralBeatPlayer.data("jPlayer");

	// Define hover states of the buttons
	$(binauralBeatOptions.cssSelectorAncestor + ' .jp-gui ul li').hover(
		function() { $(this).addClass('ui-state-hover'); },
		function() { $(this).removeClass('ui-state-hover'); }
	);

	// Create the progress slider control
	binauralBeatControl.progress.slider({
		animate: "fast",
		max: 100,
		range: "min",
		step: 0.1,
		value : 0,
		slide: function(event, ui) {
			var sp = binauralBeatData.status.seekPercent;
			if(sp > 0) {
				// Apply a fix to mp4 formats when the Flash is used.
				if(binauralBeatFixFlash_mp4) {
					binauralBeatIgnore_timeupdate = true;
					clearTimeout(binauralBeatFixFlash_mp4_id);
					binauralBeatFixFlash_mp4_id = setTimeout(function() {
						binauralBeatIgnore_timeupdate = false;
					},1000);
				}
				// Move the play-head to the value and factor in the seek percent.
				window.binauralBeatPlayer.jPlayer("playHead", ui.value * (100 / sp));
			} else {
				// Create a timeout to reset this slider to zero.
				setTimeout(function() {
					binauralBeatControl.progress.slider("value", 0);
				}, 0);
			}
		}
	});

	// Create the volume slider control
	binauralBeatControl.volume.slider({
		animate: "fast",
		max: 1,
		range: "min",
		step: 0.01,
		value : $.jPlayer.prototype.options.volume,
		slide: function(event, ui) {
			window.binauralBeatPlayer.jPlayer("option", "muted", false);
			window.binauralBeatPlayer.jPlayer("option", "volume", ui.value);
		}
	});		 

	window.bgMusicPlayer = $( "#jquery_jplayer_2" );

	var bgMusicFixFlash_mp4; // Flag: The m4a and m4v Flash player gives some old currentTime values when changed.
	var bgMusicFixFlash_mp4_id; // Timeout ID used with fixFlash_mp4
	var bgMusicIgnore_timeupdate; // Flag used with fixFlash_mp4
	var bgMusicOptions = {
		ready: function (event) {
			// Hide the volume slider on mobile browsers. ie., They have no effect.
			if(event.jPlayer.status.noVolume) {
				// Add a class and then CSS rules deal with it.
				// $(event.jPlayer.options.cssSelectorAncestor + " .jp-gui").addClass("jp-no-volume");
				$( event.jPlayer.options.cssSelectorBox ).css( {
					display: 'none'
				} );
			}
			// Determine if Flash is being used and the mp4 media type is supplied. BTW, Supplying both mp3 and mp4 is pointless.
			bgMusicFixFlash_mp4 = event.jPlayer.flash.used && /m4a|m4v/.test(event.jPlayer.options.supplied);
			// Setup the player with media.
			// $(this).jPlayer("setMedia", {
				// mp3: window.mixerAudioDirURL + window.currentCategoryData.id + "/bg-music/music-1.mp3"
				// m4a: ".m4a",
				// oga: ".ogg"
			// });
			
			$( '#jquery_jplayer_2 audio' ).attr( 'crossorigin', 'anonymous' );
		},
		timeupdate: function(event) {
			if(!bgMusicIgnore_timeupdate) {
				bgMusicControl.progress.slider("value", event.jPlayer.status.currentPercentAbsolute);
			}
		},
		volumechange: function(event) {
			if(event.jPlayer.options.muted) {
				bgMusicControl.volume.slider("value", 0);
			} else {
				bgMusicControl.volume.slider("value", event.jPlayer.options.volume);
			}
		},
		ended: function(  ) {
			window.binauralBeatPlayer.jPlayer( 'stop' );
			window.bgMusicPlayer.jPlayer( 'stop' );
			window.affirmationPlayer.jPlayer( 'stop' );
			
			// window.binauralBeatPlayer.jPlayer( 'play' );
			// window.bgMusicPlayer.jPlayer( 'play' );
			// window.affirmationPlayer.jPlayer( 'play' );							
		},			
		swfPath: "https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/jplayer",
		supplied: "mp3",
		// supplied: "m4a, oga",
		cssSelectorAncestor: "#jp_container_2",
		cssSelectorBox: "#volume-box",
		wmode: "window",
		keyEnabled: true
	};
	
	var bgMusicControl = {
		progress: $(bgMusicOptions.cssSelectorAncestor + " .jp-progress-slider"),
		volume: $(bgMusicOptions.cssSelectorAncestor + " .jp-volume-slider")
	};

	// Instance jPlayer
	window.bgMusicPlayer.jPlayer(bgMusicOptions);

	// A pointer to the jPlayer data object
	var bgMusicData = window.bgMusicPlayer.data("jPlayer");

	// Define hover states of the buttons
	$(bgMusicOptions.cssSelectorAncestor + ' .jp-gui ul li').hover(
		function() { $(this).addClass('ui-state-hover'); },
		function() { $(this).removeClass('ui-state-hover'); }
	);

	// Create the progress slider control
	bgMusicControl.progress.slider({
		animate: "fast",
		max: 100,
		range: "min",
		step: 0.1,
		value : 0,
		slide: function(event, ui) {
			var sp = bgMusicData.status.seekPercent;
			if(sp > 0) {
				// Apply a fix to mp4 formats when the Flash is used.
				if(bgMusicFixFlash_mp4) {
					bgMusicIgnore_timeupdate = true;
					clearTimeout(bgMusicFixFlash_mp4_id);
					bgMusicFixFlash_mp4_id = setTimeout(function() {
						bgMusicIgnore_timeupdate = false;
					},1000);
				}
				// Move the play-head to the value and factor in the seek percent.
				window.bgMusicPlayer.jPlayer("playHead", ui.value * (100 / sp));
			} else {
				// Create a timeout to reset this slider to zero.
				setTimeout(function() {
					bgMusicControl.progress.slider("value", 0);
				}, 0);
			}
		}
	});

	// Create the volume slider control
	bgMusicControl.volume.slider({
		animate: "fast",
		max: 1,
		range: "min",
		step: 0.01,
		value : $.jPlayer.prototype.options.volume,
		slide: function(event, ui) {
			window.bgMusicPlayer.jPlayer("option", "muted", false);
			window.bgMusicPlayer.jPlayer("option", "volume", ui.value);
		}
	});		
	
	window.affirmationPlayer = $( "#jquery_jplayer_3" );

	var affirmationFixFlash_mp4; // Flag: The m4a and m4v Flash player gives some old currentTime values when changed.
	var affirmationFixFlash_mp4_id; // Timeout ID used with fixFlash_mp4
	var affirmationIgnore_timeupdate; // Flag used with fixFlash_mp4
	var affirmationOptions = {
		ready: function (event) {
			// Hide the volume slider on mobile browsers. ie., They have no effect.
			if(event.jPlayer.status.noVolume) {
				// Add a class and then CSS rules deal with it.
				// $(event.jPlayer.options.cssSelectorAncestor + " .jp-gui").addClass("jp-no-volume");
				$( event.jPlayer.options.cssSelectorBox ).css( {
					display: 'none'
				} );
			}
			// Determine if Flash is being used and the mp4 media type is supplied. BTW, Supplying both mp3 and mp4 is pointless.
			affirmationFixFlash_mp4 = event.jPlayer.flash.used && /m4a|m4v/.test(event.jPlayer.options.supplied);
			// Setup the player with media.
			// $(this).jPlayer("setMedia", {
				// mp3: window.mixerAudioDirURL + window.currentCategoryData.id + "/affirmations/powerful-affirmation-1.mp3"
				// m4a: ".m4a",
				// oga: ".ogg"
			// });
			
			$( '#jquery_jplayer_3 audio' ).attr( 'crossorigin', 'anonymous' );
		},
		timeupdate: function(event) {
			if(!affirmationIgnore_timeupdate) {
				affirmationControl.progress.slider("value", event.jPlayer.status.currentPercentAbsolute);
			}
		},
		volumechange: function(event) {
			if(event.jPlayer.options.muted) {
				affirmationControl.volume.slider("value", 0);
			} else {
				affirmationControl.volume.slider("value", event.jPlayer.options.volume);
			}
		},
		ended: function(  ) {
			window.binauralBeatPlayer.jPlayer( 'stop' );
			window.bgMusicPlayer.jPlayer( 'stop' );
			window.affirmationPlayer.jPlayer( 'stop' );
			
			// window.binauralBeatPlayer.jPlayer( 'play' );
			// window.bgMusicPlayer.jPlayer( 'play' );
			// window.affirmationPlayer.jPlayer( 'play' );							
		},			
		swfPath: "https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/jplayer",
		supplied: "mp3",
		// supplied: "m4a, oga",
		cssSelectorAncestor: "#jp_container_3",
		cssSelectorBox: "#volume-box",
		wmode: "window",
		keyEnabled: true
	};
	
	var affirmationControl = {
		progress: $(affirmationOptions.cssSelectorAncestor + " .jp-progress-slider"),
		volume: $(affirmationOptions.cssSelectorAncestor + " .jp-volume-slider")
	};

	// Instance jPlayer
	window.affirmationPlayer.jPlayer(affirmationOptions);

	// A pointer to the jPlayer data object
	var affirmationData = window.affirmationPlayer.data("jPlayer");

	// Define hover states of the buttons
	$(affirmationOptions.cssSelectorAncestor + ' .jp-gui ul li').hover(
		function() { $(this).addClass('ui-state-hover'); },
		function() { $(this).removeClass('ui-state-hover'); }
	);

	// Create the progress slider control
	affirmationControl.progress.slider({
		animate: "fast",
		max: 100,
		range: "min",
		step: 0.1,
		value : 0,
		slide: function(event, ui) {
			var sp = affirmationData.status.seekPercent;
			if(sp > 0) {
				// Apply a fix to mp4 formats when the Flash is used.
				if(affirmationFixFlash_mp4) {
					affirmationIgnore_timeupdate = true;
					clearTimeout(affirmationFixFlash_mp4_id);
					affirmationFixFlash_mp4_id = setTimeout(function() {
						affirmationIgnore_timeupdate = false;
					},1000);
				}
				// Move the play-head to the value and factor in the seek percent.
				window.affirmationPlayer.jPlayer("playHead", ui.value * (100 / sp));
			} else {
				// Create a timeout to reset this slider to zero.
				setTimeout(function() {
					affirmationControl.progress.slider("value", 0);
				}, 0);
			}
		}
	});

	// Create the volume slider control
	affirmationControl.volume.slider({
		animate: "fast",
		max: 1,
		range: "min",
		step: 0.01,
		value : $.jPlayer.prototype.options.volume,
		slide: function(event, ui) {
			window.affirmationPlayer.jPlayer("option", "muted", false);
			window.affirmationPlayer.jPlayer("option", "volume", ui.value);
		}
	});	

	$( '#jp_container_1 .jp-mute' ).on( 'click', function(  ) {
		window.binauralBeatPlayer.jPlayer( "option", "volume", 0 );
	} );
	
	$( '#jp_container_2 .jp-mute' ).on( 'click', function(  ) {
		window.bgMusicPlayer.jPlayer( "option", "volume", 0 );
	} );

	$( '#jp_container_3 .jp-mute' ).on( 'click', function(  ) {
		window.affirmationPlayer.jPlayer( "option", "volume", 0 );
	} );
	
	window.categoriesSelect.on( "change", function(  ) {
		// console.log( "categoriesSelect change" );
		// console.log( "category: " + this.value );
		
		var categoryID = this.value;
		
		setCategoryData( categoryID );
	} );	

	$( '.audio-upload-btn' ).on( 'change', function(  ) {
    var audio = $( this ).val(  );

		if( audio ) {
			switch( audio.substring( audio.lastIndexOf( '.' ) + 1 ).toLowerCase(  ) ) {
				case 'mp3':
					if( typeof FileReader !== "undefined" ) {
						var audio1Size = 0;
						
						if( document.getElementById( 'audio1' ).files[ 0 ] ) {
							audio1Size = document.getElementById( 'audio1' ).files[ 0 ].size;
						}
						
						var audio2Size = 0;
						
						if( document.getElementById( 'audio2' ).files[ 0 ] ) {
							audio2Size = document.getElementById( 'audio2' ).files[ 0 ].size;
						}

						var audio3Size = 0;
						
						if( document.getElementById( 'audio3' ).files[ 0 ] ) {
							audio3Size = document.getElementById( 'audio3' ).files[ 0 ].size;
						}			
						
						var audioMaxSize = Math.max( audio1Size, audio2Size, audio3Size );
						
						// console.log( 'audioMaxSize: ' + audioMaxSize );
						
						// check file size
						if( audioMaxSize > window.maxFileSize ) {
							// $( this ).val( '' );
							
							var errorMessage = 'The File Size is Too Large!';
							
							console.log( errorMessage );
							console.log( 'audio1Size: ' + audio1Size );
							console.log( 'audio2Size: ' + audio2Size );
							console.log( 'audio3Size: ' + audio3Size );
							
							$( '#submit-audio-upload' ).prop( 'disabled', true );
							
							noty( {
								layout: 'bottomCenter',
								timeout: 3000,
								progressBar: false,
								theme: 'defaultTheme',
								text: errorMessage,
								maxVisible: 1, // [integer] you can set max visible notification count for dismissQueue true option,
								force: true,
								type: 'error',
								animation: {
									open: 'animated bounceIn', // Animate.css class names
									close: 'animated bounceOut', // Animate.css class names
									easing: 'swing', // unavailable - no need
									speed: 1000 // unavailable - no need
								}
							} );				
						}
						else {
							$( '#submit-audio-upload' ).prop( 'disabled', false );	
						}			
					}
					
					break;
					
				default:
					$( this ).val( '' );
					
					var errorMessage = 'Not an MP3 Audio File!';
					
					console.log( errorMessage );
					
					$( '#submit-audio-upload' ).prop( 'disabled', true );
					
					noty( {
						layout: 'bottomCenter',
						timeout: 3000,
						progressBar: false,
						theme: 'defaultTheme',
						text: errorMessage,
						maxVisible: 1, // [integer] you can set max visible notification count for dismissQueue true option,
						force: true,
						type: 'error',
						animation: {
							open: 'animated bounceIn', // Animate.css class names
							close: 'animated bounceOut', // Animate.css class names
							easing: 'swing', // unavailable - no need
							speed: 1000 // unavailable - no need
						}
					} );						

					break;
			}
		}		
	} );	
	
	$( '#submit-audio-upload' ).on( 'click', function(  ) {
		$( '#submit-audio-upload' ).prop( 'disabled', true );
		
		$( '#categories-outer-box' ).css( {
			height: '0px',
			overflow: 'hidden'
		} );

		$( '#binaural-beats-box' ).css( {
			height: '0px'
		} );

		$( '#bg-music-box' ).css( {
			height: '0px'
		} );

		$( '#affirmations-box' ).css( {
			height: '0px'
		} );	

		var uploadForm = $( '#user-form' )[ 0 ]; // You need to use standard javascript object here
		var uploadFormData = new FormData( uploadForm );
			uploadFormData.appear('action', 'upload_audio');
		
		// var formData = new FormData(  );
		// formData.append( 'section', 'general' );
		// formData.append( 'action', 'previewImg' );
		// Attach file
		// formData.append( 'image', $( 'input[type=file]' )[ 0 ].files[ 0 ] );
		
		// console.log( 'uploadForm' );	
		// console.log( uploadForm );		

		// console.log( 'uploadFormData' );	
		// console.log( uploadFormData );			
		
		var addAudioToCategory = parseInt( $( '#insert-box input[type="radio"]:checked' ).val(  ) );
		var urlPrefix;
		
		if( addAudioToCategory ) {
			// urlPrefix = "https://gce-ffmpeg-server.numerologist.com/mesl/";
			urlPrefix = "http://slides.silver-solutions.com.ua/gce-ffmpeg-server/gce-ffmpeg-server/mesl/";
		}
		else {
			urlPrefix = "";
		}	
		
		console.log( 'submit-audio-upload' );

		$.ajax( {
			type: "POST",
			dataType: "json",
			crossDomain: true,
			url: ajax_var.url,//urlPrefix + "upload-audio.php",
			data: uploadFormData,
			contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
			processData: false, // NEEDED, DON'T OMIT THIS
			error: function (  ) {
				// location.reload(  );
			} 				
		} )  
			.done( function( uploadResponse ) {
				window.uploadStatus = true;
				
				if( addAudioToCategory ) {
					var search = '/home/slides/public_html';
					var replace = '';		
					
					uploadResponse.audio1.url = uploadResponse.audio1.url.replace( search, replace );
					uploadResponse.audio2.url = uploadResponse.audio2.url.replace( search, replace );
					uploadResponse.audio3.url = uploadResponse.audio3.url.replace( search, replace );
					
					$.ajax( {
						type: "POST",
						dataType: "json",
						crossDomain: true,
						url: ajax_var.url,//"add-audio.php",
						data: uploadResponse,
						error: function (  ) {
							// location.reload(  );
						} 				
					} ) 
						.done( function( additionResponse ) {
							var errorMessage;
							
							if( additionResponse.data.result ) {
								errorMessage = 'Audio Successfully Added!';								
								
								// var categoryID = $( '#categories' )[ 0 ].value;
								
								// setCategoryData( categoryID );								
								
								$( '#submit-audio-upload' ).prop( 'disabled', false );
							}
							else {
								errorMessage = 'Error!';
							}
							
							noty( {
								layout: 'bottomCenter',
								timeout: 3000,
								progressBar: false,
								theme: 'defaultTheme',
								text: errorMessage,
								maxVisible: 1, // [integer] you can set max visible notification count for dismissQueue true option,
								force: true,
								type: 'error',
								animation: {
									open: 'animated bounceIn', // Animate.css class names
									close: 'animated bounceOut', // Animate.css class names
									easing: 'swing', // unavailable - no need
									speed: 1000 // unavailable - no need
								}
							} );							
						} );							
				}				
				
				window.uploadResponse = uploadResponse;
				
				console.log( 'uploadResponse' );	
				console.log( uploadResponse );					
				
				window.maxDuration = 0;
				
				$( '.music-duration' ).remove(  );
				
				$( '.music-box input[type="radio"]' ).trigger( 'change' );
				
				if( uploadResponse.audio1.url ) {
					window.binauralBeatPlayer.jPlayer( 
						"setMedia", 
						{ mp3: uploadResponse.audio1.url } 
					);	

					$( 
						'<span class="music-duration">' +
							uploadResponse.audio1.duration.toString(  ).toHHMMSS(  ) +
						'</span>'
					).insertAfter( '#audio1' );
				}
				else {
					$( 
						'<span class="music-duration"></span>'
					).insertAfter( '#audio1' );					
				}
				
				if( uploadResponse.audio2.url ) {
					window.bgMusicPlayer.jPlayer( 
						"setMedia", 
						{ mp3: uploadResponse.audio2.url } 
					);	

					$( 
						'<span class="music-duration">' +
							uploadResponse.audio2.duration.toString(  ).toHHMMSS(  ) +
						'</span>'
					).insertAfter( '#audio2' );
				}
				else {
					$( 
						'<span class="music-duration"></span>'
					).insertAfter( '#audio2' );					
				}				

				if( uploadResponse.audio3.url ) {
					window.affirmationPlayer.jPlayer( 
						"setMedia", 
						{ mp3: uploadResponse.audio3.url } 
					);	

					$( 
						'<span class="music-duration">' +
							uploadResponse.audio3.duration.toString(  ).toHHMMSS(  ) +
						'</span>'
					).insertAfter( '#audio3' );
				}	
				else {
					$( 
						'<span class="music-duration"></span>'
					).insertAfter( '#audio3' );					
				}				
				
				$( '#mix-audio' ).removeAttr( 'disabled' );
				$( '#save-mix' ).removeAttr( 'disabled' );

			} );			
	} );
	
	$( '#save-mix' ).on( 'click', function(  ) {

				console.log('1');
		var mixName = $( "#mix-name" )[ 0 ].value;
		mixName = mixName.trim(  );
		
		var replaceableCharacters = /\s+/gi;
		var replacement = ' ';
		mixName = mixName.replace( replaceableCharacters, replacement );	

		window.mixName = mixName || 'audio-mix';
		
		$( '#save-mix span' )
			.css( {
				opacity: '0'
			} )
			.removeClass( 'glyphicon-save' )
			.css( {
				opacity: '1'
			} )					
			.addClass( 'glyphicon-record animated flash' );
		
		var mixAudioData = {  };	   
		mixAudioData.platform = platform;
		mixAudioData.mixName = mixName;
		mixAudioData.action = 'mixAudioData';
				
				console.log('22');
		/* Temporary */
		
		if( ! window.uploadStatus ) {
			var category = $( '#categories' )[ 0 ].value;
			
			var binauralBeat = $( '.music-box input[name="binaural-beat"]:checked' ).val(  ) || '';
			var bgMusic = $( '.music-box input[name="bg-music"]:checked' ).val(  ) || '';
			var affirmation = $( '.music-box input[name="affirmation"]:checked' ).val(  ) || '';		
			
			var binauralBeatURL;
			var binauralBeatDuration;
			
			if( binauralBeat ) {
				binauralBeatURL = window.mixerAudioDirURL + category + '/binaural-beats/' + binauralBeat;
				binauralBeatDuration = $( '.music-box input[name="binaural-beat"]:checked' ).attr( 'data-duration' );
				binauralBeatDuration = parseFloat( binauralBeatDuration );
			}
			else {
				binauralBeatURL = '';
				binauralBeatDuration = 0;
			}
			
			var bgMusicURL;
			var bgMusicDuration;
			
			if( bgMusic ) {
				bgMusicURL = window.mixerAudioDirURL + category + '/bg-music/' + bgMusic;
				bgMusicDuration = $( '.music-box input[name="bg-music"]:checked' ).attr( 'data-duration' );
				bgMusicDuration = parseFloat( bgMusicDuration );			
			}
			else {
				bgMusicURL = '';
				bgMusicDuration = 0;
			}		
			
			var affirmationURL;
			var affirmationDuration;
			
			if( affirmation ) {
				affirmationURL = window.mixerAudioDirURL + category + '/affirmations/' + affirmation;
				affirmationDuration = $( '.music-box input[name="affirmation"]:checked' ).attr( 'data-duration' );
				affirmationDuration = parseFloat( affirmationDuration );			
			}		
			else {
				affirmationURL = '';
				affirmationDuration = 0;
			}		
			
			window.uploadResponse = {
				"error": false, 
				"audio1": { 
					"url": binauralBeatURL,
					"duration": binauralBeatDuration
				},
				"audio2": {
					"url": bgMusicURL,
					"duration": bgMusicDuration
				},
				"audio3": {
					"url": affirmationURL,
					"duration": affirmationDuration
				}
			};
			
			console.log( 'window.uploadResponse' );	
			console.log( window.uploadResponse );	
		}
		
		/* END Temporary */
				console.log('3');
		
		if( ! window.uploadResponse ) {
			mixAudioData.category = $( '#categories' )[ 0 ].value;
			mixAudioData.binauralBeat = $( '.music-box input[name="binaural-beat"]:checked' ).val(  ) || '';
			mixAudioData.bgMusic = $( '.music-box input[name="bg-music"]:checked' ).val(  ) || '';
			mixAudioData.affirmation = $( '.music-box input[name="affirmation"]:checked' ).val(  ) || '';
		}
		else {
			mixAudioData.category = '';
			
			if( window.uploadResponse.audio1.url ) {
				mixAudioData.binauralBeat = ( 
					window.location.protocol + 
					'//' + 
					window.location.hostname + 
					window.uploadResponse.audio1.url 
				);
			}
			else {
				mixAudioData.binauralBeat = '';
			}
			
			if( window.uploadResponse.audio2.url ) {
				mixAudioData.bgMusic = ( 
					window.location.protocol + 
					'//' + 
					window.location.hostname + 
					window.uploadResponse.audio2.url 
				);
			}
			else {
				mixAudioData.bgMusic = '';
			}

			if( window.uploadResponse.audio3.url ) {
				mixAudioData.affirmation = ( 
					window.location.protocol + 
					'//' + 
					window.location.hostname + 
					window.uploadResponse.audio3.url 
				);
			}
			else {
				mixAudioData.affirmation = '';
			}			
		}
		
				console.log('5');

		mixAudioData.binauralBeatVolume = window.binauralBeatPlayer.jPlayer( "option", "volume" );
		mixAudioData.bgMusicVolume = window.bgMusicPlayer.jPlayer( "option", "volume" );
		mixAudioData.affirmationVolume = window.affirmationPlayer.jPlayer( "option", "volume" );
		
		mixAudioData.mixDuration = $( '#mix-duration' )[ 0 ].value;
		mixAudioData.action = 'mix_audio';
		// mixAudioData.mixDuration = $( "#mix-duration" ).prop( "selectedIndex" );   

		var urlPrefix;
		
		if( location.hostname === "localhost" || location.hostname === "127.0.0.1" ) {
			urlPrefix = "http://slides.silver-solutions.com.ua/mesl/____/";
			urlSuffix = "-dev";				
		}
		else {
			urlPrefix = "";
			urlSuffix = "";
		}

		$.ajax( {
			type: "POST",
			dataType: "json",
			crossDomain: true,
			url: ajax_var.url, //urlPrefix + "mix-audio" + urlSuffix + ".php",
			data: mixAudioData,
			error: function (  ) {
				// location.reload(  );
			} 				
		} )  
			.done( function( mixAudioResponse ) {
				window.mixAudioResponse = mixAudioResponse.data;
				
				console.log( 'mixAudioResponse' );	
				console.log( mixAudioResponse );	 
				
				$( '#save-mix span' )
					.css( {
						opacity: '0'
					} )
					.removeClass( 'glyphicon-record animated flash' )
					.css( {
						opacity: '1'
					} )					
					.addClass( 'glyphicon-save' );
				
				$( '#download-mix-box' ).remove(  );
				
				console.log('downloadURL');

				var downloadURL = encodeURI( 
					ajax_var.template_url + '/includes/mixer/' +
					'download-mix.php?' + 
					'mix-url=' + mixAudioResponse.path + '&' +
					'mix-name=' + window.mixName + '&' +
					'mix-size=' + mixAudioResponse.size
				);
				
				$( '#save-box' ).append( 
					'<div id="download-mix-box" class="form-group col-xs-12 col-md-3 submit-form-group zero-padding-left">' +
						'<a id="download-mix" class="fadeIn animated submit-button btn btn-info form-control" href="' + downloadURL + '" target="_blank"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download</a>' +
					'</div>'
				);
				
				// $( '#download-mix' ).css( {
					// opacity: '1'
				// } );
			} );			
	} );	
	
	$( '#insert-box input[type="radio"]' ).on( 'change', function(  ) {
		// console.log( 'add-to-category change' );
		
		$( '#insert-box' ).css( {
			height: '0px',
			opacity: '0',
			visibility: 'hidden'
		} );			
		
		$( '.audio-upload-btn' ).removeAttr( 'disabled' );
		
		var addToCategory = $( this ).val(  );
		
		addToCategory = parseInt( addToCategory );
		
		// console.log( 'addToCategory: ' + addToCategory );
		
		var urlPrefix;
		
		if( addToCategory ) {
			// urlPrefix = 'https://gce-ffmpeg-server.numerologist.com/mesl/';
			urlPrefix = '';
			
			var audioInfoHeight = $( '.audio-info-box' ).attr( 'data-initial-height' );
			
			$( '.audio-info-box' ).css( {
				height: audioInfoHeight,
				overflow: 'visible',
				opacity: '1'
			} );					
		}
		else {
			urlPrefix = '';
		}
		
		var maxAudioSize;
		
		$.ajax( {
			type: "POST",
			dataType: "json",
			crossDomain: true,
			url: ajax_var.url, //urlPrefix + "get-upload-max-filesize.php",
			data: { 'action' : 'maxAudioSize' },
			error: function (  ) {
				// location.reload(  );
			} 				
		} )  
			.done( function( response ) {
				
				maxAudioSize = response.data.upload_max_filesize;
				
				$( '#max-audio-size' ).html( maxAudioSize + 'B' );
				
				window.maxFileSize = returnBytes( maxAudioSize );
				
				// console.log( 'window.maxFileSize: ' + window.maxFileSize );
			} );			
	} );		
		
	
} );