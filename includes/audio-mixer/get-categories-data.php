<?php
	error_reporting( E_ALL );
	
	$seconds = 0;
	set_time_limit( $seconds );	
	
	date_default_timezone_set( "UTC" ); 

	require_once( 'db.php' );
	
	$typesData = array(  );
	
	$typesResult = mysqli_query( $link, "SELECT * FROM `types`" );
	
	if( $typesResult ) {
		/* fetch associative array */
		while( $typesRow = mysqli_fetch_assoc( $typesResult ) ) {
			$typesData[ $typesRow[ 'id' ] ] = array( 
				'name' => $typesRow[ 'name' ],
				'value' => $typesRow[ 'value' ]
			);
		}

		/* free result set */
		mysqli_free_result( $typesResult );			
	}
	else {
		$typesData = null;
	}	
	
	$categoriesData = array(  );
	
	$categoriesResult = mysqli_query( $link, "SELECT * FROM `categories`" );
	
	if( $categoriesResult ) {
		/* fetch associative array */
		while( $categoriesRow = mysqli_fetch_assoc( $categoriesResult ) ) {
			$categoryID = $categoriesRow[ 'id' ];
			
			$binauralBeats = array(  );
			$bgMusic = array(  );
			$affirmations = array(  );			
			
			$audioResult = mysqli_query( $link, "SELECT * FROM `audio` WHERE `category_id`='" . $categoryID . "'" );
			
			if( $audioResult ) {
				/* fetch associative array */
				while( $audioRow = mysqli_fetch_assoc( $audioResult ) ) {
					$typeID = $audioRow[ 'type_id' ];
					$typeValue = $typesData[ $typeID ][ 'value' ];
				
					switch( $typeValue ) {
						case 'binaural-beat':
							array_push( 
								$binauralBeats,
								array(
									'name' => $audioRow[ 'name' ],
									'type' => $typeValue,
									'file' => $audioRow[ 'file_name' ],
									'duration' => floatval( $audioRow[ 'duration' ] )
								)									
							);
							
							break;
						case 'bg-music':
							array_push( 
								$bgMusic,
								array(
									'name' => $audioRow[ 'name' ],
									'type' => $typeValue,
									'file' => $audioRow[ 'file_name' ],
									'duration' => floatval( $audioRow[ 'duration' ] )
								)									
							);
							
							break;
						case 'affirmation':
							array_push( 
								$affirmations,
								array(
									'name' => $audioRow[ 'name' ],
									'type' => $typeValue,
									'file' => $audioRow[ 'file_name' ],
									'duration' => floatval( $audioRow[ 'duration' ] )
								)									
							);
							
							break;							
					}
				}

				/* free result set */
				mysqli_free_result( $audioResult );			
			}
			else {
				$audioData = null;
			}			
			
			$categoryInfo = array( 
				'name' => $categoriesRow[ 'name' ],
				'id' => $categoriesRow[ 'dir_name' ],
				'data' => array( 
					'boxesSelectors' => array( 
						'binauralBeats' => '#binaural-beats-box',
						'bgMusic' => '#bg-music-box',
						'affirmations' => '#affirmations-box'
					),
					'musicData' => array( 
						'binauralBeats' => $binauralBeats,
						'bgMusic' => $bgMusic,
						'affirmations' => $affirmations
					)
				)
			);
			
			array_push( $categoriesData, $categoryInfo );
		}

		/* free result set */
		mysqli_free_result( $categoriesResult );			
	}
	else {
		$categoriesData = null;
	}	
	
	mysqli_close( $link );
	
	echo json_encode( $categoriesData );
?>