<?php

	
//	require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
//	$seconds = 0;
//	set_time_limit( $seconds );	
	
//	date_default_timezone_set( "UTC" ); 

//	require_once( 'db.php' );
	


add_action('wp_ajax_nopriv_get_categories_data', 'get_categories_data');
add_action('wp_ajax_get_categories_data', 'get_categories_data');


if (!function_exists('get_categories_data')) {
	function get_categories_data() {

	$typesData = array(  );
	
	
	$categoriesData = array(  );
	
//	$categoriesResult = mysqli_query( $link, "SELECT * FROM `categories`" );
	
//			$categoryID = $categoriesRow[ 'id' ];
			
			$binauralBeats = array(  );
			$bgMusic = array(  );
			$affirmations = array(  );			
			
//			$audioResult = mysqli_query( $link, "SELECT * FROM `audio` WHERE `category_id`='" . $categoryID . "'" );
			

/*
			if( $audioResult ) {
				// fetch associative array
				while( $audioRow = mysqli_fetch_assoc( $audioResult ) ) {
*/
				$music = get_posts( array( 'post_type' => 'music', 'numberposts'=> -1 ) );
				echo '232';
				if ( $music->have_posts() ) : while ( $music->have_posts() ) : $music->the_post();


					$typeID = $audioRow[ 'type_id' ];
					$typeValue = $typesData[ $typeID ][ 'value' ];
				
					$typeValue = get_the_terms( get_the_ID(), 'music_cat' )[0];

					switch( $typeValue->slug ) {
						case 'binaural-beats':
							array_push( 
								$binauralBeats,
								array(
									'name' => 'name1', //$audioRow[ 'name' ],
									'type' => 'type1', //$typeValue,
									'file' => 'file1',// $audioRow[ 'file_name' ],
									'duration' => 'duration1',// floatval( $audioRow[ 'duration' ] )
								)									
							);
							
							break;
						case 'collection-of-music':
							array_push( 
								$bgMusic,
								array(
									'name' => 'name2', //$audioRow[ 'name' ],
									'type' => 'type2', //$typeValue,
									'file' => 'file2',// $audioRow[ 'file_name' ],
									'duration' => 'duration2',// floatval( $audioRow[ 'duration' ] )
								)									
							);
							
							break;
						case 'powerful-affirmations':
							array_push( 
								$affirmations,
								array(
									'name' => 'name3', //$audioRow[ 'name' ],
									'type' => 'type3', //$typeValue,
									'file' => 'file3',// $audioRow[ 'file_name' ],
									'duration' => 'duration3',// floatval( $audioRow[ 'duration' ] )
								)									
							);
							
							break;
						}						
					endwhile;
//					}
//				}

				/* free result set */
//				mysqli_free_result( $audioResult );			
			else:
				$audioData = null;
			endif;		

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

			
		wp_send_json_success( $categoryInfo );
	}
}
			
//			array_push( $categoriesData, $categoryInfo );
		

		/* free result set */	

	
?>