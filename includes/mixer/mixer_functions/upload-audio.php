<?php
	error_reporting( E_ALL );
	
	function uploadFile( $getID3, $fileInfo, $targetDIR, $targetName ) {
		$targetFile = $targetDIR . basename( $fileInfo[ "name" ] );
		$uploadStatus;
		$fileType = strtolower( pathinfo( $targetFile, PATHINFO_EXTENSION ) );
		
		// Check if file is a actual audio or fake audio
		$audioInfo = $getID3->analyze( $fileInfo[ "tmp_name" ] );
		
		// echo '<pre>';
		// print_r( $audioInfo[ 'fileformat' ] );
		// echo '</pre>';			
		
		if( $audioInfo[ 'fileformat' ] === 'mp3' ) {
			// echo "File is an audio - " . $audioInfo[ 'fileformat' ] . ".";
			
			$uploadStatus = true;
		} 
		else {
			// echo "File is not an audio.";
			
			$uploadStatus = false;
		}
		
		// Allow certain file formats
		if( $fileType !== "mp3" ) {
			// echo "Sorry, only MP3 files are allowed.";
			
			$uploadStatus = false;
		}
		
		$targetFile = $targetDIR . $targetName;
			
		// Check if file already exists
		if( file_exists( $targetFile ) ) {
			// echo "Sorry, file already exists.";
			
			$uploadStatus = false;
		}
		
		// Check file size
		if( $fileInfo[ "size" ] > MAX_AUDIO_SIZE ) {
			// echo "Sorry, your file is too large.";
			
			$uploadStatus = false;
		}
		
		// Check if $uploadStatus is set to false by an error
		
		if( ! $uploadStatus ) {
			// echo "Sorry, your file was not uploaded.";
			
			$uploadResponse = array( 
				'error' => true
			);		
		} 
		else {
			// if everything is ok, try to upload file	
			
			if( move_uploaded_file( $fileInfo[ "tmp_name" ], $targetFile ) ) {
				// echo "The file audio1 has been uploaded.";
				
				$search = '/home/slides/public_html';
				$replace = '';
				
				$uploadResponse = array( 
					'error' => false,
					basename( $targetName, '.mp3' ) => array( 
						'url' => str_replace( $search, $replace, $targetFile ),
						'duration' => $audioInfo[ 'playtime_seconds' ]
					)
				);			
			} 
			else {
				// echo "Sorry, there was an error uploading your file.";
				
				$uploadResponse = array( 
					'error' => true
				);				
			}
		}

		return $uploadResponse;
	}
	
	function getID(  ) {
		$salt = time(  );
		
		return md5( session_id(  ).rand(  ) ).md5( $salt.rand(  ) );
	}	
	



add_action('wp_ajax_nopriv_upload_audio', 'upload_audio');
add_action('wp_ajax_upload_audio', 'upload_audio');


if (!function_exists('upload_audio')) {
	function upload_audio() {


		// Delete on production
		$header = "Access-Control-Allow-Origin: *";
		$replace = true;
		header( $header, $replace );
		// END Delete on production	

		$seconds = 0;
		set_time_limit( $seconds );	
		
		require_once( 'config.php' );
		require_once( '..' . PATH_DELIMITER .'classes' . PATH_DELIMITER . 'getid3' . PATH_DELIMITER . 'getid3.php' );			
		
		$getID3 = new \getID3;	
			
		// echo '<pre>';
		// print_r( $_FILES );
		// echo '</pre>';		
			
		$uniqueID = getID(  );	
			
		$targetDIR = "/home/slides/public_html/features-igor/mesl/slides/" . $uniqueID . '/';
		$mode = 0755;
		
		mkdir( $targetDIR, $mode );	
		
		$uploadResponse = array(  );
		
		foreach( $_FILES as $key => $fileProperties ) {
			if( $fileProperties[ "size" ] ) {
				$fileInfo = $fileProperties;
				$targetName = $key . ".mp3";
				$response = uploadFile( $getID3, $fileInfo, $targetDIR, $targetName );
				
				$uploadResponse = array_merge( $uploadResponse, $response );
			}
		}
		
		if( ! $uploadResponse[ 'audio1' ] ) {
			$response = array( 
				'audio1' => array( 
					'url' => '',
					'duration' => 0
				)
			);
			
			$uploadResponse = array_merge( $uploadResponse, $response );
		}
		
		if( ! $uploadResponse[ 'audio2' ] ) {
			$response = array( 
				'audio2' => array( 
					'url' => '',
					'duration' => 0
				)
			);
			
			$uploadResponse = array_merge( $uploadResponse, $response );
		}

		if( ! $uploadResponse[ 'audio3' ] ) {
			$response = array( 
				'audio3' => array( 
					'url' => '',
					'duration' => 0
				)
			);
			
			$uploadResponse = array_merge( $uploadResponse, $response );
		}	
			
		// $fp = fopen( 'debug.txt', 'w+' );
		// fwrite( $fp, $fullOutputFilePath . "\n" );
		// fwrite( $fp, $joinAudioCommand . "\n" );
		// fclose( $fp );				  
				
		// chdir( '..' );		
		
		// unlink( $fullOutputFilePath );
		
		// $uploadResponse = array( 
			// 'path' => $mixAudioPath
		// );	
		
		echo json_encode( $uploadResponse );
	}
}
?>