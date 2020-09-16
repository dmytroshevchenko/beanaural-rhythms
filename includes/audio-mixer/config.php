<?php	
	function returnBytes( $val ) {
		$val = trim( $val );
		$last = strtolower( $val[ strlen( $val ) - 1 ] );
		
		switch( $last ) {
			// Модификатор 'G' доступен с PHP 5.1.0
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}

		return $val;
	}

	$projectName = 'audio-mixer';
	
	// In bytes
	$maxAudioSize = returnBytes( ini_get( 'upload_max_filesize' ) );	
	
	$constantName = 'MAX_AUDIO_SIZE';
	$constantValue = $maxAudioSize;					
	$caseInsensitive = false;
	define( $constantName, $constantValue, $caseInsensitive );	
	
	// $pathDelimiter = '\\';   
	$pathDelimiter = '/';	
	
	// $htdocsDirPath = 'c:' . $pathDelimiter . 'apache' . $pathDelimiter . '2_2' . $pathDelimiter . 'htdocs' . $pathDelimiter;	

	$htdocsDirPath = 
		$pathDelimiter . 'home' . $pathDelimiter . 'slides' . $pathDelimiter . 'public_html' . 
		$pathDelimiter . 'mesl' . $pathDelimiter . $projectName . $pathDelimiter;

	$audioDirPath = 'audio' . $pathDelimiter . $projectName . $pathDelimiter;

	$filePartsDelimiter = '-';
		  
	$constantName = 'PROJECT_NAME';
	$constantValue = $projectName;					
	$caseInsensitive = false;
	define( $constantName, $constantValue, $caseInsensitive );

	$constantName = 'HTDOCS_DIR_PATH';
	$constantValue = $htdocsDirPath;					
	$caseInsensitive = false;
	define( $constantName, $constantValue, $caseInsensitive );

	$constantName = 'AUDIO_DIR_PATH';
	$constantValue = $audioDirPath;					
	$caseInsensitive = false;
	define( $constantName, $constantValue, $caseInsensitive );		

	$constantName = 'PATH_DELIMITER';
	$constantValue = $pathDelimiter;					
	$caseInsensitive = false;
	define( $constantName, $constantValue, $caseInsensitive );

	$constantName = "FILE_PARTS_DELIMITER";
	$constantValue = $filePartsDelimiter;					
	$caseInsensitive = false;
	define( $constantName, $constantValue, $caseInsensitive );
?>