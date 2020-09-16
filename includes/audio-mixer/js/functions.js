var platform;
var browserName;
var userData; 

// var mixerAudioDirURL = "//gce-ffmpeg-server.numerologist.com/mesl/audio/audio-mixer/"; 
var mixerAudioDirURL = "/gce-ffmpeg-server/gce-ffmpeg-server/mesl/audio/audio-mixer/"; 

window.mixerAudioDirURL = mixerAudioDirURL; 		

$.fn.extend( {
	animateCss: function( animationName ) {
		var animationEnd = "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";			
		
		this.addClass( "animated " + animationName ).bind( animationEnd, function(  ) {
			$( this ).removeClass( "animated " + animationName );
			$( this ).unbind( "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend" );
		} );
	}
} );	

/**
 * Determine the mobile operating system.
 * This function either returns 'iOS', 'Android' or 'Unknown'
 * 
 * @returns {String}
 */
function getOS(  ) {
	var userAgent = navigator.userAgent || navigator.vendor || window.opera;

	if( userAgent.match( /iPad/i ) || userAgent.match( /iPhone/i ) || userAgent.match( /iPod/i ) ) {
		return "iOS";
	}
	else if( userAgent.match( /Mac/i ) ) {
		return "Mac";
	}
	else if( userAgent.match( /Android/i ) ) {
		return "Android";
	}
	else {
		return "Unknown";
	}
}

function firstToLowerCase( str ) {
  return str.substr( 0, 1 ).toLowerCase(  ) + str.substr( 1 );
}

function setSelectedOption( selectSelector, matchValue ) {
	var optionValue;
	
	$( selectSelector )
		.each( function( index ) {
			optionValue = $( this ).attr( "value" );
			
			// console.log( "optionValue:" + optionValue );
			// console.log( "typeof optionValue:" + typeof optionValue );
			// console.log( "matchValue:" + matchValue );
			// console.log( "typeof matchValue:" + typeof matchValue );   
			
			if( optionValue === matchValue ) {
				// console.log( "Select Option!" );
				
				$( selectSelector ).parent(  ).val( matchValue );
				
				return true;
			}			
		} );
} 

function saveUserInfo( userData ) {
	Cookies.set( "____UserData", userData, { expires: 365, path: '/' } );
}	

function fillUserForm(  ) {
	var userData = Cookies.getJSON( "____UserData" ); 
	
	console.log( "Cookies userData:" + userData );
	
	if( userData ) {
		$( "#user-name" )[ 0 ].value = userData.userName;	

		var userDataParts = userData.birthDate.split( "-" ); 
		var userYear = userDataParts[ 0 ];		
		var userMonth = userDataParts[ 1 ]; 
		var userDay = userDataParts[ 2 ]; 		
		
		var selectSelector = "#categories option"; 
		var matchValue = userMonth; 
		setSelectedOption( selectSelector, matchValue );	

		// selectSelector = "#binaural-beats option"; 
		// matchValue = userMonth; 
		// setSelectedOption( selectSelector, matchValue );

		// selectSelector = "#bg-music option"; 
		// matchValue = userDay; 
		// setSelectedOption( selectSelector, matchValue );	

		// selectSelector = "#affirmations option"; 
		// matchValue = userYear; 
		// setSelectedOption( selectSelector, matchValue );			
	}
}

function setAllSelectsWidth(  ) {
	var selectID = '.select-target.categories-select';
	var selectContentWrapperID = '.categories-select.select';
	setSelectWidth( selectID, selectContentWrapperID );	
	
	// selectID = '.select-target.binaural-beats-select';
	// selectContentWrapperID = '.binaural-beats-select.select';
	// setSelectWidth( selectID, selectContentWrapperID );

	// selectID = '.select-target.bg-music-select';
	// selectContentWrapperID = '.bg-music-select.select';
	// setSelectWidth( selectID, selectContentWrapperID );

	// selectID = '.select-target.affirmations-select';
	// selectContentWrapperID = '.affirmations-select.select';
	// setSelectWidth( selectID, selectContentWrapperID );

	selectID = '.select-target.audio1-category-select';
	selectContentWrapperID = '.audio1-category-select.select';
	setSelectWidth( selectID, selectContentWrapperID );
	
	selectID = '.select-target.audio1-type-select';
	selectContentWrapperID = '.audio1-type-select.select';
	setSelectWidth( selectID, selectContentWrapperID );	
	
	selectID = '.select-target.audio2-category-select';
	selectContentWrapperID = '.audio2-category-select.select';
	setSelectWidth( selectID, selectContentWrapperID );
	
	selectID = '.select-target.audio2-type-select';
	selectContentWrapperID = '.audio2-type-select.select';
	setSelectWidth( selectID, selectContentWrapperID );	

	selectID = '.select-target.audio3-category-select';
	selectContentWrapperID = '.audio3-category-select.select';
	setSelectWidth( selectID, selectContentWrapperID );
	
	selectID = '.select-target.audio3-type-select';
	selectContentWrapperID = '.audio3-type-select.select';
	setSelectWidth( selectID, selectContentWrapperID );		
	
	selectID = '.select-target.mix-duration-select';
	selectContentWrapperID = '.mix-duration-select.select';
	setSelectWidth( selectID, selectContentWrapperID );	

	window.categoriesSelect.open(  );
	window.categoriesSelect.close(  );	
	
	// window.binauralBeatsSelect.open(  );
	// window.binauralBeatsSelect.close(  );
	
	// window.bgMusicSelect.open(  );	
	// window.bgMusicSelect.close(  );	
	
	// window.affirmationsSelect.open(  );
	// window.affirmationsSelect.close(  );
	
	window.audio1CategorySelect.open(  );
	window.audio1CategorySelect.close(  );	

	window.audio1TypeSelect.open(  );
	window.audio1TypeSelect.close(  );	
	
	window.audio2CategorySelect.open(  );
	window.audio2CategorySelect.close(  );	

	window.audio2TypeSelect.open(  );
	window.audio2TypeSelect.close(  );

	window.audio3CategorySelect.open(  );
	window.audio3CategorySelect.close(  );	

	window.audio3TypeSelect.open(  );
	window.audio3TypeSelect.close(  );	

	window.mixDurationSelect.open(  );
	window.mixDurationSelect.close(  );	

	$( '.select-select' ).attr( 'tabindex', '-1' );
	$( '.select-target' ).attr( 'tabindex', '0' );
}

function setSelectWidth( selectID, selectContentWrapperID ) {
	var selectWidth = $( selectID ).outerWidth(  );
	
	$( selectContentWrapperID ).attr( 'style', 'width: ' + selectWidth + 'px' );
}

function init(  ) {

} 

String.prototype.toHHMMSS = function(  ) {
	var sec_num = parseInt(this, 10); // don't forget the second param
	var hours   = Math.floor(sec_num / 3600);
	var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
	var seconds = sec_num - (hours * 3600) - (minutes * 60);

	if (hours   < 10) {hours   = "0"+hours;}
	if (minutes < 10) {minutes = "0"+minutes;}
	if (seconds < 10) {seconds = "0"+seconds;}
	
	return hours+':'+minutes+':'+seconds;
} 

function returnBytes( val ) {
	val = val.trim(  );
	
	var last = val.substr( val.length - 1 );
	
	last = last.toLowerCase(  );
	
	switch( last ) {
		// Модификатор 'G' доступен с PHP 5.1.0
		case 'g':
			val = parseInt( val ) * 1024;
		case 'm':
			val = parseInt( val ) * 1024;
		case 'k':
			val = parseInt( val ) * 1024;
	}

	return val;
}

function setCategoryData( categoryID ) {
	window.maxDuration = 0;
	
	$( '.music-outer-box' ).remove(  );
	$( '#download-mix' ).remove(  );
	
	var currentCategoryData;	
	
	$.each( 
		window.categoriesData, 			
		
		function( index, categoryData ) {
			// console.log( index );	
			// console.log( categoryData );	
				
			if( categoryID === categoryData.id ) {
				currentCategoryData = categoryData;
			
				return false;
			}
		} 
	);

	window.currentCategoryData = currentCategoryData;
	
	$.each( 
		currentCategoryData.data.boxesSelectors, 			
		
		function( boxSelectorKey, boxSelector ) {
			// console.log( boxSelectorKey );	
			// console.log( boxSelector );	

			var musicBoxHTML = 
				'<div class="music-outer-box">';
			
			$.each( 
				currentCategoryData.data.musicData[ boxSelectorKey ], 			
				
				function( id, musicInfo ) {
					// console.log( id );	
					// console.log( musicInfo );				
						
					musicBoxHTML += 
						'<div class="music-box">' +	
							'<span data-file="' + musicInfo.file + '" data-type="' + musicInfo.type + '" class="glyphicon glyphicon-play listening-btn" aria-hidden="true"></span>' +			
							'<div class="radio-inline">' +
								'<label>' +
									'<input type="radio" name="' + musicInfo.type + '" value="' + musicInfo.file + '" data-duration="' + musicInfo.duration + '">' +
									musicInfo.name +
									' ' +
									'<span class="music-duration">' +
										musicInfo.duration.toString(  ).toHHMMSS(  ) +
									'</span>' +
								'</label>' +
							'</div>' +					
					'</div>';												
				} 
			);

			$( boxSelector ).append( musicBoxHTML );
		} 
	);	
	
	$( '.binaural-beats' ).css( {
		height: 'auto',
		visibility: 'hidden'
	} );	
	
	var binauralBeatHeight = $( '.binaural-beats' ).innerHeight(  );	
	
	// console.log( 'binauralBeatHeight: ' + binauralBeatHeight );
	
	$( '.binaural-beats' ).css( {
		height: '0px'
	} );		
	
	$( '.binaural-beats' ).css( {
		visibility: 'visible',
		height: binauralBeatHeight,
		opacity: '1'
	} );	
	
	$( '.bg-music' ).css( {
		height: 'auto',
		visibility: 'hidden'
	} );	
	
	var bgMusicHeight = $( '.bg-music' ).innerHeight(  );	
	
	// console.log( 'bgMusicHeight: ' + bgMusicHeight );
	
	$( '.bg-music' ).css( {
		height: '0px'
	} );		
	
	$( '.bg-music' ).css( {
		visibility: 'visible',
		height: bgMusicHeight,
		opacity: '1'
	} );	

	$( '.affirmations' ).css( {
		height: 'auto',
		visibility: 'hidden'
	} );	
	
	var affirmationsHeight = $( '.affirmations' ).innerHeight(  );	
	
	// console.log( 'affirmationsHeight: ' + affirmationsHeight );
	
	$( '.affirmations' ).css( {
		height: '0px'
	} );		
	
	$( '.affirmations' ).css( {
		visibility: 'visible',
		height: affirmationsHeight,
		opacity: '1'
	} );		
	
	$( '.music-outer-box' ).mCustomScrollbar( {
		axis: 'y', 
		theme: 'dark-3',
		contentTouchScroll: 50,
		advanced: {
			autoExpandHorizontalScroll: true,
			updateOnImageLoad: false, 
			updateOnContentResize: true
		}
	} );	
	
	$( '.listening-btn' ).on( 'click', function(  ) {
		console.log( 'listening-btn click' );
		
		var playState = $( this ).hasClass( 'glyphicon-play' );
		var pauseState = $( this ).hasClass( 'glyphicon-stop' );
		
		var name = $( this ).attr( 'data-file' );
		var type = $( this ).attr( 'data-type' );
		
		console.log( 'playState: ' + playState ); 
		console.log( 'pauseState: ' + pauseState ); 
		
		var binauralBeatPaused = $( '#jquery_jplayer_1' ).data(  ).jPlayer.status.paused;
		var bgMusicPaused = $( '#jquery_jplayer_2' ).data(  ).jPlayer.status.paused;
		var affirmationPaused = $( '#jquery_jplayer_3' ).data(  ).jPlayer.status.paused;
		
		// console.log( 'binauralBeatPaused: ' + binauralBeatPaused );
		// console.log( 'bgMusicPaused: ' + bgMusicPaused );
		// console.log( 'affirmationPaused: ' + affirmationPaused );		
		
		if( playState ) {			
			if( ! binauralBeatPaused ) {
				window.binauralBeatPlayer.jPlayer( 'pause' );
			}
			
			if( ! bgMusicPaused ) {
				window.bgMusicPlayer.jPlayer( 'pause' );
			}

			if( ! affirmationPaused ) {
				window.affirmationPlayer.jPlayer( 'pause' );			
			}			
						
			$( '.glyphicon-stop' )
				.removeClass( 'glyphicon-stop' )
				.addClass( 'glyphicon-play' );
			
			switch( type ) {
				case 'binaural-beat':
					window.binauralBeatPlayer.jPlayer( 
						"setMedia", 
						{ mp3: window.mixerAudioDirURL + window.currentCategoryData.id + '/' + type + 's/' + name } 
					);
					
					window.binauralBeatPlayer.jPlayer( 'play' );
					
					break;
					
				case 'bg-music':
					window.bgMusicPlayer.jPlayer( 
						"setMedia", 
						{ mp3: window.mixerAudioDirURL + window.currentCategoryData.id + '/' + type + '/' + name } 
					);
					
					window.bgMusicPlayer.jPlayer( 'play' );
					
					break;

				case 'affirmation':
					window.affirmationPlayer.jPlayer( 
						"setMedia", 
						{ mp3: window.mixerAudioDirURL + window.currentCategoryData.id + '/' + type + 's/' + name } 
					);
					
					window.affirmationPlayer.jPlayer( 'play' );
					
					break;					
			}
			
			$( this ).removeClass( 'glyphicon-play' );
			$( this ).addClass( 'glyphicon-stop' );
		}
		else if( pauseState ) {
			switch( type ) {
				case 'binaural-beat':
					if( ! binauralBeatPaused ) {
						window.binauralBeatPlayer.jPlayer( 'pause' );
					}
					
					break;
					
				case 'bg-music':
					if( ! bgMusicPaused ) {
						window.bgMusicPlayer.jPlayer( 'pause' );
					}
					
					break;

				case 'affirmation':
					if( ! affirmationPaused ) {
						window.affirmationPlayer.jPlayer( 'pause' );			
					}	
					
					break;					
			}
			
			$( this ).removeClass( 'glyphicon-stop' );
			$( this ).addClass( 'glyphicon-play' );
		}

		// console.log( 'window.binauralBeatPlayer' ); 
		// console.log( window.binauralBeatPlayer );
		
		// console.log( 'window.bgMusicPlayer' );		
		// console.log( window.bgMusicPlayer );
		
		// console.log( 'window.affirmationPlayer' );		
		// console.log( window.affirmationPlayer );	

		// console.log( '#jquery_jplayer_1 status' );		
		// console.log( $('#jquery_jplayer_1').data(  ).jPlayer.status );	
		
		// console.log( '#jquery_jplayer_2 status' );		
		// console.log( $('#jquery_jplayer_2').data(  ).jPlayer.status );	

		// console.log( '#jquery_jplayer_3 status' );		
		// console.log( $('#jquery_jplayer_3').data(  ).jPlayer.status );		

		// console.log( 'binauralBeatPlayer volume' );		
		// console.log( window.binauralBeatPlayer.jPlayer( "option", "volume" ) );	
		
		// console.log( 'bgMusicPlayer volume' );		
		// console.log( window.bgMusicPlayer.jPlayer( "option", "volume" ) );	

		// console.log( 'affirmationPlayer volume' );		
		// console.log( window.affirmationPlayer.jPlayer( "option", "volume" ) );	

		// console.log( 'binauralBeatPlayer muted' );		
		// console.log( window.binauralBeatPlayer.jPlayer( "option", "muted" ) );	
		
		// console.log( 'bgMusicPlayer muted' );		
		// console.log( window.bgMusicPlayer.jPlayer( "option", "muted" ) );	

		// console.log( 'affirmationPlayer muted' );		
		// console.log( window.affirmationPlayer.jPlayer( "option", "muted" ) );				
		
		// console.log( '+++++++++++++++++++++++++++' );		
	} );

	$( '.music-box input[type="radio"]' ).on( 'change', function(  ) {
		console.log( 'radio change' );
		
		$( '#mix-audio' ).removeAttr( 'disabled' );
		$( '#save-mix' ).removeAttr( 'disabled' );
		
		var binauralBeatPaused = $( '#jquery_jplayer_1' ).data(  ).jPlayer.status.paused;
		var bgMusicPaused = $( '#jquery_jplayer_2' ).data(  ).jPlayer.status.paused;
		var affirmationPaused = $( '#jquery_jplayer_3' ).data(  ).jPlayer.status.paused;
		
		// console.log( 'binauralBeatPaused: ' + binauralBeatPaused );
		// console.log( 'bgMusicPaused: ' + bgMusicPaused );
		// console.log( 'affirmationPaused: ' + affirmationPaused );		
	
		if( ! binauralBeatPaused ) {
			window.binauralBeatPlayer.jPlayer( 'pause' );
		}
		
		if( ! bgMusicPaused ) {
			window.bgMusicPlayer.jPlayer( 'pause' );
		}

		if( ! affirmationPaused ) {
			window.affirmationPlayer.jPlayer( 'pause' );			
		}			

		$( '#mix-audio' )
			.removeClass( 'btn-success' )
			.addClass( 'btn-warning' );
			
		$( '#mix-audio span' )
			.removeClass( 'glyphicon-stop' )
			.addClass( 'glyphicon-play' );			
		
		window.playerState = 'paused';
		
		$( '#mix-audio' )
			.off( 'click' )
			.on( 'click', function(  ) {
				if( window.playerState === 'paused' ) {
					var binauralBeat;
					var bgMusic;
					var affirmation;

					if( ! window.uploadResponse ) {
						binauralBeat = $( '.music-box input[name="binaural-beat"]:checked' ).val(  );
						bgMusic = $( '.music-box input[name="bg-music"]:checked' ).val(  );
						affirmation = $( '.music-box input[name="affirmation"]:checked' ).val(  );
					}
					else {
						binauralBeat = window.uploadResponse.audio1.url;
						bgMusic = window.uploadResponse.audio2.url;
						affirmation = window.uploadResponse.audio3.url;						
					}					
					
					// console.log( 'binauralBeat: ' + binauralBeat ); 
					// console.log( 'bgMusic: ' + bgMusic ); 
					// console.log( 'affirmation: ' + affirmation ); 
					
					var audioURL;
					
					if( binauralBeat ) {
						// console.log( "binauralBeat !== undefined" ); 
						
						audioURL = null;
						
						if( ! window.uploadResponse ) {
							audioURL = window.mixerAudioDirURL + window.currentCategoryData.id + '/binaural-beats/' + binauralBeat;
						}
						else {
							audioURL = binauralBeat;
						}
						
						window.binauralBeatPlayer.jPlayer( 
							"setMedia", 
							{ mp3: audioURL } 
						);						
						
						window.binauralBeatPlayer.jPlayer( 'play' );
					}
					
					if( bgMusic ) {
						audioURL = null;
						
						if( ! window.uploadResponse ) {
							audioURL = window.mixerAudioDirURL + window.currentCategoryData.id + '/bg-music/' + bgMusic;
						}
						else {
							audioURL = bgMusic;
						}
						
						window.bgMusicPlayer.jPlayer( 
							"setMedia", 
							{ mp3: audioURL } 
						);											
						
						window.bgMusicPlayer.jPlayer( 'play' );
					}
					
					if( affirmation ) {
						audioURL = null;
						
						if( ! window.uploadResponse ) {
							audioURL = window.mixerAudioDirURL + window.currentCategoryData.id + '/affirmations/' + affirmation;
						}
						else {
							audioURL = affirmation;
						}
						
						window.affirmationPlayer.jPlayer( 
							"setMedia", 
							{ mp3: audioURL } 
						);										
						
						window.affirmationPlayer.jPlayer( 'play' );
					}		
						
					if( window.browserName !== 'IE' ) {
						if( ! window.analyserInitStatus ) {
							window.AudioContext = window.AudioContext || window.webkitAudioContext || window.mozAudioContext;
							
							var binauralBeatJplayer = $( '#jquery_jplayer_1 audio' )[ 0 ];
							var binauralBeatCtx = new AudioContext();
							var binauralBeatAnalyser = binauralBeatCtx.createAnalyser();
							var binauralBeatAudioSrc = binauralBeatCtx.createMediaElementSource(binauralBeatJplayer);
							// we have to connect the MediaElementSource with the analyser 
							binauralBeatAudioSrc.connect(binauralBeatAnalyser);
							binauralBeatAnalyser.connect(binauralBeatCtx.destination);	
							
							var bgAudioJplayer = $( '#jquery_jplayer_2 audio' )[ 0 ];
							var bgAudioCtx = new AudioContext();
							var bgAudioAnalyser = bgAudioCtx.createAnalyser();
							var bgAudioAudioSrc = bgAudioCtx.createMediaElementSource(bgAudioJplayer);
							// we have to connect the MediaElementSource with the analyser 
							bgAudioAudioSrc.connect(bgAudioAnalyser);
							bgAudioAnalyser.connect(bgAudioCtx.destination);
							
							var affirmationJplayer = $( '#jquery_jplayer_3 audio' )[ 0 ];
							var affirmationCtx = new AudioContext();
							var affirmationAnalyser = affirmationCtx.createAnalyser();
							var affirmationAudioSrc = affirmationCtx.createMediaElementSource(affirmationJplayer);
							// we have to connect the MediaElementSource with the analyser 
							affirmationAudioSrc.connect(affirmationAnalyser);
							affirmationAnalyser.connect(affirmationCtx.destination);	
							
							// we could configure the analyser: e.g. analyser.fftSize (for further infos read the spec)
							// analyser.fftSize = 64;
							// frequencyBinCount tells you how many values you'll receive from the analyser
							// var frequencyData = new Uint8Array(analyser.frequencyBinCount);

							// we're ready to receive some data!
							var canvas = $( '#audio-waveform' )[ 0 ],
									cwidth = canvas.width,
									cheight = canvas.height - 2,
									meterWidth = 10, //width of the meters in the spectrum
									gap = 2, //gap between meters
									capHeight = 2,
									capStyle = '#E68A00',
									meterNum = 800 / (10 + 2), //count of the meters
									capYPositionArray = []; ////store the vertical position of hte caps for the preivous frame
							ctx = canvas.getContext('2d'),
							gradient = ctx.createLinearGradient(0, 0, 0, 150);
							gradient.addColorStop(1, '#5D8C8D');
							gradient.addColorStop(0.5, '#78A0A1');
							gradient.addColorStop(0, '#94B4B4');
							// loop
							function renderFrame() {
									var binauralBeatArray = new Uint8Array(binauralBeatAnalyser.frequencyBinCount);
									binauralBeatAnalyser.getByteFrequencyData(binauralBeatArray);
									var binauralBeatStep = Math.round(binauralBeatArray.length / meterNum); //sample limited data from the total array		
								
									var bgAudioArray = new Uint8Array(bgAudioAnalyser.frequencyBinCount);
									bgAudioAnalyser.getByteFrequencyData(bgAudioArray);
									var bgAudioStep = Math.round(bgAudioArray.length / meterNum); //sample limited data from the total array
									
									// console.log( 'bgAudioStep: ' + bgAudioStep );
									
									var affirmationArray = new Uint8Array(affirmationAnalyser.frequencyBinCount);
									affirmationAnalyser.getByteFrequencyData(affirmationArray);
									var affirmationStep = Math.round(affirmationArray.length / meterNum); //sample limited data from the total array
									
									// console.log( 'affirmationStep: ' + affirmationStep );			
									
									var step = bgAudioStep;
									
									ctx.clearRect(0, 0, cwidth, cheight);
									
									for (var i = 0; i < meterNum; i++) {
											var binauralBeatValue = binauralBeatArray[i * step];
											var bgAudioValue = bgAudioArray[i * step];
											var affirmationValue = affirmationArray[i * step];
											
											
											var value = binauralBeatValue || bgAudioValue || affirmationValue;
											
											if (capYPositionArray.length < Math.round(meterNum)) {
													capYPositionArray.push(value);
											};
											ctx.fillStyle = capStyle;
											//draw the cap, with transition effect
											if (value < capYPositionArray[i]) {
													ctx.fillRect(i * 12, cheight - (--capYPositionArray[i]), meterWidth, capHeight);
											} else {
													ctx.fillRect(i * 12, cheight - value, meterWidth, capHeight);
													capYPositionArray[i] = value;
											};
											ctx.fillStyle = gradient; //set the filllStyle to gradient for a better look
											ctx.fillRect(i * 12 /*meterWidth+gap*/ , cheight - value + capHeight, meterWidth, cheight); //the meter
									}
									requestAnimationFrame(renderFrame);
							};
							
							window.renderFrame = renderFrame;
							
							window.analyserInitStatus = true;
						}						
						
						$( '#audio-waveform-box' ).css( {
							height: '200px',
							marginTop: '25px',
							opacity: '1'
						} );
						
						window.renderFrame(  );
						// audio.play(  ); 						
					}		

					window.playerState = 'playing';
					
					$( '#mix-audio' )
						.removeClass( 'btn-warning' )
						.addClass( 'btn-success' );

					$( '#mix-audio span' )
						.removeClass( 'glyphicon-play' )
						.addClass( 'glyphicon-stop' );								
				}
				else if( window.playerState === 'playing' ) {
					var binauralBeatPaused = $( '#jquery_jplayer_1' ).data(  ).jPlayer.status.paused;
					var bgMusicPaused = $( '#jquery_jplayer_2' ).data(  ).jPlayer.status.paused;
					var affirmationPaused = $( '#jquery_jplayer_3' ).data(  ).jPlayer.status.paused;

					// console.log( 'binauralBeatPaused: ' + binauralBeatPaused );
					// console.log( 'bgMusicPaused: ' + bgMusicPaused );
					// console.log( 'affirmationPaused: ' + affirmationPaused );		
				
					if( ! binauralBeatPaused ) {
						window.binauralBeatPlayer.jPlayer( 'pause' );
					}
					
					if( ! bgMusicPaused ) {
						window.bgMusicPlayer.jPlayer( 'pause' );
					}

					if( ! affirmationPaused ) {
						window.affirmationPlayer.jPlayer( 'pause' );			
					}
					
					window.playerState = 'paused';
					
					$( '#mix-audio' )
						.removeClass( 'btn-success' )
						.addClass( 'btn-warning' );
						
					$( '#mix-audio span' )
						.removeClass( 'glyphicon-stop' )
						.addClass( 'glyphicon-play' );					
				}			
			} );	

			var audioDuration;
			
			if( ! window.uploadResponse ) {
				audioDuration = $( this ).attr( 'data-duration' );
				audioDuration = parseFloat( audioDuration );
			}
			else {
				var binauralBeat = window.uploadResponse.audio1.url;
				var bgMusic = window.uploadResponse.audio2.url;
				var affirmation = window.uploadResponse.audio3.url;			

				var binauralBeatDuration = 0;
				var bgMusicDuration = 0;
				var affirmationDuration = 0;					
				
				if( binauralBeat ) {
					binauralBeatDuration = window.uploadResponse.audio1.duration;
				}
				
				if( bgMusic ) {
					bgMusicDuration = window.uploadResponse.audio2.duration;
				}

				if( affirmation ) {
					affirmationDuration = window.uploadResponse.audio3.duration;
				}

				audioDuration = Math.max( binauralBeatDuration, bgMusicDuration, affirmationDuration );
			}			
			
			// window.minDuration = ( 
				// ( audioDuration < window.minDuration )
				// ?
				// audioDuration
				// :
				// window.minDuration
			// );
			
			// console.log( 'audioDuration: ' + audioDuration );
			
			if( audioDuration > window.maxDuration ) {
				window.maxDuration = audioDuration;			
				
				var inMinutesDuration = parseFloat( audioDuration / 60 );
				
				// console.log( 'inMinutesDuration: ' + inMinutesDuration );		

				// console.log( 'window.durationOptions' );	
				// console.log( window.durationOptions );	
				
				$( '#mix-duration' )
					.html( '' )
					.append( window.durationOptions );
				
				$.each( 
					durationOptions, 			
					
					function( index, currentOption ) {
						// console.log( index );	
						// console.log( currentOption );	
							
						var optionValue	= currentOption.value;
						
						optionValue = parseInt( optionValue );
						
						// console.log( 'optionValue: ' + optionValue );
							
						if( inMinutesDuration < optionValue ) {
							currentOption.remove(  );
						}
					} 
				);
			}			
	} );	
	
	// switch( categoryID ) { 
		// case 'meditation-relaxation':
			
			
			// break;		
	// }
}

var monthNames = [
	"January", 
	"February", 
	"March", 
	"April", 
	"May", 
	"June",
  "July", 
	"August", 
	"September", 
	"October", 
	"November", 
	"December"
];

// $( window ).resize( function(  ) {
	// if( window.platform === 'iOS' ) {
		// var bodyWidth = $( 'body' ).innerWidth(  );
		
		// console.log( 'bodyWidth: ' + bodyWidth );
	// }
// } );