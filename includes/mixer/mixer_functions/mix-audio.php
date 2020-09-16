<?php
//	error_reporting( E_ALL );



add_action('wp_ajax_nopriv_mix_audio', 'mix_audio');
add_action('wp_ajax_mix_audio', 'mix_audio');


if (!function_exists('mix_audio')) {
	function mix_audio() {




		// $mixAudioResponse = array( 
			// 'path' => 'http://cdn.numerologist.com/silver-solutions/your-element-of-feng-shui/audio/bg.mp3'
		// );		
		// echo json_encode( $mixAudioResponse );
		// exit;	

		// Delete on production
		$header = "Access-Control-Allow-Origin: *";
		$replace = true;
		header( $header, $replace );
		// END Delete on production	

		$seconds = 0;
		set_time_limit( $seconds );	
		require_once( '..' . PATH_DELIMITER .'classes' . PATH_DELIMITER . 'Google' . PATH_DELIMITER . 'autoload.php' );
		require_once( '..' . PATH_DELIMITER .'classes' . PATH_DELIMITER . 'JsSlideshow.class.php' );
		require_once( '..' . PATH_DELIMITER .'classes' . PATH_DELIMITER . 'getid3' . PATH_DELIMITER . 'getid3.php' );

		$slideShow = new JsSlideshow( '//cdn.numerologist.com/silver-solutions/' . PROJECT_NAME . '/img/bg.png', 640, 480 );	
		
		$platform = $_POST[ 'platform' ];	
		$mixName = $_POST[ 'mixName' ];		
		$category = $_POST[ 'category' ];
		
		$binauralBeat = $_POST[ 'binauralBeat' ];
		$bgMusic = $_POST[ 'bgMusic' ];
		$affirmation = $_POST[ 'affirmation' ];
		
		$binauralBeatVolume = $_POST[ 'binauralBeatVolume' ];
		$bgMusicVolume = $_POST[ 'bgMusicVolume' ];
		$affirmationVolume = $_POST[ 'affirmationVolume' ];
		
		$mixDuration = $_POST[ 'mixDuration' ];
		// to seconds   
		$mixDuration *= 60;
		
		$audioDirPath = 'audio' . PATH_DELIMITER . PROJECT_NAME . PATH_DELIMITER;		

		$uniqueID = $slideShow->getID(  );	
		$fullOutputFilePath = 'slides/' . $uniqueID . '/sound.mp3';	
		
		if( 
			$binauralBeat and
			$bgMusic and
			$affirmation
		) {
			if( $category ) {
				$joinAudioCommand = 
					' -y' . 
					' -i ' . AUDIO_DIR_PATH . $category . PATH_DELIMITER . 'binaural-beats' . PATH_DELIMITER . $binauralBeat . 
					' -t ' . $mixDuration .
					' -i ' . AUDIO_DIR_PATH . $category . PATH_DELIMITER . 'bg-music' . PATH_DELIMITER . $bgMusic . 
					' -t ' . $mixDuration . 
					' -i ' . AUDIO_DIR_PATH . $category . PATH_DELIMITER . 'affirmations' . PATH_DELIMITER . $affirmation . 
					' -t ' . $mixDuration . 	
					' -filter_complex "' . 
					'[0:a]volume=' . $binauralBeatVolume . '[a0]; ' . 
					'[1:a]volume=' . $bgMusicVolume . '[a1]; ' . 
					'[2:a]volume=' . $affirmationVolume . '[a2]; ' . 
					'[a0][a1][a2]amix=inputs=3[out]" -map "[out]" ' . 
					$fullOutputFilePath;
			}
			else {
				$joinAudioCommand = 
					' -y' . 
					' -i ' . $binauralBeat . 
					' -t ' . $mixDuration .
					' -i ' . $bgMusic . 
					' -t ' . $mixDuration . 
					' -i ' . $affirmation . 
					' -t ' . $mixDuration . 	
					' -filter_complex "' . 
					'[0:a]volume=' . $binauralBeatVolume . '[a0]; ' . 
					'[1:a]volume=' . $bgMusicVolume . '[a1]; ' . 
					'[2:a]volume=' . $affirmationVolume . '[a2]; ' . 
					'[a0][a1][a2]amix=inputs=3[out]" -map "[out]" ' . 
					$fullOutputFilePath;
			}		
		}
		else if( 
			( $binauralBeat and $bgMusic ) or
			( $binauralBeat and $affirmation ) or	
			( $bgMusic and $affirmation )
			) {
			if( $category ) {
				$joinAudioCommand = 
					' -y' . 
					(
						$binauralBeat
						?
						(
							' -i ' . AUDIO_DIR_PATH . $category . PATH_DELIMITER . 'binaural-beats' . PATH_DELIMITER . $binauralBeat . 
							' -t ' . $mixDuration
						)
						:
						''
					) .
					(
						$bgMusic
						?
						(
							' -i ' . AUDIO_DIR_PATH . $category . PATH_DELIMITER . 'bg-music' . PATH_DELIMITER . $bgMusic . 
							' -t ' . $mixDuration
						)
						:
						''
					) .
					(
						$affirmation
						?
						(
							' -i ' . AUDIO_DIR_PATH . $category . PATH_DELIMITER . 'affirmations' . PATH_DELIMITER . $affirmation . 
							' -t ' . $mixDuration
						)
						:
						''
					);
			}
			else {
				$joinAudioCommand = 
					' -y' . 
					(
						$binauralBeat
						?
						(
							' -i ' . $binauralBeat . 
							' -t ' . $mixDuration
						)
						:
						''
					) .
					(
						$bgMusic
						?
						(
							' -i ' . $bgMusic . 
							' -t ' . $mixDuration
						)
						:
						''
					) .
					(
						$affirmation
						?
						(
							' -i ' . $affirmation . 
							' -t ' . $mixDuration
						)
						:
						''
					);
				}			
				
				$joinAudioCommand .=
					' -filter_complex "';

				if( $binauralBeat ) {
					$joinAudioCommand .=
						'[0:a]volume=' . $binauralBeatVolume . '[a0]; ';
				}
				
				if( ( ! $binauralBeat ) and $bgMusic ) {
					$joinAudioCommand .=
						'[0:a]volume=' . $bgMusicVolume . '[a0]; ';
				}	

				if( $binauralBeat and $bgMusic ) {
					$joinAudioCommand .=
						'[1:a]volume=' . $bgMusicVolume . '[a1]; ';
				}			

				if( $affirmation ) {
					$joinAudioCommand .=
						'[1:a]volume=' . $affirmationVolume . '[a1]; ';
				}		
				
				$joinAudioCommand .=
					'[a0][a1]amix=inputs=2[out]" -map "[out]" ' . 
					$fullOutputFilePath;
		}
		else if( 
			$binauralBeat or 
			$bgMusic or 
			$affirmation 
			) {
			if( $category ) {
				$joinAudioCommand = 
					' -y' . 
					(
						$binauralBeat
						?
						(
							' -i ' . AUDIO_DIR_PATH . $category . PATH_DELIMITER . 'binaural-beats' . PATH_DELIMITER . $binauralBeat . 
							' -t ' . $mixDuration
						)
						:
						''
					) .
					(
						$bgMusic
						?
						(
							' -i ' . AUDIO_DIR_PATH . $category . PATH_DELIMITER . 'bg-music' . PATH_DELIMITER . $bgMusic . 
							' -t ' . $mixDuration
						)
						:
						''
					) .
					(
						$affirmation
						?
						(
							' -i ' . AUDIO_DIR_PATH . $category . PATH_DELIMITER . 'affirmations' . PATH_DELIMITER . $affirmation . 
							' -t ' . $mixDuration
						)
						:
						''
					);
			}
			else {
				$joinAudioCommand = 
					' -y' . 
					(
						$binauralBeat
						?
						(
							' -i ' . $binauralBeat . 
							' -t ' . $mixDuration
						)
						:
						''
					) .
					(
						$bgMusic
						?
						(
							' -i ' . $bgMusic . 
							' -t ' . $mixDuration
						)
						:
						''
					) .
					(
						$affirmation
						?
						(
							' -i ' . $affirmation . 
							' -t ' . $mixDuration
						)
						:
						''
					);			
			}

			$joinAudioCommand .=
				' -filter_complex "';

				if( $binauralBeat ) {
					$joinAudioCommand .=
						'[0:a]volume=' . $binauralBeatVolume . '[a0]; ';
				}
				
				if( $bgMusic ) {
					$joinAudioCommand .=
						'[0:a]volume=' . $bgMusicVolume . '[a0]; ';
				}	

				if( $affirmation ) {
					$joinAudioCommand .=
						'[0:a]volume=' . $affirmationVolume . '[a0]; ';
				}		
				
				$joinAudioCommand .=
					'[a0]amix=inputs=1[out]" -map "[out]" ' . 
					$fullOutputFilePath;
		}	
		
		// $joinAudioCommand = ' -y -i http://slides.silver-solutions.com.ua/features-igor/mesl/audio/hi-name/hi-blair.mp3 -c copy ' . $fullOutputFilePath;
		
		// $joinAudioCommand = ' -y -i http://slides.silver-solutions.com.ua/mesl/audio/your-element-of-feng-shui/Scene_11.mp3 -t 60 -i http://slides.silver-solutions.com.ua/mesl/audio/your-element-of-feng-shui/Scene_18.mp3 -t 60 -i http://slides.silver-solutions.com.ua/mesl/audio/your-element-of-feng-shui/Scene_24.mp3 -t 60 -shortest -filter_complex "[0:a]volume=0.8[a0]; [1:a]volume=0.8[a1]; [2:a]volume=0.8[a2]; [a0][a1][a2]amix=inputs=3[out]" -map "[out]" ' . $fullOutputFilePath;
			
		$fp = fopen( 'debug.txt', 'w+' );
		fwrite( $fp, $fullOutputFilePath . "\n" );
		fwrite( $fp, $joinAudioCommand . "\n" );
		fclose( $fp );				  
				
		chdir( '..' );		
				
		$fullOutputFilePath = $slideShow->executeFFmpegCommand( $joinAudioCommand, $fullOutputFilePath, $filesList );		
		
		if( $fullOutputFilePath === false ) {
			throw new Exception( "Unable to join audio!" );
		}								

		$mixAudioPath = $slideShow->gcs[ 'url' ] . $fullOutputFilePath;
		$mixAudioSize = filesize( $fullOutputFilePath );	
		
		unlink( $fullOutputFilePath );
		
		$mixAudioResponse = array( 
			'path' => $mixAudioPath, 
			'size' => $mixAudioSize
		);	
		
//		echo json_encode( $mixAudioResponse );

		wp_send_json_success( $mixAudioResponse );

	}
}
?>