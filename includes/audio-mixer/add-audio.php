<?php
	error_reporting( E_ALL );
	
	function addAudio( $link, $audioInfo ) {
		$queryResult = mysqli_query( $link, "SELECT `id` FROM `categories` WHERE `dir_name`='" . $audioInfo[ 'category' ] . "'" );
		
		if( $queryResult ) {
			/* fetch associative array */
			$result = mysqli_fetch_row( $queryResult );
			$categoryID = mysqli_real_escape_string( $link, $result[ 0 ] );
			
			/* free result set */
			mysqli_free_result( $queryResult );	
			
			$queryResult = mysqli_query( $link, "SELECT `id` FROM `types` WHERE `value`='" . $audioInfo[ 'type' ] . "'" );
			
			if( $queryResult ) {
				/* fetch associative array */
				$result = mysqli_fetch_row( $queryResult );
				$typeID = mysqli_real_escape_string( $link, $result[ 0 ] );
				
				/* free result set */
				mysqli_free_result( $queryResult );	
				
				// var_dump( $categoryID );
				// var_dump( $typeID );
				
				$name = mysqli_real_escape_string( $link, $audioInfo[ 'name' ] );
				$duration = mysqli_real_escape_string( $link, floatval( $audioInfo[ 'duration' ] ) );
				$fileName = mysqli_real_escape_string( $link, basename( $audioInfo[ 'url' ] ) );
				
				$result = mysqli_query(
					$link, 
					"INSERT INTO `audio` (`id`, `name`, `category_id`, `type_id`, `duration`, `file_name`) VALUES (NULL, '" . $name . "', '" . $categoryID . "', '" . $typeID . "', '" . $duration . "', '" . $fileName . "')",
					MYSQLI_USE_RESULT
				);
				
				// var_dump( $result );
				
				$response = array( 
					'result' => $result 
				);				
			}
			else {
				$response = false;
			}			
		}
		else {
			$response = false;
		}	

		return $response;
	}
	
	$seconds = 0;
	set_time_limit( $seconds );	
	
	date_default_timezone_set( "UTC" ); 
	
	$audio1Info = $_POST[ 'audio1' ];	
	$audio2Info = $_POST[ 'audio2' ];	
	$audio3Info = $_POST[ 'audio3' ];	

	// var_dump( $audio1Info );
	// var_dump( $audio2Info );
	// var_dump( $audio3Info );

	if( 
		boolval( $audio1Info[ 'duration' ] ) or
		boolval( $audio2Info[ 'duration' ] ) or
		boolval( $audio3Info[ 'duration' ] )
		) {
		// var_dump( $audio1Info[ 'category' ] );
		// var_dump( $audio1Info[ 'type' ] );
		// var_dump( $audio1Info[ 'name' ] );
		// var_dump( $audio1Info[ 'duration' ] );
		// var_dump( basename( $audio1Info[ 'url' ] ) );
			
		require_once( 'db.php' );
		
		if( boolval( $audio1Info[ 'duration' ] ) ) {		
			$response = addAudio( $link, $audio1Info );
		}

		if( boolval( $audio2Info[ 'duration' ] ) ) {		
			$response = addAudio( $link, $audio2Info );
		}

		if( boolval( $audio3Info[ 'duration' ] ) ) {		
			$response = addAudio( $link, $audio3Info );
		}		
	}
	else {
		$response = false;
	}	
	
	mysqli_close( $link );
	
	echo json_encode( $response );
?>